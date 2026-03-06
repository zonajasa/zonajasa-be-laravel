<?php

namespace App\Internal\Api\Auth\DTOs;

class AuthVerifyOtpDTOs
{
    public string $otp;
    public string $ephone;

    public function __construct(string $otp, string $ephone)
    {
        $this->otp = $otp;
        $this->ephone = $ephone;
    }
}
