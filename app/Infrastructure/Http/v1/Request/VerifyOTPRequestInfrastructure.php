<?php

namespace App\Infrastructure\Http\v1\Request;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidationValidator;


class VerifyOTPRequestInfrastructure
{

    public function rules(Request $request): ValidationValidator
    {
        return Validator::make($request->all(), [
            'otp' => 'required|numeric|digits:6',
            'no_whatsapp' => 'required|string',
        ], $this->messages());
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute jangan di kosongkan',
            'digits' => ':attribute minimal 6 digit'
        ];
    }
}
