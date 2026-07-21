<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MauRun') }} - {{ $title ?? 'Autentikasi' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased" style="font-family: 'Inter', sans-serif;">

<div class="min-h-screen flex">

    {{-- ===== PANEL KIRI: Branding ===== --}}
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-gradient-to-br from-brand-900 via-brand-800 to-accent-700 flex-col justify-between p-12">

        {{-- Background decoration --}}
        <div class="absolute inset-0 opacity-10">
            <svg viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg" class="absolute -top-20 -right-20 w-96 h-96 text-white">
                <circle cx="300" cy="300" r="250" fill="currentColor" />
            </svg>
            <svg viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg" class="absolute -bottom-32 -left-20 w-80 h-80 text-white">
                <circle cx="300" cy="300" r="250" fill="currentColor" />
            </svg>
        </div>

        {{-- Logo --}}
        <div class="relative">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="MauRun Logo" class="h-10 w-auto drop-shadow-lg">
                <span class="font-extrabold text-2xl tracking-tight text-white">
                    MAU<span class="text-accent-300">RUN</span>
                </span>
            </a>
        </div>

        {{-- Center Content --}}
        <div class="relative space-y-6">
            <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 text-white/90 text-sm font-semibold px-4 py-1.5 rounded-full">
                🏃‍♂️ Platform Lari Terpercaya #1 Indonesia
            </div>
            <h1 class="text-4xl xl:text-5xl font-extrabold text-white leading-tight">
                Satu Langkah<br>Menuju <span class="text-accent-300">Finish Line</span>
            </h1>
            <p class="text-white/70 text-lg leading-relaxed max-w-sm">
                Temukan ratusan event lari di seluruh Indonesia. Daftar, ikuti, dan raih medalimu!
            </p>

            {{-- Stats --}}
            <div class="flex items-center gap-8 pt-4">
                <div>
                    <p class="text-3xl font-extrabold text-white">500+</p>
                    <p class="text-white/60 text-sm">Event Tersedia</p>
                </div>
                <div class="w-px h-10 bg-white/20"></div>
                <div>
                    <p class="text-3xl font-extrabold text-white">50K+</p>
                    <p class="text-white/60 text-sm">Pelari Aktif</p>
                </div>
                <div class="w-px h-10 bg-white/20"></div>
                <div>
                    <p class="text-3xl font-extrabold text-white">30+</p>
                    <p class="text-white/60 text-sm">Kota</p>
                </div>
            </div>
        </div>

        {{-- Bottom --}}
        <div class="relative">
            <p class="text-white/40 text-sm">© {{ date('Y') }} MauRun. All rights reserved.</p>
        </div>
    </div>

    {{-- ===== PANEL KANAN: Form ===== --}}
    <div class="w-full lg:w-1/2 flex flex-col justify-center items-center px-6 sm:px-12 lg:px-16 xl:px-24 py-12 bg-slate-50">

        {{-- Mobile Logo --}}
        <div class="lg:hidden mb-8">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="MauRun Logo" class="h-9 w-auto">
                <span class="font-extrabold text-xl tracking-tight">
                    <span class="text-brand-600">MAU</span><span class="text-accent-500">RUN</span>
                </span>
            </a>
        </div>

        <div class="w-full max-w-md">
            {{ $slot }}
        </div>
    </div>

</div>

</body>
</html>
