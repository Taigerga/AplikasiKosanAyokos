<?php

namespace Database\Factories;

use App\Models\KontrakSewa;
use App\Models\Kos;
use App\Models\Kamar;
use App\Models\Penghuni;
use Illuminate\Database\Eloquent\Factories\Factory;

class KontrakSewaFactory extends Factory
{
    protected $model = KontrakSewa::class;

    public function definition(): array
    {
        return [
            'id_penghuni' => Penghuni::factory(),
            'id_kos' => Kos::factory(),
            'id_kamar' => Kamar::factory(),
            'durasi_sewa' => fake()->numberBetween(1, 12),
            'harga_sewa' => fake()->numberBetween(300000, 5000000),
            'status_kontrak' => 'pending',
            'tanggal_daftar' => now(),
        ];
    }

    public function aktif(): static
    {
        return $this->state(fn (array $attributes) => [
            'status_kontrak' => 'aktif',
            'tanggal_mulai' => now(),
            'tanggal_selesai' => now()->addMonths(6),
        ]);
    }

    public function selesai(): static
    {
        return $this->state(fn (array $attributes) => [
            'status_kontrak' => 'selesai',
            'tanggal_mulai' => now()->subMonths(6),
            'tanggal_selesai' => now()->subDay(),
        ]);
    }
}
