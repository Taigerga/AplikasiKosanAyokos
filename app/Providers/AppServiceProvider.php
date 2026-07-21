<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use App\Services\Notification\KontrakNotificationService;
use App\Services\Notification\PembayaranNotificationService;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(PembayaranNotificationService::class, function ($app) {
            return new PembayaranNotificationService();
        });
    }

    public function boot()
    {
        // Login (web)
        RateLimiter::for('login', function (Request $request) {
            $key = $request->input('username') ?: $request->ip();

            return Limit::perMinute(5)->by('login:' . $key)->response(function () {
                return back()->withErrors([
                    'login' => 'Terlalu banyak percobaan login. Silakan coba lagi dalam 1 menit.',
                ]);
            });
        });

        // Register (web)
        RateLimiter::for('register', function (Request $request) {
            return Limit::perMinute(3)->by('register:' . $request->ip())->response(function () {
                return back()->withErrors([
                    'register' => 'Terlalu banyak percobaan registrasi. Silakan coba lagi dalam 1 menit.',
                ]);
            });
        });

        // Login (API)
        RateLimiter::for('api-login', function (Request $request) {
            $key = $request->input('username') ?: $request->ip();

            return Limit::perMinute(5)->by('api-login:' . $key);
        });

        // Register (API)
        RateLimiter::for('api-register', function (Request $request) {
            return Limit::perMinute(3)->by('api-register:' . $request->ip());
        });

        // Forgot password (web + API)
        RateLimiter::for('forgot-password', function (Request $request) {
            $key = $request->input('email') ?: $request->ip();

            return Limit::perMinute(3)->by('forgot-password:' . $key)->response(function () use ($request) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Terlalu banyak permintaan reset password. Silakan coba lagi dalam 1 menit.',
                    ], 429);
                }

                return back()->withErrors([
                    'email' => 'Terlalu banyak permintaan reset password. Silakan coba lagi dalam 1 menit.',
                ]);
            });
        });

        // Reset password (web + API)
        RateLimiter::for('reset-password', function (Request $request) {
            $key = $request->input('email') ?: $request->ip();

            return Limit::perMinute(3)->by('reset-password:' . $key)->response(function () use ($request) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Terlalu banyak permintaan reset password. Silakan coba lagi dalam 1 menit.',
                    ], 429);
                }

                return back()->withErrors([
                    'email' => 'Terlalu banyak permintaan reset password. Silakan coba lagi dalam 1 menit.',
                ]);
            });
        });
    }
}
