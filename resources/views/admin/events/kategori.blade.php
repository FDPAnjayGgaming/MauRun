<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('manage-events.index') }}" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>
            <h2 class="page-header-title">
                Kelola Kategori: <span class="text-brand-600">{{ $event->nama_event }}</span>
            </h2>
        </div>
    </x-slot>

    <div class="animate-fade-in">
        <div class="flex flex-col lg:flex-row gap-6">

            {{-- Form Tambah Kategori --}}
            <div class="w-full lg:w-1/3">
                <div class="card card-hover">
                    <div class="card-body">
                        <h3 class="text-lg font-bold text-slate-800 mb-4">Tambah Kategori</h3>

                        @if(session('error'))
                            <div class="toast-error mb-4">
                                <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                </svg>
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('manage-events.kategori.store', $event->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Jenis Jarak (Kategori)</label>
                                <select name="jenis_event_id" class="form-input-modern" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($master_jenis as $jenis)
                                        <option value="{{ $jenis->id }}">{{ $jenis->nama_jenis }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Harga Tiket (Rp)</label>
                                <input type="number" name="harga" class="form-input-modern" placeholder="Contoh: 150000" min="0" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Kuota Peserta</label>
                                <input type="number" name="kuota" class="form-input-modern" placeholder="Contoh: 500" min="1" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-full">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                Tambahkan
                            </button>
                        </form>

                        <a href="{{ route('manage-events.index') }}" class="inline-flex items-center gap-1 mt-4 text-sm text-slate-500 hover:text-brand-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                            </svg>
                            Kembali ke Daftar Event
                        </a>
                    </div>
                </div>
            </div>

            {{-- Tabel Kategori --}}
            <div class="w-full lg:w-2/3">
                <div class="card">
                    <div class="card-body">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-slate-800">Kategori Tersedia</h3>
                            <span class="badge badge-info">{{ $kategoris->count() }} kategori</span>
                        </div>

                        @if(session('success'))
                            <div class="toast-success mb-4">
                                <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="overflow-x-auto">
                            <table class="table-modern">
                                <thead>
                                    <tr>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Kuota</th>
                                        <th class="text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($kategoris as $item)
                                        <tr>
                                            <td class="font-semibold text-slate-800">{{ $item->jenisEvent->nama_jenis }}</td>
                                            <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                            <td>{{ $item->kuota }} orang</td>
                                            <td>
                                                <div class="flex items-center justify-end gap-2">
                                                    <a href="{{ route('manage-events.kategori.edit', [$event->id, $item->id]) }}" class="btn btn-warning btn-sm">
                                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                        </svg>
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('manage-events.kategori.destroy', [$event->id, $item->id]) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                            </svg>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-8">
                                                <p class="text-slate-400 text-sm">Belum ada kategori untuk event ini.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>