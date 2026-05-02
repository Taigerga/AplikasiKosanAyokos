<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use App\Models\Kamar;
use App\Models\Pembayaran;
use App\Models\KontrakSewa;
use App\Models\Penghuni;
use App\Models\Pemilik;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Total counts
        $totalKos = Kos::count();
        $totalKamar = Kamar::count();
        $totalPenghuni = Penghuni::count();
        $totalPemilik = Pemilik::count();
        $totalAdmin = Admin::count();

        // Active contracts
        $kontrakAktif = KontrakSewa::where('status_kontrak', 'aktif')->count();

        // Pending approvals
        $kosPending = Kos::where('status_kos', 'pending')->count();
        $kontrakPending = KontrakSewa::where('status_kontrak', 'pending')->count();
        $pemilikPending = Pemilik::where('status_pemilik', 'pending')->count();

        // Payments stats
        $totalPendapatan = Pembayaran::where('status_pembayaran', 'lunas')->sum('jumlah');
        $pembayaranLunas = Pembayaran::where('status_pembayaran', 'lunas')->count();
        $pembayaranPending = Pembayaran::where('status_pembayaran', 'pending')->count();
        $pembayaranBelum = Pembayaran::where('status_pembayaran', 'belum')->count();

        // Monthly revenue chart
        $monthlyRevenue = Pembayaran::where('status_pembayaran', 'lunas')
            ->where('bulan_tahun', '>=', now()->subMonths(5)->format('Y-m'))
            ->select('bulan_tahun', DB::raw('SUM(jumlah) as total'))
            ->groupBy('bulan_tahun')
            ->orderBy('bulan_tahun')
            ->get();

        // Kos registration chart
        $kosBulanan = Kos::where('created_at', '>=', now()->subMonths(5))
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Latest kos pending
        $latestKosPending = Kos::with('pemilik')
            ->where('status_kos', 'pending')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Latest kontrak pending
        $latestKontrakPending = KontrakSewa::with(['penghuni', 'kos'])
            ->where('status_kontrak', 'pending')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'stats' => [
                    'total_kos' => $totalKos,
                    'total_kamar' => $totalKamar,
                    'total_penghuni' => $totalPenghuni,
                    'total_pemilik' => $totalPemilik,
                    'total_admin' => $totalAdmin,
                    'kontrak_aktif' => $kontrakAktif,
                    'kos_pending' => $kosPending,
                    'kontrak_pending' => $kontrakPending,
                    'pemilik_pending' => $pemilikPending,
                    'total_pendapatan' => (float) $totalPendapatan,
                    'pembayaran_lunas' => $pembayaranLunas,
                    'pembayaran_pending' => $pembayaranPending,
                    'pembayaran_belum' => $pembayaranBelum
                ],
                'monthly_revenue' => $monthlyRevenue,
                'kos_bulanan' => $kosBulanan,
                'latest_kos_pending' => $latestKosPending,
                'latest_kontrak_pending' => $latestKontrakPending
            ]
        ]);
    }
}
