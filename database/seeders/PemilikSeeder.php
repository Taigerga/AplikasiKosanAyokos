<?php

namespace Database\Seeders;

use App\Models\Pemilik;
use Illuminate\Database\Seeder;

class PemilikSeeder extends Seeder
{
    public function run()
    {
        $pemilik = [
            [
                'user_id' => 4,
                'nama' => 'Pemilik Sample',
                'no_hp' => '08123456789',
                'email' => 'pemilik@sample.com',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => null,
                'alamat' => null,
                'foto_profil' => null,
                'status_pemilik' => 'aktif',
                'nama_bank' => null,
                'nomor_rekening' => null,
            ],
            [
                'user_id' => 2,
                'nama' => 'Yanto',
                'no_hp' => '082121730722',
                'email' => 'mrizkiaksel@gmail.com',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => null,
                'alamat' => null,
                'foto_profil' => null,
                'status_pemilik' => 'pending',
                'nama_bank' => null,
                'nomor_rekening' => null,
            ],
        ];

        foreach ($pemilik as $data) {
            Pemilik::create($data);
        }
    }
}
