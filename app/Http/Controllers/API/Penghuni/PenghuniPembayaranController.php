<?php

namespace App\Http\Controllers\API\Penghuni;

use App\Http\Controllers\API\ApiController;

use App\Http\Requests\Penghuni\StorePembayaranRequest;
use App\Services\Pembayaran\PembayaranService;
use App\Services\Kontrak\KontrakService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenghuniPembayaranController extends ApiController
{
    public function __construct(
        protected PembayaranService $pembayaranService,
        protected KontrakService $kontrakService
    ) {}

    public function index()
    {
        $penghuni = Auth::user()->penghuni;
        $data = $this->pembayaranService->getPenghuniPembayaran($penghuni->id_penghuni);

        return $this->success([
            'pembayaran' => $data['pembayaran']->items(),
            'kontrak_aktif' => $data['kontrakAktif']->items(),
            'meta' => [
                'pembayaran_page' => $data['pembayaran']->currentPage(),
                'pembayaran_total' => $data['pembayaran']->total(),
                'kontrak_page' => $data['kontrakAktif']->currentPage(),
                'kontrak_total' => $data['kontrakAktif']->total(),
            ],
        ]);
    }

    public function update(Request $request, $id)
    {
        return $this->error('Update not supported.', 400);
    }

    public function destroy($id)
    {
        return $this->error('Delete not supported.', 400);
    }

    public function show($id)
    {
        try {
            $pembayaran = $this->pembayaranService->getPenghuniPembayaranDetail(
                Auth::user()->penghuni->id_penghuni,
                $id
            );
            return $this->success($pembayaran);
        } catch (\Exception $e) {
            return $this->notFound('Pembayaran tidak ditemukan');
        }
    }

    public function create(Request $request)
    {
        $penghuni = Auth::user()->penghuni;
        $kontrakAktif = $this->kontrakService->getPenghuniKontrakAktif($penghuni->id_penghuni);

        if ($kontrakAktif->isEmpty()) {
            return $this->error('Anda tidak memiliki kontrak aktif.', 400);
        }

        $selectedKontrak = $request->has('id_kontrak')
            ? ($kontrakAktif->where('id_kontrak', $request->id_kontrak)->first() ?? $kontrakAktif->first())
            : $kontrakAktif->first();

        $paymentData = $this->pembayaranService->getPaymentOptions($selectedKontrak);

        return $this->success([
            'kontrak_aktif' => $kontrakAktif,
            'selected_kontrak' => $selectedKontrak,
            'payment_options' => $paymentData['options'],
            'unit_label' => $paymentData['unitLabel'],
            'max_limit' => $paymentData['maxLimit'],
            'tipe_sewa' => $paymentData['tipeSewa'],
            'is_first_payment' => $paymentData['isFirstPayment'],
        ]);
    }

    public function store(StorePembayaranRequest $request)
    {
        try {
            $pembayaran = $this->pembayaranService->createPembayaran(
                Auth::user()->penghuni->id_penghuni,
                $request->validated()
            );

            return $this->created($pembayaran, 'Pembayaran berhasil dikirim! Menunggu konfirmasi pemilik.');
        } catch (\Exception $e) {
            return $this->error('Terjadi kesalahan: ' . $e->getMessage(), 500);
        }
    }
}
