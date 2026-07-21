<x-app-layout>
    <x-slot name="header">
        <h2 class="page-header-title">Master Kota / Lokasi</h2>
    </x-slot>

    <div class="max-w-3xl animate-fade-in">

        @if(session('success'))
            <div class="toast-success mb-6">
                <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">

                {{-- Form Tambah --}}
                <form action="{{ route('manage-kota.store') }}" method="POST" class="mb-6 flex items-end gap-3">
                    @csrf
                    <div class="flex-1">
                        <label class="form-label">Nama Kota</label>
                        <input type="text" name="nama_kota" class="form-input-modern" placeholder="Contoh: Jakarta" required>
                    </div>
                    <button type="submit" class="btn btn-primary shrink-0">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Simpan Kota
                    </button>
                </form>

                <div class="border-t border-slate-100 pt-4">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th>Nama Kota</th>
                                <th class="text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kota as $item)
                            <tr>
                                <td class="font-semibold text-slate-800">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                        </svg>
                                        {{ $item->nama_kota }}
                                    </div>
                                </td>
                                <td class="text-right">
                                    <form action="{{ route('manage-kota.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus kota ini?');">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>