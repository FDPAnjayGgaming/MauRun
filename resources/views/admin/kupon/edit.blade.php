<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Kupon Diskon</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <!-- 1. Tambahkan x-data di sini untuk mendeteksi pilihan awal tipe diskon -->
                <form action="{{ route('manage-kupon.update', $manage_kupon->id) }}" method="POST" x-data="{ tipeDiskon: '{{ old('tipe_diskon', $manage_kupon->tipe_diskon) }}' }">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Kode Kupon</label>
                        <input type="text" name="kode_kupon" class="w-full border-gray-300 rounded-md uppercase" value="{{ old('kode_kupon', $manage_kupon->kode_kupon) }}" required>
                        @error('kode_kupon') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Tipe Diskon</label>
                            <!-- 2. Tambahkan x-model="tipeDiskon" agar memantau perubahan pilihan -->
                            <select name="tipe_diskon" x-model="tipeDiskon" class="w-full border-gray-300 rounded-md" required>
                                <option value="nominal">Nominal (Rupiah)</option>
                                <option value="persentase">Persentase (%)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Nilai Diskon</label>
                            <input type="number" name="nilai_diskon" class="w-full border-gray-300 rounded-md" value="{{ old('nilai_diskon', $manage_kupon->nilai_diskon) }}" min="0" required>
                        </div>
                    </div>

                    <!-- 3. Gunakan x-show agar div ini HANYA MUNCUL JIKA tipeDiskon adalah 'persentase' -->
                    <div class="mb-4" x-show="tipeDiskon === 'persentase'" x-cloak>
                        <label class="block text-gray-700 font-bold mb-2">Maksimal Potongan (Rp)</label>
                        <input type="number" name="maksimal_potongan" class="w-full border-gray-300 rounded-md" value="{{ old('maksimal_potongan', $manage_kupon->maksimal_potongan) }}" min="0">
                        <span class="text-xs text-gray-500">Batas maksimal nominal potongan diskon.</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Kuota Pemakaian</label>
                            <input type="number" name="kuota_pemakaian" class="w-full border-gray-300 rounded-md" value="{{ old('kuota_pemakaian', $manage_kupon->kuota_pemakaian) }}" min="1" required>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Berlaku Sampai</label>
                            <input type="date" name="berlaku_sampai" class="w-full border-gray-300 rounded-md" value="{{ old('berlaku_sampai', $manage_kupon->berlaku_sampai ? \Carbon\Carbon::parse($manage_kupon->berlaku_sampai)->format('Y-m-d') : '') }}" required>
                        </div>
                    </div>
                    
                    <div class="flex gap-2">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Kupon</button>
                        <a href="{{ route('manage-kupon.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">Batal</a>
                    </div>
                </form>
            
            </div>
        </div>
    </div>
</x-app-layout>