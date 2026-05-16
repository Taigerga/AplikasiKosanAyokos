<?php

namespace App\Http\Controllers\Web\Pemilik;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pemilik\StoreKosRequest;
use App\Http\Requests\Pemilik\UpdateKosRequest;
use App\Services\Kos\KosService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KosController extends Controller
{
    public function __construct(
        protected KosService $kosService
    ) {}

    public function index(Request $request)
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;
        $kos = $this->kosService->getOwnerKos($pemilik->id_pemilik, $request->search, 12);

        return view('pemilik.kos.index', compact('kos', 'user'));
    }

    public function create()
    {
        $fasilitas = $this->kosService->getAllFasilitas();
        return view('pemilik.kos.create', compact('fasilitas'));
    }

    public function store(StoreKosRequest $request)
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;

        $this->kosService->createKos($pemilik->id_pemilik, $request->validated());

        return redirect()->route('pemilik.kos.index')
            ->with('success', 'Kos berhasil ditambahkan!');
    }

    public function show($id)
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;
        $kos = $this->kosService->getKosDetail($pemilik->id_pemilik, $id);

        return view('pemilik.kos.show', compact('kos', 'user'));
    }

    public function edit($id)
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;
        $kos = $this->kosService->getKosForEdit($pemilik->id_pemilik, $id);
        $fasilitas = $this->kosService->getAllFasilitas();

        return view('pemilik.kos.edit', compact('kos', 'fasilitas', 'user'));
    }

    public function update(UpdateKosRequest $request, $id)
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;

        $this->kosService->updateKos($pemilik->id_pemilik, $id, $request->validated());

        return redirect()->route('pemilik.kos.index')
            ->with('success', 'Kos berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;

        $this->kosService->deleteKos($pemilik->id_pemilik, $id);

        return redirect()->route('pemilik.kos.index')
            ->with('success', 'Kos berhasil dihapus!');
    }
}
