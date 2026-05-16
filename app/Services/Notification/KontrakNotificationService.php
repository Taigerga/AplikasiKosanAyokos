<?php

namespace App\Services\Notification;

use App\Mail\Penghuni\KontrakDiterimaMail;
use App\Mail\Penghuni\KontrakDitolakMail as PenghuniKontrakDitolakMail;
use App\Mail\Penghuni\MenungguPersetujuanMail;
use App\Mail\Penghuni\NotifikasiTenggatWaktuMail;
use App\Mail\Pemilik\KontrakDisetujuiMail;
use App\Mail\Pemilik\KontrakDitolakMail as PemilikKontrakDitolakMail;
use App\Mail\Pemilik\NotifikasiTenggatWaktuPemilikMail;
use App\Mail\Pemilik\PengajuanBaruMail;
use App\Models\KontrakSewa;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class KontrakNotificationService
{
    private function formatTanggalSafely($tanggal, $fallbackText = 'Belum ditentukan')
    {
        return $tanggal ? $tanggal->format('d F Y') : $fallbackText;
    }

    private function linkKontrak($idKontrak): string
    {
        return url('/penghuni/kontrak/' . $idKontrak);
    }

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

    // ==================== NOTIFIKASI AWAL PENGAJUAN ====================

    public function sendMenungguPersetujuan($kontrakId)
    {
        $kontrak = KontrakSewa::with(['penghuni', 'kos'])->find($kontrakId);
        if (!$kontrak) return false;

        try {
            Mail::to($kontrak->penghuni->email)->send(new MenungguPersetujuanMail($kontrak));
            $this->createInApp(
                $kontrak->penghuni->user_id, 'kontrak_dibuat',
                'Pengajuan kontrak berhasil dikirim',
                "Pengajuan kontrak untuk {$kontrak->kos->nama_kos} sedang menunggu persetujuan pemilik.",
                $this->linkKontrak($kontrakId)
            );
            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send email MenungguPersetujuan: " . $e->getMessage());
            return false;
        }
    }

    public function sendPersetujuanDiterima($kontrakId)
    {
        $kontrak = KontrakSewa::with(['penghuni', 'kos'])->find($kontrakId);
        if (!$kontrak || $kontrak->status_kontrak !== 'aktif') return false;

        try {
            Mail::to($kontrak->penghuni->email)->send(new KontrakDiterimaMail($kontrak));
            $this->createInApp(
                $kontrak->penghuni->user_id, 'kontrak_diterima',
                'Kontrak disetujui',
                "Kontrak untuk {$kontrak->kos->nama_kos} telah disetujui. Kamar siap ditempati.",
                $this->linkKontrak($kontrakId)
            );
            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send email KontrakDiterima: " . $e->getMessage());
            return false;
        }
    }

    public function sendPersetujuanDitolak($kontrakId)
    {
        $kontrak = KontrakSewa::with(['penghuni', 'kos'])->find($kontrakId);
        if (!$kontrak || $kontrak->status_kontrak !== 'ditolak') return false;

        try {
            Mail::to($kontrak->penghuni->email)->send(new PenghuniKontrakDitolakMail($kontrak));
            $this->createInApp(
                $kontrak->penghuni->user_id, 'kontrak_ditolak',
                'Kontrak ditolak',
                "Pengajuan kontrak untuk {$kontrak->kos->nama_kos} ditolak. Silakan cek alasan penolakan.",
                $this->linkKontrak($kontrakId)
            );
            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send email KontrakDitolak: " . $e->getMessage());
            return false;
        }
    }

    public function sendPengajuanBaru($kontrakId)
    {
        $kontrak = KontrakSewa::with(['penghuni', 'kos.pemilik'])->find($kontrakId);
        if (!$kontrak || !$kontrak->kos->pemilik) return false;

        try {
            Mail::to($kontrak->kos->pemilik->email)->send(new PengajuanBaruMail($kontrak));
            $this->createInApp(
                $kontrak->kos->pemilik->user_id, 'pengajuan_baru',
                'Pengajuan kontrak baru',
                "{$kontrak->penghuni->nama} mengajukan kontrak untuk {$kontrak->kos->nama_kos}.",
                url('/pemilik/kontrak')
            );
            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send email PengajuanBaru: " . $e->getMessage());
            return false;
        }
    }

    public function sendPersetujuanDiberikan($kontrakId)
    {
        $kontrak = KontrakSewa::with(['penghuni', 'kos.pemilik'])->find($kontrakId);
        if (!$kontrak || !$kontrak->kos->pemilik) return false;

        try {
            Mail::to($kontrak->kos->pemilik->email)->send(new KontrakDisetujuiMail($kontrak));
            $this->createInApp(
                $kontrak->kos->pemilik->user_id, 'kontrak_disetujui_pemilik',
                'Kontrak telah disetujui',
                "Anda telah menyetujui kontrak dari {$kontrak->penghuni->nama} untuk {$kontrak->kos->nama_kos}.",
                url('/pemilik/kontrak')
            );
            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send email KontrakDisetujui: " . $e->getMessage());
            return false;
        }
    }

    public function sendPersetujuanDitolakPemilik($kontrakId)
    {
        $kontrak = KontrakSewa::with(['penghuni', 'kos.pemilik'])->find($kontrakId);
        if (!$kontrak || !$kontrak->kos->pemilik) return false;

        try {
            Mail::to($kontrak->kos->pemilik->email)->send(new PemilikKontrakDitolakMail($kontrak));
            $this->createInApp(
                $kontrak->kos->pemilik->user_id, 'kontrak_ditolak_pemilik',
                'Kontrak telah ditolak',
                "Anda telah menolak kontrak dari {$kontrak->penghuni->nama} untuk {$kontrak->kos->nama_kos}.",
                url('/pemilik/kontrak')
            );
            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send email KontrakDitolakPemilik: " . $e->getMessage());
            return false;
        }
    }

    public function sendNotifikasiPermintaanPerpanjangan($kontrakId, $durasiTambahan)
    {
        $kontrak = KontrakSewa::with(['penghuni', 'kos.pemilik'])->find($kontrakId);
        if (!$kontrak || !$kontrak->kos->pemilik) return false;

        try {
            Mail::to($kontrak->kos->pemilik->email)->send(new PengajuanBaruMail($kontrak));
            $this->createInApp(
                $kontrak->kos->pemilik->user_id, 'perpanjangan_diminta',
                'Permintaan perpanjangan kontrak',
                "{$kontrak->penghuni->nama} meminta perpanjangan kontrak untuk {$kontrak->kos->nama_kos}.",
                url('/pemilik/kontrak')
            );
            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send email for perpanjangan request: " . $e->getMessage());
            return false;
        }
    }

    public function sendNotifikasiPerpanjanganDisetujui($kontrakId, $tanggalBaruSelesai)
    {
        $kontrak = KontrakSewa::with(['penghuni', 'kos'])->find($kontrakId);
        if (!$kontrak) return false;

        try {
            Mail::to($kontrak->penghuni->email)->send(new KontrakDiterimaMail($kontrak));
            $this->createInApp(
                $kontrak->penghuni->user_id, 'perpanjangan_disetujui',
                'Perpanjangan kontrak disetujui',
                "Perpanjangan kontrak untuk {$kontrak->kos->nama_kos} telah disetujui hingga {$tanggalBaruSelesai}.",
                $this->linkKontrak($kontrakId)
            );
            return true;
        } catch (\Exception $e) {
            Log::error("Failed to send email for perpanjangan disetujui: " . $e->getMessage());
            return false;
        }
    }

    public function sendTenggatWaktuToPenghuni(KontrakSewa $kontrak, $tipeNotifikasi)
    {
        try {
            $hariSisa = Carbon::parse($kontrak->tanggal_selesai)->diffInDays(now());
            Mail::to($kontrak->penghuni->email)
                ->send(new NotifikasiTenggatWaktuMail($kontrak, $hariSisa, $tipeNotifikasi));
            Log::info("Email {$tipeNotifikasi} dikirim ke penghuni: " . $kontrak->penghuni->email);
            $this->createInApp(
                $kontrak->penghuni->user_id, 'tenggat_' . $tipeNotifikasi,
                'Pengingat tenggat kontrak',
                "Kontrak {$kontrak->kos->nama_kos} akan berakhir dalam {$hariSisa} hari.",
                $this->linkKontrak($kontrak->id_kontrak)
            );
            return true;
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email ke penghuni: ' . $e->getMessage());
            return false;
        }
    }

    public function sendTenggatWaktuToPemilik(KontrakSewa $kontrak, $tipeNotifikasi)
    {
        try {
            $hariSisa = Carbon::parse($kontrak->tanggal_selesai)->diffInDays(now());
            Mail::to($kontrak->kos->pemilik->email)
                ->send(new NotifikasiTenggatWaktuPemilikMail($kontrak, $hariSisa, $tipeNotifikasi));
            Log::info("Email {$tipeNotifikasi} dikirim ke pemilik: " . $kontrak->kos->pemilik->email);
            $this->createInApp(
                $kontrak->kos->pemilik->user_id, 'tenggat_' . $tipeNotifikasi,
                'Pengingat tenggat kontrak penghuni',
                "Kontrak {$kontrak->penghuni->nama} di {$kontrak->kos->nama_kos} akan berakhir dalam {$hariSisa} hari.",
                url('/pemilik/kontrak')
            );
            return true;
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email ke pemilik: ' . $e->getMessage());
            return false;
        }
    }

    public function sendKontrakDiterima(KontrakSewa $kontrak)
    {
        try {
            Mail::to($kontrak->penghuni->email)->send(new KontrakDiterimaMail($kontrak));
            Log::info("Email kontrak diterima dikirim ke: " . $kontrak->penghuni->email);
            $this->createInApp(
                $kontrak->penghuni->user_id, 'kontrak_diterima',
                'Kontrak disetujui',
                "Kontrak untuk {$kontrak->kos->nama_kos} telah disetujui.",
                $this->linkKontrak($kontrak->id_kontrak)
            );
            return true;
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email kontrak diterima: ' . $e->getMessage());
            return false;
        }
    }

    public function sendKontrakDitolak(KontrakSewa $kontrak)
    {
        try {
            Mail::to($kontrak->penghuni->email)->send(new PenghuniKontrakDitolakMail($kontrak));
            Log::info("Email kontrak ditolak dikirim ke: " . $kontrak->penghuni->email);
            $this->createInApp(
                $kontrak->penghuni->user_id, 'kontrak_ditolak',
                'Kontrak ditolak',
                "Pengajuan kontrak untuk {$kontrak->kos->nama_kos} ditolak.",
                $this->linkKontrak($kontrak->id_kontrak)
            );
            return true;
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email kontrak ditolak: ' . $e->getMessage());
            return false;
        }
    }

    public function sendPengajuanBaruToPemilik(KontrakSewa $kontrak)
    {
        try {
            Mail::to($kontrak->kos->pemilik->email)->send(new PengajuanBaruMail($kontrak));
            Log::info("Email pengajuan baru dikirim ke pemilik: " . $kontrak->kos->pemilik->email);
            $this->createInApp(
                $kontrak->kos->pemilik->user_id, 'pengajuan_baru',
                'Pengajuan kontrak baru',
                "{$kontrak->penghuni->nama} mengajukan kontrak untuk {$kontrak->kos->nama_kos}.",
                url('/pemilik/kontrak')
            );
            return true;
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email pengajuan baru: ' . $e->getMessage());
            return false;
        }
    }

    public function triggerKontrakCreated($kontrakId)
    {
        $this->sendMenungguPersetujuan($kontrakId);
        $this->sendPengajuanBaru($kontrakId);
    }

    public function triggerKontrakApproved($kontrakId)
    {
        $this->sendPersetujuanDiterima($kontrakId);
        $this->sendPersetujuanDiberikan($kontrakId);
    }

    public function triggerKontrakRejected($kontrakId)
    {
        $this->sendPersetujuanDitolak($kontrakId);
        $this->sendPersetujuanDitolakPemilik($kontrakId);
    }

    public function triggerAllReminders($kontrakId)
    {
        $kontrak = KontrakSewa::find($kontrakId);
        if (!$kontrak || $kontrak->status_kontrak !== 'aktif' || !$kontrak->tanggal_selesai) return;

        $sisaHari = (int) Carbon::now()->diffInDays($kontrak->tanggal_selesai);

        if ($sisaHari == 7) {
            $this->sendTenggatWaktuToPenghuni($kontrak, '7_hari');
            $this->sendTenggatWaktuToPemilik($kontrak, '7_hari');
        } elseif ($sisaHari == 3) {
            $this->sendTenggatWaktuToPenghuni($kontrak, '3_hari');
            $this->sendTenggatWaktuToPemilik($kontrak, '3_hari');
        } elseif ($sisaHari == 1) {
            $this->sendTenggatWaktuToPenghuni($kontrak, '1_hari');
            $this->sendTenggatWaktuToPemilik($kontrak, '1_hari');
        } elseif ($sisaHari == 0) {
            $this->sendTenggatWaktuToPenghuni($kontrak, 'tenggat');
            $this->sendTenggatWaktuToPemilik($kontrak, 'tenggat');
        } elseif ($sisaHari < 0) {
            $hariTerlambat = abs($sisaHari);
            if ($hariTerlambat == 1) {
                $this->sendTenggatWaktuToPenghuni($kontrak, 'terlambat');
                $this->sendTenggatWaktuToPemilik($kontrak, 'terlambat');
            }
        }
    }

    public function checkAndSendTenggatWaktuNotifications()
    {
        $kontraks = KontrakSewa::where('status_kontrak', 'aktif')
            ->whereNotNull('tanggal_selesai')
            ->get();

        foreach ($kontraks as $kontrak) {
            $this->triggerAllReminders($kontrak->id_kontrak);
        }
    }
}
