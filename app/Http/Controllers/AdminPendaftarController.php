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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pendaftaran = Pendaftaran::with(['user', 'eventKategori.event', 'eventKategori.jenisEvent'])->findOrFail($id);
        return view('admin.pendaftar.edit', compact('pendaftaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'ukuran_jersey' => 'required|string|in:S,M,L,XL,XXL',
            'golongan_darah' => 'required|string|in:A,B,AB,O',
            'status_pembayaran' => 'required|in:Pending,Lunas,Dibatalkan'
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update([
            'ukuran_jersey' => $request->ukuran_jersey,
            'golongan_darah' => $request->golongan_darah,
            'status_pembayaran' => $request->status_pembayaran,
        ]);

        return redirect()->route('manage-pendaftar.index')->with('success', 'Data pendaftar berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->delete();

        return redirect()->route('manage-pendaftar.index')->with('success', 'Data pendaftar berhasil dihapus.');
    }
}
