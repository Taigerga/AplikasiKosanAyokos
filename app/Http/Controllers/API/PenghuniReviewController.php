<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\KontrakSewa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenghuniReviewController extends Controller
{
    public function index()
    {
        $penghuni = Auth::user();

        $reviews = Review::with(['kos', 'kontrak'])
            ->where('id_penghuni', $penghuni->id_penghuni)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['success' => true, 'data' => $reviews]);
    }

    public function create(Request $request, $kosId)
    {
        $penghuni = Auth::user();

        // Check if penghuni has active contract with this kos
        $kontrak = KontrakSewa::where('id_penghuni', $penghuni->id_penghuni)
            ->where('id_kos', $kosId)
            ->where('status_kontrak', 'aktif')
            ->first();

        if (!$kontrak) {
            return response()->json([
                'success' => false,
                'message' => 'You must have an active contract with this kos to review'
            ], 422);
        }

        // Check if already reviewed
        $existingReview = Review::where('id_penghuni', $penghuni->id_penghuni)
            ->where('id_kos', $kosId)
            ->where('id_kontrak', $kontrak->id_kontrak)
            ->first();

        if ($existingReview) {
            return response()->json([
                'success' => false,
                'message' => 'You have already reviewed this kos for this contract'
            ], 422);
        }

        $kos = \App\Models\Kos::with('kamar')->findOrFail($kosId);

        return response()->json([
            'success' => true,
            'data' => [
                'kos' => $kos,
                'kontrak' => $kontrak
            ]
        ]);
    }

    public function store(Request $request)
    {
        $penghuni = Auth::user();

        $validated = $request->validate([
            'id_kos' => 'required|exists:kos,id_kos',
            'id_kontrak' => 'required|exists:kontrak_sewa,id_kontrak',
            'rating' => 'required|numeric|min:1|max:5',
            'komentar' => 'nullable|string',
            'foto_review' => 'nullable|string|max:255'
        ]);

        // Verify kontrak belongs to penghuni
        $kontrak = KontrakSewa::where('id_penghuni', $penghuni->id_penghuni)
            ->where('id_kontrak', $validated['id_kontrak'])
            ->firstOrFail();

        $validated['id_penghuni'] = $penghuni->id_penghuni;

        $review = Review::create($validated);

        return response()->json([
            'success' => true,
            'data' => $review,
            'message' => 'Review created successfully'
        ], 201);
    }

    public function edit($id)
    {
        $penghuni = Auth::user();

        $review = Review::where('id_penghuni', $penghuni->id_penghuni)
            ->findOrFail($id);

        return response()->json(['success' => true, 'data' => $review]);
    }

    public function update(Request $request, $id)
    {
        $penghuni = Auth::user();

        $review = Review::where('id_penghuni', $penghuni->id_penghuni)
            ->findOrFail($id);

        $validated = $request->validate([
            'rating' => 'sometimes|numeric|min:1|max:5',
            'komentar' => 'nullable|string',
            'foto_review' => 'nullable|string|max:255'
        ]);

        $review->update($validated);

        return response()->json([
            'success' => true,
            'data' => $review,
            'message' => 'Review updated successfully'
        ]);
    }

    public function destroy($id)
    {
        $penghuni = Auth::user();

        $review = Review::where('id_penghuni', $penghuni->id_penghuni)
            ->findOrFail($id);

        $review->delete();

        return response()->json(['success' => true, 'message' => 'Review deleted successfully']);
    }

    public function history()
    {
        $penghuni = Auth::user();

        $reviews = Review::with(['kos', 'kontrak'])
            ->where('id_penghuni', $penghuni->id_penghuni)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['success' => true, 'data' => $reviews]);
    }
}
