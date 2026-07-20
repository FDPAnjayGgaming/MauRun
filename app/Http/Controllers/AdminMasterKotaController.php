<?php

namespace App\Http\Controllers;

use App\Models\MasterKota;
use Illuminate\Http\Request;

class AdminMasterKotaController extends Controller
{
    public function index() {
        $kota = MasterKota::all();
        return view('admin.kota.index', compact('kota'));
    }

    public function store(Request $request) {
        $request->validate(['nama_kota' => 'required|unique:master_kotas,nama_kota']);
        MasterKota::create($request->all());
        return back()->with('success', 'Data kota berhasil ditambah!');
    }

    public function destroy(MasterKota $kota) {
        $kota->delete();
        return back()->with('success', 'Data kota dihapus!');
    }
}