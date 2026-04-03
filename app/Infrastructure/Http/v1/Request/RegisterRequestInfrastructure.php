<?php

namespace App\Infrastructure\Http\v1\Request;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidationValidator;


class RegisterRequestInfrastructure
{

    public function rules(Request $request): ValidationValidator
    {
        return Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|min:8',
            'nomor_whatsapp' => 'required|numeric|digits_between:10,14',
            'password' => 'required|string|min:8'
        ], $this->messages());
    }

    public function messages(): array
    {
        return [
            'nomor_whatsapp.numeric' => 'Nomor whatsapp harus angka',
            'nomor_whatsapp.digits_between' => 'Nomor whatsapp wajib 10 hingga 14 digit',
            'min' => ':attribute minimal 8 karaketer',
            'required' => ':attribute jangan di kosongkan'
        ];
    }
}
