<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class MasterKupon extends Model
{
    protected $fillable = [
        'kode_kupon', 'tipe_diskon', 'nilai_diskon', 
        'maksimal_potongan', 'kuota_pemakaian', 'berlaku_sampai',
    ];
}