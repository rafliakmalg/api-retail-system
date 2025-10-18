<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    CONST KATEGORI_ELEKTRONIK = 1;
    CONST KATEGORI_ATK = 2;
    CONST KATEGORI_RT = 3;
    CONST KATEGORI_MASAK = 4;

    protected $table = 'barangs';
    protected $fillable = ['nama', 'kategori', 'harga'];
    protected $appends = ['kategori_label', 'kategori_short_label'];
    
    public function itemPenjualans()
    {
        return $this->hasMany(ItemPenjualan::class);
    }

    public static function getKategoriOptions()
    {
        return [
            self::KATEGORI_ELEKTRONIK => 'Elektronik',
            self::KATEGORI_ATK => 'Alat Tulis Kantor',
            self::KATEGORI_RT => 'Rumah Tangga',
            self::KATEGORI_MASAK => 'Peralatan Masak',
        ];
    }

    public static function getKategoriShortOptions()
    {
        return [
            self::KATEGORI_ELEKTRONIK => 'ELEKTRONIK',
            self::KATEGORI_ATK => 'ATK',
            self::KATEGORI_RT => 'RT',
            self::KATEGORI_MASAK => 'MASAK',
        ];
    }

    public static function getKategoriValidationRules()
    {
        $options = array_keys(self::getKategoriOptions());
        $optionsString = implode(',', $options);
        return "in:{$optionsString}";
    }

    public function getKategoriLabelAttribute()
    {
        $options = self::getKategoriOptions();
        return $options[$this->kategori] ?? 'Unknown';
    }

    public function getKategoriShortLabelAttribute()
    {
        $options = self::getKategoriShortOptions();
        return $options[$this->kategori] ?? 'Unknown';
    }
}
