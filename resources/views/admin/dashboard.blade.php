<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Panitia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-2">Selamat datang, {{ Auth::user()->name }}! 🏃‍♂️</h3>
                    <p class="text-gray-600 mb-6">Ini adalah pusat kendali aplikasi MauRun. Dari sini kamu bisa mengelola semua event lari, melihat pendaftar, dan mengatur kupon diskon.</p>
                    
                    <!-- Kartu Statistik (Data masih dummy sementara) -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                        
                        <div class="bg-blue-50 p-6 rounded-lg border border-blue-100 flex flex-col justify-center items-center shadow-sm">
                            <h4 class="font-bold text-blue-800 mb-2">Total Event Aktif</h4>
                            <p class="text-4xl font-extrabold text-blue-900">3</p>
                        </div>
                        
                        <div class="bg-green-50 p-6 rounded-lg border border-green-100 flex flex-col justify-center items-center shadow-sm">
                            <h4 class="font-bold text-green-800 mb-2">Total Peserta</h4>
                            <p class="text-4xl font-extrabold text-green-900">128</p>
                        </div>
                        
                        <div class="bg-yellow-50 p-6 rounded-lg border border-yellow-100 flex flex-col justify-center items-center shadow-sm">
                            <h4 class="font-bold text-yellow-800 mb-2">Tiket Terjual</h4>
                            <p class="text-4xl font-extrabold text-yellow-900">150</p>
                        </div>

                    </div>

                    <div class="mt-8">
                        <a href="{{ route('manage-events.index') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-150">
                            Pergi ke Kelola Event &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>