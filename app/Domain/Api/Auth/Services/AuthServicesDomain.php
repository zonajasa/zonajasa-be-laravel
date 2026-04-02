<?php

namespace App\Domain\Api\Auth\Services;

use App\Domain\Api\Auth\Repositories\AuthRepositoriesDomainInterface;
use App\Infrastructure\Database\Eloquent\User;
use App\Internal\Api\Auth\DTOs\AuthRegisterDTOs;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthServicesDomain
{
    public function __construct(
        private AuthRepositoriesDomainInterface $repository
    ) {}

    public function AuthRepositoryLogin(
        string $no_whatsapp, //sudah di format dari usecase login no whatsapp nya jadi +62 
        string $password,
        string $message_error_email_or_whatsapp,
        string $message_success_login,
        string $message_verify_account
    ): JsonResponse {
        //validate credential
        $user = $this->repository->ValidateNoWhatsapp($no_whatsapp);
        if (!$user || !$this->repository->ValidatePassword($password, $user->password)) {
            return ErrorRes($message_error_email_or_whatsapp);
        }

        //wajib account nya terverifikasi agar dapat login di sistem
        if ($user->status == 'Y') {
            $user = $this->repository->GenerateSession($no_whatsapp);
            return OkRes($message_success_login, $user);
        }

        return ErrorRes($message_verify_account);
    }

    public function AuthRepositoryVerifyOTP(
        string $otp,
        string $no_whatsapp, //wa atau email yang terenkripsi
        string $message_otp_invalid,
        string $message_verification_otp_failed,
        string $message_success_verify_otp
    ): JsonResponse|array|User {
        $no_whatsapp = $this->repository->FindOTPByPhone($no_whatsapp);
        if (!empty($no_whatsapp)) {

            $otp_by_phone = $no_whatsapp->code; //decrypt code otp dari no whatsapp yang terenkripsi
            if (Crypt::decryptString($otp_by_phone) != $otp) {
                return ErrorRes($message_otp_invalid, 422);
            }
            $generate_session_by_no_whatsapp = $this->repository->GenerateSession(Crypt::decryptString($no_whatsapp->no_whatsapp)); //decrypt no whatsapp agar dapat dicari keberadaan data di tbl user lalu generate session user by dari no whatsapp nya
            return OkRes($message_success_verify_otp, $generate_session_by_no_whatsapp);
        }

        return ErrorRes($message_verification_otp_failed, 422);
    }

    public function AuthRepositoryRegister(AuthRegisterDTOs $AuthRegisterDto, string $MessageSuccessRegister)
    {
        //validasi no whatsapp
        if ($this->repository->ValidateNoWhatsappIsExists(formatWhatsappNumber($AuthRegisterDto->NoWhatsapp))) {
            return ErrorRes('No whatsapp sudah terdaftar, silahkan Login atau daftar dengan Nomor Whatsapp baru.', 422);
        }

        //register user
        $User = $this->repository->UserRegister($AuthRegisterDto);

        //Send otp ke whatsapp client
        $CodeOtp = $this->repository->SendOTP($AuthRegisterDto->NoWhatsapp, $User['nama_lengkap']);

        //Generate OTP
        $OTPSubmit = $this->repository->SubmitOTPVerify($CodeOtp, $AuthRegisterDto->NoWhatsapp);

        //return response success
        return OkRes($MessageSuccessRegister, [
            'no_whatsapp' => $OTPSubmit['no_whatsapp'], //yang dikirim dari depan adalah no whatsapp yang terenkripsi
            'expire' => Carbon::parse($OTPSubmit['expired_at'])->timezone(config('app.timezone'))
                ->format('H:i:s')

        ]);
    }
}
