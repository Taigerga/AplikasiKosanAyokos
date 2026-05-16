<?php

namespace App\Http\Controllers\API\Public;

use App\Http\Controllers\API\ApiController;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends ApiController
{
    public function index(Request $request)
    {
        $query = Review::with(['penghuni', 'kos']);

        if ($request->filled('id_kos')) {
            $query->where('id_kos', $request->id_kos);
        }

        return $this->paginated($query->orderBy('created_at', 'desc')->paginate(10));
    }

    public function show($id)
    {
        $review = Review::with(['penghuni', 'kos'])->find($id);

        if (!$review) {
            return $this->notFound('Review tidak ditemukan');
        }

        return $this->success($review);
    }
}
