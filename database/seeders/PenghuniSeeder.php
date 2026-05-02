<?php

namespace Database\Seeders;

use App\Models\Penghuni;
use Illuminate\Database\Seeder;

class PenghuniSeeder extends Seeder
{
    public function run()
    {
        $penghuni = [
            [
                'user_id' => 3,
                'nama' => 'Rizki',
                'no_hp' => '082121730722',
                'email' => 'mrizkiaksel@gmail.com',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => null,
                'alamat' => null,
                'foto_profil' => null,
                'status_penghuni' => 'calon',
            ],
        ];

        foreach ($penghuni as $data) {
            Penghuni::create($data);
        }
    }
}
