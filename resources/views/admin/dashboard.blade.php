<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-800 tracking-tight">
            {{ __('Dashboard Panitia') }}
        </h2>
    </x-slot>

    <div class="space-y-8 animate-fade-in pb-10">

        {{-- Hero / Welcome Card (Flat Clean Style) --}}
        <div class="bg-white rounded-3xl border border-slate-200 p-8 md:p-10 flex flex-col md:flex-row items-center justify-between gap-8 shadow-sm">
            <div>
                <p class="text-brand-600 font-bold mb-2 flex items-center gap-2 tracking-wide uppercase text-xs">
                    <span class="w-2 h-2 rounded-full bg-brand-500 animate-pulse"></span>
                    Live System Overview
                </p>
                @php
                    $hour = now()->format('H');
                    if ($hour < 12) $greeting = 'Selamat Pagi';
                    elseif ($hour < 15) $greeting = 'Selamat Siang';
                    elseif ($hour < 18) $greeting = 'Selamat Sore';
                    else $greeting = 'Selamat Malam';
                @endphp
                <h3 class="text-2xl md:text-3xl font-extrabold mb-2 text-slate-800">{{ $greeting }}, {{ Auth::user()->name }} 👋</h3>
                <p class="text-slate-500 max-w-xl text-base leading-relaxed">
                    Pusat kendali event lari terbaik di Indonesia. Pantau penjualan tiket, manajemen peserta, dan performa event secara real-time.
                </p>
            </div>
            
            {{-- Quick Mini Stat in Hero --}}
            <div class="bg-slate-50 border border-slate-100 rounded-2xl p-6 w-full md:w-auto md:min-w-[260px]">
                <p class="text-slate-500 text-sm font-semibold mb-1">Total Pendapatan (Lunas)</p>
                <h4 class="text-3xl font-extrabold text-slate-900">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h4>
                <div class="mt-5">
                    <a href="{{ route('manage-pendaftar.index') }}" class="block text-center bg-brand-600 hover:bg-brand-700 text-white font-semibold py-2.5 px-4 rounded-xl transition-colors text-sm">
                        Cek Pendaftar
                    </a>
                </div>
            </div>
        </div>

        {{-- Metric Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            {{-- Total Event --}}
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 group">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-brand-100 to-brand-50 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-brand-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-slate-500 text-sm font-semibold tracking-wide">Total Event Aktif</p>
                        <p class="text-3xl font-extrabold text-slate-900 mt-1">{{ $totalEvent }}</p>
                    </div>
                </div>
            </div>

            {{-- Total Peserta --}}
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 group">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-accent-100 to-accent-50 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-accent-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-slate-500 text-sm font-semibold tracking-wide">Total Peserta</p>
                        <p class="text-3xl font-extrabold text-slate-900 mt-1">{{ $totalPeserta }}</p>
                    </div>
                </div>
            </div>

            {{-- Kupon Aktif --}}
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 group">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-100 to-amber-50 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-amber-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-slate-500 text-sm font-semibold tracking-wide">Kupon Aktif</p>
                        <p class="text-3xl font-extrabold text-slate-900 mt-1">{{ $kuponAktif }}</p>
                    </div>
                </div>
            </div>

            {{-- Rata-rata Konversi (Dummy) --}}
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 group">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-100 to-emerald-50 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-slate-500 text-sm font-semibold tracking-wide">Konversi Sukses</p>
                        <p class="text-3xl font-extrabold text-slate-900 mt-1">94<span class="text-xl">%</span></p>
                    </div>
                </div>
            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            {{-- Pendaftar Terbaru --}}
            <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-slate-800">Aktivitas Pendaftaran Terbaru</h3>
                    <a href="{{ route('manage-pendaftar.index') }}" class="text-sm font-semibold text-brand-600 hover:text-brand-800">Lihat Semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-slate-50 text-slate-500 text-xs uppercase font-bold">
                            <tr>
                                <th class="px-6 py-4">Peserta</th>
                                <th class="px-6 py-4">Event</th>
                                <th class="px-6 py-4">Nominal</th>
                                <th class="px-6 py-4 text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($recentRegistrations as $reg)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <p class="font-bold text-slate-900">{{ $reg->user->name ?? '-' }}</p>
                                        <p class="text-xs text-slate-500">{{ $reg->created_at->diffForHumans() }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="font-semibold text-brand-700">{{ $reg->eventKategori->event->nama_event ?? '-' }}</p>
                                        <p class="text-xs font-bold text-slate-700">{{ $reg->eventKategori->jenisEvent->nama_jenis ?? '-' }}</p>
                                    </td>
                                    <td class="px-6 py-4 font-bold text-slate-900">
                                        Rp {{ number_format($reg->total_bayar, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        @if($reg->status_pembayaran === 'Lunas')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-800">Lunas</span>
                                        @elseif($reg->status_pembayaran === 'Dibatalkan')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-red-100 text-red-800">Batal</span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-100 text-amber-800">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-slate-500">Belum ada aktivitas pendaftaran.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6">
                <h3 class="text-lg font-bold text-slate-800 mb-6">Aksi Cepat</h3>
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('manage-events.create') }}" class="group flex flex-col items-center justify-center p-5 rounded-2xl border border-slate-200 hover:border-brand-500 hover:bg-brand-50 transition-all duration-200 text-center">
                        <div class="w-10 h-10 rounded-full bg-brand-100 text-brand-600 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </div>
                        <p class="text-xs font-bold text-slate-800 group-hover:text-brand-700">Buat Event</p>
                    </a>

                    <a href="{{ route('manage-kupon.create') }}" class="group flex flex-col items-center justify-center p-5 rounded-2xl border border-slate-200 hover:border-accent-500 hover:bg-accent-50 transition-all duration-200 text-center">
                        <div class="w-10 h-10 rounded-full bg-accent-100 text-accent-600 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                            </svg>
                        </div>
                        <p class="text-xs font-bold text-slate-800 group-hover:text-accent-700">Buat Kupon</p>
                    </a>
                </div>
            </div>

        </div>

    </div>
</x-app-layout>