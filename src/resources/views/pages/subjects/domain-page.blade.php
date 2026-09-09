@inject('studentBktService', 'App\Services\StudentBktService')
@inject('subjectService', 'App\Services\SubjectService')

<x-layouts::subjects>
    <x-slot:breadCrumbs>
        <flux:breadcrumbs.item href="{{ route('subject.page', ['subjectId' => $subject->id]) }}">
            {{ $subject->name }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item
            href="{{ route('subject.domain.page', ['subjectId' => $subject->id, 'domainId' => $domain->id]) }}">
            {{ $domain->name }}
        </flux:breadcrumbs.item>
    </x-slot:breadCrumbs>
    <x-slot:subjectName>{{ $subject->name }}</x-slot:subjectName>
    <div class="grid grid-cols-3 gap-2">
        <flux:card class="col-span-2 flex flex-col gap-2 bg-zinc-100 shadow-sm">
            <flux:heading size="xl" level="2" class="w-full">
                {{ 'Topics for ' . $domain->name }}
            </flux:heading>
            @foreach ($subjectService->getDomainTopics($domain->id) as $topic)
                <a href="{{ route('subject.topic.page', ['subjectId' => $subject->id, 'topicId' => $topic->id]) }}">
                    <flux:card
                        class="w-full p-4 flex flex-col gap-1 justify-center items-center shadow-sm hover:border-slate-300 hover:border-2 hover:shadow-md">
                        <div class="grid grid-cols-3 w-full items-start px-2">
                            <flux:heading size="lg" class="col-span-1 pr-2">{{ $topic->name }}</flux:heading>
                            <x-colored-progress-bar class="col-span-2 pt-2"
                                progress="{{ $studentBktService->getStudentTopicMastery(auth()->user()->id, $topic->id) * 100 }}" />
                        </div>
                    </flux:card>
                </a>
            @endforeach
        </flux:card>
        @livewire('student-domain-mastery-chart', ['studentId' => auth()->user()->id, 'domainId' => $domain->id, 'class' => 'bg-zinc-100'])
    </div>
</x-layouts::subjects>
