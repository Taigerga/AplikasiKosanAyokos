<?php

namespace Database\Seeders;

use App\Models\KosFasilitas;
use Illuminate\Database\Seeder;

class KosFasilitasSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id_kos' => 1, 'id_fasilitas' => 5],
            ['id_kos' => 2, 'id_fasilitas' => 5],
            ['id_kos' => 1, 'id_fasilitas' => 8],
            ['id_kos' => 2, 'id_fasilitas' => 8],
            ['id_kos' => 1, 'id_fasilitas' => 3],
            ['id_kos' => 2, 'id_fasilitas' => 3],
            ['id_kos' => 1, 'id_fasilitas' => 4],
            ['id_kos' => 2, 'id_fasilitas' => 4],
            ['id_kos' => 1, 'id_fasilitas' => 2],
            ['id_kos' => 2, 'id_fasilitas' => 2],
            ['id_kos' => 1, 'id_fasilitas' => 7],
            ['id_kos' => 2, 'id_fasilitas' => 7],
            ['id_kos' => 1, 'id_fasilitas' => 6],
            ['id_kos' => 2, 'id_fasilitas' => 6],
            ['id_kos' => 1, 'id_fasilitas' => 9],
            ['id_kos' => 2, 'id_fasilitas' => 9],
            ['id_kos' => 1, 'id_fasilitas' => 1],
            ['id_kos' => 2, 'id_fasilitas' => 1],
        ];

        foreach ($data as $item) {
            KosFasilitas::create($item);
        }
    }
}
