<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class AdminPendaftarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $events = Event::orderBy('tanggal', 'desc')->get();

        $query = Pendaftaran::with(['user', 'eventKategori.event', 'eventKategori.jenisEvent', 'kupon']);

        // Filter by Event
        if ($request->filled('event_id')) {
            $query->whereHas('eventKategori', function($q) use ($request) {
                $q->where('event_id', $request->event_id);
            });
        }

        // Search by User Name or NIK
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        $pendaftarans = $query->latest()->paginate(20)->withQueryString();

        return view('admin.pendaftar.index', compact('pendaftarans', 'events'));
    }

    /**
     * Update status pembayaran.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_pembayaran' => 'required|in:Pending,Lunas,Dibatalkan'
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update([
            'status_pembayaran' => $request->status_pembayaran
        ]);

        return back()->with('success', 'Status pembayaran berhasil diperbarui!');
    }
}
