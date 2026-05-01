<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="bg-white">

    <div class="w-full min-h-screen">
        {{ $slot }}
    </div>

    @fluxScripts
</body>

</html>
