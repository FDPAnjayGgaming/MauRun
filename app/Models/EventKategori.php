<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class EventKategori extends Model
{
    protected $fillable = ['event_id', 'jenis_event_id', 'harga', 'kuota'];

    public function event() {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function jenisEvent() {
        return $this->belongsTo(MasterJenisEvent::class, 'jenis_event_id');
    }

    public function pendaftarans() {
        return $this->hasMany(Pendaftaran::class, 'event_kategori_id');
    }
}