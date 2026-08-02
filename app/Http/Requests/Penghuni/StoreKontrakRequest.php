<?php

namespace App\Http\Requests\Penghuni;

use Illuminate\Foundation\Http\FormRequest;

class StoreKontrakRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_kos' => 'required|exists:kos,id_kos',
            'id_kamar' => 'required|exists:kamar,id_kamar',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'durasi_sewa' => 'required|integer|min:1',
            'tanggal_mulai' => 'required|date|after_or_equal:today',
        ];
    }
}
