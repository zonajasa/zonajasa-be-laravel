<?php

namespace App\Infrastructure\Http\Request;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidationValidator;


class RegisterRequestInfrastructure
{

    public function rules(Request $request): ValidationValidator
    {
        return Validator::make($request->all(), [
            'nama_lengkap' => 'required|string|min:8',
            'no_whatsapp' => 'required|numeric|digits_between:10,12',
            'password' => 'required|string|min:8'
        ], $this->messages());
    }

    public function messages(): array
    {
        return [
            'no_whatsapp.numeric' => 'No whatsapp harus angka',
            'no_whatsapp.digits_between' => 'No whatsapp wajib 10 hingga 12 digit',
            'min' => ':attribute minimal 8 karaketer',
            'required' => ':attribute jangan di kosongkan'
        ];
    }
}
