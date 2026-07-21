<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Pendaftaran;
use App\Models\MasterKupon;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalEvent = Event::where('is_active', true)->count();
        $totalPeserta = Pendaftaran::count();
        $kuponAktif = MasterKupon::where('berlaku_sampai', '>=', now())->count();
        
        // Total Pendapatan dari Pendaftaran yang sudah 'Lunas'
        $totalPendapatan = Pendaftaran::where('status_pembayaran', 'Lunas')->sum('total_bayar');

        // Ambil 5 pendaftar terbaru
        $recentRegistrations = Pendaftaran::with(['user', 'eventKategori.event', 'eventKategori.jenisEvent'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalEvent', 
            'totalPeserta', 
            'kuponAktif', 
            'totalPendapatan', 
            'recentRegistrations'
        ));
    }
}
