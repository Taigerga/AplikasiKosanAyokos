<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ALLNotificationService;
use App\Services\NotificationService;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register ALLNotificationService (email only, WhatsApp removed)
        $this->app->singleton(ALLNotificationService::class, function ($app) {
            return new ALLNotificationService();
        });

        // Register NotificationService (email only, WhatsApp removed)
        $this->app->singleton(NotificationService::class, function ($app) {
            return new NotificationService();
        });
    }

    public function boot()
    {
        // No commands to register
    }
}
