<?php

namespace App\Internal\Api\v1\Auth\Usecase;

use App\Domain\Api\v1\Auth\Entities\AuthEntitiesDomain;
use App\Domain\Api\v1\Auth\Services\AuthServicesDomain;
use App\Infrastructure\Database\v1\Eloquent\User;
use App\Internal\Api\v1\Auth\DTOs\AuthLoginDTOs;
use App\Internal\Api\v1\Auth\DTOs\AuthRegisterDTOs;
use App\Internal\Api\v1\Auth\DTOs\AuthVerifyOtpDTOs;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthUsecase
{
    public function __construct(
        private AuthServicesDomain $service
    ) {}

    public function AuthServiceLogin(
        AuthLoginDTOs $AuthLoginDto,
        string $MessageErrorEmailOrWhatsapp,
        string $MessageSuccessLogin,
        string $MessageVerifyAccount
    ): JsonResponse {
        //interact with domain: login auth
        return $this->service->AuthRepositoryLogin(
            $AuthLoginDto,
            $MessageErrorEmailOrWhatsapp,
            $MessageSuccessLogin,
            $MessageVerifyAccount
        );
    }

    public function AuthServiceVerifyOTP(
        //interact with domain: verify otp auth
        AuthVerifyOtpDTOs $AuthVerifyOtpDTO,
        string $MessageOtpInvalid,
        string $MessageSuccessVerifyOtp,
        string $meesageExpireOtp
    ): JsonResponse|array|User {
        return $this->service->AuthRepositoryVerifyOTP(
            $AuthVerifyOtpDTO,
            $MessageOtpInvalid,
            $MessageSuccessVerifyOtp,
            $meesageExpireOtp
        );
    }

    public function AuthServiceRegister(AuthRegisterDTOs $AuthRegisterDto): JsonResponse|AuthEntitiesDomain
    {
        //interact with domain: register auth
        return $this->service->AuthRepositoryRegister($AuthRegisterDto);
    }

    public function AuthServiceResendOtp(string $kode_user, string $SuccessMessageResendOtp): JsonResponse
    {
        //interact with domain: resend otp auth
        return $this->service->AuthRepositoryResendOtp($kode_user, $SuccessMessageResendOtp);
    }

    public function AuthServiceForgotPassword(int $nomor_whatsapp): JsonResponse|AuthEntitiesDomain
    {
        // interact with domain: forgot password auth
        return $this->service->AuthRepositoryForgotPassword($nomor_whatsapp);
    }
}
