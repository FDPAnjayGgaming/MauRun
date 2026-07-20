<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\MasterKota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminEventController extends Controller
{
    // 1. Menampilkan daftar event (Read)
    public function index()
    {
        // Mengambil semua event beserta relasi kotanya, diurutkan dari yang terbaru
        $events = Event::with('kota')->latest()->get();
        return view('admin.events.index', compact('events'));
    }

    // 2. Menampilkan form tambah event (Create)
    public function create()
    {
        // Ambil data kota untuk dropdown
        $kotas = MasterKota::all();
        return view('admin.events.create', compact('kotas'));
    }

    // 3. Memproses penyimpanan data ke database (Store)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_event' => 'required|string|max:255',
            'tanggal'    => 'required|date',
            'kota_id'    => 'required|exists:master_kotas,id',
            'deskripsi'  => 'required',
            'banner'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
        ]);

        // Proses upload banner jika ada
        if ($request->hasFile('banner')) {
            $validated['banner'] = $request->file('banner')->store('banners', 'public');
        }

        // Ambil nilai checkbox is_active (jika dicentang bernilai true, jika tidak false)
        $validated['is_active'] = $request->has('is_active');

        Event::create($validated);

        return redirect()->route('manage-events.index')->with('success', 'Event berhasil ditambahkan!');
    }

    // 4. Menampilkan form edit (Edit)
    public function edit(Event $manage_event) // Variabel sesuai dengan resource route
    {
        $kotas = MasterKota::all();
        // Rename variabel agar konsisten dengan view
        $event = $manage_event; 
        return view('admin.events.edit', compact('event', 'kotas'));
    }

    // 5. Memproses perubahan data (Update)
    public function update(Request $request, Event $manage_event)
    {
        $validated = $request->validate([
            'nama_event' => 'required|string|max:255',
            'tanggal'    => 'required|date',
            'kota_id'    => 'required|exists:master_kotas,id',
            'deskripsi'  => 'required',
            'banner'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Jika panitia mengupload banner baru
        if ($request->hasFile('banner')) {
            // Hapus banner lama dari storage jika ada
            if ($manage_event->banner) {
                Storage::disk('public')->delete($manage_event->banner);
            }
            $validated['banner'] = $request->file('banner')->store('banners', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $manage_event->update($validated);

        return redirect()->route('manage-events.index')->with('success', 'Event berhasil diperbarui!');
    }

    // 6. Menghapus data (Destroy)
    public function destroy(Event $manage_event)
    {
        // Hapus file gambar banner dari storage terlebih dahulu
        if ($manage_event->banner) {
            Storage::disk('public')->delete($manage_event->banner);
        }

        $manage_event->delete();

        return redirect()->route('manage-events.index')->with('success', 'Event berhasil dihapus!');
    }
}
