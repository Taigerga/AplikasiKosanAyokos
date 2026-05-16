<?php

namespace App\Http\Controllers\API\Penghuni;

use App\Http\Controllers\API\ApiController;

use App\Http\Requests\Penghuni\StoreReviewRequest;
use App\Http\Requests\Penghuni\UpdateReviewRequest;
use App\Services\Review\ReviewService;
use App\Models\Kos;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenghuniReviewController extends ApiController
{
    public function __construct(
        protected ReviewService $reviewService
    ) {}

    public function index()
    {
        $penghuni = Auth::user()->penghuni;
        $reviews = $this->reviewService->getPenghuniReviewHistory($penghuni->id_penghuni);

        return $this->paginated($reviews);
    }

    public function show($id)
    {
        $review = Review::with('kos')->find($id);

        if (!$review || $review->id_penghuni != Auth::user()->penghuni->id_penghuni) {
            return $this->notFound('Review tidak ditemukan');
        }

        return $this->success($review);
    }

    public function create($kosId)
    {
        $penghuni = Auth::user()->penghuni;
        $kos = Kos::find($kosId);

        if (!$kos) {
            return $this->notFound('Kos tidak ditemukan');
        }

        $error = $this->reviewService->canReview($penghuni->id_penghuni, $kosId);
        if ($error) {
            return $this->error($error, 400);
        }

        return $this->success($kos);
    }

    public function store(StoreReviewRequest $request)
    {
        try {
            $review = $this->reviewService->createReview(
                Auth::user()->penghuni->id_penghuni,
                $request->validated()
            );

            return $this->created($review, 'Review berhasil ditambahkan');
        } catch (\Exception $e) {
            return $this->error('Gagal menambahkan review.', 500);
        }
    }

    public function update(UpdateReviewRequest $request, Review $review)
    {
        try {
            $review = $this->reviewService->updateReview(
                Auth::user()->penghuni->id_penghuni,
                $review,
                $request->validated()
            );

            return $this->success($review, 'Review berhasil diperbarui');
        } catch (\Exception $e) {
            return $this->error('Gagal memperbarui review.', 403);
        }
    }

    public function destroy(Review $review)
    {
        try {
            $this->reviewService->deleteReview(Auth::user()->penghuni->id_penghuni, $review);
            return $this->success(null, 'Review berhasil dihapus');
        } catch (\Exception $e) {
            return $this->error('Gagal menghapus review.', 403);
        }
    }

    public function history()
    {
        $penghuni = Auth::user()->penghuni;
        $reviews = $this->reviewService->getPenghuniReviewHistory($penghuni->id_penghuni);

        return $this->paginated($reviews);
    }
}
