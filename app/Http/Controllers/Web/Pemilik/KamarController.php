<?php

namespace App\Http\Controllers\Web\Pemilik;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pemilik\StoreKamarRequest;
use App\Http\Requests\Pemilik\UpdateKamarRequest;
use App\Services\Kamar\KamarService;
use App\Services\Kos\KosService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KamarController extends Controller
{
    public function __construct(
        protected KamarService $kamarService,
        protected KosService $kosService
    ) {}

    public function index(Request $request)
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;

        $filters = $request->only(['kos', 'status', 'tipe']);
        $result = $this->kamarService->getOwnerKamar($pemilik->id_pemilik, $filters, 10);

        $kos = $this->kosService->getOwnerKosList($pemilik->id_pemilik);

        return view('pemilik.kamar.index', [
            'kamar' => $result['kamar'],
            'stats' => $result['stats'],
            'kos' => $kos,
            'user' => $user,
        ]);
    }

    public function create()
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;
        $kos = $this->kosService->getOwnerKosList($pemilik->id_pemilik);

        return view('pemilik.kamar.create', compact('kos'));
    }

    public function store(StoreKamarRequest $request)
    {
        $validated = $request->validated();

        if (!$this->kamarService->isNomorKamarUnique($validated['id_kos'], $validated['nomor_kamar'])) {
            return back()->withErrors(['nomor_kamar' => 'Nomor kamar sudah ada di kos ini.'])->withInput();
        }

        $this->kamarService->createKamar($validated);

        return redirect()->route('pemilik.kamar.index')
            ->with('success', 'Kamar berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;
        $kamar = $this->kamarService->findKamar($pemilik->id_pemilik, $id);
        $kos = $this->kosService->getOwnerKosList($pemilik->id_pemilik);

        return view('pemilik.kamar.edit', compact('kamar', 'kos', 'user'));
    }

    public function update(UpdateKamarRequest $request, $id)
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;

        $validated = $request->validated();

        if (!$this->kamarService->isNomorKamarUnique($validated['id_kos'], $validated['nomor_kamar'], $id)) {
            return back()->withErrors(['nomor_kamar' => 'Nomor kamar sudah ada di kos ini.'])->withInput();
        }

        $this->kamarService->updateKamar($pemilik->id_pemilik, $id, $validated);

        return redirect()->route('pemilik.kamar.index')
            ->with('success', 'Kamar berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;

        $this->kamarService->deleteKamar($pemilik->id_pemilik, $id);

        return redirect()->route('pemilik.kamar.index')
            ->with('success', 'Kamar berhasil dihapus!');
    }
}
