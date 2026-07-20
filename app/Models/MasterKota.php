<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class MasterKota extends Model
{
    protected $fillable = ['nama_kota'];

    public function events() {
        return $this->hasMany(Event::class, 'kota_id');
    }
}