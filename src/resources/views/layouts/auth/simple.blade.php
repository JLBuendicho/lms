<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="bg-white antialiased dark:bg-neutral-900">

    <div class="w-full min-h-screen flex">

        <!-- LEFT PANEL -->
        <div class="w-full md:w-2/5 flex flex-col justify-center p-10 bg-gradient-to-br from-green-200 to-green-400">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="absolute top-6 left-6 flex gap-2 font-medium" wire:navigate>
                <span class="flex rounded-md">
                    <x-app-logo-icon class="size-9 fill-current text-black dark:text-white" />
                </span>
            </a>

            <!-- Login Card -->
            <div class="w-full max-w-md mx-auto bg-black rounded-2xl p-8 shadow-2xl">
                {{ $slot }}
            </div>

        </div>

        <!-- RIGHT PANEL -->
        <div class="hidden md:flex w-3/5 bg-gradient-to-br from-green-400 to-green-600">
        </div>

    </div>

    @fluxScripts
</body>

</html>
