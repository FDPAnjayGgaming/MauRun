<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminEventController;
use App\Http\Controllers\AdminEventKategoriController;
use App\Http\Controllers\PesertaEventController;
use App\Http\Controllers\AdminKuponController;
use App\Http\Controllers\AdminMasterJenisController;
use App\Http\Controllers\AdminMasterKotaController;

// Rute Halaman Utama (Bisa diarahkan ke landing page atau langsung ke katalog)
Route::get('/', function () {
    return redirect('/events'); 
});

// ==========================================
// RUTE UNTUK PESERTA (PUBLIK & LOGIN)
// ==========================================

// Katalog Event (Bisa diakses siapa saja, belum login pun bisa)
Route::get('/events', function () {
    return view('peserta.events.index');
})->name('events');;

// ==========================================
// RUTE KHUSUS PANITIA / ADMIN
// ==========================================
Route::middleware(['auth', 'is_admin'])->group(function () {

    Route::get('/dashboard-panitia', function () {
        return view('admin.dashboard');
    })->name('dashboard-panitia');

    Route::resource('manage-events', AdminEventController::class);

    Route::resource('manage-events.kategori', AdminEventKategoriController::class)
        ->parameters(['manage-events' => 'event'])
        ->except(['create', 'show']);

    Route::resource('manage-kupon', AdminKuponController::class);

    Route::resource('manage-jenis', AdminMasterJenisController::class)
        ->parameters(['manage-jenis' => 'jenis'])
        ->except(['create', 'show', 'edit', 'update']);
    
    Route::resource('manage-kota', AdminMasterKotaController::class)
        ->parameters(['manage-kota' => 'kota'])   
        ->except(['create', 'edit', 'show', 'update']);
});






// ==========================================
// RUTE PROFIL BAWAAN BREEZE (BIARKAN)
// ==========================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';