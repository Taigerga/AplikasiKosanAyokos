<?php

namespace Database\Factories;

use App\Models\Review;
use App\Models\Kos;
use App\Models\Penghuni;
use App\Models\KontrakSewa;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        return [
            'id_kos' => Kos::factory(),
            'id_penghuni' => Penghuni::factory(),
            'id_kontrak' => KontrakSewa::factory(),
            'rating' => fake()->numberBetween(1, 5),
            'komentar' => fake()->sentence(10),
        ];
    }
}
