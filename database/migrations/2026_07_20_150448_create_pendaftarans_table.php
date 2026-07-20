<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('pendaftarans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('event_kategori_id')->constrained('event_kategoris')->onDelete('restrict');
        $table->foreignId('kupon_id')->nullable()->constrained('master_kupons')->onDelete('set null');
        
        // Data Transaksi
        $table->integer('harga_awal');
        $table->integer('total_diskon')->default(0);
        $table->integer('total_bayar');
        
        // Data Spesifik Peserta Saat Mendaftar
        $table->enum('ukuran_jersey', ['S', 'M', 'L', 'XL', 'XXL']);
        $table->enum('golongan_darah', ['A', 'B', 'AB', 'O']);
        
        $table->timestamps();

        // Kunci Anti-Calo: 1 User ID hanya bisa daftar 1 kali di Kategori Event yang sama
        $table->unique(['user_id', 'event_kategori_id']);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
