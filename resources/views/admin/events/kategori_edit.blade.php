<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Kategori: <span class="text-blue-600">{{ $event->nama_event }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if(session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('manage-events.kategori.update', [$event->id, $kategori->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Jenis Jarak (Kategori)</label>
                        <select name="jenis_event_id" class="w-full border-gray-300 rounded-md shadow-sm" required>
                            @foreach($master_jenis as $jenis)
                                <option value="{{ $jenis->id }}" {{ $kategori->jenis_event_id == $jenis->id ? 'selected' : '' }}>
                                    {{ $jenis->nama_jenis }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Harga Tiket (Rp)</label>
                        <input type="number" name="harga" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ old('harga', $kategori->harga) }}" min="0" required>
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-gray-700 font-bold mb-2">Kuota Peserta</label>
                        <input type="number" name="kuota" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ old('kuota', $kategori->kuota) }}" min="1" required>
                    </div>
                    
                    <div class="flex gap-2">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('manage-events.kategori.index', $event->id) }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                            Batal
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>