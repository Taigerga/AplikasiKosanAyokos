<?php

namespace Database\Factories;

use App\Models\Pemilik;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PemilikFactory extends Factory
{
    protected $model = Pemilik::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory()->pemilik(),
            'nama' => fake()->name(),
            'no_hp' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'jenis_kelamin' => fake()->randomElement(['L', 'P']),
            'tanggal_lahir' => fake()->dateTimeBetween('-60 years', '-17 years')->format('Y-m-d'),
            'alamat' => fake()->address(),
            'status_pemilik' => 'aktif',
        ];
    }
}
