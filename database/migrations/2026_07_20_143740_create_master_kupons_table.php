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
    Schema::create('master_kupons', function (Blueprint $table) {
        $table->id();
        $table->string('kode_kupon')->unique();
        $table->enum('tipe_diskon', ['nominal', 'persentase']);
        $table->integer('nilai_diskon');
        $table->integer('maksimal_potongan')->nullable();
        $table->integer('kuota_pemakaian');
        $table->dateTime('berlaku_sampai');
       
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_kupons');
    }
};
