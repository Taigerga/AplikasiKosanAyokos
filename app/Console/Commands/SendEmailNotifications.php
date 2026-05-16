<?php

namespace App\Console\Commands;

use App\Services\Notification\KontrakNotificationService;
use Illuminate\Console\Command;

class SendEmailNotifications extends Command
{
    protected $signature = 'notifications:send-emails';
    protected $description = 'Kirim notifikasi email untuk kontrak dan tenggat waktu';

    public function __construct(
        protected KontrakNotificationService $notificationService
    ) {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Memulai pengiriman notifikasi email...');
        
        $this->notificationService->checkAndSendTenggatWaktuNotifications();
        
        $this->info('Notifikasi email telah dikirim.');
        
        return Command::SUCCESS;
    }
}