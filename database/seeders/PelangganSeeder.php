<?php

namespace Database\Seeders;

use App\Models\Pelanggan;
use Illuminate\Database\Seeder;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pelanggans = [
            [
                'nama' => 'ANDI',
                'domisili' => 'JAK-UT',
                'jenis_kelamin' => 'Pria',
            ],
            [
                'nama' => 'BUDI',
                'domisili' => 'JAK-BAR',
                'jenis_kelamin' => 'Pria',
            ],
            [
                'nama' => 'JOHAN',
                'domisili' => 'JAK-SEL',
                'jenis_kelamin' => 'Pria',
            ],
            [
                'nama' => 'SINTHA',
                'domisili' => 'JAK-TIM',
                'jenis_kelamin' => 'Perempuan',
            ],
            [
                'nama' => 'ANTO',
                'domisili' => 'JAK-UT',
                'jenis_kelamin' => 'Pria',
            ],
            [
                'nama' => 'BUJANG',
                'domisili' => 'JAK-BAR',
                'jenis_kelamin' => 'Pria',
            ],
            [
                'nama' => 'JOWAN',
                'domisili' => 'JAK-SEL',
                'jenis_kelamin' => 'Pria',
            ],
            [
                'nama' => 'SINTIA',
                'domisili' => 'JAK-TIM',
                'jenis_kelamin' => 'Perempuan',
            ],
            [
                'nama' => 'BUTET',
                'domisili' => 'JAK-BAR',
                'jenis_kelamin' => 'Perempuan',
            ],
            [
                'nama' => 'JONNY',
                'domisili' => 'JAK-SEL',
                'jenis_kelamin' => 'Perempuan',
            ],
        ];

        foreach ($pelanggans as $pelanggan) {
            Pelanggan::create($pelanggan);
        }
    }
}
