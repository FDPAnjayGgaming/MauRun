<x-app-layout>
    <x-slot name="header">
        <h2 class="page-header-title">
            {{ __('Manajemen Pendaftar') }}
        </h2>
    </x-slot>

    <div class="space-y-6">

        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6">
                <p class="text-sm text-green-700 font-semibold">{{ session('success') }}</p>
            </div>
        @endif

        {{-- Filters --}}
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
            <form method="GET" action="{{ route('manage-pendaftar.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <x-input-label for="search" value="Cari Nama / NIK" />
                    <x-text-input id="search" name="search" type="text" class="block w-full mt-1" value="{{ request('search') }}" placeholder="Ketik kata kunci..." />
                </div>
                <div>
                    <x-input-label for="event_id" value="Filter Event" />
                    <select id="event_id" name="event_id" class="border-gray-300 focus:border-brand-500 focus:ring-brand-500 rounded-md shadow-sm block mt-1 w-full">
                        <option value="">Semua Event</option>
                        @foreach($events as $event)
                            <option value="{{ $event->id }}" {{ request('event_id') == $event->id ? 'selected' : '' }}>
                                {{ $event->nama_event }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="bg-slate-800 hover:bg-slate-900 text-white font-semibold px-6 py-2.5 rounded-xl transition-colors w-full md:w-auto">
                        Terapkan Filter
                    </button>
                    @if(request()->hasAny(['search', 'event_id']))
                        <a href="{{ route('manage-pendaftar.index') }}" class="bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-semibold px-6 py-2.5 rounded-xl transition-colors w-full md:w-auto text-center">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Table --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="bg-slate-50 text-slate-800 uppercase text-xs font-bold border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4">Peserta</th>
                            <th class="px-6 py-4">Event & Kategori</th>
                            <th class="px-6 py-4">Jersey / Goldar</th>
                            <th class="px-6 py-4">Total Bayar</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($pendaftarans as $pendaftar)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4">
                                    <p class="font-bold text-slate-900">{{ $pendaftar->user->name ?? '-' }}</p>
                                    <p class="text-xs text-slate-500">NIK: {{ $pendaftar->user->nik ?? '-' }}</p>
                                    <p class="text-xs text-slate-500">HP: {{ $pendaftar->user->no_hp ?? '-' }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="font-semibold text-brand-700">{{ $pendaftar->eventKategori->event->nama_event ?? '-' }}</p>
                                    <p class="text-xs font-bold text-slate-700 mt-0.5">{{ $pendaftar->eventKategori->jenisEvent->nama_jenis ?? '-' }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <p>Jersey: <span class="font-bold text-slate-900">{{ $pendaftar->ukuran_jersey }}</span></p>
                                    <p class="text-xs">Goldar: <span class="font-bold text-slate-700">{{ $pendaftar->golongan_darah }}</span></p>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="font-bold text-slate-900">Rp {{ number_format($pendaftar->total_bayar, 0, ',', '.') }}</p>
                                    @if($pendaftar->kupon_id)
                                        <p class="text-xs text-green-600 font-semibold mt-0.5">Kupon: {{ $pendaftar->kupon->kode_kupon ?? 'Dipakai' }}</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($pendaftar->status_pembayaran === 'Lunas')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-800">
                                            Lunas
                                        </span>
                                    @elseif($pendaftar->status_pembayaran === 'Dibatalkan')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-100 text-red-800">
                                            Dibatalkan
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-100 text-amber-800">
                                            Pending
                                        </span>
                                    @endif
                                    <p class="text-[10px] text-slate-400 mt-1">{{ $pendaftar->created_at->format('d/m/Y H:i') }}</p>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <form action="{{ route('manage-pendaftar.update-status', $pendaftar->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status_pembayaran" onchange="this.form.submit()" class="text-xs border-gray-300 focus:border-brand-500 focus:ring-brand-500 rounded-lg shadow-sm font-semibold {{ $pendaftar->status_pembayaran === 'Lunas' ? 'bg-green-50' : ($pendaftar->status_pembayaran === 'Dibatalkan' ? 'bg-red-50' : 'bg-amber-50') }}">
                                            <option value="Pending" {{ $pendaftar->status_pembayaran === 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Lunas" {{ $pendaftar->status_pembayaran === 'Lunas' ? 'selected' : '' }}>Lunas</option>
                                            <option value="Dibatalkan" {{ $pendaftar->status_pembayaran === 'Dibatalkan' ? 'selected' : '' }}>Batalkan</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-slate-500">
                                    Belum ada data pendaftar yang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($pendaftarans->hasPages())
                <div class="p-6 border-t border-slate-200">
                    {{ $pendaftarans->links() }}
                </div>
            @endif
        </div>

    </div>
</x-app-layout>
