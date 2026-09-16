@inject('studentBktService', 'App\Services\StudentBktService')
@inject('subjectService', 'App\Services\SubjectService')

<x-layouts::subjects>
    @php
        $subject = $skill->topic->domain->subject;
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
        <flux:breadcrumbs.item href="{{ route('learning-materials.flash-card', ['skillId' => $skill->id]) }}">
            {{ $skill->name }}
        </flux:breadcrumbs.item>
    </x-slot:breadCrumbs>
    <x-slot:subjectName>{{ $subject->name }}</x-slot:subjectName>
    <div class="grid grid-cols-3 gap-2">
        <flux:card class="col-span-2 flex flex-col gap-2 bg-zinc-100 shadow-sm">
            <flux:heading size="xl" level="2" class="w-full">
                {{ 'Flash Cards for ' . $skill->name }}
            </flux:heading>

            {{-- <form method="POST" action="" class="h-full w-full grid grid-rows-[90%, 10%]" @submit.prevent="submit">
                @csrf --}}
            <div class="h-full w-full grid grid-rows-4">
                <div x-data="{ showBack: false }"
                    class="row-span-3 w-full h-full flex flex-col gap-2 justify-center items-center overflow-hidden">

                    <!-- 1. The Interactive Container (Handles sizing and click event) -->
                    <div @click="showBack = !showBack"
                        class="w-3/4 h-full max-h-[500px] cursor-pointer group [perspective:1000px]">

                        <!-- 2. The Inner Card (Applies the 3D rotation based on Alpine state) -->
                        <div class="relative w-full h-full duration-500 [transform-style:preserve-3d] shadow-sm rounded-xl border border-zinc-200 dark:border-zinc-800 transition-all hover:border-slate-900"
                            :class="showBack ? '[transform:rotateY(180deg)]' : ''">

                            <!-- 3. FRONT SIDE -->
                            <div
                                class="absolute inset-0 h-full w-full rounded-xl bg-white dark:bg-zinc-900 p-6 flex flex-col [backface-visibility:hidden]">
                                <flux:heading size="lg" class="mb-4 text-center shrink-0">{{ $flashCard->title }}
                                </flux:heading>
                                <div class="html-content prose overflow-y-auto flex-1 w-full text-center px-2">
                                    {!! $flashCard->content_front !!}
                                </div>
                            </div>

                            <!-- 4. BACK SIDE -->
                            <div
                                class="absolute inset-0 h-full w-full rounded-xl bg-zinc-50 dark:bg-zinc-950 p-6 flex flex-col [backface-visibility:hidden] [transform:rotateY(180deg)]">
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
                        href="{{ route('subject.topic.page', ['subjectId' => $subject->id, 'topicId' => $skill->topic->id]) }}"
                        variant="primary" color="red">
                        Return
                    </flux:button>
                    <flux:button href="{{ route('learning-materials.flash-card', ['skillId' => $skill->id]) }}"
                        variant="primary">
                        Next
                    </flux:button>
                </div>
            </div>
            {{-- </form> --}}

        </flux:card>
        @livewire('student-topic-mastery-chart', ['studentId' => auth()->user()->id, 'topicId' => $skill->topic->id, 'class' => 'bg-zinc-100 flex flex-col justify-center items-center'])
    </div>
</x-layouts::subjects>
