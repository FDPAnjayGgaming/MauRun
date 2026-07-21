<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-800 leading-tight">Kelola Pengguna</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            {{-- Flash Message --}}
            @if(session('success'))
                <div class="p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-medium">
                    ✅ {{ session('success') }}
                </div>
            @endif

            {{-- Search & Header --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <p class="text-slate-500 text-sm">Total: <span class="font-bold text-slate-700">{{ $users->total() }}</span> peserta</p>
                <form method="GET" action="{{ route('manage-users.index') }}" class="flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari nama, email, atau NIK..."
                        class="border border-slate-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 w-64">
                    <button type="submit" class="px-4 py-2 bg-brand-600 text-white text-sm font-semibold rounded-xl hover:bg-brand-700 transition-colors">
                        Cari
                    </button>
                    @if(request('search'))
                        <a href="{{ route('manage-users.index') }}" class="px-4 py-2 bg-slate-100 text-slate-600 text-sm font-semibold rounded-xl hover:bg-slate-200 transition-colors">Reset</a>
                    @endif
                </form>
            </div>

            {{-- Table --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-slate-50 border-b border-slate-100">
                            <tr>
                                <th class="text-left px-5 py-3.5 font-semibold text-slate-500">#</th>
                                <th class="text-left px-5 py-3.5 font-semibold text-slate-500">Nama</th>
                                <th class="text-left px-5 py-3.5 font-semibold text-slate-500">Email</th>
                                <th class="text-left px-5 py-3.5 font-semibold text-slate-500">NIK</th>
                                <th class="text-left px-5 py-3.5 font-semibold text-slate-500">No. HP</th>
                                <th class="text-left px-5 py-3.5 font-semibold text-slate-500">Daftar Sejak</th>
                                <th class="text-center px-5 py-3.5 font-semibold text-slate-500">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($users as $user)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="px-5 py-4 text-slate-400">{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-brand-500 to-accent-500 flex items-center justify-center text-white text-xs font-bold uppercase shrink-0">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <span class="font-semibold text-slate-800">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-5 py-4 text-slate-600">{{ $user->email }}</td>
                                <td class="px-5 py-4">
                                    @if($user->nik)
                                        <span class="font-mono text-xs bg-slate-100 px-2 py-1 rounded-lg text-slate-600">{{ $user->nik }}</span>
                                    @else
                                        <span class="text-slate-300 text-xs">— belum diisi</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-slate-600">{{ $user->no_hp ?? '—' }}</td>
                                <td class="px-5 py-4 text-slate-400 text-xs">{{ $user->created_at->format('d M Y') }}</td>
                                <td class="px-5 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('manage-users.edit', $user) }}"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-brand-50 text-brand-700 text-xs font-semibold rounded-lg hover:bg-brand-100 transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z" />
                                            </svg>
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('manage-users.destroy', $user) }}"
                                            onsubmit="return confirm('Yakin ingin hapus user {{ $user->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-50 text-red-600 text-xs font-semibold rounded-lg hover:bg-red-100 transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-5 py-16 text-center text-slate-400">
                                    <svg class="w-12 h-12 mx-auto mb-3 text-slate-200" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                    </svg>
                                    Tidak ada pengguna ditemukan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if($users->hasPages())
                <div class="px-5 py-4 border-t border-slate-100">
                    {{ $users->links() }}
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
