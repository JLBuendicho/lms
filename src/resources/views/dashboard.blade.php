@inject('studentBktService', 'App\Services\StudentBktService')
@inject('subjectService', 'App\Services\SubjectService')

<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-screen w-full flex-1 flex-col gap-4 rounded-xl p-8">
        <flux:heading size="xl" class="text-5xl">
            Welcome back, {{ auth()->user()->name }}!
        </flux:heading>
        <div class="h-full flex flex-col gap-4 bg-zinc-100 rounded-xl border border-zinc-200 p-6 shadow-sm">
            <flux:heading size="xl" level="2" class="w-full">
                Your Enrolled Subjects
            </flux:heading>
            <div class="w-full h-full flex flex-wrap gap-2">
                @foreach ($subjectService->getStudentSubjects(auth()->user()->id) as $subject)
                    <a href="{{ route('subject.page', ['subjectId' => $subject->id]) }}">
                        <flux:card class="min-w-1/4 h-3/4 p-4 flex flex-col gap-1 justify-center items-center shadow-sm hover:border-slate-300 hover:border-2 hover:shadow-md">
                            <div class="grid grid-cols-3 w-full items-start px-2">
                                <flux:heading size="lg" class="col-span-1 pr-2">{{ $subject->name }}</flux:heading>
                                <x-colored-progress-bar class="col-span-2 pt-2"
                                    progress="{{ $studentBktService->getStudentSubjectMastery(auth()->user()->id, 1) * 100 }}" />
                            </div>
                            <div>
                                @livewire('student-subject-mastery-chart', [
                                    'studentId' => auth()->user()->id,
                                    'subjectId' => $subject->id,
                                    'class' => 'bg-zinc-100',
                                ])
                            </div>
                        </flux:card>
                    </a>
                @endforeach
            </div>
            {{-- <x-accordion heading="Mathematics" variant="progress"
                progress="{{ $studentBktService->getStudentSubjectMastery(auth()->user()->id, 1) * 100 }}">
                <div class="grid grid-cols-3 gap-2">
                    <div class="col-span-2 flex flex-col gap-2">
                        @foreach ($subjectService->getSubjectDomains(1) as $domain)
                            <x-accordion heading="{{ $domain->name }}" variant="progress" class="bg-zinc-100"
                                progress="{{ $studentBktService->getStudentDomainMastery(auth()->user()->id, $domain->id) * 100 }}">
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="col-span-1 flex flex-col gap-2">
                                        @foreach ($subjectService->getDomainTopics($domain->id) as $topic)
                                            <x-accordion heading="{{ $topic->name }}" variant="progress"
                                                progress="{{ $studentBktService->getStudentTopicMastery(auth()->user()->id, $topic->id) * 100 }}">
                                                <span>What would you like to do?</span>
                                                <flux:button variant="primary" color="blue">Teach Me</flux:button>
                                                <flux:button variant="primary" color="green">Review Me</flux:button>
                                                <flux:button variant="primary" color="yellow">Quiz Me</flux:button>
                                            </x-accordion>
                                        @endforeach
                                    </div>
                                    @livewire('student-domain-mastery-chart', ['studentId' => auth()->user()->id, 'domainId' => $domain->id])
                                </div>
                            </x-accordion>
                        @endforeach
                    </div>
                    @livewire('student-subject-mastery-chart', ['studentId' => auth()->user()->id, 'subjectId' => 1, 'class' => 'bg-zinc-100'])
                </div>
            </x-accordion> --}}
        </div>
    </div>
</x-layouts::app>
