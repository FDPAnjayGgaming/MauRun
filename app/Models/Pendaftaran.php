<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $fillable = [
        'user_id', 'event_kategori_id', 'kupon_id', 'harga_awal', 
        'total_diskon', 'total_bayar', 'ukuran_jersey', 'golongan_darah', 'status_pembayaran'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function eventKategori() {
        return $this->belongsTo(EventKategori::class, 'event_kategori_id');
    }

    public function kupon() {
        return $this->belongsTo(MasterKupon::class, 'kupon_id');
    }
}