<?php

namespace App\Http\Requests\Aduan;

use Illuminate\Foundation\Http\FormRequest;

class StoreAduanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|in:kebersihan,fasilitas,keamanan,kebisingan,administrasi,pembayaran,penyewa_lain,pemilik_kos,lainnya',
            'deskripsi' => 'required|string|min:10|max:5000',
            'lampiran' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf,doc,docx|max:5120',
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required' => 'Judul aduan wajib diisi.',
            'kategori.required' => 'Kategori aduan wajib dipilih.',
            'kategori.in' => 'Kategori aduan tidak valid.',
            'deskripsi.required' => 'Deskripsi aduan wajib diisi.',
            'deskripsi.min' => 'Deskripsi aduan minimal 10 karakter.',
            'lampiran.max' => 'Ukuran lampiran maksimal 5MB.',
        ];
    }
}
