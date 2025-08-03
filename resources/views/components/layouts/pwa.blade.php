<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Cafe Royalty') }}</title>

    <!-- PWA Meta Tags -->
    <meta name="theme-color" content="#d97706">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="Cafe Royalty">
    <meta name="msapplication-TileColor" content="#d97706">
    <meta name="msapplication-tap-highlight" content="no">

    <!-- PWA Manifest -->
    <link rel="manifest" href="/manifest.json">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-amber-50 via-orange-50 to-amber-100" style="background-image: url('https://images.unsplash.com/photo-1442512595331-e89e73853f31?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80'); background-size: cover; background-position: center; background-attachment: fixed;">
    <div class="min-h-screen bg-black bg-opacity-20">
    <!-- Main Content -->
    <div class="min-h-screen pb-20">
        {{ $slot }}
    </div>
    </div>

    <!-- Bottom Navigation -->
    <nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-amber-200 shadow-lg">
        <div class="flex justify-around items-center h-16">
            <a href="{{ route('dashboard') }}"
               class="flex flex-col items-center justify-center flex-1 h-full {{ request()->routeIs('dashboard') ? 'text-amber-700 bg-amber-50' : 'text-gray-600 hover:text-amber-600' }} transition-colors">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                </svg>
                <span class="text-xs font-medium">Dashboard</span>
            </a>

            <a href="{{ route('purchases') }}"
               class="flex flex-col items-center justify-center flex-1 h-full {{ request()->routeIs('purchases') ? 'text-amber-700 bg-amber-50' : 'text-gray-600 hover:text-amber-600' }} transition-colors">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span class="text-xs font-medium">Earn</span>
            </a>

            <a href="{{ route('rewards') }}"
               class="flex flex-col items-center justify-center flex-1 h-full {{ request()->routeIs('rewards') ? 'text-amber-700 bg-amber-50' : 'text-gray-600 hover:text-amber-600' }} transition-colors">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                </svg>
                <span class="text-xs font-medium">Rewards</span>
            </a>

            @if(auth()->user()->isStaff())
            <a href="{{ route('staff.dashboard') }}"
               class="flex flex-col items-center justify-center flex-1 h-full {{ request()->routeIs('staff.dashboard') ? 'text-blue-700 bg-blue-50' : 'text-gray-600 hover:text-blue-600' }} transition-colors">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span class="text-xs font-medium">Staff</span>
            </a>
            @else
            <a href="{{ route('profile') }}"
               class="flex flex-col items-center justify-center flex-1 h-full {{ request()->routeIs('profile') ? 'text-amber-700 bg-amber-50' : 'text-gray-600 hover:text-amber-600' }} transition-colors">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span class="text-xs font-medium">Profile</span>
            </a>
            @endif
        </div>
    </nav>

    <!-- Service Worker Registration -->
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/sw.js')
                    .then(function(registration) {
                        console.log('SW registered: ', registration);
                    })
                    .catch(function(registrationError) {
                        console.log('SW registration failed: ', registrationError);
                    });
            });
        }
    </script>
</body>
</html>
