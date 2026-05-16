<?php

namespace App\Http\Controllers\Web\Penghuni;

use App\Http\Controllers\Controller;
use App\Http\Requests\Penghuni\StoreReviewRequest;
use App\Http\Requests\Penghuni\UpdateReviewRequest;
use App\Services\Review\ReviewService;
use App\Models\Kos;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function __construct(
        protected ReviewService $reviewService
    ) {}

    public function create(Kos $kos)
    {
        $penghuni = Auth::user()->penghuni;

        $error = $this->reviewService->canReview($penghuni->id_penghuni, $kos->id_kos);
        if ($error) {
            return redirect()->route('public.kos.show', $kos->id_kos)
                ->with('warning', $error);
        }

        return view('penghuni.reviews.create', compact('kos'));
    }

    public function store(StoreReviewRequest $request)
    {
        try {
            $this->reviewService->createReview(
                Auth::user()->penghuni->id_penghuni,
                $request->validated()
            );

            return redirect()->route('penghuni.reviews.history')
                ->with('success', 'Review berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit(Review $review)
    {
        $penghuni = Auth::user()->penghuni;
        if ($review->id_penghuni != $penghuni->id_penghuni) {
            abort(403, 'Anda tidak memiliki izin untuk mengedit review ini.');
        }

        return view('penghuni.reviews.edit', compact('review'));
    }

    public function update(UpdateReviewRequest $request, Review $review)
    {
        try {
            $this->reviewService->updateReview(
                Auth::user()->penghuni->id_penghuni,
                $review,
                $request->validated()
            );

            return redirect()->route('penghuni.reviews.history')
                ->with('success', 'Review berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Review $review)
    {
        $this->reviewService->deleteReview(Auth::user()->penghuni->id_penghuni, $review);

        return redirect()->route('penghuni.reviews.history')
            ->with('success', 'Review berhasil dihapus.');
    }

    public function history()
    {
        $reviews = $this->reviewService->getPenghuniReviewHistory(
            Auth::user()->penghuni->id_penghuni
        );

        return view('penghuni.reviews.history', compact('reviews'));
    }
}
