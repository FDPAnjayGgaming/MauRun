<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Manajemen Kupon Diskon</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded relative">{{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold">Daftar Kupon</h3>
                    <a href="{{ route('manage-kupon.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">+ Tambah Kupon</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border p-3">Kode</th>
                                <th class="border p-3">Diskon</th>
                                <th class="border p-3">Sisa Kuota</th>
                                <th class="border p-3">Expired</th>
                                <th class="border p-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kupons as $kupon)
                                <tr>
                                    <td class="border p-3 font-bold text-blue-600">{{ $kupon->kode_kupon }}</td>
                                    
                                    <td class="border p-3">
                                        @if($kupon->tipe_diskon == 'nominal')
                                            Rp {{ number_format($kupon->nilai_diskon, 0, ',', '.') }}
                                        @else
                                            {{ $kupon->nilai_diskon }}% 
                                            @if($kupon->maksimal_potongan)
                                                <br><span class="text-xs text-gray-500">(Max Rp {{ number_format($kupon->maksimal_potongan, 0, ',', '.') }})</span>
                                            @endif
                                        @endif
                                    </td>
                                    
                                    <td class="border p-3 text-center">{{ $kupon->kuota_pemakaian }}</td>
                                    
                                    <td class="border p-3">
                                        @php
                                            $isExpired = \Carbon\Carbon::parse($kupon->berlaku_sampai)->isPast();
                                        @endphp
                                        <span class="py-1 px-3 rounded-full text-xs font-bold {{ $isExpired ? 'bg-red-200 text-red-800' : 'bg-green-200 text-green-800' }}">
                                            {{ \Carbon\Carbon::parse($kupon->berlaku_sampai)->format('d M Y') }}
                                        </span>
                                    </td>
                                    
                                    <td class="border p-3">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('manage-kupon.edit', $kupon->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">Edit</a>
                                            <form action="{{ route('manage-kupon.destroy', $kupon->id) }}" method="POST" onsubmit="return confirm('Hapus kupon ini?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="border p-3 text-center text-gray-500">Belum ada data kupon.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>