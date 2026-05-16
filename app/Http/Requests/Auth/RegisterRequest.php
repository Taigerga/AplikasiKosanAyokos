<?php

namespace App\Http\Requests\Auth;

use App\Services\Auth\AuthService;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('role')) {
            $this->merge(['role' => 'penghuni']);
        }
    }

    public function rules(): array
    {
        return [
            ...AuthService::validationRules($this->input('role', 'penghuni')),
            'role' => 'required|in:penghuni,pemilik',
        ];
    }

    public function messages(): array
    {
        return [
            'tanggal_lahir.before_or_equal' => 'Umur tidak boleh kurang dari 17 tahun.',
            'username.unique' => 'Username sudah digunakan.',
        ];
    }
}
