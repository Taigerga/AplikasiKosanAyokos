<?php

namespace App\Http\Requests\Pemilik;

use Illuminate\Foundation\Http\FormRequest;

class StoreKamarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_kos' => 'required|exists:kos,id_kos',
            'nomor_kamar' => 'required|string|max:10',
            'tipe_kamar' => 'required|in:Standar,Deluxe,VIP,Superior,Ekonomi',
            'harga' => 'required|numeric|min:0',
            'luas_kamar' => 'required|string|max:20',
            'kapasitas' => 'required|integer|min:1',
            'fasilitas_kamar' => 'nullable|array',
            'foto_kamar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status_kamar' => 'required|in:tersedia,terisi,maintenance',
        ];
    }
}
