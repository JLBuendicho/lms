@inject('studentBktService', 'App\Services\StudentBktService')
@inject('subjectService', 'App\Services\SubjectService')

<x-layouts::subjects>
    @php
        $subject = $skill->topic->domain->subject;
        $progress = $studentBktService->getStudentSkillMastery(auth()->user()->id, $skill->id) * 100;
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
        <flux:breadcrumbs.item href="{{ route('skill.learning-materials', ['skillId' => $skill->id]) }}">
            {{ $skill->name }}
        </flux:breadcrumbs.item>
    </x-slot:breadCrumbs>
    <x-slot:subjectName>{{ $subject->name }}</x-slot:subjectName>
    <div class="h-full w-full">
        <flux:card class="w-full h-full flex flex-col gap-2 bg-zinc-100 shadow-sm">
            <div class="grid grid-cols-3 w-full items-center">
                <span class="col-span-2 text-2xl font-bold">{{ $skill->name }}</span>
                <div x-data="{ display: 0, target: {{ $progress }} }" x-init="setTimeout(() => display = target, 100)" class="col-span-1">
                    <flux:progress x-bind:value="display"
                        color="{{ $progress >= 80 ? 'green' : ($progress >= 65 ? 'yellow' : 'red') }}" />
                    <div class="text-xs text-right text-zinc-500">
                        {{ round($progress) }}%
                    </div>
                </div>
            </div>

            <div class="w-full h-full flex flex-wrap gap-1 p-2 overflow-y-auto bg-zinc-50 border rounded-xl">
                @foreach ($lessons as $lesson)
                    <a class="w-1/4 h-1/4" href="{{ route('learning-materials.resource', ['skillId' => $skill->id, 'lessonId' => $lesson->id]) }}">
                        <flux:card
                            class="w-full h-full flex justify-center items-center overflow-hidden p-2 bg-zinc-100 hover:border-2 hover:shadow-sm">
                            <flux:heading level="2" class="p-2 text-center">
                                {{ $lesson->title }}
                            </flux:heading>
                        </flux:card>
                    </a>
                @endforeach
            </div>

            <div class="flex justify-end items-end px-2">
                <flux:button
                    href="{{ route('subject.topic.page', ['subjectId' => $subject->id, 'topicId' => $skill->topic->id]) }}"
                    variant="primary" color="red">
                    Return
                </flux:button>
            </div>
        </flux:card>
    </div>
</x-layouts::subjects>
