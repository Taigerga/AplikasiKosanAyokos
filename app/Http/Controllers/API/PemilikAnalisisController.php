<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use App\Models\Kamar;
use App\Models\Pembayaran;
use App\Models\KontrakSewa;
use App\Models\Penghuni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PemilikAnalisisController extends Controller
{
    public function index()
    {
        $pemilik = Auth::user();

        // Chart data - Pendapatan 6 bulan terakhir
        $pendapatanChart = Pembayaran::whereHas('kontrak.kos', function($query) use ($pemilik) {
                $query->where('id_pemilik', $pemilik->id_pemilik);
            })
            ->where('status_pembayaran', 'lunas')
            ->where('bulan_tahun', '>=', now()->subMonths(5)->format('Y-m'))
            ->select('bulan_tahun', DB::raw('SUM(jumlah) as total'))
            ->groupBy('bulan_tahun')
            ->orderBy('bulan_tahun')
            ->get();

        // Kos dengan penghuni terbanyak
        $kosTerpopuler = Kos::where('id_pemilik', $pemilik->id_pemilik)
            ->withCount(['kontrak as penghuni_count' => function($query) {
                $query->where('status_kontrak', 'aktif');
            }])
            ->orderBy('penghuni_count', 'desc')
            ->limit(5)
            ->get();

        // Occupancy rate
        $totalKamar = Kamar::whereHas('kos', function($query) use ($pemilik) {
            $query->where('id_pemilik', $pemilik->id_pemilik);
        })->count();

        $kamarTerisi = Kamar::whereHas('kos', function($query) use ($pemilik) {
            $query->where('id_pemilik', $pemilik->id_pemilik);
        })->where('status_kamar', 'terisi')->count();

        $occupancyRate = $totalKamar > 0 ? ($kamarTerisi / $totalKamar) * 100 : 0;

        return response()->json([
            'success' => true,
            'data' => [
                'chart_data' => $pendapatanChart,
                'kos_terpopuler' => $kosTerpopuler,
                'occupancy_rate' => round($occupancyRate, 2),
                'total_kamar' => $totalKamar,
                'kamar_terisi' => $kamarTerisi,
                'kamar_tersedia' => $totalKamar - $kamarTerisi
            ]
        ]);
    }
}
