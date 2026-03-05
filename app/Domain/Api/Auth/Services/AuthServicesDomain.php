<?php

namespace App\Domain\Api\Auth\Services;

use App\Domain\Api\Auth\Repositories\AuthRepositoriesDomainInterface;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthServicesDomain
{
    public function __construct(
        private AuthRepositoriesDomainInterface $repository
    ) {}

    public function AuthRepositoryLogin(
        string $ephone,
        string $password,
        string $error_email_or_whatsapp,
        string $error_password,
        string $success_login
    ): JsonResponse {
        try {
            //validate credential
            $user = $this->repository->ValidateEmailOrNoWhatsapp($ephone);
            if (!$user) {
                return ErrorRes($error_email_or_whatsapp);
            }

            if (!$this->repository->ValidatePassword($password, $user->password)) {
                return ErrorRes($error_password);
            }

            //generate otp 6 digit
            $otp = rand(100000, 999999);
            filter_var($ephone, FILTER_VALIDATE_EMAIL)
                ? $this->repository->OTPSendRequestByEmail($otp, $ephone, $user->nama_lengkap) :
                $this->repository->OTPSendRequestByWhatsapp($otp, $ephone);

            $this->repository->SubmitOTPVerify($otp, $ephone);
            return OkRes($success_login, $user);
        } catch (\Exception $e) {
            Log::error('AuthServicesDomain Error: ' . $e->getMessage());
            return ErrorRes('Maaf terjadi kesalahan pada sistem', 500);
        }
    }
}
