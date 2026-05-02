<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemilikReviewController extends Controller
{
    public function index()
    {
        $pemilik = Auth::user();

        $reviews = Review::with(['penghuni', 'kos', 'kontrak'])
            ->whereHas('kos', function($query) use ($pemilik) {
                $query->where('id_pemilik', $pemilik->id_pemilik);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['success' => true, 'data' => $reviews]);
    }

    public function show($id)
    {
        $pemilik = Auth::user();

        $review = Review::with(['penghuni', 'kos', 'kontrak'])
            ->whereHas('kos', function($query) use ($pemilik) {
                $query->where('id_pemilik', $pemilik->id_pemilik);
            })
            ->findOrFail($id);

        return response()->json(['success' => true, 'data' => $review]);
    }
}
