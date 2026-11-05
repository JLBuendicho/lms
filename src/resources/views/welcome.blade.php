{{-- <x-layouts::guest>
    <!-- Hero Content -->
    <section id="hero-section" class="w-full h-screen flex flex-col items-center justify-center">
        <h1 class="mb-6 text-4xl font-bold text-[var(--color-accent-content)] md:text-6xl">
            Calauan LMS
        </h1>

        <p class="max-w-2xl text-lg text-[var(--color-accent-content)] md:text-2xl">
            No student left behind. Life long learning for everyone.
        </p>

        <div class="my-8 h-1 w-32 rounded-full bg-[var(--color-accent-content)]"></div>

        <div class="flex flex-col gap-4 sm:flex-row">
            <flux:button href="{{ route('get-dashboard') }}" variant="primary">
                Get Started
            </flux:button>
            <flux:button href="#goal-section">
                Learn More
            </flux:button>
        </div>
    </section>

    <section id="goal-section"
        class="w-full h-screen bg-slate-900 text-white flex flex-col items-center justify-center p-6">
        <div class="mb-10">
            <h2 class="text-4xl font-bold text-center ">Our vision and Goal</h2>
            <p class="text-lg text-white text-center mt-4 ">
                We envision a future where every student, regardless of their background or circumstances, has
                access to
                high-quality education and the opportunity to reach their full potential. Our goal is to create an
                inclusive and innovative learning environment that empowers students to thrive academically,
                socially,
                and emotionally.
            </p>
        </div>

        <div class="w-full grid grid-cols-1 md:grid-cols-3 px-5 gap-10 h-90">
            <div
                class="bg-white text-slate-900 rounded-xl shadow-lg p-6 hover:scale-105 transition-transform duration-300">
                <h3 class="text-xl font-semibold mb-2">Article Title 1</h3>
                <p class="text-sm text-slate-600">
                    A short description
                </p>
            </div>

            <div
                class="bg-white text-slate-900 rounded-2xl shadow-lg p-6 hover:scale-105 transition-transform duration-300">
                <h3 class="text-xl font-semibold mb-2">Article Title 2</h3>
                <p class="text-sm text-slate-600">
                    A short description
                </p>
            </div>

            <div
                class="bg-white text-slate-900 rounded-2xl shadow-lg p-6 hover:scale-105 transition-transform duration-300">
                <h3 class="text-xl font-semibold mb-2">Article Title 3</h3>
                <p class="text-sm text-slate-600">
                    A short description
                </p>
            </div>
        </div>
    </section>

    <section id="features-section" class="w-full h-screen flex flex-col items-center justify-center p-6">

        <!-- Header -->
        <div class="mb-12 text-center max-w-2xl">
            <h2 class="text-4xl font-bold text-black">Our Features</h2>
            <p class="text-lg text-gray-600 mt-4">
                We offer a comprehensive suite of features designed to enhance the learning experience.
            </p>
        </div>

        <!-- Grid Layout -->
        <div class="grid grid-cols-3 gap-6 w-full max-w-6xl">

            <!-- Feature 1 (MAIN FEATURE) -->
            <div
                class="col-span-2 row-span-2 group bg-white border rounded-xl shadow-md p-6 
                    transition-all duration-300 hover:shadow-xl hover:-translate-y-1">

                <h3 class="text-xl font-semibold mb-2">Personalized Learning Pathway</h3>
                <p class="text-sm text-gray-600">
                    Students receive a customized learning experience based on their strengths and weaknesses.
                </p>

                <!-- dropdown -->
                <div
                    class="max-h-0 overflow-hidden opacity-0 
                        group-hover:max-h-40 group-hover:opacity-100 
                        transition-all duration-300">

                    <p class="mt-4 text-sm text-gray-500">
                        More detailed explanation about this feature.
                    </p>

                    <button class="mt-3 text-sm text-green-700 font-medium hover:underline">
                        Learn more →
                    </button>
                </div>
            </div>

            <!-- Feature 2 -->
            <div
                class="group bg-white border rounded-xl shadow-md p-6 
                    transition-all duration-300 hover:shadow-xl hover:-translate-y-1">

                <h3 class="text-xl font-semibold mb-2">Progress Tracking</h3>
                <p class="text-sm text-gray-600">
                    Monitor your own learning progress with detailed analytics and insights.
                </p>

                <div
                    class="max-h-0 overflow-hidden opacity-0 
                        group-hover:max-h-32 group-hover:opacity-100 
                        transition-all duration-300">

                    <p class="mt-4 text-sm text-gray-500">
                        Additional details shown on hover.
                    </p>
                </div>
            </div>

            <!-- Feature 3 -->
            <div
                class="group bg-white border rounded-xl shadow-md p-6 
                    transition-all duration-300 hover:shadow-xl hover:-translate-y-1">

                <h3 class="text-xl font-semibold mb-2">Interactive Exercises</h3>
                <p class="text-sm text-gray-600">
                    Engage with dynamic content that adapts to your learning style.
                </p>

                <div
                    class="max-h-0 overflow-hidden opacity-0 
                        group-hover:max-h-32 group-hover:opacity-100 
                        transition-all duration-300">

                    <p class="mt-4 text-sm text-gray-500">
                        Additional details shown on hover.
                    </p>
                </div>
            </div>

        </div>
    </section>

    <footer id="footer" class="bg-slate-900 text-white py-12 px-6">

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-20 max-w-7xl mx-auto">

            <!-- name -->
            <div>
                <h3 class="text-2xl font-bold mb-4">Calauan LMS</h3>
                <p class="text-sm text-justify">
                    A LAN-Based Learning Management System designed for Calauan, Laguna.
                    No learner left behind. Life long learning for everyone.
                </p>
            </div>

            <!-- links -->
            <div>
                <h4 class="font-semibold mb-4">Quick Links</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:underline">Home</a></li>
                    <li><a href="#features-section" class="hover:underline">Features</a></li>
                    <li><a href="#" class="hover:underline">About</a></li>
                    <li><a href="#" class="hover:underline">Contact</a></li>
                </ul>
            </div>

            <!-- Contacts -->
            <div>
                <h4 class="font-semibold mb-4">Contact</h4>
                <ul class="space-y-2 text-sm">
                    <li>Email: calauanlms@email.com</li>
                    <li>Phone: +63 912 345 6789</li>
                    <li>Calauan, Laguna</li>
                </ul>
            </div>

            <!-- socials -->
            <div>
                <h4 class="font-semibold mb-4">Connect with us</h4>
                <p class="text-sm mb-4">We’d love to hear your needs and goals!</p>

                <div class="flex gap-4">
                    <a href="#" class="hover:scale-110 transition">Facebook</a>
                    <a href="#" class="hover:scale-110 transition">Email</a>
                    <a href="#" class="hover:scale-110 transition">Twitter</a>
                </div>
            </div>

        </div>

        <!-- DIVIDER -->
        <div class="border-t border-black/40 my-8 max-w-6xl mx-auto"></div>

        <!-- BOTTOM -->
        <div class="text-center text-sm">
            © 2026 Calauan LMS. All rights reserved.
        </div>

    </footer>
</x-layouts::guest> --}}

