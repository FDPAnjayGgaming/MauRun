<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Katalog Event MauRun') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <h3 class="text-2xl font-bold mb-4">
                    @auth
                        Selamat datang, {{ Auth::user()->name }}! 
                    @else
                        Selamat datang di MauRun!
                    @endauth
                </h3>
                
                <p class="text-gray-600 mb-6">Ini adalah halaman katalog tempat peserta memilih event lari.</p>

                <!-- Tombol Logout Manual (Jika kamu tidak pakai Navbar bawaan Breeze) -->
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                            Keluar (Log Out)
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                        Login untuk Mendaftar
                    </a>
                @endauth

            </div>
        </div>
    </div>
</x-app-layout>