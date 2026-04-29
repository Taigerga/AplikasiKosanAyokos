<?php

namespace App\Services;

use App\Models\KontrakSewa;
use App\Models\Penghuni;
use App\Models\Pemilik;
use App\Models\Kos;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Mail;
use App\Mail\Penghuni\MenungguPersetujuanMail;
use App\Mail\Penghuni\KontrakDiterimaMail;
use App\Mail\Penghuni\KontrakDitolakMail as PenghuniKontrakDitolakMail;
use App\Mail\Pemilik\PengajuanBaruMail;
use App\Mail\Pemilik\KontrakDisetujuiMail;
use App\Mail\Pemilik\KontrakDitolakMail as PemilikKontrakDitolakMail;

class NotificationService
{
    /**
     * Helper untuk format tanggal yang aman (handle null)
     */
    private function formatTanggalSafely($tanggal, $fallbackText = 'Belum ditentukan')
    {
        return $tanggal ? $tanggal->format('d F Y') : $fallbackText;
    }

    // ==================== NOTIFIKASI AWAL PENGAJUAN ====================

    public function sendMenungguPersetujuan($kontrakId)
    {
        $kontrak = KontrakSewa::with(['penghuni', 'kos'])->find($kontrakId);

        if (!$kontrak) {
            return false;
        }

        // Send Email
        try {
            Mail::to($kontrak->penghuni->email)->send(new MenungguPersetujuanMail($kontrak));
            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send email MenungguPersetujuan: " . $e->getMessage());
            return false;
        }
    }

    public function sendPersetujuanDiterima($kontrakId)
    {
        $kontrak = KontrakSewa::with(['penghuni', 'kos'])->find($kontrakId);

        if (!$kontrak || $kontrak->status_kontrak !== 'aktif') {
            return false;
        }

        // Send Email
        try {
            Mail::to($kontrak->penghuni->email)->send(new KontrakDiterimaMail($kontrak));
            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send email KontrakDiterima: " . $e->getMessage());
            return false;
        }
    }

    public function sendPersetujuanDitolak($kontrakId)
    {
        $kontrak = KontrakSewa::with(['penghuni', 'kos'])->find($kontrakId);

        if (!$kontrak || $kontrak->status_kontrak !== 'ditolak') {
            return false;
        }

        // Send Email
        try {
            Mail::to($kontrak->penghuni->email)->send(new PenghuniKontrakDitolakMail($kontrak));
            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send email KontrakDitolak: " . $e->getMessage());
            return false;
        }
    }

    public function sendPengajuanBaru($kontrakId)
    {
        $kontrak = KontrakSewa::with(['penghuni', 'kos.pemilik'])->find($kontrakId);

        if (!$kontrak || !$kontrak->kos->pemilik) {
            return false;
        }

        // Send Email
        try {
            Mail::to($kontrak->kos->pemilik->email)->send(new PengajuanBaruMail($kontrak));
            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send email PengajuanBaru: " . $e->getMessage());
            return false;
        }
    }

    public function sendPersetujuanDiberikan($kontrakId)
    {
        $kontrak = KontrakSewa::with(['penghuni', 'kos.pemilik'])->find($kontrakId);

        if (!$kontrak || !$kontrak->kos->pemilik) {
            return false;
        }

        // Send Email
        try {
            Mail::to($kontrak->kos->pemilik->email)->send(new KontrakDisetujuiMail($kontrak));
            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send email KontrakDisetujui: " . $e->getMessage());
            return false;
        }
    }

    public function sendPersetujuanDitolakPemilik($kontrakId)
    {
        $kontrak = KontrakSewa::with(['penghuni', 'kos.pemilik'])->find($kontrakId);

        if (!$kontrak || !$kontrak->kos->pemilik) {
            return false;
        }

        // Send Email
        try {
            Mail::to($kontrak->kos->pemilik->email)->send(new PemilikKontrakDitolakMail($kontrak));
            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send email KontrakDitolakPemilik: " . $e->getMessage());
            return false;
        }
    }

    // ==================== PENGINGAT MASA KONTRAK ====================

