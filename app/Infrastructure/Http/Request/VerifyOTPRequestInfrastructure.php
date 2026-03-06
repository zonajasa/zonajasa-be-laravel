<?php

namespace App\Infrastructure\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class VerifyOTPRequestInfrastructure extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // use digits_between to validate the number of digits instead of max value
            'otp' => 'required|string', //request otp yang akan divalidasi
            'ephone' => 'required|string', //yang dikirim dari depan adalah no whatsapp atau email yang terenkripsi
        ];
    }

    public function messages(): array
    {
        return [
            'otp.required' => 'OTP wajib di isi',
            'ephone.required' => 'Nomor WhatsApp wajib di isi'
        ];
    }
}
