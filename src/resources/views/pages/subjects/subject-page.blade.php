@inject('studentBktService', 'App\Services\StudentBktService')
@inject('subjectService', 'App\Services\SubjectService')

@php
    $subjectColor = $subject->color ?? 'default';
@endphp
<x-layouts::subjects :subject-color="$subjectColor" :subject-name="$subject->name">
    <x-slot:breadCrumbs>
        <flux:breadcrumbs.item href="{{ route('subject.page', ['subjectId' => $subject->id]) }}">
            {{ $subject->name }}
        </flux:breadcrumbs.item>
    </x-slot:breadCrumbs>
    {{-- <x-slot:subjectName>{{ $subject->name }}</x-slot:subjectName> --}}
    <div class="grid grid-cols-3 gap-2">
        @livewire('subject.skills', ['subjectId' => $subject->id])
        @if ($subjectService->studentSubjectAssessmentResponseExists(auth()->id(), $subject->id, 'initial'))
            <div class="flex flex-col col-span-1 gap-2">
                <flux:card class="flex flex-col justify-center items-center bg-zinc-100 shadow-sm">
                    <flux:button class="w-full" variant="primary"
                        href="{{ route('student.subject.profile', ['subjectId' => $subject->id, 'userId' => auth()->user()->id]) }}"
                        target="_blank">
                        View Profile Summary</flux:button>
                </flux:card>
                @livewire('student-subject-mastery-chart', ['studentId' => auth()->user()->id, 'subjectId' => $subject->id, 'subjectColor' => $subjectColor, 'class' => 'bg-zinc-100'])
        @endif
    </div>
    </div>
</x-layouts::subjects>
