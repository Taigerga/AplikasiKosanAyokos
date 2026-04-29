<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ALLNotificationService
{
    /**
     * Send email notification
     */
    public function sendEmailNotification($to, $subject, $view, $data = [])
    {
        try {
            Mail::send($view, $data, function ($message) use ($to, $subject) {
                $message->to($to)
                    ->subject($subject);
            });
            
            Log::info("ALLNotificationService: Email sent to {$to}");
            
            return true;
        } catch (\Exception $e) {
            Log::error("ALLNotificationService: Failed to send email to {$to}: " . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Send contract reminder email
     */
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
            // avoid using key 'message' because Mail exposes $message in views
            'emailMessage' => $this->buildContractEmailMessage($kosName, $roomNumber, $daysLeft, $endDate, $type, $isPemilik),
            // ensure view always has this variable to avoid undefined notices
            'isCompletion' => false,
        ];
        
        return $this->sendEmailNotification($to, $subject, 'emails.contract_reminder', $data);
    }

    /**
     * Send contract completion email
     */
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
            // avoid using key 'message' because Mail exposes $message in views
            'emailMessage' => $this->buildContractCompletionEmailMessage($kosName, $roomNumber, $endDate, $isPemilik)
        ];
        
        return $this->sendEmailNotification($to, $subject, 'emails.contract_reminder', $data);
    }

    /**
     * Send contract reminder (email only)
     */
    public function sendDualContractReminder($user, $kosName, $roomNumber, $daysLeft, $endDate, $type = 'before', $isPemilik = false)
    {
        $results = [];
        
        // Send Email only (WhatsApp removed)
        if (!empty($user->email)) {
            try {
                if ($type === 'completion') {
                    $results['email'] = $this->sendContractCompletionEmail(
                        $user->email,
                        $user->nama,
                        $kosName,
                        $roomNumber,
                        $endDate,
                        $isPemilik
                    );
                } else {
                    $results['email'] = $this->sendContractEmailReminder(
                        $user->email,
                        $user->nama,
                        $kosName,
                        $roomNumber,
                        $daysLeft,
                        $endDate,
                        $type,
                        $isPemilik
                    );
                }
            } catch (\Exception $e) {
                $results['email_error'] = $e->getMessage();
                Log::error("ALLNotificationService: Failed Email for {$user->email}: " . $e->getMessage());
            }
        }
        
        return $results;
    }

    /**
     * Build email subject for contract reminder
     */
    private function buildContractEmailSubject($daysLeft, $type, $isPemilik)
    {
        $prefix = $isPemilik ? "[PEMILIK] " : "";
        
        switch ($type) {
            case 'before':
                return $prefix . "⏰ Pengingat Kontrak Kos - {$daysLeft} Hari Lagi";
            case 'today':
                return $prefix . "⚠️ Kontrak Kos Berakhir Hari Ini";
            case 'overdue':
                return $prefix . "🚨 Kontrak Kos Telah Melewati Tenggat Waktu";
            default:
                return $prefix . "📋 Informasi Kontrak Kos";
        }
    }

    /**
     * Build email message for contract reminder
     */
    private function buildContractEmailMessage($kosName, $roomNumber, $daysLeft, $endDate, $type, $isPemilik)
    {
        $userType = $isPemilik ? "penghuni" : "Anda";
        $roomInfo = $roomNumber ? " (Kamar {$roomNumber})" : "";
        
        switch ($type) {
            case 'before':
                return "Kontrak kos {$userType} di <strong>{$kosName}</strong>{$roomInfo} akan berakhir dalam <strong>{$daysLeft} hari</strong> (berakhir pada {$endDate}).<br><br>" .
                       "Silakan persiapkan perpanjangan kontrak atau pengosongan kamar sesuai peraturan kos.";
            
            case 'today':
                return "<strong>PERHATIAN!</strong> Kontrak kos {$userType} di <strong>{$kosName}</strong>{$roomInfo} <strong>berakhir hari ini</strong> ({$endDate}).<br><br>" .
                       "Segera lakukan perpanjangan kontrak atau kosongkan kamar sesuai peraturan kos.";
            
            case 'overdue':
                return "<strong>PENTING!</strong> Kontrak kos {$userType} di <strong>{$kosName}</strong>{$roomInfo} telah <strong>melewati tenggat waktu {$daysLeft} hari yang lalu</strong> (berakhir pada {$endDate}).<br><br>" .
                       "Segera hubungi " . ($isPemilik ? "penghuni" : "pemilik kos") . " atau kosongkan kamar.";
            
            default:
                return "Informasi kontrak kos di <strong>{$kosName}</strong>{$roomInfo}.";
        }
    }

    /**
     * Build email message for contract completion
     */
    private function buildContractCompletionEmailMessage($kosName, $roomNumber, $endDate, $isPemilik)
    {
        $userType = $isPemilik ? "penghuni" : "Anda";
        $roomInfo = $roomNumber ? " (Kamar {$roomNumber})" : "";
        
        return "Kontrak kos {$userType} di <strong>{$kosName}</strong>{$roomInfo} telah <strong>resmi selesai</strong> (berakhir pada {$endDate}).<br><br>" .
               "Terima kasih telah menggunakan layanan AyoKos.";
    }

    /**
     * Send payment email notification
     */
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

    /**
     * Send payment notification (email only)
     */
    public function sendDualPaymentNotification($user, $type, $paymentData, $isPemilik = false)
    {
        $results = [];
        $paymentData['userName'] = $user->nama;
        $paymentData['isPemilik'] = $isPemilik;
        
        // Send Email only (WhatsApp removed)
        if (!empty($user->email)) {
            try {
                $results['email'] = $this->sendPaymentEmailNotification(
                    $user->email,
                    $type,
                    $paymentData
                );
            } catch (\Exception $e) {
                $results['email_error'] = $e->getMessage();
                Log::error("ALLNotificationService: Failed Email for {$user->email}: " . $e->getMessage());
            }
        }
        
        return $results;
    }

    /**
     * Build email subject for payment notifications
     */
    private function buildPaymentEmailSubject($type, $paymentData)
    {
        $kosName = $paymentData['kosName'] ?? '';
        $prefix = ($paymentData['isPemilik'] ?? false) ? "[PEMILIK] " : "";
        
        switch ($type) {
            case 'pending_penghuni':
                return $prefix . "⏳ Menunggu Verifikasi Pembayaran - {$kosName}";
            case 'pending_pemilik':
                return $prefix . "💳 Pembayaran Baru dari Penghuni - {$kosName}";
            case 'approved_penghuni':
                return $prefix . "✅ Pembayaran Disetujui - {$kosName}";
            case 'approved_pemilik':
                return $prefix . "✅ Pembayaran Telah Disetujui - {$kosName}";
            case 'rejected_penghuni':
                return $prefix . "❌ Pembayaran Ditolak - {$kosName}";
            case 'rejected_pemilik':
                return $prefix . "❌ Pembayaran Telah Ditolak - {$kosName}";
            default:
                return $prefix . "📋 Informasi Pembayaran - {$kosName}";
        }
    }

    /**
     * Build email message for payment notifications
     */
    private function buildPaymentEmailMessage($type, $paymentData)
    {
        $kosName = $paymentData['kosName'] ?? '';
        $roomNumber = $paymentData['roomNumber'] ?? '';
        $amount = $paymentData['amount'] ?? 0;
        $paymentDate = $paymentData['paymentDate'] ?? '';
        $period = $paymentData['period'] ?? '';
        $userName = $paymentData['userName'] ?? '';
        $isPemilik = $paymentData['isPemilik'] ?? false;
        
        $roomInfo = $roomNumber ? " (Kamar {$roomNumber})" : "";
        $amountFormatted = "Rp " . number_format($amount, 0, ',', '.');
        
        switch ($type) {
            case 'pending_penghuni':
                return "Pembayaran Anda sebesar <strong>{$amountFormatted}</strong> untuk kos <strong>{$kosName}</strong>{$roomInfo} periode <strong>{$period}</strong> (dibayar pada {$paymentDate}) sedang <strong>menunggu verifikasi</strong> dari pemilik.";
            
            case 'pending_pemilik':
                return "Ada pembayaran baru dari <strong>{$paymentData['penghuniName']}</strong> sebesar <strong>{$amountFormatted}</strong> untuk kos <strong>{$kosName}</strong>{$roomInfo} periode <strong>{$period}</strong> (dibayar pada {$paymentDate}). Silakan verifikasi pembayaran ini.";
            
            case 'approved_penghuni':
                return "Pembayaran Anda sebesar <strong>{$amountFormatted}</strong> untuk kos <strong>{$kosName}</strong>{$roomInfo} periode <strong>{$period}</strong> telah <strong>disetujui</strong>. Status pembayaran: Lunas.";
            
            case 'approved_pemilik':
                return "Anda telah <strong>menyetujui</strong> pembayaran dari <strong>{$paymentData['penghuniName']}</strong> sebesar <strong>{$amountFormatted}</strong> untuk kos <strong>{$kosName}</strong>{$roomInfo} periode <strong>{$period}</strong>. Status pembayaran: Lunas.";
            
            case 'rejected_penghuni':
                return "Pembayaran Anda sebesar <strong>{$amountFormatted}</strong> untuk kos <strong>{$kosName}</strong>{$roomInfo} periode <strong>{$period}</strong> <strong>ditolak</strong>. Silakan upload ulang bukti pembayaran yang valid.";
            
            case 'rejected_pemilik':
                return "Anda telah <strong>menolak</strong> pembayaran dari <strong>{$paymentData['penghuniName']}</strong> sebesar <strong>{$amountFormatted}</strong> untuk kos <strong>{$kosName}</strong>{$roomInfo} periode <strong>{$period}</strong>. Penghuni perlu upload ulang bukti pembayaran.";
            
            default:
                return "Informasi pembayaran untuk kos <strong>{$kosName}</strong>{$roomInfo}.";
        }
    }

    /**
     * Get email view for payment notifications
     */
    private function getPaymentEmailView($type)
    {
        if (strpos($type, 'penghuni') !== false) {
            return 'emails.penghuni.pembayaran_notification';
        } elseif (strpos($type, 'pemilik') !== false) {
            return 'emails.pemilik.pembayaran_notification';
        }
        
        return 'emails.penghuni.pembayaran_notification'; // default
    }
}
