<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Cafe Royalty') }}</title>

    <!-- PWA Meta Tags -->
    <meta name="theme-color" content="#6F4E37">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="Cafe Royalty">
    <meta name="msapplication-TileColor" content="#6F4E37">
    <meta name="msapplication-tap-highlight" content="no">

    <!-- PWA Manifest -->
    <link rel="manifest" href="/manifest.json">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-body antialiased bg-neutral-50">
    <!-- Main Content -->
    <div class="min-h-screen pb-20">
        {{ $slot }}
    </div>

    <!-- Bottom Navigation -->
    <nav class="fixed bottom-0 left-0 right-0 bg-white border-t border-neutral-200 shadow-lg">
        <div class="flex justify-around items-center h-16">
            <a href="{{ route('dashboard') }}"
               class="flex flex-col items-center justify-center flex-1 h-full {{ request()->routeIs('dashboard') ? 'text-primary-600' : 'text-neutral-500 hover:text-primary-600' }} transition-colors">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                <span class="text-xs font-medium">Home</span>
            </a>

            <a href="{{ route('rewards') }}"
               class="flex flex-col items-center justify-center flex-1 h-full {{ request()->routeIs('rewards') ? 'text-primary-600' : 'text-neutral-500 hover:text-primary-600' }} transition-colors">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                </svg>
                <span class="text-xs font-medium">Rewards</span>
            </a>

            @if(auth()->user()->isStaff())
            <a href="{{ route('staff.dashboard') }}"
               class="flex flex-col items-center justify-center flex-1 h-full {{ request()->routeIs('staff.dashboard') ? 'text-primary-600' : 'text-neutral-500 hover:text-primary-600' }} transition-colors">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span class="text-xs font-medium">Staff</span>
            </a>
            @else
            <a href="{{ route('profile') }}"
               class="flex flex-col items-center justify-center flex-1 h-full {{ request()->routeIs('profile') ? 'text-primary-600' : 'text-neutral-500 hover:text-primary-600' }} transition-colors">
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

        // Suppress Vite HMR WebSocket errors in production
        if (typeof window !== 'undefined' && window.location.hostname !== 'localhost') {
            window.addEventListener('error', function(e) {
                if (e.message.includes('WebSocket') && e.message.includes('wss://')) {
                    e.preventDefault();
                    return false;
                }
            });
        }
    </script>
</body>
</html>
