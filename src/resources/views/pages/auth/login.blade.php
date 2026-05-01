<x-layouts::auth :title="__('Log in')">

    <div class="min-h-screen flex items-center justify-center bg-taupe-100 p-4">

        <div class="w-full bg-white dark:bg-zinc-900 rounded-2xl shadow-xl p-8 flex flex-col gap-6">

            <!-- LMS Branding -->
            <div class="text-center mb-6 ">
                <h1 class="text-3xl font-bold text-green-700">Calauan LMS</h1>
                <p class="text-sm text-zinc-500 dark:text-zinc-400">
                    {{ __('Access your learning dashboard') }}
                </p>
            </div>

            <!-- Role Selection -->
            <div id="roleSelection" class="flex flex-col gap-3">    

                <flux:button type="button" class="w-full bg-green-600 hover:bg-green-700 text-white"
                    onclick="selectRole('student')">
                    Student
                </flux:button>

                <flux:button type="button" class="w-full border border-green-600 text-green-600 hover:bg-green-50"
                    onclick="selectRole('teacher')">
                    Teacher
                </flux:button>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-5">
                @csrf

            </form>

            <!-- Register -->
            @if (Route::has('register'))
                <div class="text-sm text-center text-zinc-600 dark:text-zinc-400">
                    <span>{{ __('Don\'t have an account?') }}</span>
                    <flux:link :href="route('register')" wire:navigate class="text-green-600 hover:underline">
                        {{ __('Sign up') }}
                    </flux:link>
                </div>
            @endif

        </div>

    </div>

</x-layouts::auth>