<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('manage-users.index') }}" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>
            <h2 class="font-extrabold text-2xl text-slate-800 leading-tight">Edit Pengguna</h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8">

                {{-- User info badge --}}
                <div class="flex items-center gap-4 mb-8 pb-6 border-b border-slate-100">
                    <div class="w-14 h-14 rounded-full bg-gradient-to-br from-brand-500 to-accent-500 flex items-center justify-center text-white text-xl font-bold uppercase">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="font-bold text-slate-800 text-lg">{{ $user->name }}</p>
                        <p class="text-slate-400 text-sm">Peserta · Bergabung {{ $user->created_at ? $user->created_at->format('d M Y') : '—' }}</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('manage-users.update', $user) }}" class="space-y-5">
                    @csrf
                    @method('PATCH')

                    {{-- Nama --}}
                    <div>
                        <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                            class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition">
                        @error('name')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">Alamat Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                            class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition">
                        @error('email')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- NIK --}}
                    <div>
                        <label for="nik" class="block text-sm font-semibold text-slate-700 mb-1.5">
                            NIK <span class="text-slate-400 font-normal">(16 digit)</span>
                        </label>
                        <input type="text" id="nik" name="nik" value="{{ old('nik', $user->nik) }}"
                            maxlength="16" placeholder="Nomor Induk Kependudukan"
                            class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-mono focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition">
                        @error('nik')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- No. HP --}}
                    <div>
                        <label for="no_hp" class="block text-sm font-semibold text-slate-700 mb-1.5">
                            No. HP <span class="text-slate-400 font-normal">(10–13 digit)</span>
                        </label>
                        <input type="tel" id="no_hp" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}"
                            pattern="[0-9]*" inputmode="numeric" maxlength="13" placeholder="08xxxxxxxxxx"
                            class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition">
                        @error('no_hp')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
                        <button type="submit"
                            class="flex items-center gap-2 px-6 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold text-sm rounded-xl transition-colors">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('manage-users.index') }}"
                            class="px-6 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 font-semibold text-sm rounded-xl transition-colors">
                            Batal
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
