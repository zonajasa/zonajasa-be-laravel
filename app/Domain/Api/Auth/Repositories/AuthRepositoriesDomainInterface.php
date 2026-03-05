<?php

namespace App\Domain\Api\Auth\Repositories;

use App\Infrastructure\Database\Eloquent\Otp;
use App\Infrastructure\Database\Eloquent\User;

interface AuthRepositoriesDomainInterface
{
    public function ValidateEmailOrNoWhatsapp(string $ephone): ?User;
    public function ValidatePassword(string $password, string $hash_password): bool;
    public function OTPSendRequestByWhatsapp(int $code_otp, int $no_whatsapp): void;
    public function OTPSendRequestByEmail(int $code_otp, string $email, string $full_name): void;
    public function SubmitOTPVerify(int $code_otp, string $ephone): Otp;
}
