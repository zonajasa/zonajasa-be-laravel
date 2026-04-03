<?php

namespace App\Internal\Api\v1\Auth\Usecase;

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
        AuthLoginDTOs $auth_dto_login,
        string $message_error_email_or_whatsapp,
        string $message_success_login,
        string $message_verify_account
    ): JsonResponse {
        //interact with domain: login auth
        return $this->service->AuthRepositoryLogin(
            formatWhatsappNumber($auth_dto_login->no_whatsapp),
            $auth_dto_login->password,
            $message_error_email_or_whatsapp,
            $message_success_login,
            $message_verify_account
        );
    }

    public function AuthServiceVerifyOTP(
        //interact with domain: verify otp auth
        AuthVerifyOtpDTOs $auth_dto_verify_otp,
        string $message_otp_invalid,
        string $message_verification_otp_failed,
        string $message_success_verify_otp
    ): JsonResponse|array|User {
        return $this->service->AuthRepositoryVerifyOTP(
            $auth_dto_verify_otp->otp,
            $auth_dto_verify_otp->no_whatsapp,
            $message_otp_invalid,
            $message_verification_otp_failed,
            $message_success_verify_otp
        );
    }

    public function AuthServiceRegister(AuthRegisterDTOs $AuthRegisterDto, string $MessageSuccessRegister)
    {
        //interact with domain: register auth
        return $this->service->AuthRepositoryRegister(
            $AuthRegisterDto,
            $MessageSuccessRegister
        );
    }
}
