<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('manage-events.index') }}" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>
            <h2 class="page-header-title">{{ __('Tambah Event Baru') }}</h2>
        </div>
    </x-slot>

    <div class="max-w-3xl animate-fade-in">
        <div class="card">
            <div class="card-body">

                <form action="{{ route('manage-events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">Nama Event</label>
                        <input type="text" name="nama_event" class="form-input-modern" value="{{ old('nama_event') }}" placeholder="Contoh: Jakarta Marathon 2026" required>
                        @error('nama_event') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                        <div>
                            <label class="form-label">Tanggal Pelaksanaan</label>
                            <input type="date" name="tanggal" class="form-input-modern" value="{{ old('tanggal') }}" required>
                            @error('tanggal') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="form-label">Kota</label>
                            <select name="kota_id" class="form-input-modern" required>
                                <option value="">-- Pilih Kota --</option>
                                @foreach($kotas as $kota)
                                    <option value="{{ $kota->id }}" {{ old('kota_id') == $kota->id ? 'selected' : '' }}>{{ $kota->nama_kota }}</option>
                                @endforeach
                            </select>
                            @error('kota_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Deskripsi Event</label>
                        <textarea name="deskripsi" rows="4" class="form-input-modern" placeholder="Jelaskan detail event lari..." required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Banner Event (Opsional)</label>
                        <div class="mt-1 flex justify-center rounded-xl border-2 border-dashed border-slate-300 px-6 py-8 hover:border-brand-400 transition-colors"
                             x-data="{ fileName: null }"
                             x-on:dragover.prevent="$el.classList.add('border-brand-500', 'bg-brand-50')"
                             x-on:dragleave.prevent="$el.classList.remove('border-brand-500', 'bg-brand-50')"
                             x-on:drop.prevent="$refs.fileInput.files = $event.dataTransfer.files; fileName = $refs.fileInput.files[0].name; $el.classList.remove('border-brand-500', 'bg-brand-50')">
                            <div class="text-center">
                                <svg x-show="!fileName" class="mx-auto h-10 w-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a2.25 2.25 0 002.25-2.25V5.25a2.25 2.25 0 00-2.25-2.25H3.75a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 003.75 21z" />
                                </svg>
                                <svg x-show="fileName" x-cloak class="mx-auto h-10 w-10 text-brand-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div class="mt-3 text-sm text-slate-600">
                                    <label class="cursor-pointer text-brand-600 font-semibold hover:text-brand-500">
                                        <span x-show="!fileName">Pilih file gambar</span>
                                        <span x-show="fileName" x-cloak>Ganti file</span>
                                        <input x-ref="fileInput" type="file" name="banner" accept="image/*" class="sr-only" x-on:change="fileName = $event.target.files[0].name">
                                    </label>
                                    <span x-show="!fileName" class="pl-1">atau drag & drop</span>
                                </div>
                                <p x-show="!fileName" class="text-xs text-slate-400 mt-1">PNG, JPG hingga 2MB</p>
                                <p x-show="fileName" x-cloak class="text-xs text-brand-600 font-medium mt-2 bg-brand-50 inline-block px-3 py-1 rounded-full border border-brand-200" x-text="fileName"></p>
                            </div>
                        </div>
                        @error('banner') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label class="inline-flex items-center cursor-pointer gap-2">
                            <input type="checkbox" name="is_active" value="1" class="rounded border-slate-300 text-brand-600 shadow-sm focus:border-brand-300 focus:ring focus:ring-brand-200 focus:ring-opacity-50" {{ old('is_active') ? 'checked' : '' }}>
                            <span class="text-sm text-slate-700">Langsung Aktifkan (Publish)</span>
                        </label>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                        <a href="{{ route('manage-events.index') }}" class="btn btn-ghost">Batal</a>
                        <button type="submit" class="btn btn-primary">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                            Simpan Event
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>