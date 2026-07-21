<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'username' => 'admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'username' => 'Yanto27',
                'password' => Hash::make('password'),
                'role' => 'pemilik',
            ],
            [
                'username' => 'rizki1',
                'password' => Hash::make('password'),
                'role' => 'penghuni',
            ],
            [
                'username' => 'pemilik_sample',
                'password' => Hash::make('password'),
                'role' => 'pemilik',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
