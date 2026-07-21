<x-guest-layout>
    <x-slot name="title">Daftar Akun</x-slot>

    {{-- Header --}}
    <div class="mb-7">
        <h2 class="text-3xl font-extrabold text-slate-900">Buat Akun Baru</h2>
        <p class="text-slate-500 mt-1">Bergabung dan mulai ikuti event larimu!</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        {{-- Nama Lengkap --}}
        <div>
            <x-input-label for="name" value="Nama Lengkap" class="text-sm font-semibold text-slate-700" />
            <x-text-input
                id="name"
                class="block mt-1.5 w-full"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
                autocomplete="name"
                placeholder="Nama sesuai KTP"
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        {{-- Email --}}
        <div>
            <x-input-label for="email" value="Alamat Email" class="text-sm font-semibold text-slate-700" />
            <x-text-input
                id="email"
                class="block mt-1.5 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autocomplete="username"
                placeholder="nama@email.com"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        {{-- NIK --}}
        <div>
            <x-input-label for="nik" value="NIK (Nomor Induk Kependudukan)" class="text-sm font-semibold text-slate-700" />
            <x-text-input
                id="nik"
                class="block mt-1.5 w-full"
                type="text"
                name="nik"
                :value="old('nik')"
                maxlength="16"
                placeholder="16 digit NIK sesuai KTP"
            />
            <p class="mt-1 text-xs text-slate-400">NIK tidak dapat diubah setelah registrasi. Pastikan benar.</p>
            <x-input-error :messages="$errors->get('nik')" class="mt-1" />
        </div>

        {{-- No. HP --}}
        <div>
            <x-input-label for="no_hp" value="No. HP (WhatsApp)" class="text-sm font-semibold text-slate-700" />
            <x-text-input
                id="no_hp"
                class="block mt-1.5 w-full"
                type="tel"
                name="no_hp"
                :value="old('no_hp')"
                placeholder="08xxxxxxxxxx"
                pattern="[0-9]*"
                inputmode="numeric"
                maxlength="13"
            />
            <p class="mt-1 text-xs text-slate-400">Hanya angka, 10–13 digit. Contoh: 081234567890</p>
            <x-input-error :messages="$errors->get('no_hp')" class="mt-1" />
        </div>

        {{-- Password --}}
        <div>
            <x-input-label for="password" value="Kata Sandi" class="text-sm font-semibold text-slate-700" />
            <x-text-input
                id="password"
                class="block mt-1.5 w-full"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                placeholder="Minimal 8 karakter"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        {{-- Confirm Password --}}
        <div>
            <x-input-label for="password_confirmation" value="Konfirmasi Kata Sandi" class="text-sm font-semibold text-slate-700" />
            <x-text-input
                id="password_confirmation"
                class="block mt-1.5 w-full"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="Ulangi kata sandi"
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        {{-- Submit --}}
        <button type="submit"
            class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-brand-600 hover:bg-brand-700 active:bg-brand-800 text-white font-bold rounded-xl transition-colors duration-200 shadow-sm hover:shadow-md mt-2">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
            </svg>
            Buat Akun
        </button>
    </form>

    {{-- Login Link --}}
    <p class="mt-6 text-center text-sm text-slate-500">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-brand-600 hover:text-brand-700 font-bold transition-colors">
            Masuk di sini
        </a>
    </p>
</x-guest-layout>
