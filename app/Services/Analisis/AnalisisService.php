<?php

namespace App\Services\Analisis;

use App\Models\Kos;
use App\Models\Kamar;
use App\Models\KontrakSewa;
use App\Models\Pembayaran;
use App\Models\Penghuni;
use App\Models\Review;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalisisService
{
    public static function clearAnalisisCache(string $type, int $id): void
    {
        $keys = [
            "analisis_pemilik_{$id}",
            "dashboard_pemilik_{$id}",
            "pendapatan_tahunan_{$id}_" . now()->year,
        ];

        if ($type === 'penghuni') {
            $keys[] = "analisis_penghuni_{$id}";
            $keys[] = "spending_penghuni_{$id}";
            $keys[] = "dashboard_penghuni_{$id}";
        }

        foreach ($keys as $key) {
            Cache::forget($key);
        }
    }

    public function getPemilikAnalisis(int $pemilikId): array
    {
        return Cache::remember('analisis_pemilik_' . $pemilikId, 300, function () use ($pemilikId) {
        $pendapatanPerBulan = Pembayaran::selectRaw('DATE_FORMAT(tanggal_bayar, "%Y-%m") as bulan, SUM(COALESCE(bagian_pemilik, jumlah * 0.9)) as total')
            ->join('kontrak_sewa', 'pembayaran.id_kontrak', '=', 'kontrak_sewa.id_kontrak')
            ->join('kos', 'kontrak_sewa.id_kos', '=', 'kos.id_kos')
            ->where('kos.id_pemilik', $pemilikId)
            ->where('pembayaran.status_pembayaran', 'lunas')
            ->where('pembayaran.tanggal_bayar', '>=', now()->subMonths(11)->startOfMonth())
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $statusKamar = Kamar::selectRaw('status_kamar, COUNT(*) as jumlah')
            ->join('kos', 'kamar.id_kos', '=', 'kos.id_kos')
            ->where('kos.id_pemilik', $pemilikId)
            ->groupBy('status_kamar')
            ->get();

        $jenisKos = Kos::selectRaw('jenis_kos, COUNT(*) as jumlah')
            ->where('id_pemilik', $pemilikId)
            ->groupBy('jenis_kos')
            ->get();

        $statusKontrak = KontrakSewa::selectRaw('status_kontrak, COUNT(*) as jumlah')
            ->join('kos', 'kontrak_sewa.id_kos', '=', 'kos.id_kos')
            ->where('kos.id_pemilik', $pemilikId)
            ->groupBy('status_kontrak')
            ->get();

        $penghuniAktifPerKos = Kos::selectRaw('kos.nama_kos, COUNT(kontrak_sewa.id_penghuni) as jumlah_penghuni')
            ->leftJoin('kontrak_sewa', fn($j) => $j->on('kos.id_kos', '=', 'kontrak_sewa.id_kos')->where('kontrak_sewa.status_kontrak', 'aktif'))
            ->where('kos.id_pemilik', $pemilikId)
            ->groupBy('kos.id_kos', 'kos.nama_kos')
            ->paginate(10);

        $penghuniAktifPerKosFull = Kos::selectRaw('kos.nama_kos, COUNT(kontrak_sewa.id_penghuni) as jumlah_penghuni')
            ->leftJoin('kontrak_sewa', fn($j) => $j->on('kos.id_kos', '=', 'kontrak_sewa.id_kos')->where('kontrak_sewa.status_kontrak', 'aktif'))
            ->where('kos.id_pemilik', $pemilikId)
            ->groupBy('kos.id_kos', 'kos.nama_kos')
            ->get();

        $tipeKamar = Kamar::selectRaw('tipe_kamar, COUNT(*) as jumlah')
            ->join('kos', 'kamar.id_kos', '=', 'kos.id_kos')
            ->where('kos.id_pemilik', $pemilikId)
            ->groupBy('tipe_kamar')
            ->get();

        $ratingDistribution = DB::table('reviews')
            ->selectRaw('rating, COUNT(*) as jumlah')
            ->join('kos', 'reviews.id_kos', '=', 'kos.id_kos')
            ->where('kos.id_pemilik', $pemilikId)
            ->groupBy('rating')
            ->orderBy('rating', 'desc')
            ->get();

        $pendapatanPerKos = Kos::selectRaw('kos.nama_kos, COALESCE(SUM(COALESCE(pembayaran.bagian_pemilik, pembayaran.jumlah * 0.9)), 0) as total_pendapatan')
            ->leftJoin('kontrak_sewa', 'kos.id_kos', '=', 'kontrak_sewa.id_kos')
            ->leftJoin('pembayaran', fn($j) => $j->on('kontrak_sewa.id_kontrak', '=', 'pembayaran.id_kontrak')
                ->where('pembayaran.status_pembayaran', 'lunas')
                ->whereYear('pembayaran.tanggal_bayar', now()->year))
            ->where('kos.id_pemilik', $pemilikId)
            ->groupBy('kos.id_kos', 'kos.nama_kos')
            ->orderBy('total_pendapatan', 'desc')
            ->paginate(10);

        $pendapatanPerKosFull = Kos::selectRaw('kos.nama_kos, COALESCE(SUM(COALESCE(pembayaran.bagian_pemilik, pembayaran.jumlah * 0.9)), 0) as total_pendapatan')
            ->leftJoin('kontrak_sewa', 'kos.id_kos', '=', 'kontrak_sewa.id_kos')
            ->leftJoin('pembayaran', fn($j) => $j->on('kontrak_sewa.id_kontrak', '=', 'pembayaran.id_kontrak')
                ->where('pembayaran.status_pembayaran', 'lunas')
                ->whereYear('pembayaran.tanggal_bayar', now()->year))
            ->where('kos.id_pemilik', $pemilikId)
            ->groupBy('kos.id_kos', 'kos.nama_kos')
            ->orderBy('total_pendapatan', 'desc')
            ->get();

        return compact(
            'pendapatanPerBulan', 'statusKamar', 'jenisKos', 'statusKontrak',
            'penghuniAktifPerKos', 'penghuniAktifPerKosFull', 'tipeKamar',
            'ratingDistribution', 'pendapatanPerKos', 'pendapatanPerKosFull'
        );
        });
    }

    public function getPenghuniAnalisis(int $penghuniId): array
    {
        return Cache::remember('analisis_penghuni_' . $penghuniId, 300, function () use ($penghuniId) {
        $riwayatKontrak = KontrakSewa::with(['kos', 'kamar'])
            ->where('id_penghuni', $penghuniId)
            ->orderBy('created_at', 'desc')
            ->get();

        $pembayaranPerBulan = Pembayaran::selectRaw('DATE_FORMAT(tanggal_bayar, "%Y-%m") as bulan, SUM(jumlah) as total, COUNT(*) as jumlah_transaksi')
            ->join('kontrak_sewa', 'pembayaran.id_kontrak', '=', 'kontrak_sewa.id_kontrak')
            ->where('kontrak_sewa.id_penghuni', $penghuniId)
            ->where('pembayaran.status_pembayaran', 'lunas')
            ->where('pembayaran.tanggal_bayar', '>=', now()->subMonths(5)->startOfMonth())
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $statusPembayaran = Pembayaran::selectRaw('status_pembayaran, COUNT(*) as jumlah, SUM(jumlah) as total_nominal')
            ->join('kontrak_sewa', 'pembayaran.id_kontrak', '=', 'kontrak_sewa.id_kontrak')
            ->where('kontrak_sewa.id_penghuni', $penghuniId)
            ->groupBy('status_pembayaran')
            ->get();

        $durasiTinggal = KontrakSewa::selectRaw("
            CASE
                WHEN durasi_sewa <= 3 THEN 'Jangka Pendek (1-3 bulan)'
                WHEN durasi_sewa <= 6 THEN 'Jangka Menengah (4-6 bulan)'
                WHEN durasi_sewa <= 12 THEN 'Jangka Panjang (7-12 bulan)'
                ELSE 'Lebih dari 1 tahun'
            END as kategori_durasi,
            COUNT(*) as jumlah_kontrak,
            AVG(durasi_sewa) as rata_rata_durasi
        ")->where('id_penghuni', $penghuniId)
            ->groupBy('kategori_durasi')
            ->orderByRaw('MIN(durasi_sewa)')
            ->get();

        $jenisKosDisewa = Kos::selectRaw('kos.jenis_kos, COUNT(kontrak_sewa.id_kontrak) as jumlah_sewa, AVG(kontrak_sewa.harga_sewa) as rata_rata_harga')
            ->join('kontrak_sewa', 'kos.id_kos', '=', 'kontrak_sewa.id_kos')
            ->where('kontrak_sewa.id_penghuni', $penghuniId)
            ->groupBy('kos.jenis_kos')
            ->get();

        $reviewStats = Review::selectRaw('FLOOR(rating) as rating_bulat, COUNT(*) as jumlah')
            ->where('id_penghuni', $penghuniId)
            ->groupBy('rating_bulat')
            ->orderBy('rating_bulat')
            ->get();

        $tipeKamarDisewa = DB::table('kontrak_sewa')
            ->selectRaw('kamar.tipe_kamar, COUNT(kontrak_sewa.id_kontrak) as jumlah_sewa, AVG(kontrak_sewa.harga_sewa) as rata_rata_harga')
            ->join('kamar', 'kontrak_sewa.id_kamar', '=', 'kamar.id_kamar')
            ->where('kontrak_sewa.id_penghuni', $penghuniId)
            ->groupBy('kamar.tipe_kamar')
            ->get();

        $statistikRingkasan = [
            'total_kontrak' => $riwayatKontrak->count(),
            'kontrak_aktif' => $riwayatKontrak->where('status_kontrak', 'aktif')->count(),
            'total_pembayaran' => Pembayaran::join('kontrak_sewa', 'pembayaran.id_kontrak', '=', 'kontrak_sewa.id_kontrak')
                ->where('kontrak_sewa.id_penghuni', $penghuniId)
                ->where('pembayaran.status_pembayaran', 'lunas')
                ->sum('pembayaran.jumlah'),
            'jumlah_review' => Review::where('id_penghuni', $penghuniId)->count(),
            'rata_rata_rating' => Review::where('id_penghuni', $penghuniId)->avg('rating') ?? 0,
        ];

        $penghusiData = Penghuni::find($penghuniId);

        return compact(
            'riwayatKontrak', 'pembayaranPerBulan', 'statusPembayaran',
            'durasiTinggal', 'jenisKosDisewa', 'reviewStats', 'tipeKamarDisewa',
            'statistikRingkasan', 'penghusiData'
        );
        });
    }

    public function getPenghuniSpendingAnalysis(int $penghuniId): array
    {
        return Cache::remember('spending_penghuni_' . $penghuniId, 300, function () use ($penghuniId) {
        $spendingByMonth = Pembayaran::selectRaw('YEAR(tanggal_bayar) as tahun, MONTH(tanggal_bayar) as bulan, SUM(jumlah) as total_pengeluaran')
            ->join('kontrak_sewa', 'pembayaran.id_kontrak', '=', 'kontrak_sewa.id_kontrak')
            ->where('kontrak_sewa.id_penghuni', $penghuniId)
            ->where('pembayaran.status_pembayaran', 'lunas')
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->limit(12)
            ->get()
            ->reverse()
            ->values();

        $priceTrend = DB::table('kontrak_sewa')
            ->selectRaw('YEAR(tanggal_mulai) as tahun, AVG(harga_sewa) as rata_harga, COUNT(*) as jumlah_kontrak')
            ->where('id_penghuni', $penghuniId)
            ->whereNotNull('tanggal_mulai')
            ->groupBy('tahun')
            ->orderBy('tahun')
            ->get();

        return [
            'spending_by_month' => $spendingByMonth,
            'price_trend' => $priceTrend,
        ];
        });
    }

    public function getPemilikDashboardStats(int $pemilikId): array
    {
        return Cache::remember('dashboard_pemilik_' . $pemilikId, 300, function () use ($pemilikId) {
        $totalKos = Kos::where('id_pemilik', $pemilikId)->count();
        $totalKamar = Kamar::whereHas('kos', fn($q) => $q->where('id_pemilik', $pemilikId))->count();
        $kamarTersedia = Kamar::whereHas('kos', fn($q) => $q->where('id_pemilik', $pemilikId))
            ->where('status_kamar', 'tersedia')->count();
        $totalPenghuni = KontrakSewa::whereHas('kos', fn($q) => $q->where('id_pemilik', $pemilikId))
            ->where('status_kontrak', 'aktif')->count();

        $semuaKos = Kos::where('id_pemilik', $pemilikId)
            ->withCount(['kamar as kamar_tersedia' => fn($q) => $q->where('status_kamar', 'tersedia')])
            ->orderBy('created_at', 'desc')
            ->limit(50)->get();

        $semuaKamar = Kamar::with('kos')
            ->whereHas('kos', fn($q) => $q->where('id_pemilik', $pemilikId))
            ->limit(50)->get();

        $kontrakPending = KontrakSewa::with(['penghuni', 'kos', 'kamar'])
            ->whereHas('kos', fn($q) => $q->where('id_pemilik', $pemilikId))
            ->where('status_kontrak', 'pending')
            ->orderBy('created_at', 'desc')
            ->limit(10)->get();

        $pembayaranTerbaru = Pembayaran::with(['penghuni', 'kontrak.kos'])
            ->whereHas('kontrak.kos', fn($q) => $q->where('id_pemilik', $pemilikId))
            ->latest()->take(5)->get();

        $pendapatanBulanIni = Pembayaran::whereHas('kontrak.kos', fn($q) => $q->where('id_pemilik', $pemilikId))
            ->where('status_pembayaran', 'lunas')
            ->whereBetween('tanggal_bayar', [now()->startOfMonth(), now()->endOfMonth()])
            ->selectRaw('COALESCE(SUM(COALESCE(bagian_pemilik, jumlah * 0.9)), 0) as total')
            ->value('total');

        return compact(
            'totalKos', 'totalKamar', 'kamarTersedia', 'totalPenghuni',
            'semuaKos', 'semuaKamar', 'kontrakPending', 'pembayaranTerbaru', 'pendapatanBulanIni'
        );
        });
    }

    public function getPendapatanTahunan(int $pemilikId, ?int $tahun = null)
    {
        $tahun = $tahun ?? now()->year;
        $monthFn = config('database.default') === 'sqlite'
            ? "CAST(strftime('%m', tanggal_bayar) AS INTEGER)"
            : 'MONTH(tanggal_bayar)';

        return Cache::remember("pendapatan_tahunan_{$pemilikId}_{$tahun}", 300, function () use ($pemilikId, $tahun, $monthFn) {
            return Pembayaran::selectRaw("{$monthFn} as bulan, SUM(COALESCE(bagian_pemilik, jumlah * 0.9)) as total")
                ->whereHas('kontrak.kos', fn($q) => $q->where('id_pemilik', $pemilikId))
                ->whereYear('tanggal_bayar', $tahun)
                ->where('status_pembayaran', 'lunas')
                ->groupBy('bulan')
                ->orderBy('bulan')
                ->get();
        });
    }

    public function getAktivitasTerbaru(int $pemilikId, int $limit = 10)
    {
        return Pembayaran::with(['penghuni', 'kontrak.kos'])
            ->whereHas('kontrak.kos', fn($q) => $q->where('id_pemilik', $pemilikId))
            ->latest()->take($limit)->get();
    }

    public function getPenghuniDashboardStats(int $penghuniId): array
    {
        return Cache::remember('dashboard_penghuni_' . $penghuniId, 300, function () use ($penghuniId) {
        $kontrakAktif = KontrakSewa::with(['kos', 'kamar'])
            ->where('id_penghuni', $penghuniId)
            ->where('status_kontrak', 'aktif')
            ->get()
            ->each(function ($kontrak) {
                $sekarang = now();
                if (!$kontrak->tanggal_selesai || !$kontrak->tanggal_mulai) {
                    $kontrak->sisaHari = null;
                    $kontrak->totalHari = null;
                    $kontrak->persentaseAkhir = null;
                    $kontrak->statusWarna = 'gray';
                    $kontrak->sudahBerakhir = false;
                    $kontrak->statusText = 'Menunggu pembayaran pertama';
                    return;
                }

                $selesai = Carbon::parse($kontrak->tanggal_selesai);
                $mulai = Carbon::parse($kontrak->tanggal_mulai);
                $sisaHari = (int) floor($sekarang->diffInDays($selesai, false));
                $totalHari = (int) floor($mulai->diffInDays($selesai));
                $persentaseAkhir = $totalHari > 0 ? ($sisaHari / $totalHari) * 100 : 0;

                $kontrak->sisaHari = max($sisaHari, 0);
                $kontrak->totalHari = $totalHari;
                $kontrak->persentaseAkhir = max($persentaseAkhir, 0);
                $kontrak->statusWarna = match (true) {
                    $persentaseAkhir > 50 => 'green',
                    $persentaseAkhir > 20 => 'yellow',
                    default => 'red',
                };
                $kontrak->sudahBerakhir = $sisaHari < 0;
                $kontrak->statusText = $sisaHari < 0 ? 'Kontrak telah berakhir' : 'Kontrak aktif';
            });

        $pembayaranTerakhir = Pembayaran::with(['kontrak.kos'])
            ->where('id_penghuni', $penghuniId)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $totalPembayaran = Pembayaran::where('id_penghuni', $penghuniId)
            ->where('status_pembayaran', 'lunas')
            ->sum('jumlah');

        return compact('kontrakAktif', 'pembayaranTerakhir', 'totalPembayaran');
        });
    }
}
