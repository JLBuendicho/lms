<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white scroll-smooth">
    <flux:header container class="sticky top-0 z-50 shadow-sm bg-[var(--color-accent)]">
        <flux:sidebar.toggle class="lg:hidden mr-2" icon="bars-2" inset="left" />

        <x-app-logo href="{{ route('dashboard') }}" wire:navigate />

        <flux:spacer />

        {{-- <flux:navbar class="-mb-px max-lg:hidden"> --}}
        <flux:navbar class="me-1.5 space-x-0.5 rtl:space-x-reverse py-0!">
            <flux:navbar.item
                class="!text-[var(--color-accent-foreground)] hover:!bg-[var(--color-accent-foreground)] hover:!text-[var(--color-accent)] transition-colors duration-150 ease-in-out"
                icon="home" href="#hero-section">
                {{ __('Home') }}
            </flux:navbar.item>
            <flux:navbar.item
                class="!text-[var(--color-accent-foreground)] hover:!bg-[var(--color-accent-foreground)] hover:!text-[var(--color-accent)] transition-colors duration-150 ease-in-out"
                icon="square-3-stack-3d" href="#features-section">
                {{ __('Features') }}
            </flux:navbar.item>
            <flux:navbar.item
                class="!text-[var(--color-accent-foreground)] hover:!bg-[var(--color-accent-foreground)] hover:!text-[var(--color-accent)] transition-colors duration-150 ease-in-out"
                icon="envelope" href="#footer">
                {{ __('Contact Us') }}
            </flux:navbar.item>
            <flux:navbar.item
                class="!text-[var(--color-accent-foreground)] hover:!bg-[var(--color-accent-foreground)] hover:!text-[var(--color-accent)] transition-colors duration-150 ease-in-out"
                icon="layout-grid" :href="route('dashboard')" wire:navigate>
                {{ __('Dashboard') }}
            </flux:navbar.item>

        {{-- <flux:navbar class="me-1.5 space-x-0.5 rtl:space-x-reverse py-0!">
                <flux:tooltip :content="__('Search')" position="bottom">
                    <flux:navbar.item class="!h-10 [&>div>svg]:size-5" icon="magnifying-glass" href="#" :label="__('Search')" />
                </flux:tooltip>
                <flux:tooltip :content="__('Repository')" position="bottom">
                    <flux:navbar.item
                        class="h-10 max-lg:hidden [&>div>svg]:size-5"
                        icon="folder-git-2"
                        href="https://github.com/laravel/livewire-starter-kit"
                        target="_blank"
                        :label="__('Repository')"
                    />
                </flux:tooltip>
                <flux:tooltip :content="__('Documentation')" position="bottom">
                    <flux:navbar.item
                        class="h-10 max-lg:hidden [&>div>svg]:size-5"
                        icon="book-open-text"
                        href="https://laravel.com/docs/starter-kits#livewire"
                        target="_blank"
                        :label="__('Documentation')"
                    />
                </flux:tooltip> --}}
        @guest
            <flux:navbar.item
                class="!text-[var(--color-accent-foreground)] hover:!bg-[var(--color-accent-foreground)] hover:!text-[var(--color-accent)] transition-colors duration-150 ease-in-out"
                icon="user" :href="route('login')" wire:navigate>
                {{ __('Login') }}
            </flux:navbar.item>
        @endguest
        @auth
            <x-desktop-user-menu />
        @endauth
        </flux:navbar>

    </flux:header>

    {{-- <!-- Mobile Menu -->
    <flux:sidebar collapsible="mobile" sticky class="lg:hidden border-e border-zinc-200 bg-zinc-50">
        <flux:sidebar.header>
            <x-app-logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
            <flux:sidebar.collapse
                class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
        </flux:sidebar.header>

        <flux:sidebar.nav>
            <flux:sidebar.group :heading="__('Platform')">
                <flux:sidebar.item icon="layout-grid" :href="route('dashboard')"
                    :current="request()->routeIs('dashboard')" wire:navigate>
                    {{ __('Dashboard') }}
                </flux:sidebar.item>
            </flux:sidebar.group>
        </flux:sidebar.nav>

        <flux:spacer />

        <flux:sidebar.nav>
            <flux:sidebar.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit"
                target="_blank">
                {{ __('Repository') }}
            </flux:sidebar.item>
            <flux:sidebar.item icon="book-open-text" href="https://laravel.com/docs/starter-kits#livewire"
                target="_blank">
                {{ __('Documentation') }}
            </flux:sidebar.item>
        </flux:sidebar.nav>
    </flux:sidebar> --}}

    {{ $slot }}

    @fluxScripts
</body>

</html>
