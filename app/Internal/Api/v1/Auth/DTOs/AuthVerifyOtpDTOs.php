<?php

namespace App\Internal\Api\v1\Auth\DTOs;

class AuthVerifyOtpDTOs
{
    public int $otp; //simpan OTP yang diinputkan user
    public string $kode_user; //simpan kode user yang terenkripsi
    public string $type; //simpan type OTP untuk membedakan apakah OTP untuk register atau forgot password

    public function __construct(int $otp, string $kode_user, string $type)
    {
        $this->otp = $otp;
        $this->kode_user = $kode_user;
        $this->type = $type;
    }
}
