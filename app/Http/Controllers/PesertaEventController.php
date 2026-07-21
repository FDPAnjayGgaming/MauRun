<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventKategori;
use App\Models\MasterKupon;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PesertaEventController extends Controller
{
    /**
     * Tampilkan riwayat pendaftaran peserta (My Events)
     */
    public function history()
    {
        $pendaftarans = Pendaftaran::with(['eventKategori.event.kota', 'eventKategori.jenisEvent'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('peserta.events.history', compact('pendaftarans'));
    }
    /**
     * Show the registration form for an event.
     */
    public function create(Event $event)
    {
        // 1. Cek jika user sudah daftar di event ini
        $user = Auth::user();
        $hasRegistered = Pendaftaran::where('user_id', $user->id)
            ->whereHas('eventKategori', function($q) use ($event) {
                $q->where('event_id', $event->id);
            })->exists();

        if ($hasRegistered) {
            return redirect()->route('events')->with('error', 'Anda sudah terdaftar di event ini. Satu akun hanya bisa mendaftar 1 kategori per event.');
        }

        // 2. Tampilkan form
        $event->load('kategoris.jenisEvent');

        return view('peserta.events.register', compact('event', 'user'));
    }

    /**
     * Handle the registration form submission.
     */
    public function store(Request $request, Event $event)
    {
        $user = Auth::user();

        // 1. Validasi 1 user 1 pendaftaran per event (mencegah double submit)
        $hasRegistered = Pendaftaran::where('user_id', $user->id)
            ->whereHas('eventKategori', function($q) use ($event) {
                $q->where('event_id', $event->id);
            })->exists();

        if ($hasRegistered) {
            return back()->with('error', 'Anda sudah mendaftar di event ini.');
        }

        // 2. Validasi Request
        $request->validate([
            'event_kategori_id' => 'required|exists:event_kategoris,id',
            'ukuran_jersey' => 'required|string',
            'golongan_darah' => 'required|string',
            'kode_kupon' => 'nullable|string'
        ]);

        $kategori = EventKategori::findOrFail($request->event_kategori_id);
        
        // Pastikan kategori yang dipilih memang dari event ini
        if ($kategori->event_id != $event->id) {
            return back()->with('error', 'Kategori tidak valid.');
        }

        // Cek Kuota Kategori
        $jumlahPendaftarKategori = Pendaftaran::where('event_kategori_id', $kategori->id)->count();
        if ($jumlahPendaftarKategori >= $kategori->kuota) {
            return back()->with('error', 'Maaf, kuota untuk kategori ini sudah penuh.');
        }

        $hargaAwal = $kategori->harga;
        $totalDiskon = 0;
        $kuponId = null;

        // 3. Proses Kupon (jika ada)
        if ($request->kode_kupon) {
            $kupon = MasterKupon::where('kode_kupon', $request->kode_kupon)->first();
            
            if (!$kupon) {
                return back()->withInput()->with('error', 'Kode kupon tidak valid.');
            }

            // Validasi expired
            if ($kupon->berlaku_sampai && Carbon::now()->startOfDay()->gt(Carbon::parse($kupon->berlaku_sampai))) {
                return back()->withInput()->with('error', 'Kupon sudah kadaluarsa.');
            }

            // Validasi kuota kupon
            if ($kupon->kuota_pemakaian !== null && $kupon->kuota_pemakaian <= 0) {
                return back()->withInput()->with('error', 'Kuota kupon sudah habis digunakan.');
            }

            // Hitung diskon
            $kuponId = $kupon->id;
            if ($kupon->tipe_diskon == 'persentase') {
                $diskonKalkulasi = ($hargaAwal * $kupon->nilai_diskon) / 100;
                if ($kupon->maksimal_potongan) {
                    $totalDiskon = min($diskonKalkulasi, $kupon->maksimal_potongan);
                } else {
                    $totalDiskon = $diskonKalkulasi;
                }
            } else { // Nominal
                $totalDiskon = $kupon->nilai_diskon;
            }

            // Pastikan diskon tidak melebihi harga awal
            if ($totalDiskon > $hargaAwal) {
                $totalDiskon = $hargaAwal;
            }

            // Kurangi kuota kupon
            if ($kupon->kuota_pemakaian !== null) {
                $kupon->decrement('kuota_pemakaian');
            }
        }

        $totalBayar = $hargaAwal - $totalDiskon;

        // 4. Simpan Pendaftaran
        Pendaftaran::create([
            'user_id' => $user->id,
            'event_kategori_id' => $kategori->id,
            'kupon_id' => $kuponId,
            'harga_awal' => $hargaAwal,
            'total_diskon' => $totalDiskon,
            'total_bayar' => $totalBayar,
            'ukuran_jersey' => $request->ukuran_jersey,
            'golongan_darah' => $request->golongan_darah,
            'status_pembayaran' => 'Pending'
        ]);

        return redirect()->route('events')->with('success', 'Pendaftaran berhasil! Silakan lakukan pembayaran (Status: Pending).');
    }

    /**
     * API untuk cek kupon secara real-time via AJAX.
     */
    public function checkKupon(Request $request)
    {
        $request->validate([
            'kode_kupon' => 'required|string',
            'harga_awal' => 'required|numeric'
        ]);

        $kupon = MasterKupon::where('kode_kupon', $request->kode_kupon)->first();

        if (!$kupon) {
            return response()->json(['valid' => false, 'message' => 'Kupon tidak ditemukan.']);
        }

        if ($kupon->berlaku_sampai && Carbon::now()->startOfDay()->gt(Carbon::parse($kupon->berlaku_sampai))) {
            return response()->json(['valid' => false, 'message' => 'Kupon sudah kadaluarsa.']);
        }

        if ($kupon->kuota_pemakaian !== null && $kupon->kuota_pemakaian <= 0) {
            return response()->json(['valid' => false, 'message' => 'Kuota kupon habis.']);
        }

        $hargaAwal = $request->harga_awal;
        $totalDiskon = 0;

        if ($kupon->tipe_diskon == 'persentase') {
            $diskonKalkulasi = ($hargaAwal * $kupon->nilai_diskon) / 100;
            if ($kupon->maksimal_potongan) {
                $totalDiskon = min($diskonKalkulasi, $kupon->maksimal_potongan);
            } else {
                $totalDiskon = $diskonKalkulasi;
            }
        } else {
            $totalDiskon = $kupon->nilai_diskon;
        }

        if ($totalDiskon > $hargaAwal) {
            $totalDiskon = $hargaAwal;
        }

        return response()->json([
            'valid' => true,
            'message' => 'Kupon berhasil digunakan.',
            'total_diskon' => $totalDiskon,
            'total_bayar' => max(0, $hargaAwal - $totalDiskon)
        ]);
    }
}
