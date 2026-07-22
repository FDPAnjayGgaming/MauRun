<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('manage-pendaftar.index') }}" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>
            <h2 class="font-extrabold text-2xl text-slate-800 leading-tight">Edit Pendaftar</h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8">

                {{-- User info badge --}}
                <div class="flex items-center gap-4 mb-8 pb-6 border-b border-slate-100">
                    <div class="w-14 h-14 rounded-full bg-gradient-to-br from-brand-500 to-accent-500 flex items-center justify-center text-white text-xl font-bold uppercase">
                        {{ substr($pendaftaran->user->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="font-bold text-slate-800 text-lg">{{ $pendaftaran->user->name }}</p>
                        <p class="text-slate-400 text-sm">{{ $pendaftaran->eventKategori->event->nama_event }} - {{ $pendaftaran->eventKategori->jenisEvent->nama_jenis }}</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('manage-pendaftar.update', $pendaftaran->id) }}" class="space-y-5">
                    @csrf
                    @method('PATCH')

                    {{-- Status Pembayaran --}}
                    <div>
                        <label for="status_pembayaran" class="block text-sm font-semibold text-slate-700 mb-1.5">Status Pembayaran</label>
                        <select id="status_pembayaran" name="status_pembayaran" required
                            class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition">
                            <option value="Pending" {{ old('status_pembayaran', $pendaftaran->status_pembayaran) == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Lunas" {{ old('status_pembayaran', $pendaftaran->status_pembayaran) == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                            <option value="Dibatalkan" {{ old('status_pembayaran', $pendaftaran->status_pembayaran) == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                        @error('status_pembayaran')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Ukuran Jersey --}}
                    <div>
                        <label for="ukuran_jersey" class="block text-sm font-semibold text-slate-700 mb-1.5">Ukuran Jersey</label>
                        <select id="ukuran_jersey" name="ukuran_jersey" required
                            class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition">
                            @foreach(['S', 'M', 'L', 'XL', 'XXL'] as $ukuran)
                                <option value="{{ $ukuran }}" {{ old('ukuran_jersey', $pendaftaran->ukuran_jersey) == $ukuran ? 'selected' : '' }}>{{ $ukuran }}</option>
                            @endforeach
                        </select>
                        @error('ukuran_jersey')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Golongan Darah --}}
                    <div>
                        <label for="golongan_darah" class="block text-sm font-semibold text-slate-700 mb-1.5">Golongan Darah</label>
                        <select id="golongan_darah" name="golongan_darah" required
                            class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition">
                            @foreach(['A', 'B', 'AB', 'O'] as $goldar)
                                <option value="{{ $goldar }}" {{ old('golongan_darah', $pendaftaran->golongan_darah) == $goldar ? 'selected' : '' }}>{{ $goldar }}</option>
                            @endforeach
                        </select>
                        @error('golongan_darah')
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
                        <a href="{{ route('manage-pendaftar.index') }}"
                            class="px-6 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 font-semibold text-sm rounded-xl transition-colors">
                            Batal
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
