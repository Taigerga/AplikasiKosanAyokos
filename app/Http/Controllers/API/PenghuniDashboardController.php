<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\KontrakSewa;
use App\Models\Pembayaran;
use App\Models\Kos;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenghuniDashboardController extends Controller
{
    public function index()
    {
        $penghuni = Auth::user();

        // Active contracts
        $kontrakAktif = KontrakSewa::with(['kos', 'kamar'])
            ->where('id_penghuni', $penghuni->id_penghuni)
            ->where('status_kontrak', 'aktif')
            ->get();

        // Pending contracts
        $kontrakPending = KontrakSewa::with(['kos', 'kamar'])
            ->where('id_penghuni', $penghuni->id_penghuni)
            ->where('status_kontrak', 'pending')
            ->get();

        // Recent payments
        $pembayaran = Pembayaran::with(['kontrak.kos'])
            ->where('id_penghuni', $penghuni->id_penghuni)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Payment stats
        $totalBayar = Pembayaran::where('id_penghuni', $penghuni->id_penghuni)
            ->where('status_pembayaran', 'lunas')
            ->sum('jumlah');

        $belumBayar = Pembayaran::where('id_penghuni', $penghuni->id_penghuni)
            ->where('status_pembayaran', 'belum')
            ->count();

        // Notifications for deadline
        $notifikasiTenggat = KontrakSewa::with(['kos'])
            ->where('id_penghuni', $penghuni->id_penghuni)
            ->where('status_kontrak', 'aktif')
            ->whereDate('tanggal_selesai', '<=', now()->addDays(30))
            ->whereDate('tanggal_selesai', '>=', now())
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'penghuni' => $penghuni,
                'kontrak_aktif' => $kontrakAktif,
                'kontrak_pending' => $kontrakPending,
                'pembayaran_terbaru' => $pembayaran,
                'stats' => [
                    'total_bayar' => (float) $totalBayar,
                    'belum_bayar' => $belumBayar,
                    'kontrak_aktif_count' => $kontrakAktif->count()
                ],
                'notifikasi_tenggat' => $notifikasiTenggat
            ]
        ]);
    }

    public function notifikasiTenggat()
    {
        $penghuni = Auth::user();

        $kontrak = KontrakSewa::with(['kos'])
            ->where('id_penghuni', $penghuni->id_penghuni)
            ->where('status_kontrak', 'aktif')
            ->whereDate('tanggal_selesai', '<=', now()->addDays(30))
            ->whereDate('tanggal_selesai', '>=', now())
            ->get();

        return response()->json([
            'success' => true,
            'data' => $kontrak
        ]);
    }
}
