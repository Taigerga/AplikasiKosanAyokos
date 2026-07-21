<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStatusAkunRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => 'required|string|in:aktif,nonaktif,dibatasi,diblokir',
            'alasan' => 'required_if:status,dibatasi,diblokir|string|max:1000|nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'status.required' => 'Status akun wajib dipilih.',
            'status.in' => 'Status akun tidak valid.',
            'alasan.required_if' => 'Alasan wajib diisi saat membatasi atau memblokir akun.',
        ];
    }
}
