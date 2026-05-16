<?php

namespace App\Http\Controllers\Web\Pemilik;

use App\Http\Controllers\Controller;
use App\Services\Pembayaran\PembayaranService;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function __construct(
        protected PembayaranService $pembayaranService
    ) {}

    public function index()
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;

        $data = $this->pembayaranService->getPemilikPembayaran($pemilik->id_pemilik);

        return view('pemilik.pembayaran.index', [
            'pembayaran' => $data['pembayaran'],
            'statistics' => $data['stats'],
        ]);
    }

    public function approve($id)
    {
        try {
            $this->pembayaranService->approvePembayaran(auth()->user()->pemilik->id_pemilik, $id);

            return redirect()->route('pemilik.pembayaran.index')
                ->with('success', 'Pembayaran berhasil dikonfirmasi! Durasi kontrak telah diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan sistem saat menyetujui pembayaran.');
        }
    }

    public function reject($id)
    {
        try {
            $this->pembayaranService->rejectPembayaran(auth()->user()->pemilik->id_pemilik, $id);

            return redirect()->route('pemilik.pembayaran.index')
                ->with('success', 'Pembayaran ditolak. Penghuni harus mengupload bukti baru.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan sistem saat menolak pembayaran.');
        }
    }
}
