<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login DAN role-nya adalah admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request); // Silakan lewat
        }

        // Jika bukan admin, tampilkan pesan error 403 (Akses Ditolak)
        abort(403, 'Akses Ditolak. Halaman ini khusus untuk panitia penyelenggara.');
        
        // Alternatif: Jika kamu ingin menendang mereka kembali ke beranda, 
        // hapus baris abort() di atas dan gunakan kode di bawah ini:
        // return redirect('/');
    }
}