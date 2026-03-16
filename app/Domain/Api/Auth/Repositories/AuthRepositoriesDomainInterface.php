<?php

namespace App\Domain\Api\Auth\Repositories;

use App\Infrastructure\Database\Eloquent\Otp;
use App\Infrastructure\Database\Eloquent\User;
use App\Internal\Api\Auth\DTOs\AuthRegisterDTOs;

interface AuthRepositoriesDomainInterface
{
    public function ValidateEmailOrNoWhatsapp(string $ephone): ?User;
    public function ValidatePassword(string $password, string $hash_password): bool;
    public function OTPSendRequestByWhatsapp(int $code_otp, int $no_whatsapp, string $full_name): void;
    public function OTPSendRequestByEmail(int $code_otp, string $email, string $full_name): void;
    public function SubmitOTPVerify(int $code_otp, string $ephone): Otp;
    public function GenerateOTP(string $ephone, string $full_name): int;
    public function ValidateEmailIsExists(string $email): bool|User;
    public function ValidateNoWhatsappIsExists(string $no_whatsapp): bool|User;

    //verify otp
    public function FindOTPByPhone(string $phone): ?Otp;
    public function FindOTPByEmailAddress(string $email): ?Otp;
    public function GenerateSession(string $no_whatsapp): array|User;
    public function UserRegister(AuthRegisterDTOs $data): User;
}
