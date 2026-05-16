<?php

namespace App\Http\Requests\Pemilik;

use Illuminate\Foundation\Http\FormRequest;

class StorePengaturanKosRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_kos' => 'required|exists:kos,id_kos|unique:pengaturan_kos,id_kos',
            'aturan_checkin' => 'nullable|string',
            'aturan_checkout' => 'nullable|string',
            'jam_bertamu' => 'nullable|string',
            'kebijakan_batal' => 'nullable|string',
        ];
    }
}