<x-layouts::guest>
    <!-- Hero Section -->
    <section id="hero-section"
        class="w-full min-h-screen flex flex-col items-center justify-center
               px-6 py-20 text-center">

        <h1 class="mb-6 text-4xl sm:text-5xl md:text-6xl font-bold
                   text-[var(--color-accent-content)]">
            Calauan LMS
        </h1>

        <p class="max-w-2xl text-base sm:text-lg md:text-2xl
                  text-[var(--color-accent-content)]">
            No student left behind. Life long learning for everyone.
        </p>

        <div class="my-8 h-1 w-24 sm:w-32 rounded-full
                    bg-[var(--color-accent-content)]"></div>

        <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
            <flux:button
                href="{{ route('get-dashboard') }}"
                variant="primary"
                class="w-full sm:w-auto">
                Get Started
            </flux:button>

            <flux:button
                href="#goal-section"
                class="w-full sm:w-auto">
                Learn More
            </flux:button>
        </div>
    </section>


    <!-- Vision and Goal Section -->
    <section id="goal-section"
        class="w-full min-h-screen bg-slate-900 text-white
               flex flex-col items-center justify-center
               px-6 py-20 sm:px-10">

        <div class="mb-10 max-w-4xl mx-auto">
            <h2 class="text-3xl sm:text-4xl font-bold text-center">
                Our Vision and Goal
            </h2>

            <p class="text-base sm:text-lg text-white text-center mt-4 leading-relaxed">
                We envision a future where every student, regardless of their
                background or circumstances, has access to high-quality education
                and the opportunity to reach their full potential. Our goal is
                to create an inclusive and innovative learning environment that
                empowers students to thrive academically, socially, and emotionally.
            </p>
        </div>

        <div class="w-full max-w-7xl grid grid-cols-1 sm:grid-cols-2
                    lg:grid-cols-3 gap-6 lg:gap-10">

            <div class="bg-white text-slate-900 rounded-xl shadow-lg p-6
                        hover:scale-[1.02] transition-transform duration-300">
                <h3 class="text-xl font-semibold mb-2">
                    Article Title 1
                </h3>

                <p class="text-sm text-slate-600">
                    A short description
                </p>
            </div>

            <div class="bg-white text-slate-900 rounded-xl shadow-lg p-6
                        hover:scale-[1.02] transition-transform duration-300">
                <h3 class="text-xl font-semibold mb-2">
                    Article Title 2
                </h3>

                <p class="text-sm text-slate-600">
                    A short description
                </p>
            </div>

            <div class="bg-white text-slate-900 rounded-xl shadow-lg p-6
                        hover:scale-[1.02] transition-transform duration-300
                        sm:col-span-2 lg:col-span-1">
                <h3 class="text-xl font-semibold mb-2">
                    Article Title 3
                </h3>

                <p class="text-sm text-slate-600">
                    A short description
                </p>
            </div>

        </div>
    </section>


    <!-- Features Section -->
    <section id="features-section"
        class="w-full min-h-screen flex flex-col items-center
               justify-center px-6 py-20 sm:px-10">

        <!-- Header -->
        <div class="mb-10 sm:mb-12 text-center max-w-2xl">
            <h2 class="text-3xl sm:text-4xl font-bold text-black">
                Our Features
            </h2>

            <p class="text-base sm:text-lg text-gray-600 mt-4">
                We offer a comprehensive suite of features designed to enhance
                the learning experience.
            </p>
        </div>

        <!-- Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2
                    lg:grid-cols-3 gap-6 w-full max-w-6xl">

            <!-- Feature 1 -->
            <div class="group md:col-span-2 lg:row-span-2
                        bg-white border rounded-xl shadow-md p-6
                        transition-all duration-300
                        hover:shadow-xl hover:-translate-y-1">

                <h3 class="text-xl font-semibold mb-2">
                    Personalized Learning Pathway
                </h3>

                <p class="text-sm text-gray-600">
                    Students receive a customized learning experience based
                    on their strengths and weaknesses.
                </p>

                <div class="mt-4 md:mt-6
                            opacity-100 lg:max-h-0 lg:overflow-hidden
                            lg:opacity-0 lg:mt-0
                            lg:group-hover:max-h-40
                            lg:group-hover:opacity-100
                            lg:group-hover:mt-4
                            transition-all duration-300">

                    <p class="text-sm text-gray-500">
                        More detailed explanation about this feature.
                    </p>

                    <button class="mt-3 text-sm text-green-700 font-medium
                                   hover:underline">
                        Learn more →
                    </button>
                </div>
            </div>


            <!-- Feature 2 -->
            <div class="group bg-white border rounded-xl shadow-md p-6
                        transition-all duration-300
                        hover:shadow-xl hover:-translate-y-1">

                <h3 class="text-xl font-semibold mb-2">
                    Progress Tracking
                </h3>

                <p class="text-sm text-gray-600">
                    Monitor your own learning progress with detailed analytics
                    and insights.
                </p>

                <div class="mt-4 lg:max-h-0 lg:overflow-hidden
                            lg:opacity-0 lg:mt-0
                            lg:group-hover:max-h-32
                            lg:group-hover:opacity-100
                            lg:group-hover:mt-4
                            transition-all duration-300">

                    <p class="text-sm text-gray-500">
                        Additional details shown on hover.
                    </p>
                </div>
            </div>


            <!-- Feature 3 -->
            <div class="group bg-white border rounded-xl shadow-md p-6
                        transition-all duration-300
                        hover:shadow-xl hover:-translate-y-1">

                <h3 class="text-xl font-semibold mb-2">
                    Interactive Exercises
                </h3>

                <p class="text-sm text-gray-600">
                    Engage with dynamic content that adapts to your learning style.
                </p>

                <div class="mt-4 lg:max-h-0 lg:overflow-hidden
                            lg:opacity-0 lg:mt-0
                            lg:group-hover:max-h-32
                            lg:group-hover:opacity-100
                            lg:group-hover:mt-4
                            transition-all duration-300">

                    <p class="text-sm text-gray-500">
                        Additional details shown on hover.
                    </p>
                </div>
            </div>

        </div>
    </section>


    <!-- Footer -->
    <footer id="footer"
        class="bg-slate-900 text-white py-12 px-6 sm:px-10">

        <div class="grid grid-cols-1 sm:grid-cols-2
                    lg:grid-cols-4 gap-10 lg:gap-16
                    max-w-7xl mx-auto">

            <!-- Name -->
            <div>
                <h3 class="text-2xl font-bold mb-4">
                    Calauan LMS
                </h3>

                <p class="text-sm text-justify leading-relaxed">
                    A LAN-Based Learning Management System designed for
                    Calauan, Laguna. No learner left behind. Life long
                    learning for everyone.
                </p>
            </div>


            <!-- Links -->
            <div>
                <h4 class="font-semibold mb-4">
                    Quick Links
                </h4>

                <ul class="space-y-2 text-sm">
                    <li>
                        <a href="#hero-section" class="hover:underline">
                            Home
                        </a>
                    </li>

                    <li>
                        <a href="#features-section" class="hover:underline">
                            Features
                        </a>
                    </li>

                    <li>
                        <a href="#goal-section" class="hover:underline">
                            About
                        </a>
                    </li>

                    <li>
                        <a href="#footer" class="hover:underline">
                            Contact
                        </a>
                    </li>
                </ul>
            </div>


            <!-- Contacts -->
            <div>
                <h4 class="font-semibold mb-4">
                    Contact
                </h4>

                <ul class="space-y-2 text-sm break-words">
                    <li>Email: calauanlms@email.com</li>
                    <li>Phone: +63 912 345 6789</li>
                    <li>Calauan, Laguna</li>
                </ul>
            </div>


            <!-- Socials -->
            <div>
                <h4 class="font-semibold mb-4">
                    Connect with us
                </h4>

                <p class="text-sm mb-4">
                    We’d love to hear your needs and goals!
                </p>

                <div class="flex flex-wrap gap-4 text-sm">
                    <a href="#" class="hover:scale-110 transition">
                        Facebook
                    </a>

                    <a href="#" class="hover:scale-110 transition">
                        Email
                    </a>

                    <a href="#" class="hover:scale-110 transition">
                        Twitter
                    </a>
                </div>
            </div>

        </div>


        <!-- Divider -->
        <div class="border-t border-white/20 my-8
                    max-w-6xl mx-auto"></div>


        <!-- Bottom -->
        <div class="text-center text-xs sm:text-sm">
            © 2026 Calauan LMS. All rights reserved.
        </div>

    </footer>
</x-layouts::guest>