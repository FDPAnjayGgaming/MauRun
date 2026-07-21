<x-public-layout>
    <div class="bg-slate-50 min-h-screen pt-24 pb-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-8">
                <h1 class="text-3xl font-extrabold text-slate-900">Riwayat Pendaftaran</h1>
                <p class="text-slate-500 mt-2">Pantau status pendaftaran dan tiket event lari yang telah kamu ikuti.</p>
            </div>

            @if(session('success'))
                <div class="mb-6 bg-brand-50 border-l-4 border-brand-500 p-4 rounded-r-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-brand-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-brand-800">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if($pendaftarans->isEmpty())
                <div class="bg-white rounded-3xl shadow-sm border border-slate-100 flex flex-col items-center justify-center py-20 text-center">
                    <svg class="w-16 h-16 text-slate-200 mb-4" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                    </svg>
                    <p class="text-slate-400 text-lg font-semibold">Belum ada riwayat pendaftaran.</p>
                    <p class="text-slate-400 text-sm mt-1">Yuk jelajahi event lari dan mulai taklukkan batasmu!</p>
                    <a href="{{ route('events') }}" class="mt-6 bg-brand-600 hover:bg-brand-700 text-white font-bold py-2.5 px-6 rounded-xl transition-colors shadow-sm">
                        Cari Event Lari
                    </a>
                </div>
            @else
                <div class="space-y-6">
                    @foreach($pendaftarans as $pendaftaran)
                        @php
                            $event = $pendaftaran->eventKategori->event;
                            $kategori = $pendaftaran->eventKategori;
                        @endphp
                        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden flex flex-col md:flex-row transition-all duration-300 hover:shadow-md">
                            {{-- Event Date & Banner Section (Left) --}}
                            <div class="md:w-1/3 relative bg-slate-900">
                                @if($event->banner)
                                    <img src="{{ asset('storage/'.$event->banner) }}" alt="{{ $event->nama_event }}" class="w-full h-full object-cover opacity-60">
                                @endif
                                <div class="absolute inset-0 p-6 flex flex-col justify-between">
                                    <div class="bg-white/20 backdrop-blur border border-white/30 text-white text-xs font-bold px-3 py-1 rounded-full self-start">
                                        {{ $event->kota->nama_kota ?? 'Virtual' }}
                                    </div>
                                    <div>
                                        <div class="text-white font-bold text-3xl">{{ \Carbon\Carbon::parse($event->tanggal)->format('d') }}</div>
                                        <div class="text-white/80 font-semibold uppercase text-sm tracking-widest">{{ \Carbon\Carbon::parse($event->tanggal)->format('M Y') }}</div>
                                    </div>
                                </div>
                            </div>

                            {{-- Details Section (Right) --}}
                            <div class="p-6 md:p-8 flex-1 flex flex-col justify-between">
                                <div>
                                    <div class="flex justify-between items-start mb-2">
                                        <h2 class="text-xl font-bold text-slate-900 leading-tight">
                                            <a href="{{ route('events.show', $event->id) }}" class="hover:text-brand-600 transition-colors">
                                                {{ $event->nama_event }}
                                            </a>
                                        </h2>
                                        
                                        {{-- Status Badge --}}
                                        @if($pendaftaran->status_pembayaran == 'Lunas')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 border border-green-200">
                                                Lunas
                                            </span>
                                        @elseif($pendaftaran->status_pembayaran == 'Pending')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800 border border-yellow-200">
                                                Menunggu Pembayaran
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800 border border-red-200">
                                                Dibatalkan
                                            </span>
                                        @endif
                                    </div>

                                    <div class="flex flex-wrap gap-2 mb-4">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-slate-100 text-slate-600">
                                            Kategori: {{ $kategori->jenisEvent->nama_jenis ?? 'Umum' }}
                                        </span>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-slate-100 text-slate-600">
                                            Ukuran Jersey: {{ $pendaftaran->ukuran_jersey ?? '-' }}
                                        </span>
                                    </div>
                                    
                                    <div class="text-sm text-slate-500 mb-4">
                                        Tanggal Daftar: {{ $pendaftaran->created_at->format('d M Y H:i') }}
                                    </div>
                                </div>

                                <div class="flex items-center justify-between pt-4 border-t border-slate-100 mt-auto">
                                    <div>
                                        <p class="text-xs text-slate-500 uppercase tracking-widest font-semibold mb-0.5">Total Bayar</p>
                                        <p class="text-lg font-extrabold text-brand-600">Rp {{ number_format($pendaftaran->total_bayar, 0, ',', '.') }}</p>
                                    </div>
                                    
                                    @if($pendaftaran->status_pembayaran == 'Lunas')
                                        <button class="bg-slate-900 hover:bg-slate-800 text-white text-sm font-bold px-5 py-2.5 rounded-xl transition-colors flex items-center shadow-sm">
                                            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                            </svg>
                                            E-Tiket
                                        </button>
                                    @elseif($pendaftaran->status_pembayaran == 'Pending')
                                        <a href="https://wa.me/6281234567890?text=Halo%20Admin%20MauRun,%20saya%20ingin%20konfirmasi%20pembayaran%20untuk%20event%20{{ urlencode($event->nama_event) }}." target="_blank" class="bg-brand-50 hover:bg-brand-100 text-brand-700 text-sm font-bold px-5 py-2.5 rounded-xl transition-colors flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.76c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.076-4.076a1.526 1.526 0 011.037-.443 48.282 48.282 0 005.68-.494c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                                            </svg>
                                            Konfirmasi
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-public-layout>
