<?php

namespace App\Services\Kontrak;

use App\Models\KontrakSewa;
use App\Models\Pembayaran;
use App\Models\Kamar;
use App\Models\Kos;
use App\Services\Notification\KontrakNotificationService;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KontrakService
{
    public function __construct(
        protected KontrakNotificationService $notificationService
    ) {}

    public function getPemilikKontrak(int $pemilikId): array
    {
        $kosIds = Kos::where('id_pemilik', $pemilikId)->pluck('id_kos');

        $pendingCount = KontrakSewa::whereIn('id_kos', $kosIds)->where('status_kontrak', 'pending')->count();
        $aktifCount = KontrakSewa::whereIn('id_kos', $kosIds)->where('status_kontrak', 'aktif')->count();
        $selesaiCount = KontrakSewa::whereIn('id_kos', $kosIds)->where('status_kontrak', 'selesai')->count();
        $ditolakCount = KontrakSewa::whereIn('id_kos', $kosIds)->where('status_kontrak', 'ditolak')->count();

        $pending = KontrakSewa::with(['penghuni', 'kos', 'kamar'])
            ->whereIn('id_kos', $kosIds)->where('status_kontrak', 'pending')
            ->orderBy('created_at', 'desc')->paginate(10, ['*'], 'pending_page');

        $aktif = KontrakSewa::with(['penghuni', 'kos', 'kamar'])
            ->whereIn('id_kos', $kosIds)->where('status_kontrak', 'aktif')
            ->orderBy('tanggal_selesai', 'asc')->paginate(10, ['*'], 'aktif_page');

        $selesai = KontrakSewa::with(['penghuni', 'kos', 'kamar'])
            ->whereIn('id_kos', $kosIds)->where('status_kontrak', 'selesai')
            ->orderBy('updated_at', 'desc')->paginate(10, ['*'], 'selesai_page');

        $ditolak = KontrakSewa::with(['penghuni', 'kos', 'kamar'])
            ->whereIn('id_kos', $kosIds)->where('status_kontrak', 'ditolak')
            ->orderBy('updated_at', 'desc')->paginate(10, ['*'], 'ditolak_page');

        return compact('pending', 'aktif', 'selesai', 'ditolak', 'pendingCount', 'aktifCount', 'selesaiCount', 'ditolakCount');
    }

    public function approveKontrak(int $pemilikId, int $idKontrak): void
    {
        $kontrak = KontrakSewa::with(['penghuni', 'kamar', 'kos'])->findOrFail($idKontrak);

        if ($kontrak->kos->id_pemilik !== $pemilikId) {
            abort(403, 'Anda tidak memiliki akses ke kontrak ini.');
        }

        if ($kontrak->status_kontrak !== 'pending') {
            throw new \Exception('Kontrak sudah diproses sebelumnya.');
        }

        if ($kontrak->kamar->status_kamar !== 'tersedia') {
            throw new \Exception('Kamar sudah tidak tersedia karena telah diisi penghuni lain.');
        }

        DB::beginTransaction();
        try {
            $kontrak->update(['status_kontrak' => 'aktif']);
            $kontrak->penghuni->update(['status_penghuni' => 'aktif']);
            $kontrak->kamar->update(['status_kamar' => 'terisi']);

            $pendingLain = KontrakSewa::with('penghuni')
                ->where('id_kamar', $kontrak->id_kamar)
                ->where('status_kontrak', 'pending')
                ->where('id_kontrak', '!=', $idKontrak)
                ->get();

            foreach ($pendingLain as $other) {
                $other->update([
                    'status_kontrak' => 'ditolak',
                    'alasan_ditolak' => 'Kamar sudah terisi oleh penghuni lain.',
                ]);

                $this->notificationService->sendPersetujuanDitolak($other->id_kontrak);
                $this->notificationService->sendKontrakDitolak($other);
            }

            $this->notificationService->sendPersetujuanDiterima($idKontrak);
            $this->notificationService->sendPersetujuanDiberikan($idKontrak);
            $this->notificationService->sendKontrakDiterima($kontrak);
            $this->notificationService->sendTenggatWaktuToPemilik($kontrak, 'aktif_baru');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function rejectKontrak(int $pemilikId, int $idKontrak, string $alasan): void
    {
        $kontrak = KontrakSewa::with(['penghuni', 'kos', 'kamar'])->findOrFail($idKontrak);

        if ($kontrak->kos->id_pemilik !== $pemilikId) {
            abort(403, 'Anda tidak memiliki akses ke kontrak ini.');
        }

        DB::beginTransaction();
        try {
            $kontrak->update(['status_kontrak' => 'ditolak', 'alasan_ditolak' => $alasan]);

            Pembayaran::where('id_kontrak', $idKontrak)
                ->where('status_pembayaran', 'pending')
                ->where(function ($q) {
                    $q->where('keterangan', 'like', '%Deposit%')
                        ->orWhere('keterangan', 'like', '%Uang Muka%');
                })
                ->delete();

            $kontrak->kamar->update(['status_kamar' => 'tersedia']);

            $this->notificationService->sendPersetujuanDitolak($idKontrak);
            $this->notificationService->sendPersetujuanDitolakPemilik($idKontrak);
            $this->notificationService->sendKontrakDitolak($kontrak);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function selesaiKontrak(int $pemilikId, int $idKontrak): void
    {
        $kontrak = KontrakSewa::with(['penghuni', 'kamar', 'kos'])->findOrFail($idKontrak);

        if ($kontrak->kos->id_pemilik !== $pemilikId) {
            abort(403);
        }

        DB::beginTransaction();
        try {
            $kontrak->update(['status_kontrak' => 'selesai']);

            $hasOtherActive = KontrakSewa::where('id_penghuni', $kontrak->id_penghuni)
                ->where('status_kontrak', 'aktif')
                ->where('id_kontrak', '!=', $idKontrak)
                ->exists();

            if (!$hasOtherActive) {
                $kontrak->penghuni->update(['status_penghuni' => 'nonaktif']);
            }

            $kontrak->kamar->update(['status_kamar' => 'tersedia']);

            $this->notificationService->sendTenggatWaktuToPenghuni($kontrak, 'selesai');
            $this->notificationService->sendTenggatWaktuToPemilik($kontrak, 'selesai');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getPenghuniKontrak(int $penghuniId)
    {
        return KontrakSewa::with(['kos', 'kamar'])
            ->where('id_penghuni', $penghuniId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function getPenghuniKontrakDetail(int $penghuniId, int $id): KontrakSewa
    {
        return KontrakSewa::with(['kos', 'kamar'])
            ->where('id_kontrak', $id)
            ->where('id_penghuni', $penghuniId)
            ->firstOrFail();
    }

    public function createKontrak(int $penghuniId, array $data): KontrakSewa
    {
        $kamar = Kamar::with('kos')->findOrFail($data['id_kamar']);
        $tipeSewa = $kamar->kos->tipe_sewa;
        $tanggalMulai = Carbon::parse($data['tanggal_mulai']);
        $durasi = (int) $data['durasi_sewa'];

        $tanggalSelesai = match ($tipeSewa) {
            'harian' => $tanggalMulai->copy()->addDays($durasi),
            'mingguan' => $tanggalMulai->copy()->addWeeks($durasi),
            'tahunan' => $tanggalMulai->copy()->addYears($durasi),
            default => $tanggalMulai->copy()->addMonths($durasi),
        };

        $fotoKtpPath = null;
        if (!empty($data['foto_ktp'])) {
            $fotoKtpPath = $data['foto_ktp']->store('ktp', 'public');
        }

        $kontrak = KontrakSewa::create([
            'id_penghuni' => $penghuniId,
            'id_kos' => $data['id_kos'],
            'id_kamar' => $data['id_kamar'],
            'foto_ktp' => $fotoKtpPath,
            'tanggal_daftar' => now(),
            'tanggal_mulai' => $tanggalMulai,
            'tanggal_selesai' => $tanggalSelesai,
            'durasi_sewa' => $durasi,
            'harga_sewa' => $kamar->harga,
            'status_kontrak' => 'pending',
        ]);

        $this->notificationService->sendPengajuanBaru($kontrak->id_kontrak);
        $this->notificationService->sendMenungguPersetujuan($kontrak->id_kontrak);

        return $kontrak;
    }

    public function extendKontrak(int $penghuniId, int $id, int $durasiTambahan): KontrakSewa
    {
        $kontrak = KontrakSewa::with('kos')
            ->where('id_kontrak', $id)
            ->where('id_penghuni', $penghuniId)
            ->firstOrFail();

        $tipeSewa = $kontrak->kos->tipe_sewa;
        $tanggalSelesaiBaru = Carbon::parse($kontrak->tanggal_selesai);

        $tanggalSelesaiBaru = match ($tipeSewa) {
            'harian' => $tanggalSelesaiBaru->addDays($durasiTambahan),
            'mingguan' => $tanggalSelesaiBaru->addWeeks($durasiTambahan),
            'tahunan' => $tanggalSelesaiBaru->addYears($durasiTambahan),
            default => $tanggalSelesaiBaru->addMonths($durasiTambahan),
        };

        $kontrak->update([
            'tanggal_selesai' => $tanggalSelesaiBaru,
            'durasi_sewa' => $kontrak->durasi_sewa + $durasiTambahan,
        ]);

        $this->notificationService->sendTenggatWaktuToPemilik($kontrak, 'perpanjangan');
        $this->notificationService->sendTenggatWaktuToPenghuni($kontrak, 'perpanjangan');

        return $kontrak;
    }

    public function getNotifikasiTenggat(int $penghuniId)
    {
        $kontrakAktif = KontrakSewa::with(['kos', 'kamar'])
            ->where('id_penghuni', $penghuniId)
            ->where('status_kontrak', 'aktif')
            ->orderBy('tanggal_selesai', 'asc')
            ->limit(10)
            ->get();

        foreach ($kontrakAktif as $k) {
            $k->hari_tersisa = now()->diffInDays($k->tanggal_selesai, false);
        }

        return $kontrakAktif;
    }

    public function getPenghuniKontrakAktif(int $penghuniId)
    {
        return KontrakSewa::with(['kos', 'kamar'])
            ->where('id_penghuni', $penghuniId)
            ->where('status_kontrak', 'aktif')
            ->get();
    }

    public function destroyKontrak(int $pemilikId, int $id): void
    {
        $kontrak = KontrakSewa::findOrFail($id);

        $isOwner = Kos::where('id_pemilik', $pemilikId)
            ->where('id_kos', $kontrak->id_kos)->exists();

        if (!$isOwner) {
            abort(403);
        }

        if (!in_array($kontrak->status_kontrak, ['selesai', 'ditolak'])) {
            throw new \Exception('Hanya kontrak dengan status selesai/ditolak yang bisa dihapus.');
        }

        $kontrak->delete();
    }
}
