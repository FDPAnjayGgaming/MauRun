<x-public-layout>
    <div class="bg-slate-50 min-h-screen pt-24 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Header & Filters --}}
            <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6 md:p-8 mb-10">
                <div class="mb-6">
                    <h1 class="text-3xl font-extrabold text-slate-900">Katalog Event</h1>
                    <p class="text-slate-500 mt-2">Temukan event lari yang cocok untukmu di seluruh Indonesia.</p>
                </div>

                <form action="{{ route('events') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    {{-- Search --}}
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari event..." class="pl-10 block w-full rounded-xl border-slate-200 bg-slate-50 focus:border-brand-500 focus:ring-brand-500 sm:text-sm">
                    </div>

                    {{-- Filter Kategori --}}
                    <div class="w-full md:w-48">
                        <select name="kategori_id" class="block w-full rounded-xl border-slate-200 bg-slate-50 focus:border-brand-500 focus:ring-brand-500 sm:text-sm">
                            <option value="">Semua Jarak</option>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_jenis }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Filter Kota --}}
                    <div class="w-full md:w-48">
                        <select name="kota_id" class="block w-full rounded-xl border-slate-200 bg-slate-50 focus:border-brand-500 focus:ring-brand-500 sm:text-sm">
                            <option value="">Semua Kota</option>
                            @foreach($kotas as $kota)
                                <option value="{{ $kota->id }}" {{ request('kota_id') == $kota->id ? 'selected' : '' }}>{{ $kota->nama_kota }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="px-8 py-2 bg-brand-600 text-white font-bold rounded-xl shadow-sm hover:bg-brand-700 transition-colors">
                        Terapkan
                    </button>

                    @if(request()->hasAny(['search', 'kota_id', 'kategori_id']))
                        <a href="{{ route('events') }}" class="px-6 py-2 bg-slate-100 text-slate-600 font-bold rounded-xl hover:bg-slate-200 transition-colors text-center border border-slate-200 flex items-center justify-center">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            {{-- Event Grid --}}
            @if($events->isEmpty())
                <div class="bg-white rounded-3xl shadow-sm border border-slate-100 flex flex-col items-center justify-center py-20 text-center">
                    <svg class="w-16 h-16 text-slate-200 mb-4" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                    <p class="text-slate-400 text-lg font-semibold">Oops! Tidak ada event yang sesuai kriteria.</p>
                    <p class="text-slate-400 text-sm mt-1">Coba sesuaikan filter atau kata kunci pencarianmu.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-7 mb-10">
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
                                <span class="block text-xs font-bold text-brand-600 uppercase">{{ \Carbon\Carbon::parse($event->tanggal)->format('M') }}</span>
                                <span class="block text-xl font-extrabold text-slate-900 leading-none">{{ \Carbon\Carbon::parse($event->tanggal)->format('d') }}</span>
                            </div>
                            
                            {{-- City badge --}}
                            <div class="absolute bottom-3 left-3 bg-slate-900/70 backdrop-blur text-white text-xs font-semibold px-3 py-1.5 rounded-lg flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-brand-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                </svg>
                                {{ $event->kota->nama_kota ?? 'Virtual' }}
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="p-5">
                            <h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-brand-600 transition-colors line-clamp-1">
                                {{ $event->nama_event }}
                            </h3>
                            
                            {{-- Categories badges --}}
                            <div class="flex flex-wrap gap-2 mb-5">
                                @forelse($event->kategoris as $kategori)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-accent-50 text-accent-700 border border-accent-200">
                                        {{ $kategori->jenisEvent->nama_jenis ?? 'Umum' }}
                                    </span>
                                @empty
                                    <span class="text-xs text-slate-400">Belum ada kategori</span>
                                @endforelse
                            </div>

                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                                <p class="text-sm font-semibold text-slate-500">Pendaftaran Buka</p>
                                <a href="{{ route('events.show', $event->id) }}" class="inline-flex items-center justify-center bg-brand-50 text-brand-600 hover:bg-brand-600 hover:text-white text-sm font-bold px-4 py-2 rounded-lg transition-colors">
                                    Lihat Detail
                                    <svg class="w-4 h-4 ml-1.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                {{-- Pagination --}}
                <div class="mt-8">
                    {{ $events->links() }}
                </div>
            @endif

        </div>
    </div>
</x-public-layout>
