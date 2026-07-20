<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Master Jenis Kategori</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <!-- Form Tambah -->
                <form action="{{ route('manage-jenis.store') }}" method="POST" class="mb-6 flex gap-2">
                    @csrf
                    <input type="text" name="nama_jenis" class="flex-1 border-gray-300 rounded-md" placeholder="Contoh: 10K Marathon" required>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded font-bold">+ Simpan</button>
                </form>

                <!-- Tabel -->
                <table class="w-full text-left">
                    <tr class="bg-gray-100">
                        <th class="p-3">Nama Kategori</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                    @foreach($jenis as $item)
                    <tr class="border-b">
                        <td class="p-3">{{ $item->nama_jenis }}</td>
                        <td class="p-3">
                            <form action="{{ route('manage-jenis.destroy', $item->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</x-app-layout>