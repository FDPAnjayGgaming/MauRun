<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Notifikasi Sukses -->
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold">Daftar Event</h3>
                    <a href="{{ route('manage-events.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        + Tambah Event
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border p-3">Banner</th>
                                <th class="border p-3">Nama Event</th>
                                <th class="border p-3">Tanggal</th>
                                <th class="border p-3">Kota</th>
                                <th class="border p-3">Status</th>
                                <th class="border p-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($events as $event)
                                <tr>
                                    <td class="border p-3">
                                        @if($event->banner)
                                            <img src="{{ asset('storage/'.$event->banner) }}" alt="Banner" class="w-24 h-auto rounded">
                                        @else
                                            <span class="text-gray-400 text-sm">Tanpa Banner</span>
                                        @endif
                                    </td>
                                    <td class="border p-3 font-semibold">{{ $event->nama_event }}</td>
                                    <td class="border p-3">{{ \Carbon\Carbon::parse($event->tanggal)->format('d M Y') }}</td>
                                    <td class="border p-3">{{ $event->kota->nama_kota }}</td>
                                    <td class="border p-3">
                                        @if($event->is_active)
                                            <span class="bg-green-200 text-green-800 py-1 px-3 rounded-full text-xs">Aktif</span>
                                        @else
                                            <span class="bg-gray-200 text-gray-800 py-1 px-3 rounded-full text-xs">Draft</span>
                                        @endif
                                    </td>
                                    <td class="border p-3">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('manage-events.kategori.index', $event->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">+ Kategori</a>
                                            <a href="{{ route('manage-events.edit', $event->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">Edit</a>
                                            
                                            <form action="{{ route('manage-events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus event ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="border p-3 text-center text-gray-500">Belum ada data event.</td>
                                </tr>
                            @endforelse
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>