<?php

namespace App\Http\Controllers;

use App\Models\MasterJenisEvent;
use Illuminate\Http\Request;

class AdminMasterJenisController extends Controller
{
    public function index() {
        $jenis = MasterJenisEvent::all();
        return view('admin.jenis.index', compact('jenis'));
    }

    public function store(Request $request) {
        $request->validate(['nama_jenis' => 'required|unique:master_jenis_events,nama_jenis']);
        MasterJenisEvent::create($request->all());
        return back()->with('success', 'Jenis kategori berhasil ditambah!');
    }


    public function destroy(MasterJenisEvent $jenis) {
        $jenis->delete();
        return back()->with('success', 'Jenis kategori dihapus!');
    }
}