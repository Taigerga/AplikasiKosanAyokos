<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\SendEmailNotifications::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('notifications:send-emails')
            ->dailyAt('08:00')
            ->timezone('Asia/Jakarta')
            ->withoutOverlapping()
            ->before(function () {
                Log::info('Starting contract reminder schedule at ' . now());
            })
            ->after(function () {
                Log::info('Finished contract reminder schedule at ' . now());
            })
            ->appendOutputTo(storage_path('logs/contract-reminders.log'));

        $schedule->command('notifications:send-emails')
            ->dailyAt('18:00')
            ->timezone('Asia/Jakarta')
            ->withoutOverlapping()
            ->appendOutputTo(storage_path('logs/contract-reminders-evening.log'));
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}