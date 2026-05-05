<x-layouts::auth :title="__('Log in')">

    <div class="min-h-screen flex items-center justify-center bg-zinc-50 dark:bg-zinc-950">

        <div class="w-full max-w-7xl min-h-screen rounded-2xl overflow-hidden shadow-xl grid md:grid-cols-2">

            <!-- LEFT PANEL -->
            <div
                class="hidden md:flex flex-col text-center justify-center p-12 text-black
                bg-gradient-to-br from-white via-emerald-50 to-emerald-100">

                <h1 class ="text-5xl font-bold mb-4">
                    Calauan LMS
                </h1>

                <h1 class="text-3xl font-semibold mb-4">
                    Welcome back
                </h1>

                <div class="flex flex-col gap-3 p-10">

                    <flux:button class="w-full bg-emerald-600 hover:bg-emerald-700 text-white">
                        Student
                    </flux:button>

                    <flux:button
                        class="w-full border border-zinc-300 dark:border-zinc-700 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800">
                        Teacher
                    </flux:button>

                    <!-- Register -->

                    <div class="text-sm text-center text-black p-5">
                        <span>Don't have an account?</span>
                        <a href="#" class="text-black-600 hover:underline">
                            Sign up
                        </a>
                    </div>

                </div>
            </div>

            <!-- RIGHT PANEL -->
            <div class="bg-white dark:bg-zinc-900 p-10 flex items-center justify-center">

                <div class="w-full max-w-sm">

                   
                                
                </div>

            </div>

</x-layouts::auth>
