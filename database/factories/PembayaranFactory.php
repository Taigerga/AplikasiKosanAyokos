<?php

namespace Database\Factories;

use App\Models\Pembayaran;
use App\Models\KontrakSewa;
use App\Models\Penghuni;
use Illuminate\Database\Eloquent\Factories\Factory;

class PembayaranFactory extends Factory
{
    protected $model = Pembayaran::class;

    public function definition(): array
    {
        return [
            'id_kontrak' => KontrakSewa::factory(),
            'id_penghuni' => Penghuni::factory(),
            'jumlah' => fake()->numberBetween(300000, 5000000),
            'metode_pembayaran' => fake()->randomElement(['transfer', 'qris']),
            'status_pembayaran' => 'pending',
            'bulan_tahun' => now()->format('Y-m'),
            'tanggal_jatuh_tempo' => now()->endOfMonth(),
        ];
    }

    public function lunas(): static
    {
        return $this->state(fn (array $attributes) => [
            'status_pembayaran' => 'lunas',
            'tanggal_bayar' => now(),
        ]);
    }
}
