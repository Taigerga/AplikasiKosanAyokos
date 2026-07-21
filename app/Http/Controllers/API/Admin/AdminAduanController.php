<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\ApiController;
use App\Services\Aduan\AduanService;
use App\Http\Requests\Aduan\StoreKomentarRequest;
use Illuminate\Http\Request;

class AdminAduanController extends ApiController
{
    public function __construct(
        protected AduanService $aduanService
    ) {}

    public function index(Request $request)
    {
        try {
            $filters = array_filter($request->only(['status', 'kategori', 'role']));
            $aduans = $this->aduanService->getAduanList($filters);
            $statistik = $this->aduanService->getStatistik();

            return $this->success([
                'aduans' => $aduans->items(),
                'meta' => [
                    'current_page' => $aduans->currentPage(),
                    'last_page' => $aduans->lastPage(),
                    'total' => $aduans->total(),
                ],
                'statistik' => $statistik,
            ]);
        } catch (\Exception $e) {
            return $this->error('Gagal memuat daftar aduan.', 500);
        }
    }

    public function show(int $id)
    {
        try {
            $aduan = $this->aduanService->getAduanDetail($id);
            return $this->success($aduan);
        } catch (\Exception $e) {
            return $this->notFound('Aduan tidak ditemukan.');
        }
    }

    public function updateStatus(Request $request, int $id)
    {
        try {
            $request->validate(['status' => 'required|string|in:diajukan,ditinjau,diproses,menunggu_info,selesai,ditolak,ditutup']);

            $aduan = $this->aduanService->updateStatus($id, $request->status, $request->alasan);

            return $this->success($aduan, 'Status aduan berhasil diperbarui.');
        } catch (\Exception $e) {
            return $this->error('Gagal memperbarui status aduan.', 500);
        }
    }

    public function tambahKomentar(StoreKomentarRequest $request, int $id)
    {
        try {
            $komentar = $this->aduanService->tambahKomentar($id, auth()->id(), $request->validated());
            return $this->created($komentar, 'Komentar berhasil ditambahkan.');
        } catch (\Exception $e) {
            return $this->error('Gagal menambahkan komentar.', 500);
        }
    }

    public function statistik()
    {
        try {
            return $this->success($this->aduanService->getStatistik());
        } catch (\Exception $e) {
            return $this->error('Gagal memuat statistik.', 500);
        }
    }
}
