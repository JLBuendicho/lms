<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calauan LMS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="relative min-h-screen bg-white pt-20">

        <!-- Background Pattern -->
        <div class="absolute inset-0">
            <x-placeholder-pattern class="h-full w-full text-green-100" />
        </div>

        <!-- Hero Content -->
        <div class="relative z-10 flex min-h-[calc(100vh-5rem)] flex-col items-center justify-center px-6 text-center">
            <h1 class="mb-6 text-4xl font-bold text-black md:text-6xl">
                Calauan LMS
            </h1>

            <p class="max-w-2xl text-lg text-gray-700 md:text-2xl">
                No student left behind. Life long learning for everyone.
            </p>

            <div class="my-8 h-1 w-32 rounded-full bg-green-600"></div>

            <div class="flex flex-col gap-4 sm:flex-row">
                <a href="/login"
                    class="rounded-lg bg-green-700 px-6 py-3 font-semibold text-white transition hover:bg-green-800">
                    Get Started
                </a>
                <a href="#solutions-section"
                    class="rounded-lg border border-green-700 px-6 py-3 font-semibold text-green-700 transition hover:bg-green-50">
                    Learn More
                </a>
            </div>
        </div>
    </div>
</body>

<x-navbar :navlinks="[
    ['url' => '#hero-section', 'text' => 'Home'],
    ['url' => '#features-section', 'text' => 'Features'],
    ['url' => '#contact-section', 'text' => 'Contact Us'],
]" />

<main>

    <section id = "goal-section"
        class="relative w-full h-screen bg-green-600 text-black flex flex-col items-center justify-center">
        <div class="absolute z-10 top-4 left-5 mb-10">
            <h2 class="text-4xl font-bold text-center ">Our vision and Goal</h2>
            <p class="text-lg text-black text-center mt-4 ">
                We envision a future where every student, regardless of their background or circumstances, has access to
                high-quality education and the opportunity to reach their full potential. Our goal is to create an
                inclusive and innovative learning environment that empowers students to thrive academically, socially,
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

    <section id="Features-sections" class="relative w-full min-h-screen flex flex-col items-center px-10 py-10">

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

</main>

<footer id="footer" class="bg-green-600 text-white py-12">

    <div class="grid grid-cols-1 md:grid-cols-4 gap-20 max-w-7xl mx-auto">

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

</body>

</html>
