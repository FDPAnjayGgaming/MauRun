<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['nama_event', 'tanggal', 'kota_id', 'deskripsi', 'banner', 'is_active'];

    // Relasi ke Master Kota
    public function kota() {
        return $this->belongsTo(MasterKota::class, 'kota_id');
    }

    // Relasi One-to-Many ke EventKategori (Misal: 5K, 10K dalam 1 event)
    public function kategoris() {
        return $this->hasMany(EventKategori::class, 'event_id');
    }
}