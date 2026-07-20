<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class MasterJenisEvent extends Model
{
    protected $fillable = ['nama_jenis'];

    public function eventKategoris() {
        return $this->hasMany(EventKategori::class, 'jenis_event_id');
    }
}