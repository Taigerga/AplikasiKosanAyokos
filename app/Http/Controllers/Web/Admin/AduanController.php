<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Services\Aduan\AduanService;
use App\Http\Requests\Aduan\StoreKomentarRequest;
use Illuminate\Http\Request;

class AduanController extends Controller
{
    public function __construct(
        protected AduanService $aduanService
    ) {}

    public function index(Request $request)
    {
        $filters = array_filter($request->only(['status', 'kategori', 'role']));
        $aduans = $this->aduanService->getAduanList($filters);
        $statistik = $this->aduanService->getStatistik();
        $kategoris = \App\Models\Aduan::distinct()->pluck('kategori');

        return view('admin.aduan.index', compact('aduans', 'statistik', 'kategoris'));
    }

    public function show(int $id)
    {
        $aduan = $this->aduanService->getAduanDetail($id);
        return view('admin.aduan.show', compact('aduan'));
    }

    public function updateStatus(Request $request, int $id)
    {
        $request->validate(['status' => 'required|string|in:diajukan,ditinjau,diproses,menunggu_info,selesai,ditolak,ditutup']);

        $this->aduanService->updateStatus($id, $request->status, $request->alasan);

        return redirect()->route('admin.aduan.show', $id)
            ->with('success', 'Status aduan berhasil diperbarui.');
    }

    public function tambahKomentar(StoreKomentarRequest $request, int $id)
    {
        $this->aduanService->tambahKomentar($id, auth()->id(), $request->validated());

        return redirect()->route('admin.aduan.show', $id)
            ->with('success', 'Komentar berhasil ditambahkan.');
    }
}
