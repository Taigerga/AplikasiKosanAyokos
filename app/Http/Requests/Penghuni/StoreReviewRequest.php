<?php

namespace App\Http\Requests\Penghuni;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_kos' => 'required|exists:kos,id_kos',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'required|string|min:10|max:1000',
            'foto_review' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
