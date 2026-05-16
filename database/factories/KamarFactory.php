<?php

namespace Database\Factories;

use App\Models\Kamar;
use App\Models\Kos;
use Illuminate\Database\Eloquent\Factories\Factory;

class KamarFactory extends Factory
{
    protected $model = Kamar::class;

    public function definition(): array
    {
        return [
            'id_kos' => Kos::factory(),
            'nomor_kamar' => fake()->unique()->numerify('###'),
            'tipe_kamar' => fake()->randomElement(['Standar', 'Deluxe', 'VIP', 'Superior', 'Ekonomi']),
            'harga' => fake()->numberBetween(300000, 5000000),
            'luas_kamar' => fake()->numberBetween(12, 50) . ' m²',
            'kapasitas' => fake()->numberBetween(1, 4),
            'status_kamar' => 'tersedia',
        ];
    }
}
