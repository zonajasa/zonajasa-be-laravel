<?php

namespace App\Internal\Api\Auth\Usecase;

use App\Domain\Api\Auth\Services\AuthServicesDomain;
use App\Infrastructure\Database\Eloquent\User;
use App\Internal\Api\Auth\DTOs\AuthLoginDTOs;
use App\Internal\Api\Auth\DTOs\AuthRegisterDTOs;
use App\Internal\Api\Auth\DTOs\AuthVerifyOtpDTOs;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthUsecase
{
    public function __construct(
        private AuthServicesDomain $service
    ) {}

    public function AuthServiceLogin(AuthLoginDTOs $auth_dto_login, string $message_error_email_or_whatsapp, string $message_success_login): JsonResponse
    {
        return $this->service->AuthRepositoryLogin(formatWhatsappNumber($auth_dto_login->no_whatsapp), $auth_dto_login->password, $message_error_email_or_whatsapp, $message_success_login);
    }

    public function AuthServiceVerifyOTP(
        AuthVerifyOtpDTOs $auth_dto_verify_otp,
        string $message_otp_invalid,
        string $message_verification_otp_failed,
        string $message_success_verify_otp
    ): JsonResponse|array|User {
        return $this->service->AuthRepositoryVerifyOTP($auth_dto_verify_otp->otp, $auth_dto_verify_otp->ephone, $message_otp_invalid, $message_verification_otp_failed, $message_success_verify_otp);
    }

    public function AuthServiceRegister(AuthRegisterDTOs $auth_dto_register, string $message_success_register)
    {
        return $this->service->AuthRepositoryRegister($auth_dto_register, $message_success_register);
    }
}
