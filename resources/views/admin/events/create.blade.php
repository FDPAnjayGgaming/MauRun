<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Event Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('manage-events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Nama Event</label>
                        <input type="text" name="nama_event" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" value="{{ old('nama_event') }}" required>
                        @error('nama_event') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Tanggal Pelaksanaan</label>
                            <input type="date" name="tanggal" class="w-full border-gray-300 rounded-md shadow-sm" value="{{ old('tanggal') }}" required>
                            @error('tanggal') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Kota</label>
                            <select name="kota_id" class="w-full border-gray-300 rounded-md shadow-sm" required>
                                <option value="">-- Pilih Kota --</option>
                                @foreach($kotas as $kota)
                                    <option value="{{ $kota->id }}" {{ old('kota_id') == $kota->id ? 'selected' : '' }}>{{ $kota->nama_kota }}</option>
                                @endforeach
                            </select>
                            @error('kota_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Deskripsi Event</label>
                        <textarea name="deskripsi" rows="4" class="w-full border-gray-300 rounded-md shadow-sm" required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Banner Event (Opsional)</label>
                        <input type="file" name="banner" accept="image/*" class="w-full border border-gray-300 rounded-md p-2">
                        @error('banner') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" {{ old('is_active') ? 'checked' : '' }}>
                            <span class="ml-2 text-gray-700">Langsung Aktifkan (Publish)</span>
                        </label>
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('manage-events.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Batal</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-bold">Simpan Event</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>