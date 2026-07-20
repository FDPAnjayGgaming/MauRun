<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventKategori;
use App\Models\MasterJenisEvent;
use Illuminate\Http\Request;

class AdminEventKategoriController extends Controller
{
    // Menampilkan halaman kelola kategori untuk satu event tertentu
    public function index(Event $event)
    {
        // Ambil kategori yang sudah ditambahkan ke event ini
        $kategoris = $event->kategoris()->with('jenisEvent')->get();
        // Ambil data master jenis event (5K, 10K, dll) untuk dropdown
        $master_jenis = MasterJenisEvent::all();
        
        return view('admin.events.kategori', compact('event', 'kategoris', 'master_jenis'));
    }

    // Menyimpan kategori baru ke event
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'jenis_event_id' => 'required|exists:master_jenis_events,id',
            'harga'          => 'required|numeric|min:0',
            'kuota'          => 'required|integer|min:1',
        ]);

        // Cek agar tidak ada kategori ganda (misal: masukin 5K dua kali di event yang sama)
        if ($event->kategoris()->where('jenis_event_id', $request->jenis_event_id)->exists()) {
            return back()->with('error', 'Kategori ini sudah ada di event tersebut!');
        }

        $event->kategoris()->create([
            'jenis_event_id' => $request->jenis_event_id,
            'harga'          => $request->harga,
            'kuota'          => $request->kuota,
        ]);

        return back()->with('success', 'Kategori dan Harga berhasil ditambahkan!');
    }

    // Menampilkan form edit kategori
    public function edit(Event $event, EventKategori $kategori)
    {
        $master_jenis = MasterJenisEvent::all();
        return view('admin.events.kategori_edit', compact('event', 'kategori', 'master_jenis'));
    }

    // Memproses update kategori
    public function update(Request $request, Event $event, EventKategori $kategori)
    {
        $request->validate([
            'jenis_event_id' => 'required|exists:master_jenis_events,id',
            'harga'          => 'required|numeric|min:0',
            'kuota'          => 'required|integer|min:1',
        ]);

        // Cek agar tidak bentrok jika admin mengganti jenis jarak ke jarak yang sudah ada
        if ($kategori->jenis_event_id != $request->jenis_event_id) {
            if ($event->kategoris()->where('jenis_event_id', $request->jenis_event_id)->exists()) {
                return back()->with('error', 'Kategori ini sudah ada di event tersebut!');
            }
        }

        $kategori->update([
            'jenis_event_id' => $request->jenis_event_id,
            'harga'          => $request->harga,
            'kuota'          => $request->kuota,
        ]);

        return redirect()->route('manage-events.kategori.index', $event->id)->with('success', 'Kategori berhasil diperbarui!');
    }
    
    // Menghapus kategori dari event
    public function destroy(Event $event, EventKategori $kategori)
    {
        $kategori->delete();
        return back()->with('success', 'Kategori berhasil dihapus!');
    }
}