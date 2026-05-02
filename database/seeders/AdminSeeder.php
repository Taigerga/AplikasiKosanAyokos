<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'user_id' => 1,
            'nama' => 'Administrator',
            'no_hp' => '08123456789',
            'email' => 'admin@ayokos.com',
            'jenis_kelamin' => 'L',
            'tanggal_lahir' => null,
            'alamat' => null,
            'foto_profil' => null,
            'status_admin' => 'aktif',
        ]);
    }
}
