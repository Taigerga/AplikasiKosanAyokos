<?php

return [
    'defaults' => [
        'guard' => 'web',
        'passwords' => 'penghuni',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'penghuni' => [
            'driver' => 'session',
            'provider' => 'users',
            'remember' => true,
        ],

        'pemilik' => [
            'driver' => 'session',
            'provider' => 'users',
            'remember' => true,
        ],

        'admin' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
    ],

    'passwords' => [
        'penghuni' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'pemilik' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],
];