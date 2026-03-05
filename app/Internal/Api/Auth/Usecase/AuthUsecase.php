<?php

namespace App\Internal\Api\Auth\Usecase;

use App\Domain\Api\Auth\Services\AuthServicesDomain;
use App\Internal\Api\Auth\DTOs\AuthLoginDTOs;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthUsecase
{
    public function __construct(
        private AuthServicesDomain $service
    ) {}

    public function AuthServiceLogin(AuthLoginDTOs $auth_dto_login, string $error_email_or_whatsapp, string $error_password, string $success_login): JsonResponse
    {
        return $this->service->AuthRepositoryLogin($auth_dto_login->ephone, $auth_dto_login->password, $error_email_or_whatsapp, $error_password, $success_login);
    }
}
