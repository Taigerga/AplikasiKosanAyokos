<?php

namespace App\Services\Kamar;

use App\Models\Kamar;
use App\Models\Kos;
use Illuminate\Support\Facades\Storage;

class KamarService
{
    public function getOwnerKamar(int $pemilikId, array $filters = [], int $perPage = 10)
    {
        $query = Kamar::with('kos')->whereHas('kos', fn($q) => $q->where('id_pemilik', $pemilikId));

        if (!empty($filters['kos'])) {
            $query->where('id_kos', $filters['kos']);
        }
        if (!empty($filters['status'])) {
            $query->where('status_kamar', $filters['status']);
        }
        if (!empty($filters['tipe'])) {
            $query->where('tipe_kamar', $filters['tipe']);
        }

        $stats = [
            'total_kamar' => (clone $query)->count(),
            'tersedia' => (clone $query)->where('status_kamar', 'tersedia')->count(),
            'terisi' => (clone $query)->where('status_kamar', 'terisi')->count(),
            'maintenance' => (clone $query)->where('status_kamar', 'maintenance')->count(),
        ];

        $kamar = $query->orderBy('created_at', 'desc')->paginate($perPage);

        return compact('kamar', 'stats');
    }

    public function createKamar(array $data): Kamar
    {
        if (!empty($data['foto_kamar'])) {
            $file = $data['foto_kamar'];
            $filename = 'kamar_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('kamar', $filename, 'public');
            $data['foto_kamar'] = str_replace('\\', '/', $path);
        }

        if (isset($data['fasilitas_kamar']) && is_array($data['fasilitas_kamar'])) {
            $data['fasilitas_kamar'] = json_encode($data['fasilitas_kamar']);
        } elseif (!isset($data['fasilitas_kamar'])) {
            $data['fasilitas_kamar'] = null;
        }

        return Kamar::create($data);
    }

    public function updateKamar(int $pemilikId, int $id, array $data): Kamar
    {
        $kamar = Kamar::whereHas('kos', fn($q) => $q->where('id_pemilik', $pemilikId))
            ->findOrFail($id);

        if (!empty($data['foto_kamar'])) {
            if ($kamar->foto_kamar && Storage::exists('public/' . $kamar->foto_kamar)) {
                Storage::delete('public/' . $kamar->foto_kamar);
            }
            $file = $data['foto_kamar'];
            $filename = 'kamar_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('kamar', $filename, 'public');
            $data['foto_kamar'] = str_replace('\\', '/', $path);
        } else {
            unset($data['foto_kamar']);
        }

        if (isset($data['fasilitas_kamar']) && is_array($data['fasilitas_kamar'])) {
            $data['fasilitas_kamar'] = json_encode($data['fasilitas_kamar']);
        }

        $kamar->update($data);

        return $kamar;
    }

    public function deleteKamar(int $pemilikId, int $id): void
    {
        $kamar = Kamar::whereHas('kos', fn($q) => $q->where('id_pemilik', $pemilikId))
            ->findOrFail($id);

        if ($kamar->foto_kamar && Storage::exists('public/' . $kamar->foto_kamar)) {
            Storage::delete('public/' . $kamar->foto_kamar);
        }

        $kamar->delete();
    }

    public function isNomorKamarUnique(int $idKos, string $nomorKamar, ?int $excludeId = null): bool
    {
        $query = Kamar::where('id_kos', $idKos)->where('nomor_kamar', $nomorKamar);
        if ($excludeId) {
            $query->where('id_kamar', '!=', $excludeId);
        }
        return !$query->exists();
    }

    public function findKamar(int $pemilikId, int $id): Kamar
    {
        return Kamar::whereHas('kos', fn($q) => $q->where('id_pemilik', $pemilikId))
            ->findOrFail($id);
    }
}
