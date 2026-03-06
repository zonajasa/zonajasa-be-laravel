<?php

namespace App\Internal\Api\Auth\Handler;

use App\Infrastructure\Database\Eloquent\User;
use App\Infrastructure\Http\Request\LoginRequestInfrastructure;
use App\Infrastructure\Http\Request\VerifyOTPRequestInfrastructure;
use App\Internal\Api\Auth\Constant\AuthConstant;
use App\Internal\Api\Auth\DTOs\AuthLoginDTOs;
use App\Internal\Api\Auth\DTOs\AuthVerifyOtpDTOs;
use App\Internal\Api\Auth\Usecase\AuthUsecase;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthHandler extends AuthConstant
{
    public function __construct(
        private AuthUsecase $usecase
    ) {}

    public function Login(LoginRequestInfrastructure $loginRequestInfrastructure): JsonResponse
    {
        $validated = $loginRequestInfrastructure->validated();
        $dto_login = new AuthLoginDTOs($validated['ephone'], $validated['password']); //simpan object 

        return $this->usecase->AuthServiceLogin($dto_login, static::ERROR_EMAIL_OR_NO_WHATSAPP, static::ERROR_PASSWORD, static::SUCCESS_LOGIN);
    }

    public function VerifyOTP(VerifyOTPRequestInfrastructure $verifyOTPRequestInfrastructure): JsonResponse|array|User
    {
        $validated = $verifyOTPRequestInfrastructure->validated();
        $dto_verify_otp = new AuthVerifyOtpDTOs($validated['otp'], $validated['ephone']); //simpan object
        return $this->usecase->AuthServiceVerifyOTP($dto_verify_otp, static::OTP_INVALID, static::VERIFICATION_OTP_FAILED, static::SUCCESS_VERIFY_OTP);
    }
}
