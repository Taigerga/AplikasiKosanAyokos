<?php

namespace App\Http\Requests\Pemilik;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePengaturanKosRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'aturan_checkin' => 'nullable|string',
            'aturan_checkout' => 'nullable|string',
            'jam_bertamu' => 'nullable|string',
            'kebijakan_batal' => 'nullable|string',
        ];
    }
}
