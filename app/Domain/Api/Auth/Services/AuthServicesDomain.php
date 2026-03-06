<?php

namespace App\Domain\Api\Auth\Services;

use App\Domain\Api\Auth\Repositories\AuthRepositoriesDomainInterface;
use App\Infrastructure\Database\Eloquent\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
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
                $this->repository->OTPSendRequestByWhatsapp($otp, $ephone, $user->nama_lengkap);

            $submit_otp = $this->repository->SubmitOTPVerify($otp, $ephone);
            return OkRes($success_login, [
                'ephone' => $submit_otp['no_whatsapp'] ? $submit_otp['no_whatsapp'] : $submit_otp['email'], //yang dikirim dari depan adalah no whatsapp atau email yang terenkripsi
                'expire' => Carbon::parse($submit_otp['expired_at'])->timezone(config('app.timezone'))
                    ->format('H:i:s')
            ]);
        } catch (\Exception $e) {
            Log::error('AuthServicesDomain Error: ' . $e->getMessage());
            return ErrorRes('Maaf terjadi kesalahan pada sistem', 500);
        }
    }

    public function AuthRepositoryVerifyOTP(
        string $otp,
        string $ephone, //wa atau email yang terenkripsi
        string $message_otp_invalid,
        string $message_verification_otp_failed,
        string $message_success_verify_otp
    ): JsonResponse|array|User {
        try {

            //cek yang dia kirim apakah email atau no whatsapp
            $phone = $this->repository->FindOTPByPhone($ephone);
            $email = $this->repository->FindOTPByEmailAddress($ephone);

            if (!empty($phone)) {
                //verify otp by whatsapp
                $otp_by_phone = $phone->code; //decrypt code otp dari no whatsapp yang terenkripsi
                if (Crypt::decryptString($otp_by_phone) != $otp) {
                    return ErrorRes($message_otp_invalid, 422);
                }
                $generate_session_by_no_whatsapp = $this->repository->GenerateSession(Crypt::decryptString($phone->no_whatsapp));
                return OkRes($message_success_verify_otp, $generate_session_by_no_whatsapp);
            } else if (!empty($email)) {
                //verify otp by email
                $otp_by_email = $email->code; //decrypt code otp dari email yang terenkripsi
                if (Crypt::decryptString($otp_by_email) != $otp) {
                    return ErrorRes($message_otp_invalid, 422);
                }
                $generate_session_by_email = $this->repository->GenerateSession(Crypt::decryptString($email->email));
                return OkRes($message_success_verify_otp, $generate_session_by_email);
            }

            return ErrorRes($message_verification_otp_failed, 422);
        } catch (\Exception $error) {
            Log::error('AuthServicesDomain Error: ' . $error->getMessage());
            return ErrorRes('Maaf terjadi kesalahan pada sistem', 500);
        }
    }
}
