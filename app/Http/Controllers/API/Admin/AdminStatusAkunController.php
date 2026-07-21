<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Admin\UpdateStatusAkunRequest;
use App\Models\Pemilik;
use App\Models\Penghuni;
use App\Models\Notification;

class AdminStatusAkunController extends ApiController
{
    public function updateStatusPemilik(UpdateStatusAkunRequest $request, $id)
    {
        try {
            $pemilik = Pemilik::findOrFail($id);

            $pemilik->update(['status_pemilik' => $request->status]);
            $pemilik->user->update([
                'status_updated_at' => now(),
                'status_updated_by' => auth()->id(),
                'status_alasan' => $request->alasan,
            ]);

            Notification::create([
                'id_user' => $pemilik->user_id,
                'type' => 'status_akun',
                'title' => 'Status Akun Diperbarui',
                'body' => "Status akun Anda diubah menjadi {$request->status}." . ($request->alasan ? " Alasan: {$request->alasan}" : ''),
                'link' => url('/pemilik/profile'),
                'is_read' => false,
            ]);

            return $this->success($pemilik, 'Status pemilik berhasil diperbarui.');
        } catch (\Exception $e) {
            return $this->error('Gagal memperbarui status pemilik.', 500);
        }
    }

    public function updateStatusPenghuni(UpdateStatusAkunRequest $request, $id)
    {
        try {
            $penghuni = Penghuni::findOrFail($id);

            $penghuni->update(['status_penghuni' => $request->status]);
            $penghuni->user->update([
                'status_updated_at' => now(),
                'status_updated_by' => auth()->id(),
                'status_alasan' => $request->alasan,
            ]);

            Notification::create([
                'id_user' => $penghuni->user_id,
                'type' => 'status_akun',
                'title' => 'Status Akun Diperbarui',
                'body' => "Status akun Anda diubah menjadi {$request->status}." . ($request->alasan ? " Alasan: {$request->alasan}" : ''),
                'link' => url('/penghuni/profile'),
                'is_read' => false,
            ]);

            return $this->success($penghuni, 'Status penghuni berhasil diperbarui.');
        } catch (\Exception $e) {
            return $this->error('Gagal memperbarui status penghuni.', 500);
        }
    }
}
