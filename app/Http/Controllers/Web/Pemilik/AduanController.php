<?php

namespace App\Http\Controllers\Web\Pemilik;

use App\Http\Controllers\Controller;
use App\Services\Aduan\AduanService;
use App\Http\Requests\Aduan\StoreAduanRequest;
use App\Http\Requests\Aduan\StoreKomentarRequest;
use Illuminate\Http\Request;

class AduanController extends Controller
{
    public function __construct(
        protected AduanService $aduanService
    ) {}

    public function index(Request $request)
    {
        $filters = array_merge(
            array_filter($request->only(['status', 'kategori'])),
            ['pengirim_id' => auth()->id(), 'role' => 'pemilik']
        );
        $aduans = $this->aduanService->getAduanList($filters);

        return view('pemilik.aduan.index', compact('aduans'));
    }

    public function create()
    {
        return view('pemilik.aduan.create');
    }

    public function store(StoreAduanRequest $request)
    {
        $this->aduanService->createAduan(auth()->id(), 'pemilik', $request->validated());

        return redirect()->route('pemilik.aduan.index')
            ->with('success', 'Aduan berhasil dikirim.');
    }

    public function show(int $id)
    {
        $aduan = $this->aduanService->getAduanDetail($id);

        if ($aduan->id_pengirim !== auth()->id()) {
            abort(403);
        }

        return view('pemilik.aduan.show', compact('aduan'));
    }

    public function tambahKomentar(StoreKomentarRequest $request, int $id)
    {
        $aduan = $this->aduanService->getAduanDetail($id);

        if ($aduan->id_pengirim !== auth()->id()) {
            abort(403);
        }

        $this->aduanService->tambahKomentar($id, auth()->id(), $request->validated());

        return redirect()->route('pemilik.aduan.show', $id)
            ->with('success', 'Komentar berhasil ditambahkan.');
    }
}
