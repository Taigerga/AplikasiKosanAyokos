<?php

namespace App\Services\Notification;

use App\Models\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class PembayaranNotificationService
{
    private function createInApp(int $userId, string $type, string $title, ?string $body = null, ?string $link = null): void
    {
        try {
            Notification::create([
                'id_user' => $userId,
                'type' => $type,
                'title' => $title,
                'body' => $body,
                'link' => $link,
                'is_read' => false,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to create in-app notification: ' . $e->getMessage());
        }
    }
    public function sendEmailNotification($to, $subject, $view, $data = [])
    {
        try {
            Mail::send($view, $data, function ($message) use ($to, $subject) {
                $message->to($to)
                    ->subject($subject);
            });

            Log::info("PembayaranNotificationService: Email sent to {$to}");

            return true;
        } catch (\Exception $e) {
            Log::error("PembayaranNotificationService: Failed to send email to {$to}: " . $e->getMessage());
            throw $e;
        }
    }

    public function sendContractEmailReminder($to, $userName, $kosName, $roomNumber, $daysLeft, $endDate, $type = 'before', $isPemilik = false)
    {
        $subject = $this->buildContractEmailSubject($daysLeft, $type, $isPemilik);

        $data = [
            'userName' => $userName,
            'kosName' => $kosName,
            'roomNumber' => $roomNumber,
            'daysLeft' => $daysLeft,
            'endDate' => $endDate,
            'type' => $type,
            'isPemilik' => $isPemilik,
            'emailMessage' => $this->buildContractEmailMessage($kosName, $roomNumber, $daysLeft, $endDate, $type, $isPemilik),
            'isCompletion' => false,
        ];

        return $this->sendEmailNotification($to, $subject, 'emails.contract_reminder', $data);
    }

    public function sendContractCompletionEmail($to, $userName, $kosName, $roomNumber, $endDate, $isPemilik = false)
    {
        $subject = $isPemilik ? "[PEMILIK] ✅ Kontrak Kos Telah Selesai" : "✅ Kontrak Kos Telah Selesai";

        $data = [
            'userName' => $userName,
            'kosName' => $kosName,
            'roomNumber' => $roomNumber,
            'endDate' => $endDate,
            'isPemilik' => $isPemilik,
            'isCompletion' => true,
            'emailMessage' => $this->buildContractCompletionEmailMessage($kosName, $roomNumber, $endDate, $isPemilik)
        ];

        return $this->sendEmailNotification($to, $subject, 'emails.contract_reminder', $data);
    }

    public function sendDualContractReminder($user, $kosName, $roomNumber, $daysLeft, $endDate, $type = 'before', $isPemilik = false)
    {
        $results = [];

        if (!empty($user->email)) {
            try {
                if ($type === 'completion') {
                    $results['email'] = $this->sendContractCompletionEmail(
                        $user->email, $user->nama, $kosName, $roomNumber, $endDate, $isPemilik
                    );
                } else {
                    $results['email'] = $this->sendContractEmailReminder(
                        $user->email, $user->nama, $kosName, $roomNumber, $daysLeft, $endDate, $type, $isPemilik
                    );
                }
            } catch (\Exception $e) {
                $results['email_error'] = $e->getMessage();
                Log::error("PembayaranNotificationService: Failed Email for {$user->email}: " . $e->getMessage());
            }
        }

        return $results;
    }

    public function sendPaymentEmailNotification($to, $type, $paymentData)
    {
        $subject = $this->buildPaymentEmailSubject($type, $paymentData);
        $view = $this->getPaymentEmailView($type);

        $data = array_merge($paymentData, [
            'type' => $type,
            'emailMessage' => $this->buildPaymentEmailMessage($type, $paymentData)
        ]);

        return $this->sendEmailNotification($to, $subject, $view, $data);
    }

    public function sendDualPaymentNotification($user, $type, $paymentData, $isPemilik = false)
    {
        $results = [];
        $paymentData['userName'] = $user->nama;
        $paymentData['isPemilik'] = $isPemilik;

        if (!empty($user->email)) {
            try {
                $results['email'] = $this->sendPaymentEmailNotification(
                    $user->email, $type, $paymentData
                );
            } catch (\Exception $e) {
                $results['email_error'] = $e->getMessage();
                Log::error("PembayaranNotificationService: Failed Email for {$user->email}: " . $e->getMessage());
            }
        }

        $kosName = $paymentData['kosName'] ?? '';
        $amount = $paymentData['amount'] ?? 0;
        $amountFormatted = "Rp " . number_format($amount, 0, ',', '.');
        $link = $isPemilik ? url('/pemilik/pembayaran') : url('/penghuni/pembayaran');

        $notifType = match ($type) {
            'pending_penghuni' => 'pembayaran_baru',
            'pending_pemilik' => 'pembayaran_baru',
            'approved_penghuni' => 'pembayaran_disetujui',
            'approved_pemilik' => 'pembayaran_disetujui',
            'rejected_penghuni' => 'pembayaran_ditolak',
            'rejected_pemilik' => 'pembayaran_ditolak',
            default => $type,
        };

        $title = match ($type) {
            'pending_penghuni' => 'Pembayaran menunggu verifikasi',
            'pending_pemilik' => 'Pembayaran baru dari penghuni',
            'approved_penghuni' => 'Pembayaran disetujui',
            'approved_pemilik' => 'Pembayaran telah disetujui',
            'rejected_penghuni' => 'Pembayaran ditolak',
            'rejected_pemilik' => 'Pembayaran telah ditolak',
            default => 'Informasi pembayaran',
        };

        $body = match ($type) {
            'pending_penghuni' => "Pembayaran {$amountFormatted} untuk {$kosName} sedang menunggu verifikasi pemilik.",
            'pending_pemilik' => "Pembayaran {$amountFormatted} dari {$paymentData['penghuniName']} untuk {$kosName} menunggu verifikasi.",
            'approved_penghuni' => "Pembayaran {$amountFormatted} untuk {$kosName} telah disetujui.",
            'approved_pemilik' => "Pembayaran {$amountFormatted} dari {$paymentData['penghuniName']} untuk {$kosName} telah disetujui.",
            'rejected_penghuni' => "Pembayaran {$amountFormatted} untuk {$kosName} ditolak. Silakan upload ulang.",
            'rejected_pemilik' => "Pembayaran {$amountFormatted} dari {$paymentData['penghuniName']} untuk {$kosName} telah ditolak.",
            default => "Informasi pembayaran untuk {$kosName}.",
        };

        $this->createInApp($user->user_id, $notifType, $title, $body, $link);

        return $results;
    }

    private function buildContractEmailSubject($daysLeft, $type, $isPemilik)
    {
        $prefix = $isPemilik ? "[PEMILIK] " : "";
        return match ($type) {
            'before' => $prefix . "⏰ Pengingat Kontrak Kos - {$daysLeft} Hari Lagi",
            'today' => $prefix . "⚠️ Kontrak Kos Berakhir Hari Ini",
            'overdue' => $prefix . "🚨 Kontrak Kos Telah Melewati Tenggat Waktu",
            default => $prefix . "📋 Informasi Kontrak Kos",
        };
    }

    private function buildContractEmailMessage($kosName, $roomNumber, $daysLeft, $endDate, $type, $isPemilik)
    {
        $userType = $isPemilik ? "penghuni" : "Anda";
        $roomInfo = $roomNumber ? " (Kamar {$roomNumber})" : "";

        return match ($type) {
            'before' => "Kontrak kos {$userType} di <strong>{$kosName}</strong>{$roomInfo} akan berakhir dalam <strong>{$daysLeft} hari</strong> (berakhir pada {$endDate}).<br><br>Silakan persiapkan perpanjangan kontrak atau pengosongan kamar sesuai peraturan kos.",
            'today' => "<strong>PERHATIAN!</strong> Kontrak kos {$userType} di <strong>{$kosName}</strong>{$roomInfo} <strong>berakhir hari ini</strong> ({$endDate}).<br><br>Segera lakukan perpanjangan kontrak atau kosongkan kamar sesuai peraturan kos.",
            'overdue' => "<strong>PENTING!</strong> Kontrak kos {$userType} di <strong>{$kosName}</strong>{$roomInfo} telah <strong>melewati tenggat waktu {$daysLeft} hari yang lalu</strong> (berakhir pada {$endDate}).<br><br>Segera hubungi " . ($isPemilik ? "penghuni" : "pemilik kos") . " atau kosongkan kamar.",
            default => "Informasi kontrak kos di <strong>{$kosName}</strong>{$roomInfo}.",
        };
    }

    private function buildContractCompletionEmailMessage($kosName, $roomNumber, $endDate, $isPemilik)
    {
        $userType = $isPemilik ? "penghuni" : "Anda";
        $roomInfo = $roomNumber ? " (Kamar {$roomNumber})" : "";

        return "Kontrak kos {$userType} di <strong>{$kosName}</strong>{$roomInfo} telah <strong>resmi selesai</strong> (berakhir pada {$endDate}).<br><br>Terima kasih telah menggunakan layanan AyoKos.";
    }

    private function buildPaymentEmailSubject($type, $paymentData)
    {
        $kosName = $paymentData['kosName'] ?? '';
        $prefix = ($paymentData['isPemilik'] ?? false) ? "[PEMILIK] " : "";

        return match ($type) {
            'pending_penghuni' => $prefix . "⏳ Menunggu Verifikasi Pembayaran - {$kosName}",
            'pending_pemilik' => $prefix . "💳 Pembayaran Baru dari Penghuni - {$kosName}",
            'approved_penghuni' => $prefix . "✅ Pembayaran Disetujui - {$kosName}",
            'approved_pemilik' => $prefix . "✅ Pembayaran Telah Disetujui - {$kosName}",
            'rejected_penghuni' => $prefix . "❌ Pembayaran Ditolak - {$kosName}",
            'rejected_pemilik' => $prefix . "❌ Pembayaran Telah Ditolak - {$kosName}",
            default => $prefix . "📋 Informasi Pembayaran - {$kosName}",
        };
    }

    private function buildPaymentEmailMessage($type, $paymentData)
    {
        $kosName = $paymentData['kosName'] ?? '';
        $roomNumber = $paymentData['roomNumber'] ?? '';
        $amount = $paymentData['amount'] ?? 0;
        $paymentDate = $paymentData['paymentDate'] ?? '';
        $period = $paymentData['period'] ?? '';
        $isPemilik = $paymentData['isPemilik'] ?? false;

        $roomInfo = $roomNumber ? " (Kamar {$roomNumber})" : "";
        $amountFormatted = "Rp " . number_format($amount, 0, ',', '.');

        return match ($type) {
            'pending_penghuni' => "Pembayaran Anda sebesar <strong>{$amountFormatted}</strong> untuk kos <strong>{$kosName}</strong>{$roomInfo} periode <strong>{$period}</strong> (dibayar pada {$paymentDate}) sedang <strong>menunggu verifikasi</strong> dari pemilik.",
            'pending_pemilik' => "Ada pembayaran baru dari <strong>{$paymentData['penghuniName']}</strong> sebesar <strong>{$amountFormatted}</strong> untuk kos <strong>{$kosName}</strong>{$roomInfo} periode <strong>{$period}</strong> (dibayar pada {$paymentDate}). Silakan verifikasi pembayaran ini.",
            'approved_penghuni' => "Pembayaran Anda sebesar <strong>{$amountFormatted}</strong> untuk kos <strong>{$kosName}</strong>{$roomInfo} periode <strong>{$period}</strong> telah <strong>disetujui</strong>. Status pembayaran: Lunas.",
            'approved_pemilik' => "Anda telah <strong>menyetujui</strong> pembayaran dari <strong>{$paymentData['penghuniName']}</strong> sebesar <strong>{$amountFormatted}</strong> untuk kos <strong>{$kosName}</strong>{$roomInfo} periode <strong>{$period}</strong>. Status pembayaran: Lunas.",
            'rejected_penghuni' => "Pembayaran Anda sebesar <strong>{$amountFormatted}</strong> untuk kos <strong>{$kosName}</strong>{$roomInfo} periode <strong>{$period}</strong> <strong>ditolak</strong>. Silakan upload ulang bukti pembayaran yang valid.",
            'rejected_pemilik' => "Anda telah <strong>menolak</strong> pembayaran dari <strong>{$paymentData['penghuniName']}</strong> sebesar <strong>{$amountFormatted}</strong> untuk kos <strong>{$kosName}</strong>{$roomInfo} periode <strong>{$period}</strong>. Penghuni perlu upload ulang bukti pembayaran.",
            default => "Informasi pembayaran untuk kos <strong>{$kosName}</strong>{$roomInfo}.",
        };
    }

    private function getPaymentEmailView($type)
    {
        if (strpos($type, 'penghuni') !== false) {
            return 'emails.penghuni.pembayaran_notification';
        } elseif (strpos($type, 'pemilik') !== false) {
            return 'emails.pemilik.pembayaran_notification';
        }
        return 'emails.penghuni.pembayaran_notification';
    }
}
