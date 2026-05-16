<?php

namespace App\Http\Controllers\API\Penghuni;

use App\Http\Controllers\API\ApiController;

use App\Http\Requests\Profile\UpdatePenghuniProfileRequest;
use App\Http\Requests\Profile\UploadFotoProfilRequest;
use App\Http\Requests\Profile\ChangePasswordRequest;
use App\Services\Profile\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenghuniProfileController extends ApiController
{
    public function __construct(
        protected ProfileService $profileService
    ) {}

    public function show()
    {
        $data = $this->profileService->getPenghuniProfileData(Auth::id());
        return $this->success($data);
    }

    public function edit()
    {
        return $this->show();
    }

    public function update(UpdatePenghuniProfileRequest $request)
    {
        $result = $this->profileService->updatePenghuni(Auth::id(), $request->validated());

        return $this->success($result, 'Profil berhasil diperbarui');
    }

    public function uploadPhoto(UploadFotoProfilRequest $request)
    {
        $result = $this->profileService->uploadPhotoPenghuni(Auth::id(), $request->file('foto_profil'));

        return $this->success($result, 'Foto profil berhasil diupload');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            $this->profileService->changePassword(Auth::id(), $request->password_lama, $request->password);

            return $this->success(null, 'Password berhasil diubah');
        } catch (\InvalidArgumentException $e) {
            return $this->validationError(['password_lama' => $e->getMessage()]);
        }
    }
}
