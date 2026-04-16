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
            'kode_user' => 'required|string', //kode user encrypted
            'type' => 'required|string|in:register_token,forgot_token' //type OTP untuk membedakan apakah OTP untuk register atau forgot password
        ], $this->messages());
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute jangan di kosongkan',
            'digits' => ':attribute minimal 6 digit',
            'in' => ':attribute tidak valid'
        ];
    }
}
