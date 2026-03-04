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
            'nama_lengkap' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'no_whatsapp' => 'required|integer',
            'password' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_lengkap.required' => 'Nama lengkap wajib di isi',
            'email.required' => 'Email wajib di isi',
            'email.unique' => 'Email sudah terdaftar',
            'no_whatsapp.required' => 'Nomor WhatsApp wajib di isi',
            'password.required' => 'Password wajib di isi'
        ];
    }
}
