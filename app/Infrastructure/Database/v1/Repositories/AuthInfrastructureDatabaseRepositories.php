<?php

namespace App\Infrastructure\Database\v1\Repositories;

use App\Domain\Api\v1\Auth\Repositories\AuthRepositoriesDomainInterface;
use App\Infrastructure\Database\v1\Eloquent\Otp;
use App\Infrastructure\Database\v1\Eloquent\User;
use App\Internal\Api\v1\Auth\DTOs\AuthRegisterDTOs;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AuthInfrastructureDatabaseRepositories implements AuthRepositoriesDomainInterface
{
    public function ValidateNoWhatsapp(int $NoWhatsapp): ?User
    {
        return User::where('no_whatsapp', $NoWhatsapp)->first();
    }

    public function ValidatePassword(string $Password, string $HashPassword): bool
    {
        return !Hash::check($Password, $HashPassword) ? false : true;
    }

    public function OTPSendRequestByWhatsapp(int $RandomCode, int $NoWhatsapp, string $FullName): void
    {

        switch (config('app.whatsapp_gateway_mode')) {
            case 'fonte':
                Http::withHeader([])->post(config('services.fonte.api_base_url') . "/send", []);
                break;
            default:
                //default is waha
                Http::withHeaders([
                    'X-Api-Key' => config('services.waha.api_key'),
                    'Accept' => config('services.waha.accept')
                ])->post(config('services.waha.api_base_url') . "/api/sendText", [
                    "chatId" => formatWhatsappNumber($NoWhatsapp) . "@c.us",
                    "text" => "*{$RandomCode} Kode OTP Anda {$FullName}*\n\n"
                        . "Gunakan kode ini untuk verifikasi akun Anda.\n"
                        . "Jangan bagikan kode ini kepada siapa pun.\n"
                        . "Kode berlaku selama *1 menit*.",
                    "session" => "default"
                ]);
                break;
        }
    }

    public function SendOTP(int $NoWhatsapp, string $FullName): int
    {
        $RandomCode = rand(100000, 999999); //generate random code OTP 6 digit
        $this->OTPSendRequestByWhatsapp($RandomCode, $NoWhatsapp, $FullName);
        return $RandomCode;
    }

    public function SubmitOTPVerify(int $otp, int $NoWhatsapp): Otp
    {
        return Otp::create([
            'code' => Crypt::encryptString($otp), //encrypt otp
            'no_whatsapp' => Crypt::encryptString(formatWhatsappNumber($NoWhatsapp)),
            'expired_at' => now()->timezone(config('app.timezone'))->addMinute(1),
            'created_at' => now()->timezone(config('app.timezone')),
        ]);
    }

    public function FindOTPByPhone(int $NoWhatsapp): ?Otp
    {
        return Otp::where('no_whatsapp', $NoWhatsapp)->first(); //wa yang terenkripsi
    }

    public function GenerateSession(int $NoWhatsapp): array|User
    {
        $Data['user'] = User::where('no_whatsapp', $NoWhatsapp)->with('role')->first();

        $TokenResult = $Data['user']->createToken('zonajasa');
        $TokenModel = $TokenResult->token;

        $Expires = Carbon::now(config('app.timezone'))->addMonth();

        $TokenModel->expires_at = $Expires;
        $TokenModel->save();

        $Data['token'] = $TokenResult->accessToken;
        $Data['expired_at'] = Carbon::parse($Expires)->format('Y-m-d H:i:s');

        return $Data;
    }

    public function UserRegister(AuthRegisterDTOs $AuthRegisterDto): User
    {
        return User::create([
            'nama_lengkap' => $AuthRegisterDto->NamaLengkap,
            'no_whatsapp' => formatWhatsappNumber($AuthRegisterDto->NoWhatsapp),
            'password' => Hash::make($AuthRegisterDto->Password),
            'role_id' => 1 //default role sebagai pencari jasa
        ]);
    }

    public function ValidateNoWhatsappIsExists(int $NoWhatsapp): bool|User
    {
        return !User::where('no_whatsapp', $NoWhatsapp)->exists() ? false : true; //gak boleh insert no whatsapp yang sudah ada sebelumnya
    }
}
