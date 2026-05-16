<?php

namespace App\Services\Pembayaran;

use App\Models\Pembayaran;
use App\Models\KontrakSewa;
use App\Models\Kos;
use App\Services\Notification\PembayaranNotificationService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PembayaranService
{
    public function __construct(
        protected PembayaranNotificationService $notificationService
    ) {}

    public function getPemilikPembayaran(int $pemilikId)
    {
        $query = Pembayaran::with(['penghuni', 'kontrak.kos'])
            ->whereHas('kontrak.kos', fn($q) => $q->where('id_pemilik', $pemilikId));

        $stats = [
            'total' => (clone $query)->count(),
            'lunas' => (clone $query)->where('status_pembayaran', 'lunas')->count(),
            'pending' => (clone $query)->where('status_pembayaran', 'pending')->count(),
            'belum' => (clone $query)->where('status_pembayaran', 'belum')->count(),
            'terlambat' => (clone $query)->where('status_pembayaran', 'terlambat')->count(),
        ];

        $pembayaran = $query->orderBy('created_at', 'desc')->paginate(5);

        return compact('pembayaran', 'stats');
    }

    public function approvePembayaran(int $pemilikId, int $id): void
    {
        $pembayaran = Pembayaran::with(['kontrak.kos.pemilik', 'penghuni', 'kontrak.kamar', 'kontrak.kos'])
            ->whereHas('kontrak.kos', fn($q) => $q->where('id_pemilik', $pemilikId))
            ->where('status_pembayaran', 'pending')
            ->firstOrFail();

        $kontrak = $pembayaran->kontrak;

        DB::beginTransaction();
        try {
            $pembayaran->update([
                'status_pembayaran' => 'lunas',
                'tanggal_bayar' => now(),
            ]);

            if (!$kontrak->tanggal_mulai) {
                $diffDays = Carbon::parse($pembayaran->tanggal_mulai_sewa)
                    ->diffInDays(Carbon::parse($pembayaran->tanggal_akhir_sewa));

                $kontrak->update([
                    'tanggal_mulai' => now(),
                    'tanggal_selesai' => now()->addDays($diffDays),
                ]);

                $pembayaran->update([
                    'tanggal_mulai_sewa' => now(),
                    'tanggal_akhir_sewa' => now()->addDays($diffDays),
                    'bulan_tahun' => now()->format('Y-m'),
                ]);
            } else {
                $kontrak->update([
                    'tanggal_selesai' => $pembayaran->tanggal_akhir_sewa,
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('PembayaranService::approvePembayaran failed: ' . $e->getMessage());
            throw $e;
        }

        $this->sendApprovalNotifications($pembayaran, 'approved');
    }

    public function rejectPembayaran(int $pemilikId, int $id): void
    {
        $pembayaran = Pembayaran::with(['kontrak.kos.pemilik', 'penghuni', 'kontrak.kamar', 'kontrak.kos'])
            ->whereHas('kontrak.kos', fn($q) => $q->where('id_pemilik', $pemilikId))
            ->where('status_pembayaran', 'pending')
            ->firstOrFail();

        $pembayaran->update(['status_pembayaran' => 'belum']);

        $this->sendApprovalNotifications($pembayaran, 'rejected');
    }

    private function sendApprovalNotifications($pembayaran, string $action): void
    {
        try {
            $paymentData = [
                'kosName' => $pembayaran->kontrak->kos->nama_kos,
                'roomNumber' => $pembayaran->kontrak->kamar->nomor_kamar ?? '-',
                'amount' => $pembayaran->jumlah,
                'paymentDate' => $pembayaran->created_at?->format('d/m/Y') ?? now()->format('d/m/Y'),
                'period' => $this->formatPaymentPeriod($pembayaran),
                'penghuniName' => $pembayaran->penghuni->nama,
                'metodePembayaran' => $pembayaran->metode_pembayaran,
                'approvedDate' => now()->format('d/m/Y'),
            ];

            $typePenghuni = $action === 'approved' ? 'approved_penghuni' : 'rejected_penghuni';
            $typePemilik = $action === 'approved' ? 'approved_pemilik' : 'rejected_pemilik';

            $this->notificationService->sendDualPaymentNotification(
                $pembayaran->penghuni, $typePenghuni, $paymentData, false
            );
            $this->notificationService->sendDualPaymentNotification(
                $pembayaran->kontrak->kos->pemilik, $typePemilik, $paymentData, true
            );
        } catch (\Exception $e) {
            Log::error('Payment notification error: ' . $e->getMessage());
        }
    }

    private function formatPaymentPeriod($pembayaran): string
    {
        if ($pembayaran->tanggal_mulai_sewa && $pembayaran->tanggal_akhir_sewa) {
            return $pembayaran->tanggal_mulai_sewa->format('d/m/Y') . ' - ' . $pembayaran->tanggal_akhir_sewa->format('d/m/Y');
        }
        return $pembayaran->bulan_tahun ?? 'Periode tidak diketahui';
    }

    public function getPenghuniPembayaran(int $penghuniId)
    {
        $pembayaran = Pembayaran::with(['kontrak.kos'])
            ->where('id_penghuni', $penghuniId)
            ->orderBy('bulan_tahun', 'desc')
            ->paginate(10, ['*'], 'pembayaran_page')
            ->withQueryString();

        $kontrakAktif = KontrakSewa::with(['kos'])
            ->where('id_penghuni', $penghuniId)
            ->where('status_kontrak', 'aktif')
            ->paginate(5, ['*'], 'kontrak_page')
            ->withQueryString();

        return compact('pembayaran', 'kontrakAktif');
    }

    public function getPaymentOptions(KontrakSewa $kontrak): array
    {
        $tipeSewa = strtolower($kontrak->kos->tipe_sewa);
        $options = [];
        $unitLabel = '';
        $maxLimit = 0;

        switch ($tipeSewa) {
            case 'harian':
                $unitLabel = 'Hari';
                $maxLimit = 365;
                foreach ([1, 2, 3, 4, 5, 6, 7, 14, 30] as $i) {
                    $options[] = [
                        'value' => $i,
                        'label' => "$i Hari",
                        'total' => $kontrak->harga_sewa * $i,
                        'max_date' => $this->calculateMaxDate($kontrak, $i, 'harian'),
                    ];
                }
                break;
            case 'mingguan':
                $unitLabel = 'Minggu';
                $maxLimit = 52;
                for ($i = 1; $i <= 12; $i++) {
                    $options[] = [
                        'value' => $i,
                        'label' => "$i Minggu",
                        'total' => $kontrak->harga_sewa * $i,
                        'max_date' => $this->calculateMaxDate($kontrak, $i, 'mingguan'),
                    ];
                }
                break;
            case 'tahunan':
                $unitLabel = 'Tahun';
                $maxLimit = 5;
                for ($i = 1; $i <= 5; $i++) {
                    $options[] = [
                        'value' => $i,
                        'label' => "$i Tahun",
                        'total' => $kontrak->harga_sewa * $i,
                        'max_date' => $this->calculateMaxDate($kontrak, $i, 'tahunan'),
                    ];
                }
                break;
            default:
                $unitLabel = 'Bulan';
                $maxLimit = 12;
                for ($i = 1; $i <= 12; $i++) {
                    $options[] = [
                        'value' => $i,
                        'label' => "$i Bulan",
                        'total' => $kontrak->harga_sewa * $i,
                        'max_date' => $this->calculateMaxDate($kontrak, $i, 'bulanan'),
                    ];
                }
                break;
        }

        $isFirstPayment = !Pembayaran::where('id_kontrak', $kontrak->id_kontrak)
            ->whereIn('status_pembayaran', ['lunas', 'pending'])->exists();

        if ($isFirstPayment && $kontrak->tanggal_mulai && $kontrak->tanggal_selesai) {
            $options = [[
                'value' => $kontrak->durasi_sewa,
                'label' => $kontrak->durasi_sewa . ' ' . $unitLabel,
                'total' => $kontrak->harga_sewa * $kontrak->durasi_sewa,
                'max_date' => $kontrak->tanggal_selesai,
            ]];
            $maxLimit = $kontrak->durasi_sewa;
        }

        return compact('options', 'unitLabel', 'maxLimit', 'tipeSewa', 'isFirstPayment');
    }

    public function createPembayaran(int $penghuniId, array $data): Pembayaran
    {
        $kontrak = KontrakSewa::with(['kos.pemilik', 'kamar'])
            ->where('id_penghuni', $penghuniId)
            ->where('id_kontrak', $data['id_kontrak'])
            ->firstOrFail();

        $tipeSewa = strtolower($kontrak->kos->tipe_sewa);
        $jumlahWaktu = (int) $data['jumlah_waktu'];
        $tanggalMulai = $this->getTanggalMulaiOtomatis($kontrak);

        $tanggalAkhir = $tanggalMulai->copy();
        $tanggalAkhir = match ($tipeSewa) {
            'harian' => $tanggalAkhir->addDays($jumlahWaktu),
            'mingguan' => $tanggalAkhir->addWeeks($jumlahWaktu),
            'tahunan' => $tanggalAkhir->addYears($jumlahWaktu),
            default => $tanggalAkhir->addMonths($jumlahWaktu),
        };

        $jenisPembayaran = 'rutin';
        $keterangan = 'Pembayaran rutin';

        if ($kontrak->tanggal_selesai && $tanggalMulai->greaterThan(Carbon::parse($kontrak->tanggal_selesai))) {
            $jenisPembayaran = 'advance';
            $keterangan = 'Pembayaran di muka (perpanjangan otomatis)';
        }

        $buktiPembayaranPath = null;
        if (!empty($data['bukti_pembayaran'])) {
            $file = $data['bukti_pembayaran'];
            $fileName = time() . '_' . $penghuniId . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $buktiPembayaranPath = $file->storeAs('bukti_pembayaran', $fileName, 'public');
        }

        $pembayaran = Pembayaran::create([
            'id_kontrak' => $kontrak->id_kontrak,
            'id_penghuni' => $penghuniId,
            'bulan_tahun' => $tanggalMulai->format('Y-m'),
            'tanggal_mulai_sewa' => $tanggalMulai,
            'tanggal_akhir_sewa' => $tanggalAkhir,
            'tanggal_jatuh_tempo' => $tanggalMulai,
            'jumlah' => $kontrak->harga_sewa * $jumlahWaktu,
            'metode_pembayaran' => $data['metode_pembayaran'],
            'bukti_pembayaran' => $buktiPembayaranPath,
            'status_pembayaran' => 'pending',
            'jenis_pembayaran' => $jenisPembayaran,
            'keterangan' => $keterangan . " ({$jumlahWaktu} {$tipeSewa})",
        ]);

        try {
            $this->sendPaymentNotifications($pembayaran, $kontrak);
        } catch (\Exception $e) {
            Log::error('Payment notification error (ignoring): ' . $e->getMessage());
        }

        return $pembayaran;
    }

    private function getTanggalMulaiOtomatis($kontrak): Carbon
    {
        $lastPayment = Pembayaran::where('id_kontrak', $kontrak->id_kontrak)
            ->whereIn('status_pembayaran', ['lunas', 'pending'])
            ->orderBy('tanggal_akhir_sewa', 'desc')
            ->orderBy('bulan_tahun', 'desc')
            ->first();

        if ($lastPayment) {
            if ($lastPayment->tanggal_akhir_sewa) {
                return Carbon::parse($lastPayment->tanggal_akhir_sewa)->addDay();
            }
            return Carbon::createFromFormat('Y-m', $lastPayment->bulan_tahun)->endOfMonth()->addDay();
        }

        if ($kontrak->tanggal_mulai) {
            return Carbon::parse($kontrak->tanggal_mulai);
        }
        return Carbon::now();
    }

    private function calculateMaxDate($kontrak, int $jumlah, string $tipeSewa): Carbon
    {
        $startDate = $this->getTanggalMulaiOtomatis($kontrak);
        $endDate = $startDate->copy();

        return match ($tipeSewa) {
            'harian' => $endDate->addDays($jumlah),
            'mingguan' => $endDate->addWeeks($jumlah),
            'tahunan' => $endDate->addYears($jumlah),
            default => $endDate->addMonths($jumlah),
        };
    }

    private function sendPaymentNotifications($pembayaran, $kontrak): void
    {
        $pemilik = $kontrak->kos->pemilik;
        if (!$pemilik) return;

        $paymentData = [
            'kosName' => $kontrak->kos->nama_kos,
            'roomNumber' => $kontrak->kamar->nomor_kamar ?? null,
            'amount' => $pembayaran->jumlah,
            'paymentDate' => $pembayaran->created_at?->format('d/m/Y') ?? now()->format('d/m/Y'),
            'period' => $this->formatPaymentPeriod($pembayaran),
            'penghuniName' => $kontrak->penghuni->nama ?? '',
            'metodePembayaran' => $pembayaran->metode_pembayaran,
        ];

        $this->notificationService->sendDualPaymentNotification($kontrak->penghuni, 'pending_penghuni', $paymentData, false);
        $this->notificationService->sendDualPaymentNotification($pemilik, 'pending_pemilik', $paymentData, true);
    }

    public function getPenghuniPembayaranDetail(int $penghuniId, int $id): Pembayaran
    {
        return Pembayaran::with(['kontrak.kos'])
            ->where('id_penghuni', $penghuniId)
            ->findOrFail($id);
    }
}
