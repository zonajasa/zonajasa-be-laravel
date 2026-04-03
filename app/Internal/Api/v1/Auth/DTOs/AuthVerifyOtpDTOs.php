<?php

namespace App\Internal\Api\v1\Auth\DTOs;

class AuthVerifyOtpDTOs
{
    public int $otp; //simpan OTP yang diinputkan user
    public string $nomor_whatsapp; //simpan no whatsapp yang terenkripsi

    public function __construct(int $otp, string $nomor_whatsapp)
    {
        $this->otp = $otp;
        $this->nomor_whatsapp = $nomor_whatsapp;
    }
}
