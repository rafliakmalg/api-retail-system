<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {    
        $barangs = [
            [
                'nama' => 'PEN',
                'kategori' => Barang::KATEGORI_ATK,
                'harga' => 15000.00,
            ],
            [
                'nama' => 'PENSIL',
                'kategori' => Barang::KATEGORI_ATK,
                'harga' => 10000.00,
            ],
            [
                'nama' => 'PAYUNG',
                'kategori' => Barang::KATEGORI_RT,
                'harga' => 70000.00,
            ],
            [
                'nama' => 'PANCI',
                'kategori' => Barang::KATEGORI_MASAK,
                'harga' => 110000.00,
            ],
            [
                'nama' => 'SAPU',
                'kategori' => Barang::KATEGORI_RT,
                'harga' => 40000.00,
            ],
            [
                'nama' => 'KIPAS',
                'kategori' => Barang::KATEGORI_ELEKTRONIK,
                'harga' => 200000.00,
            ],
            [
                'nama' => 'KUALI',
                'kategori' => Barang::KATEGORI_MASAK,
                'harga' => 120000.00,
            ],
            [
                'nama' => 'SIKAT',
                'kategori' => Barang::KATEGORI_RT,
                'harga' => 30000.00,
            ],
            [
                'nama' => 'GELAS',
                'kategori' => Barang::KATEGORI_RT,
                'harga' => 25000.00,
            ],
            [
                'nama' => 'PIRING',
                'kategori' => Barang::KATEGORI_RT,
                'harga' => 35000.00,
            ],
            [
                'nama' => 'LAMPU LED',
                'kategori' => Barang::KATEGORI_ELEKTRONIK,
                'harga' => 85000.00,
            ],
            [
                'nama' => 'BUKU TULIS',
                'kategori' => Barang::KATEGORI_ATK,
                'harga' => 12000.00,
            ],
            [
                'nama' => 'KARPET',
                'kategori' => Barang::KATEGORI_RT,
                'harga' => 150000.00,
            ],
            [
                'nama' => 'WOK',
                'kategori' => Barang::KATEGORI_MASAK,
                'harga' => 95000.00,
            ],
            [
                'nama' => 'PULPEN',
                'kategori' => Barang::KATEGORI_ATK,
                'harga' => 5000.00,
            ],
            [
                'nama' => 'SETRIKA',
                'kategori' => Barang::KATEGORI_ELEKTRONIK,
                'harga' => 180000.00,
            ],
            [
                'nama' => 'RAK PIRING',
                'kategori' => Barang::KATEGORI_RT,
                'harga' => 65000.00,
            ],
            [
                'nama' => 'TEFLON',
                'kategori' => Barang::KATEGORI_MASAK,
                'harga' => 130000.00,
            ],
            [
                'nama' => 'PENGHAPUS',
                'kategori' => Barang::KATEGORI_ATK,
                'harga' => 3000.00,
            ],
            [
                'nama' => 'GORDEN',
                'kategori' => Barang::KATEGORI_RT,
                'harga' => 90000.00,
            ],
        ];

        foreach ($barangs as $barang) {
            Barang::create($barang);
        }
    }
}