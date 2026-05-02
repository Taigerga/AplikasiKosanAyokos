<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['kos', 'penghuni', 'kontrak'])->get();
        return response()->json(['success' => true, 'data' => $reviews]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kos' => 'required|exists:kos,id_kos',
            'id_penghuni' => 'required|exists:penghuni,id_penghuni',
            'id_kontrak' => 'required|exists:kontrak_sewa,id_kontrak',
            'rating' => 'required|numeric|min:1|max:5',
            'komentar' => 'nullable|string',
            'foto_review' => 'nullable|string|max:255'
        ]);

        $review = Review::create($validated);
        return response()->json(['success' => true, 'data' => $review, 'message' => 'Review created successfully'], 201);
    }

    public function show($id)
    {
        $review = Review::with(['kos', 'penghuni', 'kontrak'])->findOrFail($id);
        return response()->json(['success' => true, 'data' => $review]);
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        $validated = $request->validate([
            'rating' => 'sometimes|numeric|min:1|max:5',
            'komentar' => 'nullable|string',
            'foto_review' => 'nullable|string|max:255'
        ]);

        $review->update($validated);
        return response()->json(['success' => true, 'data' => $review, 'message' => 'Review updated successfully']);
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();
        return response()->json(['success' => true, 'message' => 'Review deleted successfully']);
    }
}
