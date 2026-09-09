@inject('studentBktService', 'App\Services\StudentBktService')
@inject('subjectService', 'App\Services\SubjectService')

<x-layouts::subjects>
    <x-slot:breadCrumbs>
        <flux:breadcrumbs.item href="{{ route('subject.page', ['subjectId' => $subject->id]) }}">
            {{ $subject->name }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item
            href="{{ route('subject.domain.page', ['subjectId' => $subject->id, 'domainId' => $topic->domain->id]) }}">
            {{ $topic->domain->name }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item
            href="{{ route('subject.topic.page', ['subjectId' => $subject->id, 'topicId' => $topic->id]) }}">
            {{ $topic->name }}
        </flux:breadcrumbs.item>
    </x-slot:breadCrumbs>
    <x-slot:subjectName>{{ $subject->name }}</x-slot:subjectName>
    <div class="grid grid-cols-3 gap-2">
        <flux:card class="col-span-2 flex flex-col gap-2 bg-zinc-100 shadow-sm">
            <flux:heading size="xl" level="2" class="w-full">
                {{ 'Skills for ' . $topic->name }}
            </flux:heading>
            @foreach ($subjectService->getTopicSkills($topic->id) as $skill)
                {{-- <a>
                    <flux:card
                        class="w-full p-4 flex flex-col gap-1 justify-center items-center shadow-sm hover:border-slate-300 hover:border-2 hover:shadow-md">
                        <div class="grid grid-cols-3 w-full items-start px-2">
                            <flux:heading size="lg" class="col-span-1 pr-2">{{ $skill->name }}</flux:heading>
                            <x-colored-progress-bar class="col-span-2 pt-2"
                                progress="{{ $studentBktService->getStudentSkillMastery(auth()->user()->id, $skill->id) * 100 }}" />
                        </div>
                    </flux:card>
                </a> --}}
                <x-accordion heading="{{ $skill->name }}" variant="progress"
                    progress="{{ $studentBktService->getStudentSkillMastery(auth()->user()->id, $skill->id) * 100 }}">
                    <span>What would you like to do?</span>
                    <flux:button variant="primary" color="blue">View Lessons</flux:button>
                    <flux:button variant="primary" color="yellow">Do Practice Questions</flux:button>
                    <flux:button variant="primary" color="green">Review</flux:button>
                </x-accordion>
            @endforeach
        </flux:card>
        @livewire('student-topic-mastery-chart', ['studentId' => auth()->user()->id, 'topicId' => $topic->id, 'class' => 'bg-zinc-100'])
    </div>
</x-layouts::subjects>
