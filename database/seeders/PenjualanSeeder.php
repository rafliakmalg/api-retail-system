<?php

namespace Database\Seeders;

use App\Models\Penjualan;
use App\Models\ItemPenjualan;
use App\Models\Pelanggan;
use App\Models\Barang;
use Illuminate\Database\Seeder;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pelangganMap = [
            'PELANGAN_1' => Pelanggan::where('nama', 'ANDI')->first()->id,
            'PELANGAN_2' => Pelanggan::where('nama', 'BUDI')->first()->id,
            'PELANGAN_3' => Pelanggan::where('nama', 'JOHAN')->first()->id,
            'PELANGAN_4' => Pelanggan::where('nama', 'SINTHA')->first()->id,
            'PELANGAN_5' => Pelanggan::where('nama', 'ANTO')->first()->id,
            'PELANGAN_7' => Pelanggan::where('nama', 'JOWAN')->first()->id,
            'PELANGAN_8' => Pelanggan::where('nama', 'SINTIA')->first()->id,
            'PELANGAN_9' => Pelanggan::where('nama', 'BUTET')->first()->id,
        ];

        $barangMap = [
            'BRG_1' => Barang::where('nama', 'PEN')->first()->id,
            'BRG_2' => Barang::where('nama', 'PENSIL')->first()->id,
            'BRG_3' => Barang::where('nama', 'PAYUNG')->first()->id,
            'BRG_4' => Barang::where('nama', 'PANCI')->first()->id,
            'BRG_5' => Barang::where('nama', 'SAPU')->first()->id,
            'BRG_6' => Barang::where('nama', 'KIPAS')->first()->id,
            'BRG_7' => Barang::where('nama', 'KUALI')->first()->id,
            'BRG_8' => Barang::where('nama', 'SIKAT')->first()->id,
            'BRG_9' => Barang::where('nama', 'GELAS')->first()->id,
            'BRG_10' => Barang::where('nama', 'PIRING')->first()->id,
        ];

        $penjualans = [
            [
                'nota' => 'NOTA_1',
                'tanggal' => '2018-01-01',
                'pelanggan_id' => $pelangganMap['PELANGAN_1'],
                'sub_total' => 50000.00,
                'items' => [
                    ['barang_id' => $barangMap['BRG_1'], 'qty' => 2],
                    ['barang_id' => $barangMap['BRG_2'], 'qty' => 2],
                ],
            ],
            [
                'nota' => 'NOTA_2',
                'tanggal' => '2018-01-01',
                'pelanggan_id' => $pelangganMap['PELANGAN_2'],
                'sub_total' => 200000.00,
                'items' => [
                    ['barang_id' => $barangMap['BRG_6'], 'qty' => 1],
                ],
            ],
            [
                'nota' => 'NOTA_3',
                'tanggal' => '2018-01-01',
                'pelanggan_id' => $pelangganMap['PELANGAN_3'],
                'sub_total' => 430000.00,
                'items' => [
                    ['barang_id' => $barangMap['BRG_4'], 'qty' => 1],
                    ['barang_id' => $barangMap['BRG_7'], 'qty' => 1],
                    ['barang_id' => $barangMap['BRG_6'], 'qty' => 1],
                ],
            ],
            [
                'nota' => 'NOTA_4',
                'tanggal' => '2018-01-02',
                'pelanggan_id' => $pelangganMap['PELANGAN_7'],
                'sub_total' => 120000.00,
                'items' => [
                    ['barang_id' => $barangMap['BRG_9'], 'qty' => 2],
                    ['barang_id' => $barangMap['BRG_10'], 'qty' => 2],
                ],
            ],
            [
                'nota' => 'NOTA_5',
                'tanggal' => '2018-01-02',
                'pelanggan_id' => $pelangganMap['PELANGAN_4'],
                'sub_total' => 70000.00,
                'items' => [
                    ['barang_id' => $barangMap['BRG_3'], 'qty' => 1],
                ],
            ],
            [
                'nota' => 'NOTA_6',
                'tanggal' => '2018-01-03',
                'pelanggan_id' => $pelangganMap['PELANGAN_8'],
                'sub_total' => 230000.00,
                'items' => [
                    ['barang_id' => $barangMap['BRG_7'], 'qty' => 1],
                    ['barang_id' => $barangMap['BRG_5'], 'qty' => 1],
                    ['barang_id' => $barangMap['BRG_3'], 'qty' => 1],
                ],
            ],
            [
                'nota' => 'NOTA_7',
                'tanggal' => '2018-01-03',
                'pelanggan_id' => $pelangganMap['PELANGAN_9'],
                'sub_total' => 390000.00,
                'items' => [
                    ['barang_id' => $barangMap['BRG_5'], 'qty' => 1],
                    ['barang_id' => $barangMap['BRG_6'], 'qty' => 1],
                    ['barang_id' => $barangMap['BRG_7'], 'qty' => 1],
                    ['barang_id' => $barangMap['BRG_8'], 'qty' => 1],
                ],
            ],
            [
                'nota' => 'NOTA_8',
                'tanggal' => '2018-01-03',
                'pelanggan_id' => $pelangganMap['PELANGAN_5'],
                'sub_total' => 65000.00,
                'items' => [
                    ['barang_id' => $barangMap['BRG_5'], 'qty' => 1],
                    ['barang_id' => $barangMap['BRG_9'], 'qty' => 1],
                ],
            ],
            [
                'nota' => 'NOTA_9',
                'tanggal' => '2018-01-04',
                'pelanggan_id' => $pelangganMap['PELANGAN_2'],
                'sub_total' => 40000.00,
                'items' => [
                    ['barang_id' => $barangMap['BRG_5'], 'qty' => 1],
                ],
            ],
        ];

        foreach ($penjualans as $penjualanData) {
            $penjualan = Penjualan::create([
                'pelanggan_id' => $penjualanData['pelanggan_id'],
                'tanggal' => $penjualanData['tanggal'],
                'sub_total' => $penjualanData['sub_total'],
            ]);

            foreach ($penjualanData['items'] as $item) {
                ItemPenjualan::create([
                    'penjualan_id' => $penjualan->id,
                    'barang_id' => $item['barang_id'],
                    'qty' => $item['qty'],
                ]);
            }
        }
    }
}