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
            // use digits_between to validate the number of digits instead of max value
            'ephone' => 'required|string',
            'password' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'ephone.required' => 'Nomor WhatsApp wajib di isi',
            'password.required' => 'Password wajib di isi'
        ];
    }
}
