<?php

namespace Database\Factories;

use App\Models\Penghuni;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PenghuniFactory extends Factory
{
    protected $model = Penghuni::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory()->penghuni(),
            'nama' => fake()->name(),
            'no_hp' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'jenis_kelamin' => fake()->randomElement(['L', 'P']),
            'tanggal_lahir' => fake()->dateTimeBetween('-60 years', '-17 years')->format('Y-m-d'),
            'alamat' => fake()->address(),
            'status_penghuni' => 'aktif',
        ];
    }
}
