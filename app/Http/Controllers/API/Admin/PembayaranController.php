<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\ApiController;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends ApiController
{
    public function index(Request $request)
    {
        $query = Pembayaran::with(['penghuni', 'kontrak.kos']);

        if ($request->filled('status')) {
            $query->where('status_pembayaran', $request->status);
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
        $pembayaran = Pembayaran::with(['penghuni', 'kontrak.kos'])->find($id);
        if (!$pembayaran) return $this->notFound('Pembayaran tidak ditemukan');
        return $this->success($pembayaran);
    }
}
