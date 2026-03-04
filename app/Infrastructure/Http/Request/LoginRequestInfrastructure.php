<?php

namespace App\Infrastructure\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequestInfrastructure extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'no_whatsapp' => 'required|integer',
            'password' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'no_whatsapp.required' => 'Nomor WhatsApp wajib di isi',
            'password.required' => 'Password wajib di isi'
        ];
    }
}
