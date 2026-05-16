<?php

namespace App\Http\Requests\Pemilik;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKosRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_kos' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kecamatan' => 'required|string|max:100',
            'kota' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
            'deskripsi' => 'nullable|string',
            'peraturan' => 'nullable|string',
            'jenis_kos' => 'required|in:putra,putri,campuran',
            'tipe_sewa' => 'required|in:harian,mingguan,bulanan,tahunan',
            'status_kos' => 'required|in:aktif,nonaktif,pending',
            'foto_utama' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'fasilitas' => 'nullable|array',
            'fasilitas.*' => 'exists:fasilitas,id_fasilitas',
        ];
    }
}