    /**
     * Pengingat 7 hari sebelum kontrak habis (update dari 5 hari)
     */
    public function sendPengingat7Hari($kontrakId)
    {
        $kontrak = KontrakSewa::with(['penghuni', 'kos'])->find($kontrakId);

        if (!$kontrak || $kontrak->status_kontrak !== 'aktif') {
            return false;
        }

        // Skip jika tanggal_selesai null
        if (!$kontrak->tanggal_selesai) {
            return false;
        }

        // Send Email via EmailNotificationService
        try {
            $emailService = app(EmailNotificationService::class);
            $emailService->sendContractReminderEmail(
                $kontrak->penghuni->email,
                $kontrak->penghuni->nama,
                $kontrak->kos->nama_kos,
                $kontrak->kamar->nomor_kamar ?? null,
                (int) ceil(Carbon::now()->diffInDays($kontrak->tanggal_selesai)),
                $kontrak->tanggal_selesai->format('d F Y'),
                'before',
                false
            );
            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send 7-day reminder email: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Pengingat 3 hari sebelum kontrak habis
     */
    public function sendPengingat3Hari($kontrakId)
    {
        $kontrak = KontrakSewa::with(['penghuni', 'kos'])->find($kontrakId);

        if (!$kontrak || $kontrak->status_kontrak !== 'aktif') {
            return false;
        }

        // Skip jika tanggal_selesai null
        if (!$kontrak->tanggal_selesai) {
            return false;
        }

        // Send Email via EmailNotificationService
        try {
            $emailService = app(EmailNotificationService::class);
            $emailService->sendContractReminderEmail(
                $kontrak->penghuni->email,
                $kontrak->penghuni->nama,
                $kontrak->kos->nama_kos,
                $kontrak->kamar->nomor_kamar ?? null,
                (int) ceil(Carbon::now()->diffInDays($kontrak->tanggal_selesai)),
                $kontrak->tanggal_selesai->format('d F Y'),
                'before',
                false
            );
            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send 3-day reminder email: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Pengingat H-1 (besok habis) - update dari hari terakhir
     */
    public function sendPengingatH1($kontrakId)
    {
        $kontrak = KontrakSewa::with(['penghuni', 'kos'])->find($kontrakId);

        if (!$kontrak || $kontrak->status_kontrak !== 'aktif' || !$kontrak->tanggal_selesai) {
            return false;
        }

        // Send Email via EmailNotificationService
        try {
            $emailService = app(EmailNotificationService::class);
            $emailService->sendContractReminderEmail(
                $kontrak->penghuni->email,
                $kontrak->penghuni->nama,
                $kontrak->kos->nama_kos,
                $kontrak->kamar->nomor_kamar ?? null,
                1,
                $kontrak->tanggal_selesai->format('d F Y'),
                'today',
                false
            );
            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send H-1 reminder email: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Pengingat hari ini habis
     */
    public function sendPengingatHariIni($kontrakId)
    {
        $kontrak = KontrakSewa::with(['penghuni', 'kos'])->find($kontrakId);

        if (!$kontrak || $kontrak->status_kontrak !== 'aktif' || !$kontrak->tanggal_selesai) {
            return false;
        }

        // Send Email via EmailNotificationService
        try {
            $emailService = app(EmailNotificationService::class);
            $emailService->sendContractReminderEmail(
                $kontrak->penghuni->email,
                $kontrak->penghuni->nama,
                $kontrak->kos->nama_kos,
                $kontrak->kamar->nomor_kamar ?? null,
                0,
                $kontrak->tanggal_selesai->format('d F Y'),
                'today',
                false
            );
            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send today reminder email: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Notifikasi keterlambatan (sudah lewat)
     */
    public function sendNotifikasiTerlambat($kontrakId, $hariTerlambat)
    {
        $kontrak = KontrakSewa::with(['penghuni', 'kos'])->find($kontrakId);

        if (!$kontrak || $kontrak->status_kontrak !== 'aktif' || !$kontrak->tanggal_selesai) {
            return false;
        }

        // Send Email via EmailNotificationService
        try {
            $emailService = app(EmailNotificationService::class);
            $emailService->sendContractReminderEmail(
                $kontrak->penghuni->email,
                $kontrak->penghuni->nama,
                $kontrak->kos->nama_kos,
                $kontrak->kamar->nomor_kamar ?? null,
                $hariTerlambat,
                $kontrak->tanggal_selesai->format('d F Y'),
                'overdue',
                false
            );
            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send overdue email: " . $e->getMessage());
            return false;
        }
    }

    // ==================== PENGINGAT UNTUK PEMILIK ====================

    /**
     * Pengingat 7 hari untuk pemilik
     */
    public function sendPengingat7HariPemilik($kontrakId)
    {
        $kontrak = KontrakSewa::with(['penghuni', 'kos.pemilik'])->find($kontrakId);

        if (!$kontrak || $kontrak->status_kontrak !== 'aktif' || !$kontrak->tanggal_selesai || !$kontrak->kos->pemilik) {
            return false;
        }

        // Send Email via EmailNotificationService
        try {
            $emailService = app(EmailNotificationService::class);
            $emailService->sendContractReminderEmail(
                $kontrak->kos->pemilik->email,
                $kontrak->penghuni->nama,
                $kontrak->kos->nama_kos,
                $kontrak->kamar->nomor_kamar ?? null,
                (int) ceil(Carbon::now()->diffInDays($kontrak->tanggal_selesai)),
                $kontrak->tanggal_selesai->format('d F Y'),
                'before',
                true
            );
            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send 7-day reminder email to pemilik: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Pengingat 3 hari untuk pemilik
     */
    public function sendPengingat3HariPemilik($kontrakId)
    {
        $kontrak = KontrakSewa::with(['penghuni', 'kos.pemilik'])->find($kontrakId);

        if (!$kontrak || $kontrak->status_kontrak !== 'aktif' || !$kontrak->tanggal_selesai || !$kontrak->kos->pemilik) {
            return false;
        }

        // Send Email via EmailNotificationService
        try {
            $emailService = app(EmailNotificationService::class);
            $emailService->sendContractReminderEmail(
                $kontrak->kos->pemilik->email,
                $kontrak->penghuni->nama,
                $kontrak->kos->nama_kos,
                $kontrak->kamar->nomor_kamar ?? null,
                (int) ceil(Carbon::now()->diffInDays($kontrak->tanggal_selesai)),
                $kontrak->tanggal_selesai->format('d F Y'),
                'before',
                true
            );
            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send 3-day reminder email to pemilik: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Pengingat H-1 untuk pemilik
     */
    public function sendPengingatH1Pemilik($kontrakId)
    {
        $kontrak = KontrakSewa::with(['penghuni', 'kos.pemilik'])->find($kontrakId);

        if (!$kontrak || $kontrak->status_kontrak !== 'aktif' || !$kontrak->tanggal_selesai || !$kontrak->kos->pemilik) {
            return false;
        }

        // Send Email via EmailNotificationService
        try {
            $emailService = app(EmailNotificationService::class);
            $emailService->sendContractReminderEmail(
                $kontrak->kos->pemilik->email,
                $kontrak->penghuni->nama,
                $kontrak->kos->nama_kos,
                $kontrak->kamar->nomor_kamar ?? null,
                1,
                $kontrak->tanggal_selesai->format('d F Y'),
                'today',
                true
            );
            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send H-1 reminder email to pemilik: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Pengingat hari ini untuk pemilik
     */
    public function sendPengingatHariIniPemilik($kontrakId)
    {
        $kontrak = KontrakSewa::with(['penghuni', 'kos.pemilik'])->find($kontrakId);

        if (!$kontrak || $kontrak->status_kontrak !== 'aktif' || !$kontrak->tanggal_selesai || !$kontrak->kos->pemilik) {
            return false;
        }

        // Send Email via EmailNotificationService
        try {
            $emailService = app(EmailNotificationService::class);
            $emailService->sendContractReminderEmail(
                $kontrak->kos->pemilik->email,
                $kontrak->penghuni->nama,
                $kontrak->kos->nama_kos,
                $kontrak->kamar->nomor_kamar ?? null,
                0,
                $kontrak->tanggal_selesai->format('d F Y'),
                'today',
                true
            );
            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send today reminder email to pemilik: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Notifikasi keterlambatan untuk pemilik
     */
    public function sendNotifikasiTerlambatPemilik($kontrakId, $hariTerlambat)
    {
        $kontrak = KontrakSewa::with(['penghuni', 'kos.pemilik'])->find($kontrakId);

        if (!$kontrak || $kontrak->status_kontrak !== 'aktif' || !$kontrak->tanggal_selesai || !$kontrak->kos->pemilik) {
            return false;
        }

        // Send Email via EmailNotificationService
        try {
            $emailService = app(EmailNotificationService::class);
            $emailService->sendContractReminderEmail(
                $kontrak->kos->pemilik->email,
                $kontrak->penghuni->nama,
                $kontrak->kos->nama_kos,
                $kontrak->kamar->nomor_kamar ?? null,
                $hariTerlambat,
                $kontrak->tanggal_selesai->format('d F Y'),
                'overdue',
                true
            );
            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send overdue email to pemilik: " . $e->getMessage());
            return false;
        }
    }

    // ==================== NOTIFIKASI PERPANJANGAN ====================

    /**
     * Notifikasi permintaan perpanjangan dari penghuni
     */
    public function sendNotifikasiPermintaanPerpanjangan($kontrakId, $durasiTambahan)
    {
        $kontrak = KontrakSewa::with(['penghuni', 'kos.pemilik'])->find($kontrakId);

        if (!$kontrak || !$kontrak->kos->pemilik) {
            return false;
        }

        // Send Email
        try {
            Mail::to($kontrak->kos->pemilik->email)->send(new PengajuanBaruMail($kontrak));
            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send email for perpanjangan request: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Notifikasi perpanjangan disetujui untuk penghuni
     */
    public function sendNotifikasiPerpanjanganDisetujui($kontrakId, $tanggalBaruSelesai)
    {
        $kontrak = KontrakSewa::with(['penghuni', 'kos'])->find($kontrakId);

        if (!$kontrak) {
            return false;
        }

        // Send Email
        try {
            Mail::to($kontrak->penghuni->email)->send(new KontrakDiterimaMail($kontrak));
            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send email for perpanjangan disetujui: " . $e->getMessage());
            return false;
        }
    }

    // ==================== TRIGGER METHODS ====================

    /**
     * Auto trigger ketika kontrak dibuat
     */
    public function triggerKontrakCreated($kontrakId)
    {
        $this->sendMenungguPersetujuan($kontrakId);
        $this->sendPengajuanBaru($kontrakId);
    }

    /**
     * Auto trigger ketika kontrak disetujui
     */
    public function triggerKontrakApproved($kontrakId)
    {
        $this->sendPersetujuanDiterima($kontrakId);
        $this->sendPersetujuanDiberikan($kontrakId);
    }

    /**
     * Auto trigger ketika kontrak ditolak
     */
    public function triggerKontrakRejected($kontrakId)
    {
        $this->sendPersetujuanDitolak($kontrakId);
        $this->sendPersetujuanDitolakPemilik($kontrakId);
    }

    /**
     * Auto trigger semua pengingat berdasarkan sisa hari
     */
    public function triggerAllReminders($kontrakId)
    {
        $kontrak = KontrakSewa::find($kontrakId);

        if (!$kontrak || $kontrak->status_kontrak !== 'aktif' || !$kontrak->tanggal_selesai) {
            return;
        }

        $sisaHari = (int) Carbon::now()->diffInDays($kontrak->tanggal_selesai);

        if ($sisaHari == 7) {
            $this->sendPengingat7Hari($kontrakId);
            $this->sendPengingat7HariPemilik($kontrakId);
        } elseif ($sisaHari == 3) {
            $this->sendPengingat3Hari($kontrakId);
            $this->sendPengingat3HariPemilik($kontrakId);
        } elseif ($sisaHari == 1) {
            $this->sendPengingatH1($kontrakId);
            $this->sendPengingatH1Pemilik($kontrakId);
        } elseif ($sisaHari == 0) {
            $this->sendPengingatHariIni($kontrakId);
            $this->sendPengingatHariIniPemilik($kontrakId);
        } elseif ($sisaHari < 0) {
            $hariTerlambat = abs($sisaHari);
            $this->sendNotifikasiTerlambat($kontrakId, $hariTerlambat);
            $this->sendNotifikasiTerlambatPemilik($kontrakId, $hariTerlambat);
        }
    }

    // ==================== COMPATIBILITY METHODS (untuk existing code) ====================

    /**
     * Untuk kompatibilitas dengan kode lama (5 hari)
     */
    public function sendPengingat5Hari($kontrakId)
    {
        // Panggil pengingat 7 hari sebagai ganti 5 hari
        return $this->sendPengingat7Hari($kontrakId);
    }

    public function sendPengingat5HariPemilik($kontrakId)
    {
        // Panggil pengingat 7 hari pemilik sebagai ganti 5 hari
        return $this->sendPengingat7HariPemilik($kontrakId);
    }

    /**
     * Untuk kompatibilitas dengan kode lama (hari terakhir)
     */
    public function sendPengingatHariTerakhir($kontrakId)
    {
        // Panggil pengingat H-1 sebagai ganti hari terakhir
        return $this->sendPengingatH1($kontrakId);
    }

    public function sendPengingatHariTerakhirPemilik($kontrakId)
    {
        // Panggil pengingat H-1 pemilik sebagai ganti hari terakhir
        return $this->sendPengingatH1Pemilik($kontrakId);
    }
}
