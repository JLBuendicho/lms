<?php

use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Skills;
use App\Models\Subjects;

new class extends Component {
    use WithPagination;

    #[Url]
    public string $topicId = '';

    public int $subjectId = 1;
    public string $sortBy = 'name';
    public string $sortDirection = 'asc';

    public function updated($property)
    {
        // Reset to page 1 whenever a filter changes
        if (in_array($property, ['topicId'])) {
            $this->resetPage();
        }
    }

    public function sort($column)
    {
        // Whitelist so users can't order by arbitrary columns
        if (!in_array($column, ['name', 'mastery'])) {
            return;
        }

        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }

        $this->resetPage();
    }

    #[Computed]
    public function getSubject()
    {
        return Subjects::find($this->subjectId);
    }

    #[Computed]
    public function skills()
    {
        $userId = auth()->id();

        return Skills::query()
            ->with(['topic.domain.subject'])
            ->whereHas('topic.domain.subject', fn($q) => $q->where('subjects.id', $this->subjectId))
            ->whereHas('masteryRecords', fn($q) => $q->where('user_id', $userId))
            ->withMax(['masteryRecords as mastery' => fn($q) => $q->where('user_id', $userId)], 'mastery')
            ->when($this->topicId, fn($q) => $q->where('topic_id', $this->topicId))
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(7);
    }
};
?>

@inject('subjectService', 'App\Services\SubjectService')
@php
    $subject = $this->getSubject($subjectId);
@endphp

<flux:card class="col-span-2 flex flex-col gap-2 bg-zinc-100 shadow-sm">
    <div class="flex justify-between items-center">
        <flux:text class="cursor-pointer" variant="strong" size="xl">Skills for {{ $subject->name }}</flux:text>
        <div class="w-1/2 flex justify-between items-center">
            <flux:text class="cursor-pointer" variant="strong">Filter by Topic</flux:text>
            <flux:select wire:model.live="topicId">
                <flux:select.option value="">All Topics</flux:select.option>
                @foreach ($subjectService->getSubjectDomains($subject->id) as $domain)
                    <flux:select.group label="{{ $domain->name }}">
                        @foreach ($subjectService->getDomainTopics($domain->id) as $topic)
                            <flux:select.option value="{{ $topic->id }}">{{ $topic->name }}</flux:select.option>
                        @endforeach
                    </flux:select.group>
                @endforeach
            </flux:select>
        </div>
    </div>
    <flux:table bleed :paginate="$this->skills">
        <flux:table.columns>
            <flux:table.column sortable :sorted="$sortBy === 'name'" :direction="$sortDirection"
                wire:click="sort('name')">Skill</flux:table.column>
            <flux:table.column sortable :sorted="$sortBy === 'mastery'" :direction="$sortDirection"
                wire:click="sort('mastery')" class="w-full">Mastery</flux:table.column>
            <flux:table.column>Actions</flux:table.column>
        </flux:table.columns>

        <flux:table.rows>
            @forelse ($this->skills as $skill)
                <flux:table.row :key="$skill->id">
                    <flux:table.cell variant="strong">{{ $skill->name }}</flux:table.cell>
                    <flux:table.cell>
                        <x-colored-progress-bar progress="{{ $skill->mastery * 100 }}" />
                    </flux:table.cell>
                    <flux:table.cell class="flex gap-2">
                        <flux:text color="blue" class="cursor-pointer" class="inline">
                            <flux:link href="{{ route('skill.learning-materials', ['skillId' => $skill->id]) }}">
                                <flux:icon.playing-cards-fan variant="micro" class="inline" />Lessons
                            </flux:link>
                        </flux:text>
                        <flux:text color="emerald" class="cursor-pointer" class="inline">
                            <flux:link href="{{ route('learning-materials.flash-card', ['skillId' => $skill->id]) }}">
                                <flux:icon.playing-cards-fan variant="micro" class="inline" />Cards
                            </flux:link>
                        </flux:text>
                        <flux:text color="yellow" class="cursor-pointer" class="inline">
                            <flux:link href="{{ route('questions.practice', ['skillId' => $skill->id]) }}">
                                <flux:icon.playing-cards-fan variant="micro" class="inline" />Practice
                            </flux:link>
                        </flux:text>
                    </flux:table.cell>
                </flux:table.row>
            @empty
                <flux:table.row>
                    <flux:table.cell colspan="2" class="text-center">No results.</flux:table.cell>
                </flux:table.row>
            @endforelse
        </flux:table.rows>
    </flux:table>
</flux:card>
{{-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci --}}
