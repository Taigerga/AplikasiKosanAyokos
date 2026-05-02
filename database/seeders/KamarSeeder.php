<?php

namespace Database\Seeders;

use App\Models\Kamar;
use Illuminate\Database\Seeder;

class KamarSeeder extends Seeder
{
    public function run()
    {
        $kamar = [
            [
                'id_kos' => 1,
                'nomor_kamar' => 'A1',
                'tipe_kamar' => 'Deluxe',
                'harga' => 1500000.00,
                'luas_kamar' => '3x4',
                'kapasitas' => 1,
                'fasilitas_kamar' => 'AC, Tempat Tidur, Meja Belajar',
                'foto_kamar' => null,
                'status_kamar' => 'tersedia',
            ],
            [
                'id_kos' => 1,
                'nomor_kamar' => 'A2',
                'tipe_kamar' => 'Standar',
                'harga' => 1200000.00,
                'luas_kamar' => '3x3',
                'kapasitas' => 1,
                'fasilitas_kamar' => 'Tempat Tidur, Meja Belajar',
                'foto_kamar' => null,
                'status_kamar' => 'tersedia',
            ],
            [
                'id_kos' => 2,
                'nomor_kamar' => 'B1',
                'tipe_kamar' => 'VIP',
                'harga' => 2000000.00,
                'luas_kamar' => '4x5',
                'kapasitas' => 2,
                'fasilitas_kamar' => 'AC, Kulkas, TV, Tempat Tidur King Size',
                'foto_kamar' => null,
                'status_kamar' => 'tersedia',
            ],
        ];

        foreach ($kamar as $data) {
            Kamar::create($data);
        }
    }
}
