<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('manage-events.kategori.index', $event->id) }}" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>
            <h2 class="page-header-title">
                Edit Kategori: <span class="text-brand-600">{{ $event->nama_event }}</span>
            </h2>
        </div>
    </x-slot>

    <div class="max-w-2xl animate-fade-in">
        <div class="card">
            <div class="card-body">

                @if(session('error'))
                    <div class="toast-error mb-4">
                        <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('manage-events.kategori.update', [$event->id, $kategori->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-label">Jenis Jarak (Kategori)</label>
                        <select name="jenis_event_id" class="form-input-modern" required>
                            @foreach($master_jenis as $jenis)
                                <option value="{{ $jenis->id }}" {{ $kategori->jenis_event_id == $jenis->id ? 'selected' : '' }}>
                                    {{ $jenis->nama_jenis }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Harga Tiket (Rp)</label>
                        <input type="number" name="harga" class="form-input-modern" value="{{ old('harga', $kategori->harga) }}" min="0" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Kuota Peserta</label>
                        <input type="number" name="kuota" class="form-input-modern" value="{{ old('kuota', $kategori->kuota) }}" min="1" required>
                    </div>

                    <div class="flex gap-3 pt-4 border-t border-slate-100">
                        <button type="submit" class="btn btn-primary">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('manage-events.kategori.index', $event->id) }}" class="btn btn-ghost">Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>