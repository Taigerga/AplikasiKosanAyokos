<?php

namespace App\Http\Controllers\API\Pemilik;

use App\Http\Controllers\API\ApiController;
use App\Services\Aduan\AduanService;
use App\Http\Requests\Aduan\StoreAduanRequest;
use App\Http\Requests\Aduan\StoreKomentarRequest;
use Illuminate\Http\Request;

class PemilikAduanController extends ApiController
{
    public function __construct(
        protected AduanService $aduanService
    ) {}

    public function index(Request $request)
    {
        try {
            $filters = array_merge(
                array_filter($request->only(['status', 'kategori'])),
                ['pengirim_id' => $request->user()->id, 'role' => 'pemilik']
            );
            $aduans = $this->aduanService->getAduanList($filters);

            return $this->paginated($aduans);
        } catch (\Exception $e) {
            return $this->error('Gagal memuat daftar aduan.', 500);
        }
    }

    public function store(StoreAduanRequest $request)
    {
        try {
            $aduan = $this->aduanService->createAduan($request->user()->id, 'pemilik', $request->validated());
            return $this->created($aduan, 'Aduan berhasil dikirim.');
        } catch (\Exception $e) {
            return $this->error('Gagal mengirim aduan.', 500);
        }
    }

    public function show(int $id)
    {
        try {
            $aduan = $this->aduanService->getAduanDetail($id);

            if ($aduan->id_pengirim !== auth()->id()) {
                return $this->forbidden();
            }

            return $this->success($aduan);
        } catch (\Exception $e) {
            return $this->notFound('Aduan tidak ditemukan.');
        }
    }

    public function tambahKomentar(StoreKomentarRequest $request, int $id)
    {
        try {
            $aduan = $this->aduanService->getAduanDetail($id);

            if ($aduan->id_pengirim !== auth()->id()) {
                return $this->forbidden();
            }

            $komentar = $this->aduanService->tambahKomentar($id, auth()->id(), $request->validated());
            return $this->created($komentar, 'Komentar berhasil ditambahkan.');
        } catch (\Exception $e) {
            return $this->error('Gagal menambahkan komentar.', 500);
        }
    }
}
