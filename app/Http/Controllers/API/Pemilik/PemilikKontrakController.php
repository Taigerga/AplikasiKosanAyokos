<?php

namespace App\Http\Controllers\API\Pemilik;

use App\Http\Controllers\API\ApiController;

use App\Services\Kontrak\KontrakService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemilikKontrakController extends ApiController
{
    public function __construct(
        protected KontrakService $kontrakService
    ) {}

    public function index()
    {
        $pemilik = Auth::user()->pemilik;
        $data = $this->kontrakService->getPemilikKontrak($pemilik->id_pemilik);

        return $this->success([
            'pending' => $data['pending']->items(),
            'aktif' => $data['aktif']->items(),
            'selesai' => $data['selesai']->items(),
            'ditolak' => $data['ditolak']->items(),
            'counts' => [
                'pending' => $data['pendingCount'],
                'aktif' => $data['aktifCount'],
                'selesai' => $data['selesaiCount'],
                'ditolak' => $data['ditolakCount'],
            ],
        ]);
    }

    public function show($id)
    {
        $kontrak = \App\Models\KontrakSewa::with(['penghuni', 'kos', 'kamar'])->find($id);

        if (!$kontrak || $kontrak->kos->id_pemilik != Auth::user()->pemilik->id_pemilik) {
            return $this->notFound('Kontrak tidak ditemukan');
        }

        return $this->success($kontrak);
    }

    public function approve($id)
    {
        try {
            $this->kontrakService->approveKontrak(Auth::user()->pemilik->id_pemilik, $id);
            return $this->success(null, 'Kontrak berhasil disetujui');
        } catch (\Exception $e) {
            return $this->error('Gagal menyetujui kontrak.', 500);
        }
    }

    public function reject(Request $request, $id)
    {
        $request->validate(['alasan_ditolak' => 'required|string']);

        try {
            $this->kontrakService->rejectKontrak(Auth::user()->pemilik->id_pemilik, $id, $request->alasan_ditolak);
            return $this->success(null, 'Kontrak berhasil ditolak');
        } catch (\Exception $e) {
            return $this->error('Gagal menolak kontrak.', 500);
        }
    }

    public function selesai($id)
    {
        try {
            $this->kontrakService->selesaiKontrak(Auth::user()->pemilik->id_pemilik, $id);
            return $this->success(null, 'Kontrak berhasil diselesaikan');
        } catch (\Exception $e) {
            return $this->error('Gagal menyelesaikan kontrak.', 500);
        }
    }

    public function store(Request $request)
    {
        return $this->error('Use create kontrak via Penghuni endpoint.', 400);
    }

    public function update(Request $request, $id)
    {
        return $this->error('Method not supported. Use approve/reject/selesai.', 400);
    }

    public function destroy($id)
    {
        try {
            $this->kontrakService->destroyKontrak(Auth::user()->pemilik->id_pemilik, $id);
            return $this->success(null, 'Kontrak berhasil dihapus');
        } catch (\Exception $e) {
            return $this->error('Gagal menghapus kontrak.', 400);
        }
    }
}
