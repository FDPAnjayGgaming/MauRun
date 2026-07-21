<x-public-layout>
    {{-- =================== HERO DETAIL =================== --}}
    <section class="relative pt-24 pb-12 overflow-hidden bg-slate-900 min-h-[40vh] flex items-center">
        @if($event->banner)
            <img src="{{ asset('storage/' . $event->banner) }}" alt="{{ $event->nama_event }}" class="absolute inset-0 w-full h-full object-cover opacity-40 mix-blend-overlay">
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-brand-900 to-slate-900 opacity-90"></div>
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/60 to-transparent"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10 w-full pt-10">
            <div class="flex flex-col md:flex-row gap-6 md:items-end justify-between">
                <div class="max-w-3xl">
                    <div class="inline-flex items-center gap-2 bg-brand-500/20 text-brand-300 border border-brand-500/30 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider mb-4">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                        {{ $event->kota->nama_kota ?? 'Lokasi Belum Ditentukan' }}
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-4">{{ $event->nama_event }}</h1>
                    <div class="flex items-center gap-4 text-slate-300">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-accent-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                            <span class="font-medium">{{ \Carbon\Carbon::parse($event->tanggal)->translatedFormat('l, d F Y') }}</span>
                        </div>
                    </div>
                </div>
                <div>
                    <a href="#kategori" class="inline-flex justify-center items-center gap-2 bg-brand-500 hover:bg-brand-600 text-white font-bold px-8 py-3.5 rounded-xl shadow-lg transition-all hover:-translate-y-0.5">
                        Daftar Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- =================== CONTENT =================== --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            {{-- Left: Deskripsi --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100">
                    <h3 class="text-2xl font-extrabold text-slate-900 mb-6">Tentang Event Ini</h3>
                    <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed">
                        {!! nl2br(e($event->deskripsi)) !!}
                    </div>
                </div>
            </div>

            {{-- Right: Kategori & Tiket --}}
            <div id="kategori" class="space-y-6">
                <h3 class="text-2xl font-extrabold text-slate-900">Kategori Tiket</h3>
                
                @if($event->kategoris->count() > 0)
                    @foreach($event->kategoris as $kategori)
                        @php
                            $terjual = \App\Models\Pendaftaran::where('event_kategori_id', $kategori->id)->count();
                            $sisa = $kategori->kuota - $terjual;
                            $isPenuh = $sisa <= 0;
                        @endphp
                        <div class="bg-white rounded-2xl p-6 border {{ $isPenuh ? 'border-slate-200 opacity-75' : 'border-brand-200 shadow-lg shadow-brand-100/50 hover:border-brand-500 transition-colors' }}">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h4 class="text-lg font-bold text-slate-900">{{ $kategori->jenisEvent->nama_jenis ?? 'Kategori' }}</h4>
                                    <p class="text-sm text-slate-500 mt-1">Kuota: {{ $kategori->kuota }} pelari</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xl font-extrabold text-brand-600">Rp {{ number_format($kategori->harga, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            
                            {{-- Progress Bar Kuota --}}
                            <div class="mb-5">
                                <div class="flex justify-between text-xs font-semibold mb-1.5">
                                    <span class="text-slate-500">Terjual {{ $terjual }}</span>
                                    <span class="{{ $isPenuh ? 'text-red-500' : 'text-brand-600' }}">Sisa {{ max(0, $sisa) }}</span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                                    <div class="h-2 rounded-full {{ $isPenuh ? 'bg-red-500' : 'bg-brand-500' }}" style="width: {{ min(100, ($terjual / max(1, $kategori->kuota)) * 100) }}%"></div>
                                </div>
                            </div>

                            @if($isPenuh)
                                <button disabled class="w-full bg-slate-100 text-slate-400 font-bold py-3 rounded-xl cursor-not-allowed">
                                    Kuota Habis
                                </button>
                            @elseif(isset($hasRegistered) && $hasRegistered)
                                <button disabled class="w-full bg-slate-100 text-slate-400 font-bold py-3 rounded-xl cursor-not-allowed">
                                    Sudah Terdaftar
                                </button>
                            @else
                                <a href="{{ route('events.register', $event->id) }}?kategori={{ $kategori->id }}" class="block text-center w-full bg-brand-50 hover:bg-brand-500 text-brand-700 hover:text-white font-bold py-3 rounded-xl border border-brand-200 transition-all">
                                    Pilih Kategori Ini
                                </a>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="bg-slate-50 rounded-2xl p-6 text-center border border-slate-100">
                        <p class="text-slate-500">Belum ada kategori lomba untuk event ini.</p>
                    </div>
                @endif
            </div>

        </div>
    </section>
</x-public-layout>
