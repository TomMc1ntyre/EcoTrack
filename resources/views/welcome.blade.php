<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'EcoTrack') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 min-h-screen">

        <!-- Navigation -->
        <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center gap-2">
                        <svg class="h-7 w-7 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064" />
                        </svg>
                        <span class="text-xl font-semibold text-gray-800 dark:text-white">EcoTrack</span>
                    </div>

                    <div class="flex items-center gap-3">
                        @auth
                            <a href="{{ url('/dashboard') }}"
                               class="text-sm text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white px-4 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="text-sm bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md transition">
                                    Log Out
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}"
                               class="text-sm text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white px-4 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                                Log In
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                   class="text-sm bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md transition">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
            <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 dark:text-white mb-6">
                Track your <span class="text-green-600">eco-friendly</span> habits
            </h1>
            <p class="text-lg text-gray-500 dark:text-gray-400 max-w-2xl mx-auto mb-10">
                EcoTrack helps you log sustainable actions, set green goals, and earn points for making a positive impact on the planet.
            </p>

            @auth
                <a href="{{ url('/dashboard') }}"
                   class="inline-block bg-green-600 hover:bg-green-700 text-white font-medium px-8 py-3 rounded-lg text-lg transition">
                    Go to Dashboard
                </a>
            @else
                <div class="flex justify-center gap-4 flex-wrap">
                    <a href="{{ route('register') }}"
                       class="inline-block bg-green-600 hover:bg-green-700 text-white font-medium px-8 py-3 rounded-lg text-lg transition">
                        Get Started
                    </a>
                    <a href="{{ route('login') }}"
                       class="inline-block border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 font-medium px-8 py-3 rounded-lg text-lg transition">
                        Log In
                    </a>
                </div>
            @endauth

            <!-- Features -->
            <div class="mt-20 grid grid-cols-1 sm:grid-cols-3 gap-8 text-left">
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
                    <div class="text-green-600 mb-3">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-1">Log Actions</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Record your eco-friendly activities and earn points for each one.</p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
                    <div class="text-green-600 mb-3">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-1">Set Goals</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Create sustainability goals and track your progress over time.</p>
                </div>
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
                    <div class="text-green-600 mb-3">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-1">Track Progress</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">See your score history and how your impact grows over time.</p>
                </div>
            </div>
        </main>
    </body>
</html>
