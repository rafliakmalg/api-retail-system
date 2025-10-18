<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'penjualans';
    protected $fillable = ['pelanggan_id', 'tanggal', 'sub_total'];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function itemPenjualans()
    {
        return $this->hasMany(ItemPenjualan::class);
    }

    public function getTotalItemsAttribute()
    {
        return $this->itemPenjualans->sum('qty');
    }    
}
