<?php

namespace App\Http\Requests\Aduan;

use Illuminate\Foundation\Http\FormRequest;

class StoreKomentarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'isi' => 'required|string|min:1|max:5000',
            'lampiran' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'isi.required' => 'Isi komentar wajib diisi.',
            'lampiran.max' => 'Ukuran lampiran maksimal 5MB.',
        ];
    }
}
