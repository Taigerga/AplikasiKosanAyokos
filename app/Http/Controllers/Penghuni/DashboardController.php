<?php

namespace App\Http\Controllers\Penghuni;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KontrakSewa;
use App\Models\Pembayaran;
use App\Models\Kos;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $penghuni = $user->penghuni;

        if (!$penghuni) {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai penghuni.');
        }

        $kontrakAktif = KontrakSewa::with(['kos', 'kamar'])
            ->where('id_penghuni', $penghuni->id_penghuni)
            ->where('status_kontrak', 'aktif')
            ->get();

        // Tambahkan data sisa waktu untuk setiap kontrak
        $kontrakAktif->each(function ($kontrak) {
            $sekarang = Carbon::now();

            // Handle null tanggal_selesai dan tanggal_mulai
            if (!$kontrak->tanggal_selesai || !$kontrak->tanggal_mulai) {
                // Kontrak baru disetujui tapi belum ada pembayaran
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

            if ($persentaseAkhir > 50) {
                $statusWarna = 'green';
            } elseif ($persentaseAkhir > 20) {
                $statusWarna = 'yellow';
            } else {
                $statusWarna = 'red';
            }

            $kontrak->sisaHari = max($sisaHari, 0);
            $kontrak->totalHari = $totalHari;
            $kontrak->persentaseAkhir = max($persentaseAkhir, 0);
            $kontrak->statusWarna = $statusWarna;
            $kontrak->sudahBerakhir = $sisaHari < 0;
            $kontrak->statusText = $sisaHari < 0 ? 'Kontrak telah berakhir' : 'Kontrak aktif';
        });

        $pembayaranTerakhir = Pembayaran::with(['kontrak.kos'])
            ->where('id_penghuni', $penghuni->id_penghuni)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $totalPembayaran = $this->hitungTotalPembayaran($penghuni->id_penghuni);

        return view('penghuni.dashboard', compact(
            'user',
            'penghuni',
            'kontrakAktif',
            'pembayaranTerakhir',
            'totalPembayaran'
        ));
    }

    private function hitungTotalPembayaran($penghuniId)
    {
        return Pembayaran::where('id_penghuni', $penghuniId)
            ->where('status_pembayaran', 'lunas')
            ->sum('jumlah');
    }
}