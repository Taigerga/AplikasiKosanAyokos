<?php

namespace App\Http\Controllers\API\Pemilik;

use App\Http\Controllers\API\ApiController;

use App\Services\Review\ReviewService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemilikReviewController extends ApiController
{
    public function __construct(
        protected ReviewService $reviewService
    ) {}

    public function index()
    {
        $pemilik = Auth::user()->pemilik;

        if (!$pemilik) {
            return $this->forbidden();
        }

        $data = $this->reviewService->getPemilikReviews($pemilik->id_pemilik);

        return $this->success([
            'reviews' => $data['reviews']->items(),
            'overall_avg_rating' => $data['overallAvgRating'],
            'latest_review' => $data['latestReview'],
            'meta' => [
                'current_page' => $data['reviews']->currentPage(),
                'last_page' => $data['reviews']->lastPage(),
                'total' => $data['reviews']->total(),
            ],
        ]);
    }

    public function store(Request $request)
    {
        return $this->error('Use create review via Penghuni endpoint.', 400);
    }

    public function update(Request $request, $id)
    {
        return $this->error('Use update review via Penghuni endpoint.', 400);
    }

    public function destroy($id)
    {
        return $this->error('Use delete review via Penghuni endpoint.', 400);
    }

    public function show($id)
    {
        $review = \App\Models\Review::with(['kos', 'penghuni'])->find($id);
        if (!$review) {
            return $this->notFound('Review tidak ditemukan');
        }
        return $this->success($review);
    }
}
