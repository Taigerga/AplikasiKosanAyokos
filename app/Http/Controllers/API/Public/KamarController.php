<?php

namespace App\Http\Controllers\API\Public;

use App\Http\Controllers\API\ApiController;

use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends ApiController
{
    public function index(Request $request)
    {
        $query = Kamar::with('kos');

        if ($request->filled('id_kos')) {
            $query->where('id_kos', $request->id_kos);
        }
        if ($request->filled('status')) {
            $query->where('status_kamar', $request->status);
        }

        return $this->paginated($query->paginate(20));
    }

    public function show($id)
    {
        $kamar = Kamar::with('kos')->find($id);

        if (!$kamar) {
            return $this->notFound('Kamar tidak ditemukan');
        }

        return $this->success($kamar);
    }
}
