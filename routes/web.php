<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminEventController;
use App\Http\Controllers\AdminEventKategoriController;
use App\Http\Controllers\PesertaEventController;
use App\Http\Controllers\AdminKuponController;
use App\Http\Controllers\AdminMasterJenisController;
use App\Http\Controllers\AdminMasterKotaController;
use App\Http\Controllers\FrontEventController;

// Rute Halaman Utama
Route::get('/', [FrontEventController::class, 'landing'])->name('home');

// ==========================================
// RUTE UNTUK PESERTA (PUBLIK & LOGIN)
// ==========================================

// Katalog Event (Bisa diakses siapa saja, belum login pun bisa)
Route::get('/events', [FrontEventController::class, 'index'])->name('events');
Route::get('/events/{event}', [FrontEventController::class, 'show'])->name('events.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/riwayat-pendaftaran', [PesertaEventController::class, 'history'])->name('riwayat-pendaftaran');
});

// ==========================================
// RUTE KHUSUS PANITIA / ADMIN
// ==========================================
Route::middleware(['auth', 'is_admin'])->group(function () {

    Route::get('/dashboard-panitia', [\App\Http\Controllers\AdminDashboardController::class, 'index'])->name('dashboard-panitia');

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

    // Data Pendaftar
    Route::get('/manage-pendaftar', [\App\Http\Controllers\AdminPendaftarController::class, 'index'])->name('manage-pendaftar.index');
    Route::patch('/manage-pendaftar/{id}/status', [\App\Http\Controllers\AdminPendaftarController::class, 'updateStatus'])->name('manage-pendaftar.update-status');
});






// ==========================================
// RUTE PROFIL BAWAAN BREEZE & PENDAFTARAN EVENT
// ==========================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Pendaftaran Event
    Route::get('/events/{event}/register', [\App\Http\Controllers\PesertaEventController::class, 'create'])->name('events.register');
    Route::post('/events/{event}/register', [\App\Http\Controllers\PesertaEventController::class, 'store'])->name('events.register.store');
    
    // API Cek Kupon
    Route::post('/events/check-kupon', [\App\Http\Controllers\PesertaEventController::class, 'checkKupon'])->name('events.check-kupon');
});

require __DIR__.'/auth.php';