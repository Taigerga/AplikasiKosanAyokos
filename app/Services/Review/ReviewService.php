<?php

namespace App\Services\Review;

use App\Models\Review;
use App\Models\Kos;
use App\Models\KontrakSewa;
use Illuminate\Support\Facades\Storage;

class ReviewService
{
    public function getPemilikReviews(int $pemilikId)
    {
        $kosIds = Kos::where('id_pemilik', $pemilikId)->pluck('id_kos');

        $reviews = Review::with(['kos', 'penghuni'])
            ->whereIn('id_kos', $kosIds)
            ->orderBy('created_at', 'desc')
            ->paginate(2);

        $overallAvgRating = Review::whereIn('id_kos', $kosIds)->avg('rating');
        $latestReview = Review::whereIn('id_kos', $kosIds)->latest()->first();

        return compact('reviews', 'overallAvgRating', 'latestReview');
    }

    public function canReview(int $penghuniId, int $idKos): ?string
    {
        $existingReview = Review::where('id_penghuni', $penghuniId)
            ->where('id_kos', $idKos)->first();

        if ($existingReview) {
            return 'Anda sudah memberikan review untuk kos ini.';
        }

        $hasContract = KontrakSewa::where('id_penghuni', $penghuniId)
            ->where('id_kos', $idKos)
            ->whereIn('status_kontrak', ['aktif', 'selesai'])
            ->exists();

        if (!$hasContract) {
            return 'Hanya penghuni yang pernah menyewa di kos ini yang bisa memberikan review.';
        }

        return null;
    }

    public function createReview(int $penghuniId, array $data): Review
    {
        $kontrak = KontrakSewa::where('id_penghuni', $penghuniId)
            ->where('id_kos', $data['id_kos'])
            ->whereIn('status_kontrak', ['aktif', 'selesai'])
            ->firstOrFail();

        $fotoPath = null;
        if (!empty($data['foto_review'])) {
            $file = $data['foto_review'];
            $filename = 'review_' . time() . '.' . $file->getClientOriginalExtension();
            $fotoPath = $file->storeAs('reviews', $filename, 'public');
        }

        return Review::create([
            'id_kos' => $data['id_kos'],
            'id_penghuni' => $penghuniId,
            'id_kontrak' => $kontrak->id_kontrak,
            'rating' => $data['rating'],
            'komentar' => $data['komentar'],
            'foto_review' => $fotoPath,
        ]);
    }

    public function updateReview(int $penghuniId, Review $review, array $data): Review
    {
        if ($review->id_penghuni != $penghuniId) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit review ini.');
        }

        $fotoPath = $review->foto_review;

        if (!empty($data['hapus_foto'])) {
            if ($fotoPath && Storage::disk('public')->exists($fotoPath)) {
                Storage::disk('public')->delete($fotoPath);
            }
            $fotoPath = null;
        } elseif (!empty($data['foto_review'])) {
            if ($fotoPath && Storage::disk('public')->exists($fotoPath)) {
                Storage::disk('public')->delete($fotoPath);
            }
            $file = $data['foto_review'];
            $filename = 'review_' . time() . '_' . $review->id_review . '.' . $file->getClientOriginalExtension();
            $fotoPath = $file->storeAs('reviews', $filename, 'public');
        }

        $review->update([
            'rating' => $data['rating'],
            'komentar' => $data['komentar'],
            'foto_review' => $fotoPath,
        ]);

        return $review;
    }

    public function deleteReview(int $penghuniId, Review $review): void
    {
        if ($review->id_penghuni != $penghuniId) {
            abort(403, 'Anda tidak memiliki izin untuk menghapus review ini.');
        }

        if ($review->foto_review && Storage::disk('public')->exists($review->foto_review)) {
            Storage::disk('public')->delete($review->foto_review);
        }

        $review->delete();
    }

    public function getPenghuniReviewHistory(int $penghuniId)
    {
        return Review::with('kos')
            ->where('id_penghuni', $penghuniId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }
}
