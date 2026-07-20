<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola Kategori: <span class="text-blue-600">{{ $event->nama_event }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col md:flex-row gap-6">
            
            <!-- Kolom Kiri: Form Tambah Kategori -->
            <div class="w-full md:w-1/3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-4">Tambah Kategori</h3>
                    
                    @if(session('error'))
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-sm">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('manage-events.kategori.store', $event->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Jenis Jarak (Kategori)</label>
                            <select name="jenis_event_id" class="w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($master_jenis as $jenis)
                                    <option value="{{ $jenis->id }}">{{ $jenis->nama_jenis }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Harga Tiket (Rp)</label>
                            <input type="number" name="harga" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="Contoh: 150000" min="0" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Kuota Peserta</label>
                            <input type="number" name="kuota" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="Contoh: 500" min="1" required>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            + Tambahkan
                        </button>
                    </form>
                    <div class="mt-4">
                        <a href="{{ route('manage-events.index') }}" class="text-sm text-gray-600 hover:underline">&larr; Kembali ke Daftar Event</a>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Tabel Kategori yang Sudah Ada -->
            <div class="w-full md:w-2/3">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-4">Kategori Tersedia</h3>
                    
                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border p-3">Kategori</th>
                                    <th class="border p-3">Harga</th>
                                    <th class="border p-3">Kuota</th>
                                    <th class="border p-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kategoris as $item)
                                    <tr>
                                        <td class="border p-3 font-semibold">{{ $item->jenisEvent->nama_jenis }}</td>
                                        <td class="border p-3">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                        <td class="border p-3">{{ $item->kuota }} orang</td>
                                        <td class="border p-3">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('manage-events.kategori.edit', [$event->id, $item->id]) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">Edit</a>
                                            <form action="{{ route('manage-events.kategori.destroy', [$event->id, $item->id]) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="border p-3 text-center text-gray-500">Belum ada kategori untuk event ini.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>