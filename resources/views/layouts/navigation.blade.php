<div class="flex min-h-screen">
    <!-- Sidebar -->
   <aside class="fixed top-0 left-0 w-64 h-screen bg-slate-800 text-white">
        <div class="p-6 text-xl font-bold border-b border-gray-700">
            MAURUN
        </div>

        <nav class="mt-4 flex flex-col">

            @auth
                @if(Auth::user()->role == 'admin')

                    <a href="{{ route('dashboard-panitia') }}"
                       class="px-6 py-3 hover:bg-gray-700 {{ request()->routeIs('dashboard-panitia') ? 'bg-gray-700' : '' }}">
                        Dashboard
                    </a>

                    <a href="{{ route('manage-events.index') }}"
                       class="px-6 py-3 hover:bg-gray-700 {{ request()->routeIs('manage-events.*') ? 'bg-gray-700' : '' }}">
                        Kelola Event
                    </a>
                    
                    <div class="px-6 pt-6 pb-2 text-xs font-bold uppercase tracking-wider text-gray-400">
                        Master Data
                    </div>

                        <a href="{{ route('manage-jenis.index') }}"
                        class="block px-6 py-3 hover:bg-gray-700 {{ request()->routeIs('manage-jenis.*') ? 'bg-gray-700' : '' }}">
                            Kelola Jenis
                        </a>

                        <a href="{{ route('manage-kupon.index') }}"
                        class="block px-6 py-3 hover:bg-gray-700 {{ request()->routeIs('manage-kupon.*') ? 'bg-gray-700' : '' }}">
                            Kelola Kupon
                        </a>

                        <a href="{{ route('manage-kota.index') }}"
                        class="block px-6 py-3 hover:bg-gray-700 {{ request()->routeIs('manage-kota.*') ? 'bg-gray-700' : '' }}">
                            Kelola Kota
                        </a>

                @else

                    <a href="{{ route('events') }}"
                       class="px-6 py-3 hover:bg-gray-700">
                        Katalog Event
                    </a>

                @endif
            @endauth

        </nav>

        <div class="absolute bottom-0 w-64 border-t border-gray-700 p-4">
            <div>{{ Auth::user()->name }}</div>

            <a href="{{ route('profile.edit') }}"
               class="block px-6 py-3 hover:bg-gray-700 {{ request()->routeIs('profile.*') ? 'bg-gray-700' : '' }}">
                Profile
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="mt-2 w-full rounded bg-red-600 py-2 hover:bg-red-700">
                    Logout
                </button>
            </form>
        </div>
    </aside>
</div>