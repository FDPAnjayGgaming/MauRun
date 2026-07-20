<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Event') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('manage-events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Nama Event</label>
                        <input type="text" name="nama_event" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ old('nama_event', $event->nama_event) }}" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Tanggal Pelaksanaan</label>
                            <input type="date" name="tanggal" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ old('tanggal', $event->tanggal) }}" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Kota</label>
                            <select name="kota_id" class="w-full border-gray-300 rounded-md shadow-sm" required>
                                @foreach($kotas as $kota)
                                    <option value="{{ $kota->id }}" {{ old('kota_id', $event->kota_id) == $kota->id ? 'selected' : '' }}>{{ $kota->nama_kota }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Deskripsi Event</label>
                        <textarea name="deskripsi" rows="4" class="w-full border-gray-300 rounded-md shadow-sm" required>{{ old('deskripsi', $event->deskripsi) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Banner Event</label>
                        @if($event->banner)
                            <div class="mb-2">
                                <img src="{{ asset('storage/'.$event->banner) }}" alt="Banner Lama" class="w-32 rounded border">
                                <span class="text-xs text-gray-500">Gambar saat ini</span>
                            </div>
                        @endif
                        <input type="file" name="banner" accept="image/*" class="w-full border border-gray-300 rounded-md p-2">
                        <span class="text-sm text-gray-500">Biarkan kosong jika tidak ingin mengubah gambar.</span>
                    </div>

                    <div class="mb-6">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300 text-blue-600 shadow-sm" {{ old('is_active', $event->is_active) ? 'checked' : '' }}>
                            <span class="ml-2 text-gray-700">Aktifkan (Publish)</span>
                        </label>
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('manage-events.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Batal</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-bold">Update Event</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>