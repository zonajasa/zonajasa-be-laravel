<?php

namespace App\Domain\Api\v1\Auth\Repositories;

use App\Infrastructure\Database\v1\Eloquent\Otp;
use App\Infrastructure\Database\v1\Eloquent\User;
use App\Internal\Api\v1\Auth\DTOs\AuthRegisterDTOs;

interface AuthRepositoriesDomainInterface
{
    //kode user
    public function GetUserByKodeUser(string $KodeUser): ?User;
    public function ValidateByKodeUser(string $KodeUser): bool;

    public function ValidateNomorWhatsapp(string $NomorWhatsapp): ?User;
    public function ValidatePassword(string $Password, string $HashPassword): bool;
    public function OTPSendRequestByWhatsapp(int $RandomCode, string $NomorWhatsapp, string $FullName): void;
    public function SubmitOTP(int $Otp, string $KodeUser): Otp;
    public function SendOTP(string $NomorWhatsapp, string $FullName): int;
    public function ValidateNomorWhatsappIsExists(string $NomorWhatsapp): bool|User;

    //verify otp
    public function FindOTPByKodeUser(string $KodeUser): ?Otp;
    public function GenerateSession(string $NomorWhatsapp): array|User;
    public function UserRegister(AuthRegisterDTOs $AuthRegisterDTO): User;
    public function UpdateStatusAccountIsVerified(string $KodeUser): void;
    public function FindWhatsappByKodeUser(string $KodeUser): int;

    //reset password
    public function SendMessageAfterResetPasswordSuccess(string $NomorWhatsapp, string $FullName): void;
}
