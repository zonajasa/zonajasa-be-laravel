<?php

namespace App\Internal\Api\Auth\DTOs;

class AuthVerifyOtpDTOs
{
    public int $otp;
    public string $no_whatsapp;

    public function __construct(int $otp, string $no_whatsapp)
    {
        $this->otp = $otp;
        $this->no_whatsapp = $no_whatsapp;
    }
}
