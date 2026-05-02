<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UsersSeeder::class,
            FasilitasSeeder::class,
            PemilikSeeder::class,
            PenghuniSeeder::class,
            AdminSeeder::class,
            KosSeeder::class,
            KamarSeeder::class,
            KosFasilitasSeeder::class,
        ]);
    }
}