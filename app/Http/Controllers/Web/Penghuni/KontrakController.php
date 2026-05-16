<?php

namespace App\Http\Controllers\Web\Penghuni;

use App\Http\Controllers\Controller;
use App\Http\Requests\Penghuni\StoreKontrakRequest;
use App\Http\Requests\Penghuni\ExtendKontrakRequest;
use App\Services\Kontrak\KontrakService;
use App\Services\Kos\KosService;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KontrakController extends Controller
{
    public function __construct(
        protected KontrakService $kontrakService,
        protected KosService $kosService
    ) {}

    public function create($kosId)
    {
        try {
            $kos = $this->kosService->getPublicKosDetail($kosId);
            return view('penghuni.kontrak.create', compact('kos'));
        } catch (\Exception $e) {
            return redirect()->route('public.kos.show', $kosId)
                ->with('error', 'Kos tidak ditemukan atau tidak ada kamar tersedia.');
        }
    }

    public function cariKos()
    {
        $filters = request()->all();
        $kos = $this->kosService->getPublicKosWithFilters($filters, 12);
        $fasilitasList = Fasilitas::all();

        return view('public.kos.index', compact('kos', 'fasilitasList'));
    }

    public function store(StoreKontrakRequest $request)
    {
        try {
            $this->kontrakService->createKontrak(
                Auth::user()->penghuni->id_penghuni,
                $request->validated()
            );

            return redirect()->route('penghuni.dashboard')
                ->with('success', 'Pengajuan kos berhasil dikirim! Tunggu persetujuan dari pemilik.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal mengajukan kontrak: ' . $e->getMessage());
        }
    }

    public function index()
    {
        $user = Auth::user();
        $penghuni = $user->penghuni;
        $kontrak = $this->kontrakService->getPenghuniKontrak($penghuni->id_penghuni);

        return view('penghuni.kontrak.index', compact('kontrak', 'user'));
    }

    public function show($id)
    {
        $kontrak = $this->kontrakService->getPenghuniKontrakDetail(
            Auth::user()->penghuni->id_penghuni,
            $id
        );

        return view('penghuni.kontrak.show', compact('kontrak'));
    }

    public function extend(ExtendKontrakRequest $request, $id)
    {
        try {
            $this->kontrakService->extendKontrak(
                Auth::user()->penghuni->id_penghuni,
                $id,
                (int) $request->validated()['durasi_perpanjangan']
            );

            return redirect()->back()->with('success', 'Kontrak berhasil diperpanjang. Email notifikasi telah dikirim.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperpanjang kontrak: ' . $e->getMessage());
        }
    }

    public function notifikasiTenggat()
    {
        $user = Auth::user();
        $kontrakAktif = $this->kontrakService->getNotifikasiTenggat(
            $user->penghuni->id_penghuni
        );

        return view('penghuni.kontrak.notifikasi', compact('kontrakAktif', 'user'));
    }
}
