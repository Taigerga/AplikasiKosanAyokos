<?php

namespace App\Http\Controllers\API\Public;

use App\Http\Controllers\API\ApiController;

use App\Models\Fasilitas;

class FasilitasController extends ApiController
{
    public function index()
    {
        return $this->success(Fasilitas::orderBy('nama_fasilitas')->get());
    }

    public function show($id)
    {
        $fasilitas = Fasilitas::find($id);

        if (!$fasilitas) {
            return $this->notFound('Fasilitas tidak ditemukan');
        }

        return $this->success($fasilitas);
    }
}
