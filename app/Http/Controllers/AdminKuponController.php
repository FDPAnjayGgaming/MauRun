<?php

namespace App\Http\Controllers;

use App\Models\MasterKupon; // Pastikan model ini sudah ada
use Illuminate\Http\Request;

class AdminKuponController extends Controller
{
    public function index()
    {
        $kupons = MasterKupon::latest()->get();
        return view('admin.kupon.index', compact('kupons'));
    }

    public function create()
    {
        return view('admin.kupon.create');
    }



    public function edit(MasterKupon $manage_kupon)
    {
        return view('admin.kupon.edit', compact('manage_kupon'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_kupon'        => 'required|string|unique:master_kupons,kode_kupon|max:50',
            'tipe_diskon'       => 'required|in:nominal,persentase',
            'nilai_diskon'      => 'required|numeric|min:0',
            'maksimal_potongan' => 'nullable|numeric|min:0',
            'kuota_pemakaian'   => 'required|integer|min:1',
            'berlaku_sampai'    => 'required|date',
        ]);

        $validated['kode_kupon'] = strtoupper($validated['kode_kupon']);

        MasterKupon::create($validated);

        return redirect()->route('manage-kupon.index')->with('success', 'Kupon berhasil ditambahkan!');
    }

    public function update(Request $request, MasterKupon $manage_kupon)
    {
        $validated = $request->validate([
            'kode_kupon'        => 'required|string|max:50|unique:master_kupons,kode_kupon,' . $manage_kupon->id,
            'tipe_diskon'       => 'required|in:nominal,persentase',
            'nilai_diskon'      => 'required|numeric|min:0',
            'maksimal_potongan' => 'nullable|numeric|min:0',
            'kuota_pemakaian'   => 'required|integer|min:1',
            'berlaku_sampai'    => 'required|date',
        ]);

        $validated['kode_kupon'] = strtoupper($validated['kode_kupon']);

        $manage_kupon->update($validated);

        return redirect()->route('manage-kupon.index')->with('success', 'Kupon berhasil diperbarui!');
    }

    public function destroy(MasterKupon $manage_kupon)
    {
        $manage_kupon->delete();
        return redirect()->route('manage-kupon.index')->with('success', 'Kupon berhasil dihapus!');
    }
}