<?php

namespace App\Services;

use App\Mail\Penghuni\KontrakDiterimaMail;
use App\Mail\Penghuni\KontrakDitolakMail;
use App\Mail\Penghuni\NotifikasiTenggatWaktuMail;
use App\Mail\Pemilik\PengajuanBaruMail;
use App\Mail\Pemilik\NotifikasiTenggatWaktuPemilikMail; // PASTIKAN FILE INI ADA
use App\Models\KontrakSewa;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class NotificationEmailService
{
    /**
     * Kirim email notifikasi kontrak diterima ke penghuni
     */
    public function sendKontrakDiterima(KontrakSewa $kontrak)
    {
        try {
            Mail::to($kontrak->penghuni->email)
                ->send(new KontrakDiterimaMail($kontrak));
             
            return true;
        } catch (\Exception $e) {
            \Log::error('Gagal mengirim email kontrak diterima: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Kirim email notifikasi kontrak ditolak ke penghuni
     */
    public function sendKontrakDitolak(KontrakSewa $kontrak)
    {
        try {
            Mail::to($kontrak->penghuni->email)
                ->send(new KontrakDitolakMail($kontrak));
             
            return true;
        } catch (\Exception $e) {
            \Log::error('Gagal mengirim email kontrak ditolak: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Kirim email notifikasi pengajuan baru ke pemilik
     */
    public function sendPengajuanBaruToPemilik(KontrakSewa $kontrak)
    {
        try {
            Mail::to($kontrak->kos->pemilik->email)
                ->send(new PengajuanBaruMail($kontrak));
             
            return true;
        } catch (\Exception $e) {
            \Log::error('Gagal mengirim email pengajuan baru: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Kirim email notifikasi tenggat waktu ke PENGHUNI (dengan tracking)
     */
    public function sendTenggatWaktuToPenghuni(KontrakSewa $kontrak, $tipeNotifikasi)
    {
        try {
            $hariSisa = Carbon::parse($kontrak->tanggal_selesai)->diffInDays(now());
             
            Mail::to($kontrak->penghuni->email)
                ->send(new NotifikasiTenggatWaktuMail($kontrak, $hariSisa, $tipeNotifikasi));
             
            return true;
        } catch (\Exception $e) {
            \Log::error('Gagal mengirim email tenggat waktu ke penghuni: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Kirim email notifikasi tenggat waktu ke PEMILIK (TANPA tracking)
     */
    public function sendTenggatWaktuToPemilik(KontrakSewa $kontrak, $tipeNotifikasi)
    {
        try {
            $hariSisa = Carbon::parse($kontrak->tanggal_selesai)->diffInDays(now());
            
            Mail::to($kontrak->kos->pemilik->email)
                ->send(new NotifikasiTenggatWaktuPemilikMail($kontrak, $hariSisa, $tipeNotifikasi));
            
            // TIDAK ADA TRACKING untuk pemilik - jadi selalu dikirim
            \Log::info("Notifikasi {$tipeNotifikasi} dikirim ke pemilik: " . $kontrak->kos->pemilik->email);
            
            return true;
        } catch (\Exception $e) {
            \Log::error('Gagal mengirim email tenggat waktu ke pemilik: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Cek dan kirim semua notifikasi tenggat waktu
     * KE PENGHUNI DAN PEMILIK
     */
    public function checkAndSendTenggatWaktuNotifications()
    {
        $kontraks = KontrakSewa::where('status_kontrak', 'aktif')
            ->whereNotNull('tanggal_selesai')
            ->get();

        foreach ($kontraks as $kontrak) {
            $this->checkSingleKontrak($kontrak);
        }
    }

    /**
     * Cek notifikasi untuk satu kontrak
     */
    private function checkSingleKontrak(KontrakSewa $kontrak)
    {
        $tanggalSelesai = Carbon::parse($kontrak->tanggal_selesai);
        $hariSisa = $tanggalSelesai->diffInDays(now());
         
        // 7 hari sebelum berakhir
        if ($hariSisa == 7) {
            $this->sendTenggatWaktuToPemilik($kontrak, '7_hari');
            $this->sendTenggatWaktuToPenghuni($kontrak, '7_hari');
        }
         
        // 3 hari sebelum berakhir
        if ($hariSisa == 3) {
            $this->sendTenggatWaktuToPemilik($kontrak, '3_hari');
            $this->sendTenggatWaktuToPenghuni($kontrak, '3_hari');
        }
         
        // 1 hari sebelum berakhir
        if ($hariSisa == 1) {
            $this->sendTenggatWaktuToPemilik($kontrak, '1_hari');
            $this->sendTenggatWaktuToPenghuni($kontrak, '1_hari');
        }
         
        // Hari berakhir
        if ($hariSisa == 0) {
            $this->sendTenggatWaktuToPemilik($kontrak, 'tenggat');
            $this->sendTenggatWaktuToPenghuni($kontrak, 'tenggat');
        }
         
        // Sudah melewati tenggat waktu (1 hari setelah berakhir)
        if ($hariSisa < 0 && abs($hariSisa) == 1) {
            $this->sendTenggatWaktuToPemilik($kontrak, 'terlambat');
            $this->sendTenggatWaktuToPenghuni($kontrak, 'terlambat');
        }
    }
}