<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPenjualan extends Model
{
    protected $table = 'item_penjualans';
    protected $fillable = ['penjualan_id', 'barang_id', 'qty'];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
