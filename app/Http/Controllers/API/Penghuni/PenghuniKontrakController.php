<?php

namespace App\Http\Controllers\API\Penghuni;

use App\Http\Controllers\API\ApiController;

use App\Http\Requests\Penghuni\StoreKontrakRequest;
use App\Services\Kontrak\KontrakService;
use App\Services\Kos\KosService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenghuniKontrakController extends ApiController
{
    public function __construct(
        protected KontrakService $kontrakService,
        protected KosService $kosService
    ) {}

    public function index()
    {
        $penghuni = Auth::user()->penghuni;
        $kontrak = $this->kontrakService->getPenghuniKontrak($penghuni->id_penghuni);

        return $this->paginated($kontrak);
    }

    public function show($id)
    {
        try {
            $kontrak = $this->kontrakService->getPenghuniKontrakDetail(
                Auth::user()->penghuni->id_penghuni,
                $id
            );
            return $this->success($kontrak);
        } catch (\Exception $e) {
            return $this->notFound('Kontrak tidak ditemukan');
        }
    }

    public function create($kosId)
    {
        try {
            $kos = $this->kosService->getPublicKosDetail($kosId);
            return $this->success($kos);
        } catch (\Exception $e) {
            return $this->notFound('Kos tidak ditemukan');
        }
    }

    public function store(StoreKontrakRequest $request)
    {
        try {
            $kontrak = $this->kontrakService->createKontrak(
                Auth::user()->penghuni->id_penghuni,
                $request->validated()
            );

            return $this->created($kontrak, 'Pengajuan kos berhasil dikirim');
        } catch (\Exception $e) {
            return $this->error('Gagal mengajukan kontrak: ' . $e->getMessage(), 500);
        }
    }

    public function cariKos()
    {
        $filters = request()->all();
        $kos = $this->kosService->getPublicKosWithFilters($filters, 12);

        return $this->paginated($kos);
    }
}
