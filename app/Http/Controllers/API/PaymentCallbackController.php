<?php

namespace App\Http\Controllers\API;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentCallbackController extends ApiController
{
    public function handleCallback(Request $request)
    {
        Log::info('Payment callback received', $request->all());

        $externalId = $request->input('external_id');
        $status = $request->input('status');

        if (!$externalId || !$status) {
            return $this->error('Invalid callback data', 400);
        }

        $pembayaran = Pembayaran::where('id_pembayaran', $externalId)->first();

        if (!$pembayaran) {
            return $this->notFound('Pembayaran tidak ditemukan');
        }

        if ($status === 'settled' || $status === 'paid') {
            $pembayaran->update([
                'status_pembayaran' => 'lunas',
                'tanggal_bayar' => now(),
            ]);
        } elseif ($status === 'expired' || $status === 'failed') {
            $pembayaran->update(['status_pembayaran' => 'belum']);
        }

        return $this->success(null, 'Callback processed');
    }

    public function simulatePayment($externalId)
    {
        $pembayaran = Pembayaran::find($externalId);

        if (!$pembayaran) {
            return $this->notFound('Pembayaran tidak ditemukan');
        }

        $pembayaran->update([
            'status_pembayaran' => 'lunas',
            'tanggal_bayar' => now(),
        ]);

        Log::info('Payment simulated', ['id' => $externalId]);

        return $this->success($pembayaran, 'Pembayaran berhasil disimulasikan');
    }
}
