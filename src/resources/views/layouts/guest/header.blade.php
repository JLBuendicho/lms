<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white scroll-smooth">
    <flux:header container class="sticky top-0 z-50 shadow-sm bg-[var(--color-accent)]">
        <flux:sidebar.toggle class="lg:hidden mr-2" icon="bars-2" inset="left" />

        <x-app-logo
            class="!text-[var(--color-accent-foreground)] hover:!bg-[var(--color-accent-foreground)] hover:!text-[var(--color-accent)]" />

        <flux:spacer />

        <flux:navbar class="me-1.5 space-x-0.5 rtl:space-x-reverse py-0! max-lg:hidden">
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
                icon="layout-grid" :href="route('get-dashboard')" wire:navigate>
                {{ __('Dashboard') }}
            </flux:navbar.item>

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

    <!-- Mobile Menu -->
    <flux:sidebar collapsible="mobile" sticky class="lg:hidden border-e border-zinc-200 bg-zinc-50">
        <flux:sidebar.header>
            <x-app-logo :sidebar="true" href="{{ route('get-dashboard') }}" wire:navigate />
            <flux:sidebar.collapse
                class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
        </flux:sidebar.header>

        <flux:sidebar.nav>
            <flux:sidebar.group :heading="__('Platform')">
                <flux:sidebar.item
                    icon="home" href="#hero-section">
                    {{ __('Home') }}
                </flux:sidebar.item>
                <flux:sidebar.item
                    icon="square-3-stack-3d" href="#features-section">
                    {{ __('Features') }}
                </flux:sidebar.item>
                <flux:sidebar.item
                    icon="envelope" href="#footer">
                    {{ __('Contact Us') }}
                </flux:sidebar.item>
                <flux:sidebar.item icon="layout-grid" :href="route('get-dashboard')"
                    :current="request()->routeIs('get-dashboard')" wire:navigate>
                    {{ __('Dashboard') }}
                </flux:sidebar.item>
            </flux:sidebar.group>
        </flux:sidebar.nav>

        <flux:spacer />

        <flux:sidebar.nav>
            <flux:sidebar.group :heading="__('Account')">
                @guest
                    <flux:sidebar.item
                        class="!text-[var(--color-accent-foreground)] hover:!bg-[var(--color-accent-foreground)] hover:!text-[var(--color-accent)] transition-colors duration-150 ease-in-out"
                        icon="user" :href="route('login')" wire:navigate>
                        {{ __('Login') }}
                    </flux:sidebar.item>
                @endguest
                @auth
                    <x-desktop-user-menu isSidebar="true" />
                @endauth
            </flux:sidebar.group>
        </flux:sidebar.nav>
    </flux:sidebar>

    {{ $slot }}

    @fluxScripts
</body>

</html>
