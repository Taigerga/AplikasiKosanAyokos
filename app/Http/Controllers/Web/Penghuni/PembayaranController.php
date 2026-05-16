<?php

namespace App\Http\Controllers\Web\Penghuni;

use App\Http\Controllers\Controller;
use App\Http\Requests\Penghuni\StorePembayaranRequest;
use App\Services\Pembayaran\PembayaranService;
use App\Services\Kontrak\KontrakService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function __construct(
        protected PembayaranService $pembayaranService,
        protected KontrakService $kontrakService
    ) {}

    public function index()
    {
        $user = Auth::user();
        $penghuni = $user->penghuni;

        $data = $this->pembayaranService->getPenghuniPembayaran($penghuni->id_penghuni);

        return view('penghuni.pembayaran.index', array_merge(
            compact('user'),
            $data
        ));
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        $penghuni = $user->penghuni;

        $kontrakAktif = $this->kontrakService->getPenghuniKontrakAktif($penghuni->id_penghuni);

        if ($kontrakAktif->isEmpty()) {
            return redirect()->route('penghuni.pembayaran.index')
                ->with('error', 'Anda tidak memiliki kontrak aktif.');
        }

        $selectedKontrak = $request->has('id_kontrak')
            ? ($kontrakAktif->where('id_kontrak', $request->id_kontrak)->first() ?? $kontrakAktif->first())
            : $kontrakAktif->first();

        $paymentData = $this->pembayaranService->getPaymentOptions($selectedKontrak);

        return view('penghuni.pembayaran.create', array_merge(
            compact('kontrakAktif', 'selectedKontrak', 'user'),
            ['paymentOptions' => $paymentData['options']],
            ['unitLabel' => $paymentData['unitLabel']],
            ['maxLimit' => $paymentData['maxLimit']],
            ['tipeSewa' => $paymentData['tipeSewa']],
            ['isFirstPayment' => $paymentData['isFirstPayment']],
        ));
    }

    public function store(StorePembayaranRequest $request)
    {
        try {
            $this->pembayaranService->createPembayaran(
                Auth::user()->penghuni->id_penghuni,
                $request->validated()
            );

            return redirect()->route('penghuni.pembayaran.index')
                ->with('success', 'Pembayaran berhasil dikirim! Menunggu konfirmasi pemilik.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        $pembayaran = $this->pembayaranService->getPenghuniPembayaranDetail(
            Auth::user()->penghuni->id_penghuni,
            $id
        );

        return view('penghuni.pembayaran.show', compact('pembayaran'));
    }
}
