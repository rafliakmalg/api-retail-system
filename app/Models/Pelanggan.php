<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggans';
    protected $fillable = ['nama', 'domisili', 'jenis_kelamin'];

    public function penjualans()
    {
        return $this->hasMany(Penjualan::class);
    }

    public function itemPenjualans()
    {
        return $this->hasManyThrough(ItemPenjualan::class, Penjualan::class);
    }

    public function getTotalPenjualanAttribute()
    {
        return $this->penjualans->sum('sub_total');
    }
}
