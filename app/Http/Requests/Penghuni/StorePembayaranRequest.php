<?php

namespace App\Http\Requests\Penghuni;

use Illuminate\Foundation\Http\FormRequest;

class StorePembayaranRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_kontrak' => 'required|exists:kontrak_sewa,id_kontrak',
            'jumlah_waktu' => 'required|integer|min:1',
            'metode_pembayaran' => 'required|in:transfer,qris',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ];
    }
}
