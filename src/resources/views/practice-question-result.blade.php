@inject('studentBktService', 'App\Services\StudentBktService')
@inject('subjectService', 'App\Services\SubjectService')

<x-layouts::subjects>
    @php
        $subject = $skill->topic->domain->subject;
    @endphp
    <x-slot:breadCrumbs>
        <flux:breadcrumbs.item href="{{ route('subject.page', ['subjectId' => $subject->id]) }}">
            {{ $skill->topic->domain->subject->name }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item
            href="{{ route('subject.domain.page', ['subjectId' => $subject->id, 'domainId' => $skill->topic->domain->id]) }}">
            {{ $skill->topic->domain->name }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item
            href="{{ route('subject.topic.page', ['subjectId' => $subject->id, 'topicId' => $skill->topic->id]) }}">
            {{ $skill->topic->name }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('questions.practice', ['skillId' => $skill->id]) }}">
            {{ $skill->name }}
        </flux:breadcrumbs.item>
    </x-slot:breadCrumbs>
    <x-slot:subjectName>{{ $subject->name }}</x-slot:subjectName>
    <div class="grid grid-cols-3 gap-2">
        <flux:card class="col-span-2 flex flex-col gap-2 justify-center items-center bg-zinc-100 shadow-sm">
            @if ($isCorrect)
                <flux:heading size="xl" level="2" class="w-full text-5xl flex justify-center items-center">
                    Congratulations!!!
                </flux:heading>
                <flux:heading size="xl" level="2" class="w-full flex justify-center items-center">
                    {{ 'You have answered correctly :>' }}
                </flux:heading>
            @else
                <flux:heading size="xl" level="2" class="w-full text-5xl flex justify-center items-center">
                    {{ 'Incorrect Answer :<' }}
                </flux:heading>
                <flux:heading size="xl" level="2" class="w-full flex justify-center items-center">
                    {{ 'Maybe next time... :>' }}
                </flux:heading>
            @endif
            <div class="flex flex-col items-end">
                <flux:heading size="lg">
                    {{ 'Previous Mastery: ' . number_format($pMastery * 100, 2) . '%' }}
                </flux:heading>
                <flux:heading size="lg">
                    {{ 'Delta Mastery: ' . ($reward > 0 ? '+' : '') . number_format($reward * 100, 2) . '%' }}
                </flux:heading>
                <flux:heading size="lg">
                    {{ $skill->name . ' Mastery: ' . number_format($nMastery * 100, 2) . '%' }}
                </flux:heading>
            </div>
            <div class="flex gap-2">
                <flux:button variant="primary" color="red"
                    href="{{ route('subject.topic.page', ['subjectId' => $subject->id, 'topicId' => $skill->topic->id]) }}">
                    Exit Practice</flux:button>
                <flux:button variant="primary" color="blue"
                    href="{{ route('questions.practice', ['skillId' => $skill->id]) }}">
                    Next</flux:button>
            </div>
        </flux:card>
        @livewire('student-topic-mastery-chart', ['studentId' => auth()->user()->id, 'topicId' => $skill->topic->id, 'class' => 'bg-zinc-100 flex flex-col justify-center items-center'])
    </div>
</x-layouts::subjects>
