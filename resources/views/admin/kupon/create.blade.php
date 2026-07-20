<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Kupon Baru</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <!-- 1. Tambahkan x-data dengan nilai default 'nominal' -->
                <form action="{{ route('manage-kupon.store') }}" method="POST" x-data="{ tipeDiskon: '{{ old('tipe_diskon', 'nominal') }}' }">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Kode Kupon</label>
                        <input type="text" name="kode_kupon" class="w-full border-gray-300 rounded-md uppercase" value="{{ old('kode_kupon') }}" required>
                        @error('kode_kupon') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Tipe Diskon</label>
                            <!-- 2. Tambahkan x-model -->
                            <select name="tipe_diskon" x-model="tipeDiskon" class="w-full border-gray-300 rounded-md" required>
                                <option value="nominal">Nominal (Rupiah)</option>
                                <option value="persentase">Persentase (%)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Nilai Diskon</label>
                            <input type="number" name="nilai_diskon" class="w-full border-gray-300 rounded-md" value="{{ old('nilai_diskon') }}" min="0" required>
                        </div>
                    </div>

                    <!-- 3. Sembunyikan kolom ini secara default, muncul jika tipeDiskon === 'persentase' -->
                    <div class="mb-4" x-show="tipeDiskon === 'persentase'" x-cloak>
                        <label class="block text-gray-700 font-bold mb-2">Maksimal Potongan (Rp)</label>
                        <input type="number" name="maksimal_potongan" class="w-full border-gray-300 rounded-md" value="{{ old('maksimal_potongan') }}" min="0">
                        <span class="text-xs text-gray-500">Batas maksimal nominal potongan diskon.</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Kuota Pemakaian</label>
                            <input type="number" name="kuota_pemakaian" class="w-full border-gray-300 rounded-md" value="{{ old('kuota_pemakaian') }}" min="1" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Berlaku Sampai</label>
                            <input type="date" name="berlaku_sampai" class="w-full border-gray-300 rounded-md" value="{{ old('berlaku_sampai') }}" required>
                        </div>
                    </div>
                    
                    <div class="flex gap-2">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan Kupon</button>
                        <a href="{{ route('manage-kupon.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>