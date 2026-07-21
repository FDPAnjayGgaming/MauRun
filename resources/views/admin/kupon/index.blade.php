<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="page-header-title">Manajemen Kupon Diskon</h2>
            <a href="{{ route('manage-kupon.create') }}" class="btn btn-primary">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Kupon
            </a>
        </div>
    </x-slot>

    <div class="animate-fade-in">

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
                <div class="flex items-center justify-between mb-5">
                    <h3 class="text-lg font-bold text-slate-800">Daftar Kupon</h3>
                    <span class="badge badge-info">{{ $kupons->count() }} kupon</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Diskon</th>
                                <th class="text-center">Sisa Kuota</th>
                                <th>Expired</th>
                                <th class="text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kupons as $kupon)
                                <tr>
                                    <td>
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md bg-slate-100 text-slate-800 font-mono text-xs font-bold tracking-wider">
                                            {{ $kupon->kode_kupon }}
                                        </span>
                                    </td>

                                    <td>
                                        @if($kupon->tipe_diskon == 'nominal')
                                            <span class="font-semibold text-slate-800">Rp {{ number_format($kupon->nilai_diskon, 0, ',', '.') }}</span>
                                        @else
                                            <span class="font-semibold text-slate-800">{{ $kupon->nilai_diskon }}%</span>
                                            @if($kupon->maksimal_potongan)
                                                <br><span class="text-xs text-slate-400">Max Rp {{ number_format($kupon->maksimal_potongan, 0, ',', '.') }}</span>
                                            @endif
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <span class="font-semibold">{{ $kupon->kuota_pemakaian }}</span>
                                    </td>

                                    <td>
                                        @php
                                            $isExpired = \Carbon\Carbon::parse($kupon->berlaku_sampai)->isPast();
                                        @endphp
                                        <span class="badge {{ $isExpired ? 'badge-danger' : 'badge-success' }}">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $isExpired ? 'bg-red-500' : 'bg-emerald-500' }}"></span>
                                            {{ \Carbon\Carbon::parse($kupon->berlaku_sampai)->format('d M Y') }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('manage-kupon.edit', $kupon->id) }}" class="btn btn-warning btn-sm">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                </svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('manage-kupon.destroy', $kupon->id) }}" method="POST" onsubmit="return confirm('Hapus kupon ini?');">
                                                @csrf @method('DELETE')
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
                                    <td colspan="5" class="text-center py-8">
                                        <div class="flex flex-col items-center gap-2">
                                            <svg class="w-10 h-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                                            </svg>
                                            <p class="text-slate-400 text-sm">Belum ada data kupon.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>