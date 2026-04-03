<?php

namespace App\Internal\Api\v1\Auth\Usecase;

use App\Domain\Api\v1\Auth\Entities\AuthRegisterEntitiesDomain;
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
        string $MessageVerificationOtpFailed,
        string $MessageSuccessVerifyOtp
    ): JsonResponse|array|User {
        return $this->service->AuthRepositoryVerifyOTP(
            $AuthVerifyOtpDTO,
            $MessageOtpInvalid,
            $MessageVerificationOtpFailed,
            $MessageSuccessVerifyOtp
        );
    }

    public function AuthServiceRegister(AuthRegisterDTOs $AuthRegisterDto): JsonResponse|AuthRegisterEntitiesDomain
    {
        //interact with domain: register auth
        return $this->service->AuthRepositoryRegister($AuthRegisterDto);
    }
}
