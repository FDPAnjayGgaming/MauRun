<x-public-layout>

    <div class="py-12 bg-slate-50 min-h-screen pt-24">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-8">
                <a href="{{ route('events.show', $event->id) }}" class="inline-flex items-center text-sm font-semibold text-brand-600 hover:text-brand-800 transition-colors">
                    <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    Kembali ke Detail Event
                </a>
                <h1 class="text-3xl font-extrabold text-slate-900 mt-4">{{ $event->nama_event }}</h1>
                <p class="text-slate-500">{{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('l, d F Y') }} &bull; {{ $event->kota->nama_kota ?? '-' }}</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('success')" />
            <x-input-error :messages="session('error')" class="mb-4" />

            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                <form action="{{ route('events.register.store', $event->id) }}" method="POST">
                    @csrf

                    <div class="p-8 md:p-10 border-b border-slate-100">
                        <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                            <span class="bg-brand-100 text-brand-700 w-8 h-8 rounded-full flex items-center justify-center text-sm">1</span>
                            Data Diri
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="name" :value="__('Nama Lengkap')" />
                                <x-text-input id="name" class="block mt-1 w-full bg-slate-50 text-slate-500" type="text" value="{{ $user->name }}" readonly />
                                <p class="text-xs text-slate-400 mt-1">Sesuai profil akun Anda</p>
                            </div>
                            <div>
                                <x-input-label for="nik" :value="__('NIK (Nomor Induk Kependudukan)')" />
                                <x-text-input id="nik" class="block mt-1 w-full bg-slate-50 text-slate-500" type="text" value="{{ $user->nik ?? '-' }}" readonly />
                            </div>
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full bg-slate-50 text-slate-500" type="email" value="{{ $user->email }}" readonly />
                            </div>
                            <div>
                                <x-input-label for="no_hp" :value="__('No. HP (WhatsApp)')" />
                                <x-text-input id="no_hp" class="block mt-1 w-full bg-slate-50 text-slate-500" type="text" value="{{ $user->no_hp ?? '-' }}" readonly />
                            </div>
                            
                            <!-- Jenis Kelamin -->
                            <div class="mt-4">
                                <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
                                <x-text-input id="jenis_kelamin" class="block mt-1 w-full bg-slate-50 text-slate-500 cursor-not-allowed" type="text" name="jenis_kelamin" :value="$user->jenis_kelamin ?? 'Belum Diatur'" readonly />
                            </div>
                        </div>
                    </div>

                    <div class="p-8 md:p-10 border-b border-slate-100">
                        <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                            <span class="bg-brand-100 text-brand-700 w-8 h-8 rounded-full flex items-center justify-center text-sm">2</span>
                            Pilih Kategori Lomba
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($event->kategoris as $kategori)
                                @php
                                    $terjual = \App\Models\Pendaftaran::where('event_kategori_id', $kategori->id)->count();
                                    $isPenuh = $terjual >= $kategori->kuota;
                                    $isSelected = request('kategori') == $kategori->id;
                                @endphp
                                <label class="relative flex cursor-pointer rounded-2xl border bg-white p-4 shadow-sm focus:outline-none {{ $isPenuh ? 'opacity-50 grayscale border-slate-200' : 'border-slate-200 hover:border-brand-300 has-[:checked]:border-brand-500 has-[:checked]:ring-1 has-[:checked]:ring-brand-500' }}">
                                    <input type="radio" name="event_kategori_id" value="{{ $kategori->id }}" class="sr-only" data-harga="{{ $kategori->harga }}" onchange="updateHarga()" {{ $isSelected && !$isPenuh ? 'checked' : '' }} {{ $isPenuh ? 'disabled' : '' }} required>
                                    <span class="flex flex-1">
                                        <span class="flex flex-col">
                                            <span class="block text-sm font-bold text-slate-900">{{ $kategori->jenisEvent->nama_jenis ?? 'Kategori' }}</span>
                                            <span class="mt-1 flex items-center text-sm text-slate-500">
                                                Sisa Kuota: {{ max(0, $kategori->kuota - $terjual) }}
                                            </span>
                                            <span class="mt-3 text-lg font-extrabold text-brand-600">Rp {{ number_format($kategori->harga, 0, ',', '.') }}</span>
                                        </span>
                                    </span>
                                    <svg class="h-5 w-5 text-brand-600 absolute top-4 right-4 hidden [[name=event_kategori_id]:checked~*>&]:block" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                    </svg>
                                </label>
                            @endforeach
                        </div>
                        <x-input-error :messages="$errors->get('event_kategori_id')" class="mt-2" />
                    </div>

                    <div class="p-8 md:p-10 border-b border-slate-100">
                        <h3 class="text-lg font-bold text-slate-900 mb-6 flex items-center gap-2">
                            <span class="bg-brand-100 text-brand-700 w-8 h-8 rounded-full flex items-center justify-center text-sm">3</span>
                            Perlengkapan Lari
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="ukuran_jersey" :value="__('Ukuran Jersey')" />
                                <select id="ukuran_jersey" name="ukuran_jersey" class="border-gray-300 focus:border-brand-500 focus:ring-brand-500 rounded-md shadow-sm block mt-1 w-full" required>
                                    <option value="" disabled selected>-- Pilih Ukuran --</option>
                                    @foreach(['S', 'M', 'L', 'XL', 'XXL'] as $ukuran)
                                        <option value="{{ $ukuran }}" {{ (old('ukuran_jersey') ?? $user->ukuran_jersey_default) == $ukuran ? 'selected' : '' }}>{{ $ukuran }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('ukuran_jersey')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="golongan_darah" :value="__('Golongan Darah')" />
                                <select id="golongan_darah" name="golongan_darah" class="border-gray-300 focus:border-brand-500 focus:ring-brand-500 rounded-md shadow-sm block mt-1 w-full" required>
                                    <option value="" disabled selected>-- Pilih Gol. Darah --</option>
                                    @foreach(['A', 'B', 'AB', 'O', 'Tidak Tahu'] as $goldar)
                                        <option value="{{ $goldar }}" {{ (old('golongan_darah') ?? $user->golongan_darah_default) == $goldar ? 'selected' : '' }}>{{ $goldar }}</option>
                                    @endforeach
                                </select>
                                <p class="text-xs text-slate-500 mt-1">Penting untuk keperluan medis darurat.</p>
                                <x-input-error :messages="$errors->get('golongan_darah')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <div class="p-8 md:p-10 bg-slate-50">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                            
                            {{-- Kupon --}}
                            <div>
                                <h3 class="text-lg font-bold text-slate-900 mb-4">Gunakan Kupon Diskon</h3>
                                <div class="flex gap-2">
                                    <x-text-input id="kode_kupon" name="kode_kupon" type="text" class="block w-full uppercase" placeholder="Masukkan kode promo..." value="{{ old('kode_kupon') }}" />
                                    <button type="button" id="btn-cek-kupon" class="bg-slate-800 hover:bg-slate-900 text-white font-semibold px-4 py-2 rounded-xl text-sm transition-colors whitespace-nowrap">
                                        Terapkan
                                    </button>
                                </div>
                                <p id="kupon-message" class="text-sm mt-2 font-medium"></p>
                            </div>

                            {{-- Ringkasan Harga --}}
                            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200">
                                <h3 class="text-base font-bold text-slate-900 mb-4">Ringkasan Pembayaran</h3>
                                
                                <div class="space-y-3 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-slate-500">Harga Kategori</span>
                                        <span class="font-semibold text-slate-900" id="display-harga-awal">Rp 0</span>
                                    </div>
                                    <div class="flex justify-between text-brand-600">
                                        <span>Potongan Diskon</span>
                                        <span class="font-semibold" id="display-diskon">- Rp 0</span>
                                    </div>
                                    <div class="border-t border-slate-100 pt-3 flex justify-between items-center">
                                        <span class="font-bold text-slate-900 text-base">Total Pembayaran</span>
                                        <span class="font-extrabold text-xl text-brand-600" id="display-total-bayar">Rp 0</span>
                                    </div>
                                </div>

                                <button type="submit" class="mt-6 w-full bg-brand-500 hover:bg-brand-600 text-white font-bold py-3.5 rounded-xl transition-colors text-lg shadow-lg shadow-brand-500/30">
                                    Selesaikan Pendaftaran
                                </button>
                                <p class="text-center text-xs text-slate-400 mt-4">
                                    Dengan menekan tombol di atas, Anda menyetujui syarat & ketentuan penyelenggaraan event.
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        let baseHarga = 0;
        let diskonAmount = 0;

        function formatRupiah(angka) {
            return 'Rp ' + new Intl.NumberFormat('id-ID').format(angka);
        }

        function updateHarga() {
            const selected = document.querySelector('input[name="event_kategori_id"]:checked');
            if(selected) {
                baseHarga = parseInt(selected.getAttribute('data-harga'));
                document.getElementById('display-harga-awal').innerText = formatRupiah(baseHarga);
                
                // Reset kupon jika pindah kategori
                if(diskonAmount > 0) {
                    resetKupon();
                } else {
                    kalkulasiTotal();
                }
            }
        }

        function kalkulasiTotal() {
            let total = baseHarga - diskonAmount;
            if(total < 0) total = 0;
            document.getElementById('display-total-bayar').innerText = formatRupiah(total);
        }

        function resetKupon() {
            document.getElementById('kode_kupon').value = '';
            diskonAmount = 0;
            document.getElementById('display-diskon').innerText = '- Rp 0';
            let msg = document.getElementById('kupon-message');
            msg.innerText = '';
            msg.className = 'text-sm mt-2 font-medium';
            kalkulasiTotal();
        }

        document.addEventListener('DOMContentLoaded', function() {
            updateHarga();

            document.getElementById('btn-cek-kupon').addEventListener('click', function() {
                let kode = document.getElementById('kode_kupon').value.trim();
                let msg = document.getElementById('kupon-message');
                
                if(!kode) {
                    msg.innerText = 'Masukkan kode kupon terlebih dahulu.';
                    msg.className = 'text-sm mt-2 font-medium text-red-500';
                    return;
                }

                if(baseHarga === 0) {
                    msg.innerText = 'Pilih kategori lomba terlebih dahulu.';
                    msg.className = 'text-sm mt-2 font-medium text-red-500';
                    return;
                }

                // Call AJAX to check coupon
                fetch('{{ route("events.check-kupon") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        kode_kupon: kode,
                        harga_awal: baseHarga
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if(data.valid) {
                        msg.innerText = data.message;
                        msg.className = 'text-sm mt-2 font-medium text-green-600';
                        diskonAmount = data.total_diskon;
                        document.getElementById('display-diskon').innerText = '- ' + formatRupiah(diskonAmount);
                        kalkulasiTotal();
                    } else {
                        msg.innerText = data.message;
                        msg.className = 'text-sm mt-2 font-medium text-red-500';
                        diskonAmount = 0;
                        document.getElementById('display-diskon').innerText = '- Rp 0';
                        kalkulasiTotal();
                    }
                })
                .catch(error => {
                    msg.innerText = 'Terjadi kesalahan jaringan.';
                    msg.className = 'text-sm mt-2 font-medium text-red-500';
                });
            });
        });
    </script>
    @endpush
</x-app-layout>
