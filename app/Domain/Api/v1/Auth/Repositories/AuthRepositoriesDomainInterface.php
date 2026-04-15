<?php

namespace App\Domain\Api\v1\Auth\Repositories;

use App\Infrastructure\Database\v1\Eloquent\Otp;
use App\Infrastructure\Database\v1\Eloquent\User;
use App\Internal\Api\v1\Auth\DTOs\AuthRegisterDTOs;

interface AuthRepositoriesDomainInterface
{
    public function ValidateNomorWhatsapp(int $NomorWhatsapp): ?User;
    public function ValidatePassword(string $Password, string $HashPassword): bool;
    public function OTPSendRequestByWhatsapp(int $RandomCode, int $NomorWhatsapp, string $FullName): void;
    public function SubmitOTP(int $Otp, string $KodeUser): Otp;
    public function SendOTP(int $NomorWhatsapp, string $FullName): int;
    public function ValidateNomorWhatsappIsExists(int $NomorWhatsapp): bool|User;

    //verify otp
    public function FindOTPByNomorWhatsappEncrypted(string $NomorWhatsapp): ?Otp;
    public function GenerateSession(int $NomorWhatsapp): array|User;
    public function UserRegister(AuthRegisterDTOs $AuthRegisterDTO): User;
    public function UpdateStatusAccountIsVerified(string $NomorWhatsapp): void;
}
