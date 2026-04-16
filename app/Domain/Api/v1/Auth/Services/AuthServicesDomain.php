<?php

namespace App\Domain\Api\v1\Auth\Services;

use App\Domain\Api\v1\Auth\Entities\AuthEntitiesDomain;
use App\Domain\Api\v1\Auth\Repositories\AuthRepositoriesDomainInterface;
use App\Infrastructure\Database\v1\Eloquent\User;
use App\Internal\Api\v1\Auth\DTOs\AuthLoginDTOs;
use App\Internal\Api\v1\Auth\DTOs\AuthRegisterDTOs;
use App\Internal\Api\v1\Auth\DTOs\AuthResetPasswordDTOs;
use App\Internal\Api\v1\Auth\DTOs\AuthVerifyOtpDTOs;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthServicesDomain
{
    public function __construct(
        private AuthRepositoriesDomainInterface $repository
    ) {}

    public function AuthRepositoryLogin(
        AuthLoginDTOs $AuthLoginDto,
        string $MessageErrorEmailOrWhatsapp,
        string $MessageSuccessLogin,
        string $MessageVerifyAccount
    ): JsonResponse {
        //validate credential
        $user = $this->repository->ValidateNomorWhatsapp(formatWhatsappNumber($AuthLoginDto->no_whatsapp));
        if (!$user || !$this->repository->ValidatePassword($AuthLoginDto->password, $user->password)) {
            return ErrorRes($MessageErrorEmailOrWhatsapp);
        }

        //wajib account nya terverifikasi agar dapat login di sistem
        if ($user->status_account == 1) {
            $user = $this->repository->GenerateSession(formatWhatsappNumber($AuthLoginDto->no_whatsapp));
            return OkRes($MessageSuccessLogin, $user);
        }

        return ErrorRes($MessageVerifyAccount);
    }

    public function AuthRepositoryVerifyOTP(
        AuthVerifyOtpDTOs $AuthVerifyOtpDTO,
        string $MessageOtpInvalid,
        string $MessageSuccessVerifyOtp,
        string $meesageExpireOtp
    ): JsonResponse|array|User {
        $Data = $this->repository->FindOTPByKodeUser($AuthVerifyOtpDTO->kode_user);
        if (!empty($Data)) {

            //decrypt otp yang terenkripsi base on dari whatsapp yang terenkripsi lalu dibandingkan dengan otp yang dikirim client
            if (Crypt::decryptString($Data->otp) != $AuthVerifyOtpDTO->otp) {
                return ErrorRes($MessageOtpInvalid, 422);
            }

            ///generate session user berdasarkan nomor whatsapp dari kode user
            $GenerateSessionByKodeUser = $this->repository->GenerateSession($this->repository->FindWhatsappByKodeUser($Data->kode_user));
            //update status account is verified
            $this->repository->UpdateStatusAccountIsVerified($Data->kode_user);
            return OkRes($MessageSuccessVerifyOtp, $GenerateSessionByKodeUser);
        }

        return ErrorRes($meesageExpireOtp, 422);
    }

    public function AuthRepositoryRegister(AuthRegisterDTOs $AuthRegisterDto): JsonResponse|AuthEntitiesDomain
    {
        //validasi no whatsapp
        if (!$this->repository->ValidateNomorWhatsappIsExists(formatWhatsappNumber($AuthRegisterDto->NomorWhatsapp))) {
            //register user
            $User = $this->repository->UserRegister($AuthRegisterDto);

            //Send otp ke whatsapp client
            $CodeOtp = $this->repository->SendOTP($AuthRegisterDto->NomorWhatsapp, $User['full_name']);

            //Generate OTP
            $OTPSubmit = $this->repository->SubmitOTP($CodeOtp, $User['kode_user']);

            //return entity response
            return new AuthEntitiesDomain(
                $OTPSubmit['kode_user'],
                Carbon::parse($OTPSubmit['expired_at'])->timezone(config('app.timezone'))->format('H:i:s')
            );
        }

        return ErrorRes('Nomor whatsapp sudah terdaftar, silahkan Login atau daftar dengan Nomor Whatsapp baru.', 422);
    }


    public function AuthRepositoryResendOtp(string $kode_user, string $SuccessMessageResendOtp): JsonResponse
    {

        //validasi kode user
        $user_code = $this->repository->ValidateByKodeUser($kode_user);
        if ($user_code) {

            //get user by kode user
            $user = $this->repository->GetUserByKodeUser($kode_user);

            //Send otp ke whatsapp client
            $CodeOtp = $this->repository->SendOTP($user->whatsapp, $user->full_name);

            //Generate OTP
            $OTPSubmit = $this->repository->SubmitOTP($CodeOtp, $user->kode_user);

            //return success resend
            return OkRes($SuccessMessageResendOtp, $OTPSubmit);
        }


        return ErrorRes('Invalid kode user', 422);
    }


    public function AuthRepositoryForgotPassword(int $nomor_whatsapp): JsonResponse|AuthEntitiesDomain
    {

        if (!$this->repository->ValidateNomorWhatsappIsExists($nomor_whatsapp)) {
            return ErrorRes('Nomor whatsapp tidak terdaftar', 422);
        }

        //validate & get user by nomor whatsapp
        $user = $this->repository->ValidateNomorWhatsapp($nomor_whatsapp);

        //Send otp ke whatsapp client
        $CodeOtp = $this->repository->SendOTP($user->whatsapp, $user->full_name);

        //Generate OTP
        $OTPSubmit = $this->repository->SubmitOTP($CodeOtp, $user->kode_user);

        return new AuthEntitiesDomain(
            $OTPSubmit['kode_user'],
            Carbon::parse($OTPSubmit['expired_at'])->timezone(config('app.timezone'))->format('H:i:s'),
            'forgot_token'
        );
    }

    public function AuthRepositoryResetPassword(
        AuthResetPasswordDTOs $AuthResetPasswordDTO,
    ): void {
        //validasi password confirmation
        $this->repository->GetUserByKodeUser($AuthResetPasswordDTO->Kode_user)->update([
            'password' => Hash::make($AuthResetPasswordDTO->Password)
        ]);
    }
}
