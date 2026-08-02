<?php

namespace App\Http\Controllers\API;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentCallbackController extends ApiController
{
    private function verifySignature(Request $request): bool
    {
        $token = config('app.payment_callback_token');
        if (!$token) {
            return true;
        }

        $signature = $request->header('X-Callback-Signature');
        if (!$signature) {
            return false;
        }

        $payload = $request->getContent();
        $expected = hash_hmac('sha256', $payload, $token);

        return hash_equals($expected, $signature);
    }

    public function handleCallback(Request $request)
    {
        if (!$this->verifySignature($request)) {
            Log::warning('Payment callback invalid signature', [
                'ip' => $request->ip(),
                'headers' => $request->headers->all(),
            ]);
            return $this->error('Invalid signature', 401);
        }

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
