<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ALLNotificationService;
use App\Services\NotificationService;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(ALLNotificationService::class, function ($app) {
            return new ALLNotificationService();
        });

        $this->app->singleton(NotificationService::class, function ($app) {
            return new NotificationService();
        });
    }

    public function boot()
    {
        // No commands to register
    }
}
