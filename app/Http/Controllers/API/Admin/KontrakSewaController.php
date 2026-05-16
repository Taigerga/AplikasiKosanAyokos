<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\ApiController;

use App\Models\KontrakSewa;
use Illuminate\Http\Request;

class KontrakSewaController extends ApiController
{
    public function index(Request $request)
    {
        $query = KontrakSewa::with(['penghuni', 'kos', 'kamar']);

        if ($request->filled('status')) {
            $query->where('status_kontrak', $request->status);
        }

        return $this->paginated($query->orderBy('created_at', 'desc')->paginate(10));
    }

    public function store(Request $request)
    {
        return $this->error('Not available via admin endpoint.', 400);
    }

    public function update(Request $request, $id)
    {
        return $this->error('Not available via admin endpoint.', 400);
    }

    public function destroy($id)
    {
        return $this->error('Not available via admin endpoint.', 400);
    }

    public function show($id)
    {
        $kontrak = KontrakSewa::with(['penghuni', 'kos', 'kamar', 'pembayaran'])->find($id);
        if (!$kontrak) return $this->notFound('Kontrak tidak ditemukan');
        return $this->success($kontrak);
    }
}
