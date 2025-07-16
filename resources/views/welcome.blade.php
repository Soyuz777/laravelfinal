<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Booking System') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen flex flex-col items-center justify-center px-4">

        <!-- Branding -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800">Laravel Booking System</h1>
            <p class="mt-2 text-gray-500 text-lg">Book, manage, and track with ease.</p>
        </div>

        <!-- Card -->
        <div class="w-full max-w-md bg-white shadow-md rounded-lg p-8 space-y-6">
            <h2 class="text-2xl font-semibold text-gray-800 text-center">Welcome</h2>
            <p class="text-center text-gray-500 text-sm">Log in or register to access your bookings</p>

            <!-- Buttons -->
            <div class="flex flex-col gap-4">
                <a href="{{ route('login') }}"
                   class="w-full text-center bg-gray-800 hover:bg-black text-white font-medium py-2 px-4 rounded transition">
                    Login
                </a>
                <a href="{{ route('register') }}"
                   class="w-full text-center border border-gray-300 text-gray-700 hover:bg-gray-100 font-medium py-2 px-4 rounded transition">
                    Register
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-10 text-gray-400 text-xs">
            &copy; {{ now()->year }} Laravel Booking System
        </div>
    </div>
</body>
</html>
