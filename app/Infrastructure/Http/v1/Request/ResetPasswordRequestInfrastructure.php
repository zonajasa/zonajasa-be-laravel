<?php

namespace App\Infrastructure\Http\v1\Request;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidationValidator;


class ResetPasswordRequestInfrastructure
{

    public function rules(Request $request): ValidationValidator
    {
        return Validator::make($request->all(), [
            'kode_user' => 'required|string|exists:users,kode_user',
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|same:password'
        ], $this->messages());
    }

    public function messages(): array
    {
        return [
            'password.min' => 'Password minimal 8 karakter',
            'password_confirmation.same' => 'Konfirmasi password tidak cocok',
            'required' => ':attribute jangan di kosongkan'
        ];
    }
}
