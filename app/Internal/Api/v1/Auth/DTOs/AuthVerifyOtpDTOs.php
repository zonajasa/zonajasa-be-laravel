<?php

namespace App\Internal\Api\v1\Auth\DTOs;

class AuthVerifyOtpDTOs
{
    public int $otp; //simpan OTP yang diinputkan user
    public string $kode_user; //simpan kode user yang terenkripsi

    public function __construct(int $otp, string $kode_user)
    {
        $this->otp = $otp;
        $this->kode_user = $kode_user;
    }
}
