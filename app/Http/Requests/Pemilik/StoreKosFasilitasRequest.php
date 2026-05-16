<?php

namespace App\Http\Requests\Pemilik;

use Illuminate\Foundation\Http\FormRequest;

class StoreKosFasilitasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_kos' => 'required|exists:kos,id_kos',
            'id_fasilitas' => 'required|exists:fasilitas,id_fasilitas',
            'jumlah' => 'nullable|integer|min:1',
            'keterangan' => 'nullable|string|max:255',
        ];
    }
}
