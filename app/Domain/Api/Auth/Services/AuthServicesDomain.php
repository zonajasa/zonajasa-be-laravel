<?php

namespace App\Domain\Api\Auth\Services;

use App\Domain\Api\Auth\Repositories\AuthRepositoriesDomainInterface;
use App\Infrastructure\Database\Eloquent\User;
use App\Internal\Api\Auth\DTOs\AuthRegisterDTOs;
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
        string $no_whatsapp, //sudah di format dari usecase login no whatsapp nya jadi +62 
        string $password,
        string $message_error_email_or_whatsapp,
        string $message_success_login,
        string $message_verify_account
    ): JsonResponse {
        try {
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
            //===============PROCEDURE INI GAK DIGUNAKAN =========================
            // //generate otp 6 digit
            // $otp = $this->repository->GenerateOTP($ephone, $user->nama_lengkap);
            // $submit_otp = $this->repository->SubmitOTPVerify($otp, $ephone);

            // //return response after submit otp success of login
            // return OkRes($message_success_login, [
            //     'ephone' => $submit_otp['no_whatsapp'] ? $submit_otp['no_whatsapp'] : $submit_otp['email'], //yang dikirim dari depan adalah no whatsapp atau email yang terenkripsi
            //     'expire' => Carbon::parse($submit_otp['expired_at'])->timezone(config('app.timezone'))
            //         ->format('H:i:s')
            // ]);

            //generate session

        } catch (\Exception $e) {
            Log::error('AuthServicesDomain Error: ' . $e->getMessage());
            return ErrorRes('Maaf terjadi kesalahan pada sistem', 500);
        }
    }

    public function AuthRepositoryVerifyOTP(
        string $otp,
        string $no_whatsapp, //wa atau email yang terenkripsi
        string $message_otp_invalid,
        string $message_verification_otp_failed,
        string $message_success_verify_otp
    ): JsonResponse|array|User {
        try {

            //cek yang dia kirim apakah email atau no whatsapp
            $no_whatsapp = $this->repository->FindOTPByPhone($no_whatsapp);
            // $email = $this->repository->FindOTPByEmailAddress($ephone);

            if (!empty($no_whatsapp)) {
                //verify otp by whatsapp
                $otp_by_phone = $no_whatsapp->code; //decrypt code otp dari no whatsapp yang terenkripsi
                if (Crypt::decryptString($otp_by_phone) != $otp) {
                    return ErrorRes($message_otp_invalid, 422);
                }
                $generate_session_by_no_whatsapp = $this->repository->GenerateSession(Crypt::decryptString($no_whatsapp->no_whatsapp));
                return OkRes($message_success_verify_otp, $generate_session_by_no_whatsapp);
            }
            //========================= procedure di bawah ini tidak digunakan ==========================
            // } else if (!empty($email)) {
            //     //verify otp by email
            //     $otp_by_email = $email->code; //decrypt code otp dari email yang terenkripsi
            //     if (Crypt::decryptString($otp_by_email) != $otp) {
            //         return ErrorRes($message_otp_invalid, 422);
            //     }
            //     $generate_session_by_email = $this->repository->GenerateSession(Crypt::decryptString($email->email));
            //     return OkRes($message_success_verify_otp, $generate_session_by_email);
            // }

            return ErrorRes($message_verification_otp_failed, 422);
        } catch (\Exception $error) {
            Log::error('AuthServicesDomain Error: ' . $error->getMessage());
            return ErrorRes('Maaf terjadi kesalahan pada sistem', 500);
        }
    }

    public function AuthRepositoryRegister(AuthRegisterDTOs $data, string $message_success_register)
    {
        try {

            //========================= procedure di bawah ini tidak digunakan ==========================
            // //validasi email atau no whatsapp sudah terdaftar sebelumnya
            // if (filter_var($data->ephone, FILTER_VALIDATE_EMAIL) && $this->repository->ValidateEmailIsExists($data->ephone)) {
            //     return ErrorRes('Email sudah terdaftar, silahkan login atau daftar dengan Email baru.', 422);
            // }

            // if (!filter_var($data->ephone, FILTER_VALIDATE_EMAIL) && $this->repository->ValidateNoWhatsappIsExists(formatWhatsappNumber($data->ephone))) {
            //     return ErrorRes('No whatsapp sudah terdaftar, silahkan Login atau daftar dengan Nomor Whatsapp baru.', 422);
            // }

            //validasi no whatsapp
            if ($this->repository->ValidateNoWhatsappIsExists(formatWhatsappNumber($data->no_whatsapp))) {
                return ErrorRes('No whatsapp sudah terdaftar, silahkan Login atau daftar dengan Nomor Whatsapp baru.', 422);
            }

            //register user
            $user = $this->repository->UserRegister($data);

            //generate OTP & send otp di whatsapp client
            $otp = $this->repository->GenerateOTP($data->no_whatsapp, $user['nama_lengkap']);

            //submit OTP
            $submit_otp = $this->repository->SubmitOTPVerify($otp, $data->no_whatsapp);

            //return response success
            return OkRes($message_success_register, [
                'no_whatsapp' => $submit_otp['no_whatsapp'], //yang dikirim dari depan adalah no whatsapp yang terenkripsi
                'expire' => Carbon::parse($submit_otp['expired_at'])->timezone(config('app.timezone'))
                    ->format('H:i:s')

            ]);
        } catch (\Exception $error) {
            Log::error('AuthServicesDomain Error: ' . $error->getMessage());
            return ErrorRes('Maaf terjadi kesalahan pada sistem', 500);
        }
    }
}
