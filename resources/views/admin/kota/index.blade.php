<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Master Kota / Lokasi</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
            @endif

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <!-- Form Tambah -->
                <form action="{{ route('manage-kota.store') }}" method="POST" class="mb-6 flex gap-2">
                    @csrf
                    <input type="text" name="nama_kota" class="flex-1 border-gray-300 rounded-md" placeholder="Contoh: Jakarta" required>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded font-bold">+ Simpan Kota</button>
                </form>

                <!-- Tabel -->
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="p-3">Nama Kota</th>
                            <th class="p-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kota as $item)
                        <tr class="border-b">
                            <td class="p-3">{{ $item->nama_kota }}</td>
                            <td class="p-3">
                                <form action="{{ route('manage-kota.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus kota ini?');">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>