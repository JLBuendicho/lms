@inject('studentBktService', 'App\Services\StudentBktService')
@inject('subjectService', 'App\Services\SubjectService')

@php
    $subject = $skill->topic->domain->subject;

    $colorThemes = [
        'default' => [
            'bg' => 'bg-white',
            'text' => 'text-zinc-900',
        ],
        'red' => [
            'bg' => 'bg-red-300',
            'text' => 'text-zinc-200',
        ],
        'emerald' => [
            'bg' => 'bg-emerald-300',
            'text' => 'text-slate-200',
        ],
        'blue' => [
            'bg' => 'bg-blue-300',
            'text' => 'text-slate-200',
        ],
        'amber' => [
            'bg' => 'bg-amber-300',
            'text' => 'text-slate-200',
        ],
        'violet' => [
            'bg' => 'bg-violet-300',
            'text' => 'text-slate-200',
        ],
    ];

    $subjectColor = $subject->color ?? 'default';
@endphp
<x-layouts::subjects :subject-color="$subjectColor" :subject-name="$subject->name">
    <x-slot:breadCrumbs>
        <flux:breadcrumbs.item href="{{ route('subject.page', ['subjectId' => $subject->id]) }}">
            {{ $skill->topic->domain->subject->name }}
        </flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('learning-materials.flash-card', ['skillId' => $skill->id]) }}">
            {{ $skill->name }} Flash Cards
        </flux:breadcrumbs.item>
    </x-slot:breadCrumbs>
    <x-slot:subjectName>{{ $subject->name }}</x-slot:subjectName>
    {{-- <div class="grid grid-cols-3 gap-2">
        <flux:card class="col-span-2 flex flex-col gap-2 bg-zinc-100 shadow-sm">
            <flux:heading size="xl" level="2" class="w-full">
                {{ 'Flash Cards for ' . $skill->name }}
            </flux:heading>

            <div class="h-full w-full grid grid-rows-4">
                <div x-data="{ showBack: false }"
                    class="row-span-3 w-full h-full flex flex-col gap-2 justify-center items-center overflow-hidden">

                    <!-- 1. The Interactive Container (Handles sizing and click event) -->
                    <div @click="showBack = !showBack"
                        class="w-3/4 h-full max-h-[500px] cursor-pointer group [perspective:1000px]">

                        <!-- 2. The Inner Card (Applies the 3D rotation based on Alpine state) -->
                        <div class="relative w-full h-full duration-500 [transform-style:preserve-3d] shadow-sm rounded-xl border border-zinc-200 transition-all hover:border-slate-900"
                            :class="showBack ? '[transform:rotateY(180deg)]' : ''">

                            <!-- 3. FRONT SIDE -->
                            <div
                                class="absolute inset-0 h-full w-full rounded-xl {{ $colorThemes[$subjectColor]['bg'] }} p-6 flex flex-col [backface-visibility:hidden]">
                                <flux:heading size="lg" class="mb-4 text-center shrink-0">{{ $flashCard->title }}
                                </flux:heading>
                                <div class="html-content prose overflow-y-auto flex-1 w-full text-center px-2">
                                    {!! $flashCard->content_front !!}
                                </div>
                            </div>

                            <!-- 4. BACK SIDE -->
                            <div
                                class="absolute inset-0 h-full w-full rounded-xl bg-zinc-200 p-6 flex flex-col [backface-visibility:hidden] [transform:rotateY(180deg)]">
                                <flux:heading size="lg" class="mb-4 text-center shrink-0">{{ $flashCard->title }}
                                    (Answer)</flux:heading>
                                <div class="html-content prose overflow-y-auto flex-1 w-full text-center px-2">
                                    {!! $flashCard->content_back !!}
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="row-span-1 flex justify-between items-end px-2">
                    <flux:button
                        href="{{ route('subject.page', ['subjectId' => $subject->id, 'topicId' => $skill->topic->id]) }}"
                        variant="primary" color="red">
                        Return
                    </flux:button>
                    <flux:button href="{{ route('learning-materials.flash-card', ['skillId' => $skill->id]) }}"
                        variant="primary">
                        Next
                    </flux:button>
                </div>
            </div>

        </flux:card>
        @livewire('student-topic-mastery-chart', ['studentId' => auth()->user()->id, 'topicId' => $skill->topic->id, 'subjectColor' => $subjectColor, 'class' => 'bg-zinc-100 flex flex-col justify-center items-center'])
    </div> --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-2 items-start">
        <flux:card class="xl:col-span-2 flex flex-col gap-2 bg-zinc-100 shadow-sm">
            <flux:heading size="xl" level="2" class="w-full">
                {{ 'Flash Cards for ' . $skill->name }}
            </flux:heading>

            <div class="flex flex-col gap-4">
                <div x-data="{ showBack: false }" class="flex justify-center">
                    <div @click="showBack = !showBack"
                        class="w-full md:w-3/4 h-[min(24rem,45dvh)] cursor-pointer [perspective:1000px]">

                        <div class="relative w-full h-full duration-500 [transform-style:preserve-3d] shadow-sm rounded-xl border border-zinc-200 transition-all hover:border-slate-900"
                            :class="showBack ? '[transform:rotateY(180deg)]' : ''">

                            {{-- <!-- FRONT -->
                            <div class="absolute inset-0 rounded-xl {{ $colorThemes[$subjectColor]['bg'] }} p-6 flex flex-col min-h-0 [backface-visibility:hidden]"
                                :class="showBack ? 'pointer-events-none' : ''">
                                <flux:heading size="lg" class="mb-4 text-center shrink-0">{{ $flashCard->title }}
                                </flux:heading>
                                <div
                                    class="html-content prose flex-1 min-h-0 overflow-y-auto overscroll-contain touch-pan-y w-full text-center px-2">
                                    {!! $flashCard->content_front !!}
                                </div>
                            </div>

                            <!-- BACK -->
                            <div class="absolute inset-0 rounded-xl bg-zinc-200 p-6 flex flex-col min-h-0 [backface-visibility:hidden] [transform:rotateY(180deg)]"
                                :class="showBack ? '' : 'pointer-events-none'">
                                <flux:heading size="lg" class="mb-4 text-center shrink-0">{{ $flashCard->title }}
                                    (Answer)</flux:heading>
                                <div
                                    class="html-content prose flex-1 min-h-0 overflow-y-auto overscroll-contain touch-pan-y w-full text-center px-2">
                                    {!! $flashCard->content_back !!}
                                </div>
                            </div> --}}
                            <!-- FRONT -->
                            <div class="absolute inset-0 rounded-xl {{ $colorThemes[$subjectColor]['bg'] }} p-6 flex flex-col min-h-0 [backface-visibility:hidden]"
                                :class="showBack ? 'pointer-events-none' : ''">
                                <flux:heading size="lg" class="mb-4 text-center shrink-0">{{ $flashCard->title }}
                                </flux:heading>
                                <div
                                    class="flex-1 min-h-0 overflow-y-auto overscroll-contain touch-pan-y w-full flex flex-col">
                                    <div class="html-content prose max-w-none my-auto w-full text-center px-2">
                                        {!! $flashCard->content_front !!}
                                    </div>
                                </div>
                            </div>

                            <!-- BACK -->
                            <div class="absolute inset-0 rounded-xl bg-zinc-200 p-6 flex flex-col min-h-0 [backface-visibility:hidden] [transform:rotateY(180deg)]"
                                :class="showBack ? '' : 'pointer-events-none'">
                                <flux:heading size="lg" class="mb-4 text-center shrink-0">{{ $flashCard->title }}
                                    (Answer)</flux:heading>
                                <div
                                    class="flex-1 min-h-0 overflow-y-auto overscroll-contain touch-pan-y w-full flex flex-col">
                                    <div class="html-content prose max-w-none my-auto w-full text-center px-2">
                                        {!! $flashCard->content_back !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between px-2">
                    <flux:button
                        href="{{ route('subject.page', ['subjectId' => $subject->id, 'topicId' => $skill->topic->id]) }}"
                        variant="primary" color="red">
                        Return
                    </flux:button>
                    <flux:button href="{{ route('learning-materials.flash-card', ['skillId' => $skill->id]) }}"
                        variant="primary">
                        Next
                    </flux:button>
                </div>
            </div>
        </flux:card>
        @livewire('student-topic-mastery-chart', ['studentId' => auth()->user()->id, 'topicId' => $skill->topic->id, 'subjectColor' => $subjectColor, 'class' => 'hidden xl:block bg-zinc-100 flex flex-col justify-center items-center'])
    </div>
</x-layouts::subjects>
