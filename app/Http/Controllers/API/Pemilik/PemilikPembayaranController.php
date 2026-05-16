<?php

namespace App\Http\Controllers\API\Pemilik;

use App\Http\Controllers\API\ApiController;

use App\Services\Pembayaran\PembayaranService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemilikPembayaranController extends ApiController
{
    public function __construct(
        protected PembayaranService $pembayaranService
    ) {}

    public function index()
    {
        $pemilik = Auth::user()->pemilik;
        $data = $this->pembayaranService->getPemilikPembayaran($pemilik->id_pemilik);

        return $this->success([
            'pembayaran' => $data['pembayaran']->items(),
            'stats' => $data['stats'],
            'meta' => [
                'current_page' => $data['pembayaran']->currentPage(),
                'last_page' => $data['pembayaran']->lastPage(),
                'total' => $data['pembayaran']->total(),
            ],
        ]);
    }

    public function show($id)
    {
        $pemilik = Auth::user()->pemilik;
        $pembayaran = \App\Models\Pembayaran::with(['penghuni', 'kontrak.kos'])
            ->whereHas('kontrak.kos', fn($q) => $q->where('id_pemilik', $pemilik->id_pemilik))
            ->find($id);

        if (!$pembayaran) {
            return $this->notFound('Pembayaran tidak ditemukan');
        }

        return $this->success($pembayaran);
    }

    public function approve($id)
    {
        try {
            $this->pembayaranService->approvePembayaran(Auth::user()->pemilik->id_pemilik, $id);
            return $this->success(null, 'Pembayaran berhasil dikonfirmasi');
        } catch (\Exception $e) {
            return $this->error('Gagal mengkonfirmasi pembayaran', 500);
        }
    }

    public function reject($id)
    {
        try {
            $this->pembayaranService->rejectPembayaran(Auth::user()->pemilik->id_pemilik, $id);
            return $this->success(null, 'Pembayaran ditolak');
        } catch (\Exception $e) {
            return $this->error('Gagal menolak pembayaran', 500);
        }
    }

    public function store(Request $request)
    {
        return $this->error('Use create payment via Penghuni endpoint.', 400);
    }

    public function update(Request $request, $id)
    {
        return $this->error('Method not supported. Use approve/reject.', 400);
    }

    public function destroy($id)
    {
        return $this->error('Method not supported.', 400);
    }
}
