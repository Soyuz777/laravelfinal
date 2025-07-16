<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />

    <!-- AlpineJS for interactivity -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">

    <div class="min-h-screen flex">
        <!-- Sidebar (Hover to Expand) -->
        <aside 
            x-data="{ open: false }" 
            @mouseenter="open = true" 
            @mouseleave="open = false"
            class="bg-gray-800 text-white transition-all duration-300 overflow-hidden"
            :class="open ? 'w-64 p-6' : 'w-16 p-3'"
        >
            <div class="mb-6" x-show="open" x-transition>
                <h2 class="text-xl font-bold">📋 Menu</h2>
            </div>
            <nav class="space-y-3 text-sm">
                <a href="{{ route('dashboard') }}" class="block hover:underline">
                    <span x-show="open">🏠 Dashboard</span>
                    <span x-show="!open" class="text-lg">🏠</span>
                </a>
                <a href="{{ route('bookings.index') }}" class="block hover:underline">
                    <span x-show="open">📅 My Bookings</span>
                    <span x-show="!open" class="text-lg">📅</span>
                </a>
                <a href="{{ route('bookings.manual') }}" class="block hover:underline">
                    <span x-show="open">➕ Manual Booking</span>
                    <span x-show="!open" class="text-lg">➕</span>
                </a>

                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.bookings.index') }}" class="block hover:underline">
                            <span x-show="open">🛠 Manage Bookings (Admin)</span>
                            <span x-show="!open" class="text-lg">🛠</span>
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="block hover:underline">
                            <span x-show="open">👥 Manage Users (Admin)</span>
                            <span x-show="!open" class="text-lg">👥</span>
                        </a>
                    @endif
                @endauth
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <!-- Toast Notifications -->
    <script>
        @if (session('success'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        @endif

        @if (session('error'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        @endif
    </script>
</body>
</html>
