<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\MasterKota;
use App\Models\MasterJenisEvent;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Membuat Akun Admin
        User::create([
            'name' => 'Panitia MauRun',
            'email' => 'admin@maurun.com',
            'password' => Hash::make('password123'), // Password default
            'role' => 'admin',
        ]);

        // 2. Membuat Akun Peserta Dummy (Untuk testing)
        User::create([
            'name' => 'Budi Pelari',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'peserta',
        ]);

        // 3. Mengisi Master Kota
        $kotas = ['Jakarta', 'Bandung', 'Surabaya', 'Yogyakarta', 'Bali'];
        foreach ($kotas as $kota) {
            MasterKota::create(['nama_kota' => $kota]);
        }

        // 4. Mengisi Master Jenis Event
        $jenis_events = ['5K', '10K', 'Half Marathon (21K)', 'Full Marathon (42K)'];
        foreach ($jenis_events as $jenis) {
            MasterJenisEvent::create(['nama_jenis' => $jenis]);
        }
    }
}