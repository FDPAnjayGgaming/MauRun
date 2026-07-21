<x-public-layout>

    {{-- =================== HERO =================== --}}
    <section class="relative min-h-[90vh] flex items-center overflow-hidden bg-cover bg-center" style="background-image: url('{{ asset('images/hero-bg.png') }}');">
        
        {{-- Dark overlay --}}
        <div class="absolute inset-0 bg-slate-900/70 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-50 via-transparent to-transparent opacity-90"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 z-10 w-full">
            <div class="max-w-3xl">
                {{-- Label --}}
                <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur border border-white/20 text-white/90 text-xs font-semibold px-4 py-1.5 rounded-full mb-6 uppercase tracking-widest">
                    <span class="w-2 h-2 rounded-full bg-accent-400 animate-ping inline-block"></span>
                    Pendaftaran Event Lari Terbuka
                </div>

                {{-- Headline --}}
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold text-white leading-none tracking-tight mb-6 drop-shadow-lg">
                    Taklukkan<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-300 to-accent-300">
                        Batasmu.
                    </span>
                </h1>

                <p class="text-white/90 text-lg md:text-xl max-w-xl mb-10 leading-relaxed drop-shadow-md font-medium">
                    Temukan event lari terbaik di seluruh Indonesia dan jadilah bagian dari komunitas pelari yang terus berkembang bersama MauRun.
                </p>

                <div class="flex flex-wrap gap-4">
                    <a href="#events" class="inline-flex items-center gap-2 bg-brand-500 hover:bg-brand-600 text-white font-bold text-base px-7 py-3.5 rounded-xl shadow-lg shadow-brand-500/30 transition-all duration-200 hover:-translate-y-0.5">
                        Jelajahi Event
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </a>
                    @guest
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-2 bg-white/20 hover:bg-white/30 backdrop-blur border border-white/30 text-white font-bold text-base px-7 py-3.5 rounded-xl transition-all duration-200 shadow-lg">
                        Daftar Akun
                    </a>
                    @endguest
                </div>

                {{-- Quick Stats --}}
                <div class="flex flex-wrap gap-8 mt-14">
                    <div>
                        <p class="text-3xl font-extrabold text-white drop-shadow-md">{{ \App\Models\Event::where('is_active', true)->count() }}+</p>
                        <p class="text-white/80 text-sm mt-0.5 font-medium">Event Aktif</p>
                    </div>
                    <div class="w-px bg-white/20"></div>
                    <div>
                        <p class="text-3xl font-extrabold text-white drop-shadow-md">{{ \App\Models\Pendaftaran::count() }}+</p>
                        <p class="text-white/80 text-sm mt-0.5 font-medium">Pelari Terdaftar</p>
                    </div>
                    <div class="w-px bg-white/20"></div>
                    <div>
                        <p class="text-3xl font-extrabold text-white drop-shadow-md">{{ \App\Models\MasterKota::count() }}+</p>
                        <p class="text-white/80 text-sm mt-0.5 font-medium">Kota di Indonesia</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Wave divider --}}
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 80" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <path d="M0 80L1440 80L1440 40C1200 80 960 0 720 40C480 80 240 0 0 40L0 80Z" fill="#f8fafc"/>
            </svg>
        </div>
    </section>

    {{-- =================== EVENT LIST =================== --}}
    <section id="events" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">

        <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-6">
            <div>
                <p class="text-brand-600 font-semibold text-sm uppercase tracking-widest mb-2">Event Mendatang</p>
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900">Event Lari Terbaru</h2>
            </div>
            
            <a href="{{ route('events') }}" class="inline-flex items-center justify-center px-6 py-2.5 bg-brand-50 text-brand-700 font-bold rounded-xl hover:bg-brand-100 transition-colors">
                Lihat Semua
                <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </a>
        </div>

        @if($events->isEmpty())
            <div class="flex flex-col items-center justify-center py-20 text-center">
                <svg class="w-16 h-16 text-slate-200 mb-4" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                </svg>
                <p class="text-slate-400 text-lg font-semibold">Belum ada event aktif saat ini</p>
                <p class="text-slate-400 text-sm mt-1">Pantau terus halaman ini ya!</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7">
                @foreach($events as $event)
                <div class="group bg-white rounded-2xl overflow-hidden shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">

                    {{-- Banner --}}
                    <div class="relative h-48 bg-gradient-to-br from-brand-800 to-accent-700 overflow-hidden">
                        @if($event->banner)
                            <img src="{{ asset('storage/'.$event->banner) }}" alt="{{ $event->nama_event }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg class="w-16 h-16 text-white/20" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a2.25 2.25 0 002.25-2.25V5.25a2.25 2.25 0 00-2.25-2.25H3.75a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 003.75 21z" />
                                </svg>
                            </div>
                        @endif

                        {{-- Date badge --}}
                        <div class="absolute top-3 left-3 bg-white/90 backdrop-blur rounded-xl px-3 py-1 text-center shadow">
                            <p class="text-brand-700 font-extrabold text-lg leading-none">{{ \Carbon\Carbon::parse($event->tanggal)->format('d') }}</p>
                            <p class="text-brand-600 font-semibold text-xs uppercase">{{ \Carbon\Carbon::parse($event->tanggal)->format('M Y') }}</p>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="p-5">
                        <h3 class="font-bold text-slate-900 text-base leading-snug mb-3 group-hover:text-brand-700 transition-colors line-clamp-2">
                            {{ $event->nama_event }}
                        </h3>

                        <div class="space-y-1.5 mb-4">
                            <div class="flex items-center gap-2 text-slate-500 text-sm">
                                <svg class="w-4 h-4 text-brand-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                                {{ $event->kota->nama_kota ?? '-' }}
                            </div>
                            @if($event->kategoris->count())
                            <div class="flex items-center gap-2 text-slate-500 text-sm">
                                <svg class="w-4 h-4 text-accent-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                </svg>
                                {{ $event->kategoris->pluck('nama_kategori')->join(', ') }}
                            </div>
                            @endif
                        </div>

                        <a href="{{ route('events.show', $event->id) }}" class="flex items-center justify-center gap-2 w-full bg-brand-50 hover:bg-brand-600 text-brand-700 hover:text-white font-semibold text-sm py-2.5 rounded-xl border border-brand-200 hover:border-brand-600 transition-all duration-200">
                            Lihat Detail
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </section>

    {{-- =================== SPONSOR =================== --}}
    <section class="bg-white border-y border-slate-100 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-center text-sm font-semibold uppercase tracking-widest text-slate-400 mb-10">Partner & Sponsor Kami</p>
            <div class="flex flex-wrap items-center justify-center gap-10 md:gap-16 grayscale opacity-50 hover:opacity-70 transition-opacity">
                <img src="{{ asset('images/sponsors/garmin.png') }}" alt="Garmin" class="h-14 md:h-16 object-contain hover:grayscale-0 hover:opacity-100 transition-all duration-300">
                <img src="{{ asset('images/sponsors/amazfit.png') }}" alt="Amazfit" class="h-14 md:h-16 object-contain hover:grayscale-0 hover:opacity-100 transition-all duration-300">
                <img src="{{ asset('images/sponsors/910.png') }}" alt="910 Nineten" class="h-14 md:h-16 object-contain hover:grayscale-0 hover:opacity-100 transition-all duration-300">
                <img src="{{ asset('images/sponsors/ortuseight.png') }}" alt="Ortuseight" class="h-16 md:h-20 object-contain hover:grayscale-0 hover:opacity-100 transition-all duration-300">
                <img src="{{ asset('images/sponsors/mills.png') }}" alt="Mills" class="h-16 md:h-20 object-contain hover:grayscale-0 hover:opacity-100 transition-all duration-300">
            </div>
            <p class="text-center text-xs text-slate-400 mt-8">Tertarik menjadi partner? <a href="mailto:info@maurun.id" class="text-brand-600 font-semibold hover:underline">Hubungi kami</a></p>
        </div>
    </section>

    {{-- =================== CTA BOTTOM =================== --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="rounded-3xl bg-gradient-to-br from-brand-600 to-accent-500 p-12 md:p-16 text-center text-white relative overflow-hidden">
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, white 1px, transparent 0); background-size: 30px 30px;"></div>
            <div class="relative z-10">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Siap Mulai Berlari?</h2>
                <p class="text-white/80 text-lg mb-8 max-w-lg mx-auto">Bergabunglah dengan ribuan pelari dari seluruh Indonesia. Daftar sekarang, gratis!</p>
                @guest
                    <a href="{{ route('register') }}" class="inline-block bg-white text-brand-700 font-bold px-8 py-3.5 rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200">
                        Daftar Sekarang — Gratis
                    </a>
                @else
                    <a href="{{ route('events') }}" class="inline-block bg-white text-brand-700 font-bold px-8 py-3.5 rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200">
                        Lihat Semua Event
                    </a>
                @endguest
            </div>
        </div>
    </section>

</x-public-layout>