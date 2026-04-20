<?php

namespace App\Infrastructure\Http\v1\Request;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidationValidator;

class LoginRequestInfrastructure
{

    public function rules(Request $request): ValidationValidator
    {
        return Validator::make($request->all(), [
            'nomor_whatsapp' => 'required|numeric|digits_between:10,14',
            'password' => 'required|string|min:8'
        ], $this->messages());
    }

    public function messages(): array
    {
        return [
            'nomor_whatsapp.numeric' => 'No whatsapp harus angka',
            'nomor_whatsapp.digits_between' => 'No whatsapp wajib 10 hingga 14 digit',
            'nomor_whatsapp.required' => 'Nomor WhatsApp wajib di isi',
            'password.required' => 'Password wajib di isi',
            'password.min' => 'Password minimal 8 karakter'
        ];
    }
}
