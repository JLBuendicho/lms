@inject('studentBktService', 'App\Services\StudentBktService')
@inject('subjectService', 'App\Services\SubjectService')

<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <flux:heading size="xl" class="text-5xl">
            Welcome back, {{ auth()->user()->name }}!
        </flux:heading>
        <div class="flex flex-col gap-4 bg-zinc-100 rounded-xl border border-zinc-200 p-6 shadow-sm">
            <flux:heading size="lg" level="2" class="w-full">
                Your Enrolled Subjects
            </flux:heading>
            <x-accordion heading="Mathematics" variant="progress"
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
            </x-accordion>
        </div>
        {{-- <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
        </div> --}}
    </div>
</x-layouts::app>
