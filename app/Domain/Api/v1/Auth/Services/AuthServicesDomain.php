<?php

namespace App\Domain\Api\v1\Auth\Services;

use App\Domain\Api\v1\Auth\Repositories\AuthRepositoriesDomainInterface;
use App\Infrastructure\Database\v1\Eloquent\User;
use App\Internal\Api\v1\Auth\DTOs\AuthLoginDTOs;
use App\Internal\Api\v1\Auth\DTOs\AuthRegisterDTOs;
use App\Internal\Api\v1\Auth\DTOs\AuthVerifyOtpDTOs;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
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
        if ($user->status == 'Y') {
            $user = $this->repository->GenerateSession(formatWhatsappNumber($AuthLoginDto->no_whatsapp));
            return OkRes($MessageSuccessLogin, $user);
        }

        return ErrorRes($MessageVerifyAccount);
    }

    public function AuthRepositoryVerifyOTP(
        AuthVerifyOtpDTOs $AuthVerifyOtpDTO,
        string $MessageOtpInvalid,
        string $MessageVerificationOtpFailed,
        string $MessageSuccessVerifyOtp
    ): JsonResponse|array|User {
        $Data = $this->repository->FindOTPByNomorWhatsappEncrypted($AuthVerifyOtpDTO->nomor_whatsapp);
        if (!empty($Data)) {

            //decrypt otp yang terenkripsi base on dari whatsapp yang terenkripsi lalu dibandingkan dengan otp yang dikirim client
            if (Crypt::decryptString($Data->code) != $AuthVerifyOtpDTO->otp) {
                return ErrorRes($MessageOtpInvalid, 422);
            }
            $GenerateSessionByWhatsappNumber = $this->repository->GenerateSession(Crypt::decryptString($Data->no_whatsapp)); //decrypt nomor whatsapp kemudian generate session user berdasarkan dari nomor whatsapp nya
            return OkRes($MessageSuccessVerifyOtp, $GenerateSessionByWhatsappNumber);
        }

        return ErrorRes($MessageVerificationOtpFailed, 422);
    }

    public function AuthRepositoryRegister(AuthRegisterDTOs $AuthRegisterDto, string $MessageSuccessRegister)
    {
        //validasi no whatsapp
        if ($this->repository->ValidateNomorWhatsappIsExists(formatWhatsappNumber($AuthRegisterDto->NomorWhatsapp))) {
            return ErrorRes('No whatsapp sudah terdaftar, silahkan Login atau daftar dengan Nomor Whatsapp baru.', 422);
        }

        //register user
        $User = $this->repository->UserRegister($AuthRegisterDto);

        //Send otp ke whatsapp client
        $CodeOtp = $this->repository->SendOTP($AuthRegisterDto->NomorWhatsapp, $User['nama_lengkap']);

        //Generate OTP
        $OTPSubmit = $this->repository->SubmitOTPVerify($CodeOtp, $AuthRegisterDto->NomorWhatsapp);

        //return response success
        return OkRes($MessageSuccessRegister, [
            'no_whatsapp' => $OTPSubmit['no_whatsapp'], //yang dikirim dari depan adalah no whatsapp yang terenkripsi
            'expire' => Carbon::parse($OTPSubmit['expired_at'])->timezone(config('app.timezone'))
                ->format('H:i:s')

        ]);
    }
}
