<?php

namespace App\Http\Controllers\Web\Pemilik;

use App\Http\Controllers\Controller;
use App\Services\Review\ReviewService;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function __construct(
        protected ReviewService $reviewService
    ) {}

    public function index()
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;

        if (!$pemilik) {
            abort(403, 'Unauthorized');
        }

        $data = $this->reviewService->getPemilikReviews($pemilik->id_pemilik);

        return view('pemilik.reviews.index', [
            'reviews' => $data['reviews'],
            'overall_avg_rating' => $data['overallAvgRating'],
            'latest_review' => $data['latestReview'],
        ]);
    }
}
