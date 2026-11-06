@inject('studentBktService', 'App\Services\StudentBktService')
@inject('subjectService', 'App\Services\SubjectService')

@php
    $colorThemes = [
        'default' => [
            'bg' => 'bg-zinc-100',
            'text' => 'text-zinc-900',
        ],
        'red' => [
            'bg' => 'bg-red-900',
            'text' => 'text-zinc-200',
        ],
        'emerald' => [
            'bg' => 'bg-emerald-900',
            'text' => 'text-slate-200',
        ],
        'blue' => [
            'bg' => 'bg-blue-900',
            'text' => 'text-slate-200',
        ],
        'amber' => [
            'bg' => 'bg-amber-900',
            'text' => 'text-slate-200',
        ],
        'violet' => [
            'bg' => 'bg-violet-900',
            'text' => 'text-slate-200',
        ],
    ];
@endphp

<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-screen w-full flex-1 flex-col gap-4 rounded-xl p-8 overflow-y-auto">
        <flux:card class="bg-zinc-100 shadow-sm">
            <flux:heading size="xl" class="text-5xl">
                Welcome back, {{ auth()->user()->name }}!
            </flux:heading>
        </flux:card>
        <flux:card class="w-full h-full flex flex-col gap-4 bg-zinc-100 shadow-sm">
            @if (count($subjectService->getStudentSubjects(auth()->user()->id)) === 0 || auth()->user()->assigned_instructor_id === null)
                <div class="flex flex-col gap-4 bg-zinc-100 w-full h-full justify-center items-center">
                    <flux:heading size="xl" level="2" class="text-4xl text-center">Nothing to see here...
                        <flux:text class="text-2xl">Please wait for your enrollment to be processed</flux:text>
                    </flux:heading>
                </div>
            @else
                <flux:heading size="xl" level="2" class="w-full">
                    Your Enrolled Subjects
                </flux:heading>
                <div class="w-full h-full flex flex-wrap gap-2">
                    @if (auth()->user()->assigned_instructor_id != null)
                    @foreach ($subjectService->getStudentSubjects(auth()->user()->id) as $subject)
                        <a href="{{ route('subject.page', ['subjectId' => $subject->id]) }}">
                            <flux:card
                                class="min-w-1/4 p-4 flex flex-col gap-1 justify-center items-center shadow-sm hover:border-black hover:border hover:shadow-md">
                                <div class="grid grid-cols-3 w-full items-start px-2">
                                    <flux:heading size="lg" class="col-span-1 pr-2">{{ $subject->name }}
                                    </flux:heading>
                                    <x-colored-progress-bar class="col-span-2 pt-2"
                                        progress="{{ $studentBktService->getStudentSubjectMastery(auth()->user()->id, 1) * 100 }}" />
                                </div>
                                <div>
                                    @livewire('student-subject-mastery-chart', [
                                        'studentId' => auth()->user()->id,
                                        'subjectId' => $subject->id,
                                        'class' => 'bg-zinc-100',
                                        'subjectColor' => $subject->color ?? 'default',
                                    ])
                                </div>
                            </flux:card>
                        </a>
                    @endforeach
                    @endif
                </div>

            @endif
        </flux:card>
    </div>
</x-layouts::app>
