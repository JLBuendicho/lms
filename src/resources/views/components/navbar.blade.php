@props([
    'navlinks' => [],
])

<nav x-data="{ open: false }" class="fixed top-0 left-0 z-50 w-full bg-slate-900 text-white shadow-md">
    <div class="mx-auto flex max-w-7xl justify-between py-10">

        <!-- Brand -->
        <a href="/" class="text-xl font-bold">
            Calauan LMS
        </a>

        <!--  Links -->
        <div class="hidden md:flex items-center gap-6">
            @foreach ($navlinks as $link)
                <a href="{{ $link['url'] }}" class="transition hover:text-slate-100">
                    {{ $link['text'] }}
                </a>
            @endforeach

            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="rounded-lg bg-white px-4 py-2 font-medium text-slate-900 hover:bg-slate-200">
                        Logout
                    </button>
                </form>
            @else
                <a href="/login" class="transition hover:text-slate-200">
                    Login
                </a>
            @endauth
        </div>
    </div>
</nav>
