<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="MauRun — Platform pendaftaran event lari terbaik di Indonesia. Temukan, daftar, dan taklukkan tantanganmu bersama kami.">
    <title>{{ $title ?? 'MauRun — Event Lari Terbaik di Indonesia' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-slate-50">

    {{-- =================== NAVBAR =================== --}}
    <nav class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2.5">
                    <img src="{{ asset('images/logo.png') }}" alt="MauRun Logo" class="h-9 w-auto">
                    <span class="font-extrabold text-xl tracking-tight">
                        <span class="text-brand-600">MAU</span><span class="text-accent-500">RUN</span>
                    </span>
                </a>

                {{-- Nav Links --}}
                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ route('home') }}" class="text-sm font-semibold text-slate-600 hover:text-brand-600 transition-colors">Home</a>
                    <a href="{{ route('events') }}" class="text-sm font-semibold text-slate-600 hover:text-brand-600 transition-colors">Event</a>
                </div>

                {{-- Auth Buttons --}}
                <div class="flex items-center gap-3">
                    @auth
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-slate-500 bg-white hover:text-slate-700 focus:outline-none transition ease-in-out duration-150 shadow-sm">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ms-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                @if(Auth::user()->role === 'admin' || Auth::user()->role === 'panitia')
                                    <x-dropdown-link :href="route('dashboard-panitia')" class="font-bold text-brand-600">
                                        {{ __('Dashboard Panitia') }}
                                    </x-dropdown-link>
                                    <div class="border-t border-slate-100"></div>
                                @endif

                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profil Saya') }}
                                </x-dropdown-link>
                                
                                <x-dropdown-link :href="route('riwayat-pendaftaran')">
                                    {{ __('Riwayat Pendaftaran') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();"
                                            class="text-red-600 hover:text-red-700 hover:bg-red-50">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-slate-600 hover:text-brand-600 transition-colors">Masuk</a>
                        <a href="{{ route('register') }}" class="text-sm font-semibold px-4 py-2 rounded-lg bg-brand-600 text-white hover:bg-brand-700 transition-colors shadow-sm">
                            Daftar Sekarang
                        </a>
                    @endauth
                </div>

            </div>
        </div>
    </nav>

    {{-- =================== SLOT =================== --}}
    <main>
        {{ $slot }}
    </main>

    {{-- =================== FOOTER =================== --}}
    <footer class="bg-slate-900 text-slate-400 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                {{-- Brand --}}
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <img src="{{ asset('images/logo.png') }}" alt="MauRun" class="h-8 w-auto brightness-0 invert opacity-80">
                        <span class="font-extrabold text-lg text-white">
                            <span class="text-brand-400">MAU</span><span class="text-accent-400">RUN</span>
                        </span>
                    </div>
                    <p class="text-sm leading-relaxed">Platform pendaftaran event lari online terpercaya di Indonesia. Temukan event terbaik dan taklukkan batasmu.</p>
                </div>
                {{-- Links --}}
                <div>
                    <h4 class="text-white font-semibold mb-3 text-sm uppercase tracking-widest">Navigasi</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="{{ route('events') }}" class="hover:text-white transition-colors">Semua Event</a></li>
                    </ul>
                </div>
                {{-- Contact --}}
                <div>
                    <h4 class="text-white font-semibold mb-3 text-sm uppercase tracking-widest">Kontak</h4>
                    <ul class="space-y-2 text-sm">
                        <li>Email: info@maurun.id</li>
                        <li>Instagram: @maurun.id</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-slate-800 mt-10 pt-6 text-center text-xs">
                &copy; {{ date('Y') }} MauRun. Semua hak dilindungi.
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
