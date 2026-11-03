@inject('subjectService', 'App\Services\SubjectService')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white">
    <flux:sidebar sticky collapsible class="border-e border-zinc-200 bg-zinc-50">
        <flux:sidebar.header>
            <flux:sidebar.brand :href="route('dashboard')" :logo="asset('images/lms-logo-colored.svg')"
                name="Calauan LMS" class="text-lg font-bold text-zinc-900" />
            <flux:sidebar.collapse
                class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
        </flux:sidebar.header>

        <flux:sidebar.nav>
            <flux:sidebar.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')"
                wire:navigate>
                {{ __('Dashboard') }}
            </flux:sidebar.item>
            @php
                $subjects = $subjectService->getStudentSubjects(auth()->user()->id);
            @endphp
            @if (count($subjects) !== 0)
                <flux:sidebar.group expandable :expanded="request()->is('assessment/*/initial/*')" icon="document-text"
                    heading="Initial Assessments" class="grid">
                    @foreach ($subjects as $subject)
                        @if ($subjectService->subjectAssessmentMaterialsExists($subject->id, 'initial'))
                            <flux:sidebar.item
                                :href="route('assessment.question.show', ['subjectName' => $subject->name, 'assessmentType' => 'initial', 'step' => 1])"
                                :current="request()->is('assessment/' . $subject->name . '/initial/*')" wire:navigate>
                                {{ __($subject->name) }}
                            </flux:sidebar.item>
                        @endif
                    @endforeach
                </flux:sidebar.group>
                <flux:sidebar.group expandable :expanded="request()->is('assessment/*/middle/*')" icon="document-text"
                    heading="Middle Assessments" class="grid">
                    @foreach ($subjects as $subject)
                        @if ($subjectService->subjectAssessmentMaterialsExists($subject->id, 'middle'))
                            <flux:sidebar.item
                                :href="route('assessment.question.show', ['subjectName' => $subject->name, 'assessmentType' => 'middle', 'step' => 1])"
                                :current="request()->is('assessment/' . $subject->name . '/middle/*')" wire:navigate>
                                {{ __($subject->name) }}
                            </flux:sidebar.item>
                        @endif
                    @endforeach
                </flux:sidebar.group>
                <flux:sidebar.group expandable :expanded="request()->is('assessment/*/final/*')" icon="document-text"
                    heading="Final Assessments" class="grid">
                    @foreach ($subjects as $subject)
                        @if ($subjectService->subjectAssessmentMaterialsExists($subject->id, 'final'))
                            <flux:sidebar.item
                                :href="route('assessment.question.show', ['subjectName' => $subject->name, 'assessmentType' => 'final', 'step' => 1])"
                                :current="request()->is('assessment/' . $subject->name . '/final/*')" wire:navigate>
                                {{ __($subject->name) }}
                            </flux:sidebar.item>
                        @endif
                    @endforeach
                </flux:sidebar.group>
                <flux:sidebar.group expandable :expanded="request()->is('subjects/*')" icon="book-open"
                    heading="Subjects" class="grid">
                    @foreach ($subjects as $subject)
                        <flux:sidebar.item :href="route('subject.page', ['subjectId' => $subject->id])"
                            :current="request()->is(['subjects/' . $subject->id, 'subjects/' . $subject->id . '/*'])"
                            wire:navigate>
                            {{ __($subject->name) }}
                        </flux:sidebar.item>
                    @endforeach
                </flux:sidebar.group>
            @endif
            <flux:sidebar.group expandable expanded icon="exclamation-circle" heading="To Do:" class="grid">
                @foreach ($subjects as $subject)
                    @if (!$subjectService->studentSubjectAssessmentResponseExists(auth()->id(), $subject->id, 'initial'))
                    <flux:tooltip class="block w-full" content="You have yet to complete the Initial Assessment for {{ $subject->name }}. Please complete it." position="right">
                        <flux:sidebar.item
                            :href="route('assessment.question.show', ['subjectName' => $subject->name, 'assessmentType' => 'initial', 'step' => 1])"
                            :current="request()->is('assessment/' . $subject->name . '/initial/*')" wire:navigate>
                            <flux:text class="text-red-600 hover:text-red-800">
                                {{ __($subject->name . ' - Initial Assessment') }}
                            </flux:text>
                        </flux:sidebar.item>
                    </flux:tooltip>
                    @endif
                    @if (!$subjectService->studentSubjectAssessmentResponseExists(auth()->id(), $subject->id, 'middle'))
                    <flux:tooltip class="block w-full" content="You have yet to complete the Middle Assessment for {{ $subject->name }}. Please complete it." position="right">
                        <flux:sidebar.item
                            :href="route('assessment.question.show', ['subjectName' => $subject->name, 'assessmentType' => 'middle', 'step' => 1])"
                            :current="request()->is('assessment/' . $subject->name . '/middle/*')" wire:navigate>
                            <flux:text class="text-red-600 hover:text-red-800">
                                {{ __($subject->name . ' - Middle Assessment') }}
                            </flux:text>
                        </flux:sidebar.item>
                    </flux:tooltip>
                    @endif
                    @if (!$subjectService->studentSubjectAssessmentResponseExists(auth()->id(), $subject->id, 'final'))
                    <flux:tooltip class="block w-full" content="You have yet to complete the Final Assessment for {{ $subject->name }}. Please complete it." position="right">
                        <flux:sidebar.item
                            :href="route('assessment.question.show', ['subjectName' => $subject->name, 'assessmentType' => 'final', 'step' => 1])"
                            :current="request()->is('assessment/' . $subject->name . '/final/*')" wire:navigate>
                            <flux:text class="text-red-600 hover:text-red-800">
                                {{ __($subject->name . ' - Final Assessment') }}
                            </flux:text>
                        </flux:sidebar.item>
                    </flux:tooltip>
                    @endif
                @endforeach
            </flux:sidebar.group>
        </flux:sidebar.nav>

        <flux:spacer />

        <x-desktop-user-menu class="hidden lg:block" is-sidebar=true />
    </flux:sidebar>

    {{-- <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <flux:avatar
                                    :name="auth()->user()->name"
                                    :initials="auth()->user()->initials()"
                                />

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                                    <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                            {{ __('Settings') }}
                        </flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item
                            as="button"
                            type="submit"
                            icon="arrow-right-start-on-rectangle"
                            class="w-full cursor-pointer"
                            data-test="logout-button"
                        >
                            {{ __('Log out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header> --}}

    {{ $slot }}

    @filamentScripts
    @fluxScripts
</body>

</html>
