<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('manage-kupon.index') }}" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
            </a>
            <h2 class="page-header-title">Edit Kupon Diskon</h2>
        </div>
    </x-slot>

    <div class="max-w-2xl animate-fade-in">
        <div class="card">
            <div class="card-body">

                {{-- Alpine.js untuk toggle tipe diskon --}}
                <form action="{{ route('manage-kupon.update', $manage_kupon->id) }}" method="POST" x-data="{ tipeDiskon: '{{ old('tipe_diskon', $manage_kupon->tipe_diskon) }}' }">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="form-label">Kode Kupon</label>
                        <input type="text" name="kode_kupon" class="form-input-modern uppercase tracking-wider font-mono" value="{{ old('kode_kupon', $manage_kupon->kode_kupon) }}" required>
                        @error('kode_kupon') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                        <div>
                            <label class="form-label">Tipe Diskon</label>
                            <select name="tipe_diskon" x-model="tipeDiskon" class="form-input-modern" required>
                                <option value="nominal">Nominal (Rupiah)</option>
                                <option value="persentase">Persentase (%)</option>
                            </select>
                        </div>
                        <div>
                            <label class="form-label">Nilai Diskon</label>
                            <input type="number" name="nilai_diskon" class="form-input-modern" value="{{ old('nilai_diskon', $manage_kupon->nilai_diskon) }}" min="0" required>
                        </div>
                    </div>

                    {{-- Muncul hanya jika tipe persentase --}}
                    <div class="form-group" x-show="tipeDiskon === 'persentase'" x-cloak>
                        <label class="form-label">Maksimal Potongan (Rp)</label>
                        <input type="number" name="maksimal_potongan" class="form-input-modern" value="{{ old('maksimal_potongan', $manage_kupon->maksimal_potongan) }}" min="0">
                        <p class="text-xs text-slate-400 mt-1">Batas maksimal nominal potongan diskon.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                        <div>
                            <label class="form-label">Kuota Pemakaian</label>
                            <input type="number" name="kuota_pemakaian" class="form-input-modern" value="{{ old('kuota_pemakaian', $manage_kupon->kuota_pemakaian) }}" min="1" required>
                        </div>
                        <div>
                            <label class="form-label">Berlaku Sampai</label>
                            <input type="date" name="berlaku_sampai" class="form-input-modern" value="{{ old('berlaku_sampai', $manage_kupon->berlaku_sampai ? \Carbon\Carbon::parse($manage_kupon->berlaku_sampai)->format('Y-m-d') : '') }}" required>
                        </div>
                    </div>

                    <div class="flex gap-3 pt-4 border-t border-slate-100">
                        <button type="submit" class="btn btn-primary">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                            Update Kupon
                        </button>
                        <a href="{{ route('manage-kupon.index') }}" class="btn btn-ghost">Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>