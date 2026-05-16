<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdatePenghuniProfileRequest;
use App\Http\Requests\Profile\UpdatePemilikProfileRequest;
use App\Http\Requests\Profile\UploadFotoProfilRequest;
use App\Services\Profile\ProfileService;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct(
        protected ProfileService $profileService
    ) {}

    // ==================== PENGHUNI ====================

    public function showPenghuni()
    {
        $data = $this->profileService->getPenghuniProfileData(Auth::id());

        return view('penghuni.profile.show', $data);
    }

    public function editPenghuni()
    {
        $user = Auth::user();
        $penghuni = $user->penghuni;

        return view('penghuni.profile.edit', compact('penghuni', 'user'));
    }

    public function updatePenghuni(UpdatePenghuniProfileRequest $request)
    {
        $this->profileService->updatePenghuni(Auth::id(), $request->validated());

        return redirect()->route('penghuni.profile.show')
            ->with('success', 'Profil berhasil diperbarui!');
    }

    public function uploadPhotoPenghuni(UploadFotoProfilRequest $request)
    {
        $this->profileService->uploadPhotoPenghuni(Auth::id(), $request->file('foto_profil'));

        return redirect()->route('penghuni.profile.show')
            ->with('success', 'Foto profil berhasil diupload');
    }

    // ==================== PEMILIK ====================

    public function showPemilik()
    {
        $data = $this->profileService->getPemilikProfileData(Auth::id());

        return view('pemilik.profile.show', $data);
    }

    public function editPemilik()
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;

        return view('pemilik.profile.edit', compact('pemilik', 'user'));
    }

    public function updatePemilik(UpdatePemilikProfileRequest $request)
    {
        $this->profileService->updatePemilik(Auth::id(), $request->validated());

        return redirect()->route('pemilik.profile.show')
            ->with('success', 'Profil berhasil diperbarui!');
    }

    public function uploadPhotoPemilik(UploadFotoProfilRequest $request)
    {
        $this->profileService->uploadPhotoPemilik(Auth::id(), $request->file('foto_profil'));

        return redirect()->route('pemilik.profile.show')
            ->with('success', 'Foto profil berhasil diupload');
    }
}
