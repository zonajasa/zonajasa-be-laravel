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
            'no_whatsapp' => 'required|numeric|digits_between:1,13',
            'password' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'no_whatsapp.required' => 'Nomor WhatsApp wajib di isi',
            'no_whatsapp.digits_between' => 'Nomor WhatsApp maksimal 13 digit',
            'no_whatsapp.numeric' => 'Nomor WhatsApp harus berupa angka',
            'password.required' => 'Password wajib di isi'
        ];
    }
}
