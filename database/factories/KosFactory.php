<?php

namespace Database\Factories;

use App\Models\Kos;
use App\Models\Pemilik;
use Illuminate\Database\Eloquent\Factories\Factory;

class KosFactory extends Factory
{
    protected $model = Kos::class;

    public function definition(): array
    {
        return [
            'id_pemilik' => Pemilik::factory(),
            'nama_kos' => fake()->company(),
            'alamat' => fake()->address(),
            'kecamatan' => fake()->city(),
            'kota' => fake()->city(),
            'provinsi' => fake()->state(),
            'kode_pos' => fake()->postcode(),
            'deskripsi' => fake()->sentence(),
            'jenis_kos' => fake()->randomElement(['putra', 'putri', 'campuran']),
            'tipe_sewa' => fake()->randomElement(['harian', 'mingguan', 'bulanan', 'tahunan']),
            'status_kos' => 'aktif',
        ];
    }
}
