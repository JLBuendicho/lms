@inject('studentBktService', 'App\Services\StudentBktService')
@inject('subjectService', 'App\Services\SubjectService')

<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-screen w-full flex-1 flex-col gap-4 rounded-xl p-8 overflow-y-auto">
        <flux:card class="bg-zinc-100 shadow-sm">
            <flux:heading size="xl" class="text-5xl">
                Welcome back, {{ auth()->user()->name }}!
            </flux:heading>
        </flux:card>
        <flux:card class="flex flex-col gap-4 bg-zinc-100 shadow-sm">
            <flux:heading size="xl" level="2" class="w-full">
                Your Enrolled Subjects
            </flux:heading>
            <div class="w-full h-full flex flex-wrap gap-2">
                @foreach ($subjectService->getStudentSubjects(auth()->user()->id) as $subject)
                    <a href="{{ route('subject.page', ['subjectId' => $subject->id]) }}">
                        <flux:card
                            class="min-w-1/4 p-4 flex flex-col gap-1 justify-center items-center shadow-sm hover:border-slate-300 hover:border-2 hover:shadow-md">
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
        </flux:card>
    </div>
</x-layouts::app>
