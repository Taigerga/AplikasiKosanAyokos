<?php

namespace App\Providers;

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
        // No commands to register
    }
}
