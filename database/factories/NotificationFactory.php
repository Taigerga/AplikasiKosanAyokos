<?php

namespace Database\Factories;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    protected $model = Notification::class;

    public function definition()
    {
        return [
            'id_user' => User::factory(),
            'type' => fake()->randomElement([
                'kontrak_dibuat', 'kontrak_diterima', 'kontrak_ditolak',
                'pembayaran_baru', 'pembayaran_disetujui', 'pembayaran_ditolak',
                'tenggat_h7', 'tenggat_h3', 'tenggat_h1',
            ]),
            'title' => fake()->sentence(4),
            'body' => fake()->paragraph(),
            'link' => fake()->url(),
            'is_read' => false,
        ];
    }

    public function unread()
    {
        return $this->state(fn() => ['is_read' => false]);
    }

    public function read()
    {
        return $this->state(fn() => ['is_read' => true]);
    }
}
