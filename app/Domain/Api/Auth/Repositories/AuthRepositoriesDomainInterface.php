<?php

namespace App\Domain\Api\Auth\Repositories;

use App\Infrastructure\Database\Eloquent\User;

interface AuthRepositoriesDomainInterface
{
    public function ValidateEmailOrNoWhatsapp(string $ephone): ?User;
    public function ValidatePassword(string $password, string $hashPassword): bool;
    public function OTPSendRequestByWhatsapp(int $code_otp, int $no_whatsapp): void;
    public function OTPSendRequestByEmail(int $code_otp, string $email): void;
}
