<?php

namespace App\Internal\Api\Auth\Handler;

use App\Infrastructure\Http\Request\LoginRequestInfrastructure;
use App\Internal\Api\Auth\DTOs\AuthLoginDTOs;
use App\Internal\Api\Auth\Usecase\AuthUsecase;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthHandler
{
    public function __construct(
        private AuthUsecase $usecase
    ) {}

    public function Login(LoginRequestInfrastructure $loginRequestInfrastructure): JsonResponse
    {
        $validated = $loginRequestInfrastructure->validated();
        $dto_login = new AuthLoginDTOs($validated['no_whatsapp'], $validated['password']); //simpan object 

        return OkRes('Login berhasil', $dto_login);
    }
}
