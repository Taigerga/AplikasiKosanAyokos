<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use App\Models\Kamar;
use App\Models\Fasilitas;
use App\Models\Review;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {
        // Featured kos
        $featuredKos = Kos::with(['kamar', 'fasilitas'])
            ->where('status_kos', 'aktif')
            ->limit(6)
            ->get();

        // Total statistics
        $totalKos = Kos::where('status_kos', 'aktif')->count();
        $totalKamar = Kamar::whereHas('kos', function($query) {
            $query->where('status_kos', 'aktif');
        })->count();
        $totalKamarTersedia = Kamar::where('status_kamar', 'tersedia')
            ->whereHas('kos', function($query) {
                $query->where('status_kos', 'aktif');
            })->count();

        // Latest reviews
        $latestReviews = Review::with(['kos', 'penghuni'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'featured_kos' => $featuredKos,
                'stats' => [
                    'total_kos' => $totalKos,
                    'total_kamar' => $totalKamar,
                    'total_kamar_tersedia' => $totalKamarTersedia
                ],
                'latest_reviews' => $latestReviews
            ]
        ]);
    }

    public function kosIndex(Request $request)
    {
        $query = Kos::with(['kamar', 'fasilitas'])
            ->where('status_kos', 'aktif');

        if ($request->has('q')) {
            $query->where(function($q) use ($request) {
                $q->where('nama_kos', 'like', '%' . $request->q . '%')
                  ->orWhere('alamat', 'like', '%' . $request->q . '%')
                  ->orWhere('kecamatan', 'like', '%' . $request->q . '%')
                  ->orWhere('kota', 'like', '%' . $request->q . '%');
            });
        }

        if ($request->has('jenis_kos')) {
            $query->where('jenis_kos', $request->jenis_kos);
        }

        if ($request->has('tipe_sewa')) {
            $query->where('tipe_sewa', $request->tipe_sewa);
        }

        if ($request->has('harga_min')) {
            $query->whereHas('kamar', function($q) use ($request) {
                $q->where('harga', '>=', $request->harga_min);
            });
        }

        if ($request->has('harga_max')) {
            $query->whereHas('kamar', function($q) use ($request) {
                $q->where('harga', '<=', $request->harga_max);
            });
        }

        $kos = $query->paginate(10);

        return response()->json(['success' => true, 'data' => $kos]);
    }

    public function kosShow($id)
    {
        $kos = Kos::with(['kamar', 'fasilitas', 'reviews.penghuni', 'pemilik'])
            ->where('status_kos', 'aktif')
            ->findOrFail($id);

        // Average rating
        $averageRating = $kos->reviews()->avg('rating');

        return response()->json([
            'success' => true,
            'data' => [
                'kos' => $kos,
                'average_rating' => round($averageRating, 1),
                'total_reviews' => $kos->reviews()->count()
            ]
        ]);
    }

    public function peta(Request $request)
    {
        $query = Kos::with(['kamar'])
            ->where('status_kos', 'aktif')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude');

        if ($request->has('kota')) {
            $query->where('kota', $request->kota);
        }

        $kos = $query->get();

        return response()->json(['success' => true, 'data' => $kos]);
    }

    public function about()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'title' => 'About Ayokos',
                'content' => 'Ayokos adalah platform pencarian kos terbaik di Indonesia.'
            ]
        ]);
    }

    public function howto()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'title' => 'How to Use Ayokos',
                'content' => 'Cara menggunakan Ayokos: 1. Cari kos, 2. Pilih kamar, 3. Ajukan kontrak, 4. Bayar, 5. Tinggal.'
            ]
        ]);
    }

    public function terms()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'title' => 'Terms and Conditions',
                'content' => 'Syarat dan ketentuan penggunaan Ayokos.'
            ]
        ]);
    }

    public function privacy()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'title' => 'Privacy Policy',
                'content' => 'Kebijakan privasi Ayokos.'
            ]
        ]);
    }
}
