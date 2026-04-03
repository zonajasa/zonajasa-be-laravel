<?php

namespace App\Domain\Api\v1\Auth\Repositories;

use App\Infrastructure\Database\v1\Eloquent\Otp;
use App\Infrastructure\Database\v1\Eloquent\User;
use App\Internal\Api\v1\Auth\DTOs\AuthRegisterDTOs;

interface AuthRepositoriesDomainInterface
{
    public function ValidateNoWhatsapp(int $NoWhatsapp): ?User;
    public function ValidatePassword(string $Password, string $HashPassword): bool;
    public function OTPSendRequestByWhatsapp(int $RandomCode, int $NoWhatsapp, string $FullName): void;
    public function SubmitOTPVerify(int $CodeOtp, int $NoWhatsapp): Otp;
    public function SendOTP(int $NoWhatsapp, string $FullName): int;
    public function ValidateNoWhatsappIsExists(int $NoWhatsapp): bool|User;

    //verify otp
    public function FindOTPByPhone(int $NoWhatsapp): ?Otp;
    public function GenerateSession(int $NoWhatsapp): array|User;
    public function UserRegister(AuthRegisterDTOs $AuthRegisterDTO): User;
}
