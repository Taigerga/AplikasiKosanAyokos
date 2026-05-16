<?php

namespace App\Services\Kos;

use App\Models\Kos;
use App\Models\Fasilitas;
use Illuminate\Support\Facades\Storage;

class KosService
{
    public function getOwnerKos(int $pemilikId, ?string $search = null, int $perPage = 12)
    {
        $query = Kos::withCount('kamar')->where('id_pemilik', $pemilikId);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_kos', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%")
                    ->orWhere('kecamatan', 'like', "%{$search}%")
                    ->orWhere('kota', 'like', "%{$search}%");
            });
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function createKos(int $pemilikId, array $data): Kos
    {
        if (!empty($data['foto_utama'])) {
            $file = $data['foto_utama'];
            $filename = 'kos_' . time() . '.' . $file->getClientOriginalExtension();
            $data['foto_utama'] = $file->storeAs('kos', $filename, 'public');
        }

        $data['id_pemilik'] = $pemilikId;
        $data['status_kos'] = 'aktif';

        $fasilitasIds = $data['fasilitas'] ?? [];
        unset($data['fasilitas']);

        $kos = Kos::create($data);

        if (!empty($fasilitasIds)) {
            $kos->fasilitas()->attach($fasilitasIds);
        }

        return $kos->load('fasilitas');
    }

    public function updateKos(int $pemilikId, int $id, array $data): Kos
    {
        $kos = Kos::where('id_pemilik', $pemilikId)->findOrFail($id);

        if (!empty($data['foto_utama'])) {
            if ($kos->foto_utama && Storage::exists('public/' . $kos->foto_utama)) {
                Storage::delete('public/' . $kos->foto_utama);
            }
            $file = $data['foto_utama'];
            $filename = 'kos_' . time() . '.' . $file->getClientOriginalExtension();
            $data['foto_utama'] = $file->storeAs('kos', $filename, 'public');
        } else {
            unset($data['foto_utama']);
        }

        $fasilitasIds = $data['fasilitas'] ?? [];
        unset($data['fasilitas']);

        $kos->update($data);

        if (!empty($fasilitasIds)) {
            $kos->fasilitas()->sync($fasilitasIds);
        }

        return $kos->load('fasilitas');
    }

    public function deleteKos(int $pemilikId, int $id): void
    {
        $kos = Kos::where('id_pemilik', $pemilikId)->findOrFail($id);

        if ($kos->foto_utama && Storage::exists('public/' . $kos->foto_utama)) {
            Storage::delete('public/' . $kos->foto_utama);
        }

        $kos->delete();
    }

    public function getKosDetail(int $pemilikId, int $id): Kos
    {
        return Kos::with(['kamar', 'fasilitas', 'reviews.penghuni'])
            ->where('id_pemilik', $pemilikId)
            ->findOrFail($id);
    }

    public function getKosForEdit(int $pemilikId, int $id): Kos
    {
        return Kos::with('fasilitas')
            ->where('id_pemilik', $pemilikId)
            ->findOrFail($id);
    }

    public function getOwnerKosList(int $pemilikId)
    {
        return Kos::where('id_pemilik', $pemilikId)
            ->where('status_kos', 'aktif')
            ->get();
    }

    public function getAllFasilitas()
    {
        return Fasilitas::all();
    }

    public function getPublicKosWithFilters(array $filters, int $perPage = 12)
    {
        $query = Kos::with(['fasilitas', 'reviews'])->where('status_kos', 'aktif');

        if (!empty($filters['search'])) {
            $s = $filters['search'];
            $query->where(function ($q) use ($s) {
                $q->where('nama_kos', 'like', "%{$s}%")
                    ->orWhere('alamat', 'like', "%{$s}%")
                    ->orWhere('kecamatan', 'like', "%{$s}%")
                    ->orWhere('kota', 'like', "%{$s}%");
            });
        }

        if (!empty($filters['jenis_kos'])) {
            $query->where('jenis_kos', $filters['jenis_kos']);
        }

        if (!empty($filters['kota'])) {
            $query->where('kota', 'like', '%' . $filters['kota'] . '%');
        }

        if (!empty($filters['tipe_sewa'])) {
            $query->where('tipe_sewa', $filters['tipe_sewa']);
        }

        if (!empty($filters['ketersediaan'])) {
            if ($filters['ketersediaan'] === 'tersedia') {
                $query->whereHas('kamar', fn($q) => $q->where('status_kamar', 'tersedia'));
            } elseif ($filters['ketersediaan'] === 'penuh') {
                $query->whereDoesntHave('kamar', fn($q) => $q->where('status_kamar', 'tersedia'));
            }
        }

        $query->addSelect([
            'harga_terendah_tersedia' => \DB::table('kamar')
                ->selectRaw('MIN(harga)')
                ->whereColumn('kamar.id_kos', 'kos.id_kos')
                ->where('status_kamar', 'tersedia'),
            'kamar_tersedia_count' => \DB::table('kamar')
                ->selectRaw('COUNT(*)')
                ->whereColumn('kamar.id_kos', 'kos.id_kos')
                ->where('status_kamar', 'tersedia'),
            'total_kamar_count' => \DB::table('kamar')
                ->selectRaw('COUNT(*)')
                ->whereColumn('kamar.id_kos', 'kos.id_kos'),
            'harga_terendah_all' => \DB::table('kamar')
                ->selectRaw('MIN(harga)')
                ->whereColumn('kamar.id_kos', 'kos.id_kos'),
        ]);

        if (!empty($filters['min_harga'])) {
            $query->whereHas('kamar', fn($q) => $q->where('status_kamar', 'tersedia')->where('harga', '>=', $filters['min_harga']));
        }

        if (!empty($filters['max_harga'])) {
            $query->whereHas('kamar', fn($q) => $q->where('status_kamar', 'tersedia')->where('harga', '<=', $filters['max_harga']));
        }

        if (!empty($filters['min_rating'])) {
            $query->whereHas('reviews', function ($q) use ($filters) {
                $q->selectRaw('AVG(rating) as avg_rating, id_kos')
                    ->groupBy('id_kos')
                    ->having('avg_rating', '>=', $filters['min_rating']);
            }, '>=', 1);
        }

        if (!empty($filters['fasilitas'])) {
            $facilityIds = (array) $filters['fasilitas'];
            $query->whereHas('fasilitas', fn($q) => $q->whereIn('fasilitas.id_fasilitas', $facilityIds), '=', count($facilityIds));
        }

        $sort = $filters['sort'] ?? 'created_desc';
        switch ($sort) {
            case 'harga_asc':
                $query->orderByRaw('COALESCE(harga_terendah_all, 9999999999) ASC');
                break;
            case 'harga_desc':
                $query->orderByRaw('COALESCE(harga_terendah_all, 0) DESC');
                break;
            case 'rating_desc':
                $query->leftJoin('reviews', 'kos.id_kos', '=', 'reviews.id_kos')
                    ->addSelect(\DB::raw('COALESCE(AVG(reviews.rating), 0) as avg_rating'))
                    ->groupBy('kos.id_kos')
                    ->orderByDesc('avg_rating');
                break;
            case 'nama_asc':
                $query->orderBy('nama_kos', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        return $query->paginate($perPage)->withQueryString();
    }

    public function getPublicKosDetail(int $id): Kos
    {
        $kos = Kos::with([
            'fasilitas',
            'kamar' => fn($q) => $q->where('status_kamar', 'tersedia'),
            'reviews' => fn($q) => $q->with('penghuni')->orderBy('created_at', 'desc'),
        ])->where('status_kos', 'aktif')->findOrFail($id);

        $kos->total_kamar_count = $kos->kamar()->count();
        $kos->kamar_tersedia_count = $kos->kamar()->where('status_kamar', 'tersedia')->count();

        return $kos;
    }

    public function getSimilarKos(Kos $kos, int $limit = 2)
    {
        $similar = collect();

        $ownerKos = Kos::where('id_pemilik', $kos->id_pemilik)
            ->where('id_kos', '!=', $kos->id_kos)
            ->where('status_kos', 'aktif')
            ->with(['kamar' => fn($q) => $q->where('status_kamar', 'tersedia')])
            ->inRandomOrder()->limit($limit)->get();
        $similar = $similar->concat($ownerKos);

        if ($similar->count() < $limit) {
            $remaining = $limit - $similar->count();
            $byType = Kos::where('id_kos', '!=', $kos->id_kos)
                ->where('status_kos', 'aktif')
                ->where(fn($q) => $q->where('jenis_kos', $kos->jenis_kos)->orWhere('jenis_kos', 'campuran'))
                ->whereNotIn('id_kos', $similar->pluck('id_kos'))
                ->with(['kamar' => fn($q) => $q->where('status_kamar', 'tersedia')])
                ->inRandomOrder()->limit($remaining)->get();
            $similar = $similar->concat($byType);
        }

        if ($similar->count() < $limit) {
            $remaining = $limit - $similar->count();
            $byCity = Kos::where('id_kos', '!=', $kos->id_kos)
                ->where('status_kos', 'aktif')
                ->where('kota', $kos->kota)
                ->whereNotIn('id_kos', $similar->pluck('id_kos'))
                ->with(['kamar' => fn($q) => $q->where('status_kamar', 'tersedia')])
                ->inRandomOrder()->limit($remaining)->get();
            $similar = $similar->concat($byCity);
        }

        if ($similar->count() < $limit) {
            $remaining = $limit - $similar->count();
            $random = Kos::where('id_kos', '!=', $kos->id_kos)
                ->where('status_kos', 'aktif')
                ->whereNotIn('id_kos', $similar->pluck('id_kos'))
                ->with(['kamar' => fn($q) => $q->where('status_kamar', 'tersedia')])
                ->inRandomOrder()->limit($remaining)->get();
            $similar = $similar->concat($random);
        }

        return $similar;
    }

    public function getKosForMap()
    {
        return Kos::withCount(['kamar' => fn($q) => $q->where('status_kamar', 'tersedia')])
            ->with(['kamar' => fn($q) => $q->where('status_kamar', 'tersedia')->select('id_kos', 'harga', 'status_kamar')->orderBy('harga', 'asc')])
            ->where('status_kos', 'aktif')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get()
            ->map(function ($k) {
                $k->min_harga = $k->kamar->min('harga') ?? 0;
                return $k;
            });
    }

    public function getRecommendedKos(int $limit = 6)
    {
        return Kos::where('status_kos', 'aktif')
            ->withWhereHas('kamar', fn($q) => $q->where('status_kamar', 'tersedia')->where('harga', '>', 0))
            ->with(['kamar' => fn($q) => $q->where('status_kamar', 'tersedia')->where('harga', '>', 0)])
            ->with(['fasilitas', 'reviews'])
            ->limit($limit)
            ->get();
    }
}
