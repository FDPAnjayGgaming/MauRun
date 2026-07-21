<x-guest-layout>
    <x-slot name="title">Masuk</x-slot>

    {{-- Header --}}
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-slate-900">Selamat Datang!</h2>
        <p class="text-slate-500 mt-1">Masuk ke akun MauRun kamu</p>
    </div>

    {{-- Session Status --}}
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        {{-- Email --}}
        <div>
            <x-input-label for="email" :value="__('Alamat Email')" class="text-sm font-semibold text-slate-700" />
            <x-text-input
                id="email"
                class="block mt-1.5 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
                placeholder="nama@email.com"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- Password --}}
        <div>
            <div class="flex items-center justify-between">
                <x-input-label for="password" :value="__('Kata Sandi')" class="text-sm font-semibold text-slate-700" />
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs text-brand-600 hover:text-brand-700 font-semibold transition-colors">
                        Lupa kata sandi?
                    </a>
                @endif
            </div>
            <x-text-input
                id="password"
                class="block mt-1.5 w-full"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="••••••••"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Remember Me --}}
        <div class="flex items-center gap-2">
            <input id="remember_me" type="checkbox"
                class="rounded border-slate-300 text-brand-600 shadow-sm focus:ring-brand-500"
                name="remember">
            <label for="remember_me" class="text-sm text-slate-600 cursor-pointer">Ingat saya</label>
        </div>

        {{-- Submit --}}
        <button type="submit"
            class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-brand-600 hover:bg-brand-700 active:bg-brand-800 text-white font-bold rounded-xl transition-colors duration-200 shadow-sm hover:shadow-md mt-2">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
            </svg>
            Masuk
        </button>
    </form>

    {{-- Register Link --}}
    <p class="mt-6 text-center text-sm text-slate-500">
        Belum punya akun?
        <a href="{{ route('register') }}" class="text-brand-600 hover:text-brand-700 font-bold transition-colors">
            Daftar Sekarang
        </a>
    </p>
</x-guest-layout>
