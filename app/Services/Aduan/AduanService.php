<?php

namespace App\Services\Aduan;

use App\Models\Aduan;
use App\Models\AduanKomentar;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AduanService
{
    public function getAduanList(array $filters = [])
    {
        $query = Aduan::with('pengirim');

        if (!empty($filters['status'])) {
            $query->byStatus($filters['status']);
        }
        if (!empty($filters['kategori'])) {
            $query->byKategori($filters['kategori']);
        }
        if (!empty($filters['role'])) {
            $query->byPengirimRole($filters['role']);
        }
        if (!empty($filters['pengirim_id'])) {
            $query->where('id_pengirim', $filters['pengirim_id']);
        }

        return $query->orderBy('created_at', 'desc')->paginate(10);
    }

    public function getAduanDetail(int $id): Aduan
    {
        return Aduan::with(['pengirim', 'komentar.pengirim'])->findOrFail($id);
    }

    public function createAduan(int $pengirimId, string $pengirimRole, array $data): Aduan
    {
        $lampiranPath = null;
        if (!empty($data['lampiran'])) {
            $file = $data['lampiran'];
            $fileName = 'aduan_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $lampiranPath = $file->storeAs('aduan', $fileName, 'public');
        }

        $aduan = Aduan::create([
            'id_pengirim' => $pengirimId,
            'pengirim_role' => $pengirimRole,
            'judul' => $data['judul'],
            'kategori' => $data['kategori'],
            'deskripsi' => $data['deskripsi'],
            'lampiran' => $lampiranPath,
            'status_aduan' => 'diajukan',
        ]);

        $this->notifyAdmins($aduan, 'aduan_baru');

        return $aduan;
    }

    public function updateStatus(int $aduanId, string $status, ?string $alasan = null): Aduan
    {
        $aduan = Aduan::findOrFail($aduanId);
        $oldStatus = $aduan->status_aduan;
        $aduan->update(['status_aduan' => $status]);

        if ($oldStatus !== $status) {
            $this->notifyPengirim($aduan, 'status_berubah');
        }

        return $aduan;
    }

    public function tambahKomentar(int $aduanId, int $pengirimId, array $data): AduanKomentar
    {
        $lampiranPath = null;
        if (!empty($data['lampiran'])) {
            $file = $data['lampiran'];
            $fileName = 'komentar_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $lampiranPath = $file->storeAs('aduan', $fileName, 'public');
        }

        $komentar = AduanKomentar::create([
            'id_aduan' => $aduanId,
            'id_pengirim' => $pengirimId,
            'isi' => $data['isi'],
            'lampiran' => $lampiranPath,
        ]);

        $aduan = Aduan::find($aduanId);

        if ($aduan && $aduan->id_pengirim !== $pengirimId) {
            $this->notifyPengirim($aduan, 'komentar_baru');
        } elseif ($aduan) {
            $this->notifyAdmins($aduan, 'komentar_baru');
        }

        return $komentar;
    }

    public function getStatistik(): array
    {
        return [
            'total' => Aduan::count(),
            'diajukan' => Aduan::where('status_aduan', 'diajukan')->count(),
            'ditinjau' => Aduan::where('status_aduan', 'ditinjau')->count(),
            'diproses' => Aduan::where('status_aduan', 'diproses')->count(),
            'selesai' => Aduan::where('status_aduan', 'selesai')->count(),
            'ditolak' => Aduan::where('status_aduan', 'ditolak')->count(),
            'perKategori' => Aduan::selectRaw('kategori, COUNT(*) as jumlah')
                ->groupBy('kategori')
                ->get(),
        ];
    }

    private function notifyAdmins(Aduan $aduan, string $event): void
    {
        try {
            $admins = User::where('role', 'admin')->get();
            $title = match ($event) {
                'aduan_baru' => 'Aduan Baru',
                'komentar_baru' => 'Komentar Baru pada Aduan',
                default => 'Pembaruan Aduan',
            };
            $body = match ($event) {
                'aduan_baru' => "Aduan \"{$aduan->judul}\" dari {$aduan->pengirim_role} telah diajukan.",
                'komentar_baru' => "Komentar baru pada aduan \"{$aduan->judul}\".",
                default => "Aduan \"{$aduan->judul}\" telah diperbarui.",
            };

            foreach ($admins as $admin) {
                Notification::create([
                    'id_user' => $admin->id,
                    'type' => 'aduan',
                    'title' => $title,
                    'body' => $body,
                    'link' => url("/admin/aduan/{$aduan->id_aduan}"),
                    'is_read' => false,
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Aduan notify admins error: ' . $e->getMessage());
        }
    }

    private function notifyPengirim(Aduan $aduan, string $event): void
    {
        try {
            $title = match ($event) {
                'status_berubah' => 'Status Aduan Berubah',
                'komentar_baru' => 'Komentar Baru',
                default => 'Pembaruan Aduan',
            };
            $body = match ($event) {
                'status_berubah' => "Status aduan \"{$aduan->judul}\" berubah menjadi {$aduan->status_aduan}.",
                'komentar_baru' => "Komentar baru pada aduan \"{$aduan->judul}\".",
                default => "Aduan \"{$aduan->judul}\" telah diperbarui.",
            };

            Notification::create([
                'id_user' => $aduan->id_pengirim,
                'type' => 'aduan',
                'title' => $title,
                'body' => $body,
                'link' => $aduan->pengirim_role === 'admin'
                    ? url("/admin/aduan/{$aduan->id_aduan}")
                    : url("/{$aduan->pengirim_role}/aduan/{$aduan->id_aduan}"),
                'is_read' => false,
            ]);
        } catch (\Exception $e) {
            Log::error('Aduan notify pengirim error: ' . $e->getMessage());
        }
    }
}
