<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class FrontEventController extends Controller
{
    public function landing()
    {
        if (\Illuminate\Support\Facades\Auth::check() && in_array(\Illuminate\Support\Facades\Auth::user()->role, ['admin', 'panitia'])) {
            return redirect()->route('dashboard-panitia');
        }

        $events = Event::with(['kota', 'kategoris'])
            ->where('is_active', true)
            ->orderBy('tanggal', 'asc')
            ->take(6)
            ->get();

        return view('peserta.events.index', compact('events'));
    }

    public function index(Request $request)
    {
        if (\Illuminate\Support\Facades\Auth::check() && in_array(\Illuminate\Support\Facades\Auth::user()->role, ['admin', 'panitia'])) {
            return redirect()->route('dashboard-panitia');
        }

        $query = Event::with(['kota', 'kategoris'])->where('is_active', true);

        // Filter berdasarkan pencarian nama event
        if ($request->filled('search')) {
            $query->where('nama_event', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan kota
        if ($request->filled('kota_id')) {
            $query->where('kota_id', $request->kota_id);
        }

        // Filter berdasarkan kategori (Jenis Event)
        if ($request->filled('kategori_id')) {
            $query->whereHas('kategoris', function ($q) use ($request) {
                $q->where('master_jenis_event_id', $request->kategori_id);
            });
        }

        $events = $query->orderBy('tanggal', 'asc')->paginate(9)->withQueryString();

        // Ambil semua kota untuk dropdown filter
        $kotas = \App\Models\MasterKota::orderBy('nama_kota')->get();
        // Ambil semua kategori untuk dropdown filter
        $kategoris = \App\Models\MasterJenisEvent::orderBy('nama_jenis')->get();

        return view('peserta.events.catalog', compact('events', 'kotas', 'kategoris'));
    }

    public function show($id)
    {
        $event = Event::with(['kota', 'kategoris.jenisEvent'])
            ->where('is_active', true)
            ->findOrFail($id);

        $hasRegistered = false;
        if (\Illuminate\Support\Facades\Auth::check()) {
            $hasRegistered = \App\Models\Pendaftaran::where('user_id', \Illuminate\Support\Facades\Auth::id())
                ->whereHas('eventKategori', function($q) use ($event) {
                    $q->where('event_id', $event->id);
                })->exists();
        }

        return view('peserta.events.show', compact('event', 'hasRegistered'));
    }
}
