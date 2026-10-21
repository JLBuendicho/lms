@inject('studentBktService', 'App\Services\StudentBktService')
@inject('subjectService', 'App\Services\SubjectService')

<x-layouts::subjects>
    <x-slot:breadCrumbs>
        <flux:breadcrumbs.item href="{{ route('subject.page', ['subjectId' => $subject->id]) }}">
            {{ $subject->name }}
        </flux:breadcrumbs.item>
    </x-slot:breadCrumbs>
    <x-slot:subjectName>{{ $subject->name }}</x-slot:subjectName>
    <div class="grid grid-cols-3 gap-2">
        {{-- <flux:card class="col-span-2 flex flex-col gap-2 bg-zinc-100 shadow-sm">
            <flux:heading size="xl" level="2" class="w-full">
                {{ 'Domains for ' . $subject->name }}
            </flux:heading>
            @foreach ($subjectService->getSubjectDomains($subject->id) as $domain)
                <a href="{{ route('subject.domain.page', ['subjectId' => $subject->id, 'domainId' => $domain->id]) }}">
                    <flux:card
                        class="w-full p-4 flex flex-col gap-1 justify-center items-center shadow-sm hover:border-slate-300 hover:border-2 hover:shadow-md">
                        <div class="grid grid-cols-3 w-full items-start px-2">
                            <flux:heading size="lg" class="col-span-1 pr-2">{{ $domain->name }}</flux:heading>
                            <x-colored-progress-bar class="col-span-2 pt-2"
                                progress="{{ $studentBktService->getStudentDomainMastery(auth()->user()->id, $domain->id) * 100 }}" />
                        </div>
                    </flux:card>
                </a>
            @endforeach
        </flux:card> --}}
        @livewire('subject.skills', ['subjectId' => $subject->id])
        <div class="flex flex-col col-span-1 gap-2">
            <flux:card class="flex flex-col justify-center items-center bg-zinc-100 shadow-sm">
                <flux:button class="w-full" variant="primary"
                    href="{{ route('student.subject.profile', ['subjectId' => $subject->id, 'userId' => auth()->user()->id]) }}"
                    target="_blank">
                    View Profile Summary</flux:button>
            </flux:card>
            @livewire('student-subject-mastery-chart', ['studentId' => auth()->user()->id, 'subjectId' => $subject->id, 'class' => 'bg-zinc-100'])
        </div>
    </div>
</x-layouts::subjects>
