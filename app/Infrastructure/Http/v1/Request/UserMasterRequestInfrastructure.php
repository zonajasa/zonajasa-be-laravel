<?php

namespace App\Infrastructure\Http\v1\Request;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidationValidator;

class UserMasterRequestInfrastructure
{

    public function rules(Request $request): ValidationValidator
    {
        return Validator::make($request->all(), [
            'full_name' => 'required|string',
            'whatsapp' => 'required|numeric|digits_between:10,14',
            'password' => 'string|min:8',
            'image' => 'string'
        ], $this->messages());
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute jangan di kosongkan'
        ];
    }
}
