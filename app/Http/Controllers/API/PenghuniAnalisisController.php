<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\KontrakSewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenghuniAnalisisController extends Controller
{
    public function index()
    {
        $penghuni = Auth::user();

        // Monthly spending
        $monthlySpending = Pembayaran::where('id_penghuni', $penghuni->id_penghuni)
            ->where('status_pembayaran', 'lunas')
            ->selectRaw('bulan_tahun, SUM(jumlah) as total')
            ->groupBy('bulan_tahun')
            ->orderBy('bulan_tahun', 'desc')
            ->limit(12)
            ->get();

        // Spending by kos
        $spendingByKos = Pembayaran::with('kontrak.kos')
            ->where('id_penghuni', $penghuni->id_penghuni)
            ->where('status_pembayaran', 'lunas')
            ->get()
            ->groupBy('kontrak.kos.nama_kos')
            ->map(function ($items) {
                return [
                    'total' => $items->sum('jumlah'),
                    'count' => $items->count()
                ];
            });

        // Contract history
        $contractHistory = KontrakSewa::with(['kos', 'kamar'])
            ->where('id_penghuni', $penghuni->id_penghuni)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'monthly_spending' => $monthlySpending,
                'spending_by_kos' => $spendingByKos,
                'contract_history' => $contractHistory
            ]
        ]);
    }

    public function getSpendingAnalysis(Request $request)
    {
        $penghuni = Auth::user();
        $year = $request->get('year', date('Y'));

        $spending = Pembayaran::where('id_penghuni', $penghuni->id_penghuni)
            ->where('status_pembayaran', 'lunas')
            ->where('bulan_tahun', 'like', $year . '-%')
            ->selectRaw('MONTH(STR_TO_DATE(CONCAT(bulan_tahun, "-01"), "%Y-%m-%d")) as bulan, SUM(jumlah) as total')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Format for chart
        $bulanLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $spendingData = array_fill(0, 12, 0);

        foreach ($spending as $item) {
            $spendingData[$item->bulan - 1] = (float) $item->total;
        }

        return response()->json([
            'success' => true,
            'data' => [
                'labels' => $bulanLabels,
                'spending' => $spendingData,
                'year' => $year,
                'total_year' => array_sum($spendingData)
            ]
        ]);
    }
}
