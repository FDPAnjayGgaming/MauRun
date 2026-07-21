{{-- Sidebar --}}
<aside class="fixed top-0 left-0 w-64 h-screen bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900 text-white flex flex-col z-50">

    {{-- Logo --}}
    <div class="px-5 py-4 border-b border-white/10">
        <a href="{{ route('dashboard-panitia') }}" class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-white flex items-center justify-center shadow-lg p-1">
                <img src="{{ asset('images/logo.png') }}" alt="MauRun" class="w-full h-full object-contain">
            </div>
            <div>
                <span class="text-lg font-bold tracking-tight">
                    <span class="text-brand-400">MAU</span><span class="text-accent-400">RUN</span>
                </span>
                <p class="text-[10px] text-slate-500 -mt-0.5 tracking-wider">ADMIN PANEL</p>
            </div>
        </a>
    </div>

    {{-- Navigation --}}
    <nav class="mt-4 flex-1 overflow-y-auto">

        @auth
            @if(Auth::user()->role == 'admin')

                <a href="{{ route('dashboard-panitia') }}"
                   class="sidebar-link {{ request()->routeIs('dashboard-panitia') ? 'sidebar-link-active' : '' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                    </svg>
                    Dashboard
                </a>

                <a href="{{ route('manage-events.index') }}"
                   class="sidebar-link {{ request()->routeIs('manage-events.*') ? 'sidebar-link-active' : '' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                    Kelola Event
                </a>

                <a href="{{ route('manage-pendaftar.index') }}"
                   class="sidebar-link {{ request()->routeIs('manage-pendaftar.*') ? 'sidebar-link-active' : '' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                    Data Pendaftar
                </a>

                {{-- Section: Master Data --}}
                <div class="sidebar-section-title">Master Data</div>

                <a href="{{ route('manage-jenis.index') }}"
                   class="sidebar-link {{ request()->routeIs('manage-jenis.*') ? 'sidebar-link-active' : '' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                    </svg>
                    Kelola Jenis
                </a>

                <a href="{{ route('manage-kupon.index') }}"
                   class="sidebar-link {{ request()->routeIs('manage-kupon.*') ? 'sidebar-link-active' : '' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                    </svg>
                    Kelola Kupon
                </a>

                <a href="{{ route('manage-kota.index') }}"
                   class="sidebar-link {{ request()->routeIs('manage-kota.*') ? 'sidebar-link-active' : '' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>
                    Kelola Kota
                </a>

            @else

                <a href="{{ route('events') }}"
                   class="sidebar-link">
                    <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                    </svg>
                    Katalog Event
                </a>

            @endif
        @endauth

    </nav>

    {{-- User Section --}}
    @auth
    <div class="border-t border-white/10 p-4">

        <div class="flex items-center gap-3 mb-3">
            {{-- Avatar Initial --}}
            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-brand-500 to-accent-500 flex items-center justify-center text-sm font-bold uppercase">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-slate-400 truncate">{{ Auth::user()->email }}</p>
            </div>
        </div>

        <a href="{{ route('profile.edit') }}"
           class="sidebar-link text-xs {{ request()->routeIs('profile.*') ? 'sidebar-link-active' : '' }}">
            <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </svg>
            Profile
        </a>

        <form method="POST" action="{{ route('logout') }}" class="mt-1">
            @csrf
            <button class="sidebar-link text-xs text-red-400 hover:text-red-300 hover:bg-red-500/10 w-full">
                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                </svg>
                Logout
            </button>
        </form>

    </div>
    @endauth

</aside>