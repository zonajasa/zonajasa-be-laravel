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
    public function ValidateNomorWhatsapp(int $NomorWhatsapp): ?User
    {
        return User::where('no_whatsapp', $NomorWhatsapp)->first();
    }

    public function ValidatePassword(string $Password, string $HashPassword): bool
    {
        return !Hash::check($Password, $HashPassword) ? false : true;
    }

    public function OTPSendRequestByWhatsapp(int $RandomCode, int $NomorWhatsapp, string $FullName): void
    {

        switch (config('app.whatsapp_gateway_mode')) {
            case 'fonte':
                Http::withHeaders([
                    'Authorization' => config('services.fonte.device_token')
                ])->post(config('services.fonte.api_base_url') . "/send", [
                    'target' => (string)$NomorWhatsapp,
                    'message' => "*{$RandomCode} Kode OTP Anda {$FullName}*\n\n"
                        . "Gunakan kode ini untuk verifikasi akun Anda.\n"
                        . "Jangan bagikan kode ini kepada siapa pun.\n"
                        . "Kode berlaku selama *1 menit*.",
                ]);
                break;
            default:
                //default is waha
                Http::withHeaders([
                    'X-Api-Key' => config('services.waha.api_key'),
                    'Accept' => config('services.waha.accept')
                ])->post(config('services.waha.api_base_url') . "/api/sendText", [
                    "chatId" => formatWhatsappNumber($NomorWhatsapp) . "@c.us",
                    "text" => "*{$RandomCode} Kode OTP Anda {$FullName}*\n\n"
                        . "Gunakan kode ini untuk verifikasi akun Anda.\n"
                        . "Jangan bagikan kode ini kepada siapa pun.\n"
                        . "Kode berlaku selama *1 menit*.",
                    "session" => "default"
                ]);
                break;
        }
    }

    public function SendOTP(int $NomorWhatsapp, string $FullName): int
    {
        $RandomCode = rand(100000, 999999); //generate random code OTP 6 digit
        $this->OTPSendRequestByWhatsapp($RandomCode, $NomorWhatsapp, $FullName);
        return $RandomCode;
    }

    public function SubmitOTPVerify(int $CodeOtp, int $NomorWhatsapp): Otp
    {
        return Otp::create([
            'code' => Crypt::encryptString($CodeOtp), //encrypt otp
            'no_whatsapp' => Crypt::encryptString(formatWhatsappNumber($NomorWhatsapp)),
            'expired_at' => now()->timezone(config('app.timezone'))->addMinute(1),
            'created_at' => now()->timezone(config('app.timezone')),
        ]);
    }

    public function FindOTPByNomorWhatsappEncrypted(string $NomorWhatsapp): ?Otp
    {
        return Otp::where('no_whatsapp', $NomorWhatsapp)->first(); //wa yang terenkripsi
    }

    public function GenerateSession(int $NomorWhatsapp): array|User
    {
        $Data['user'] = User::where('no_whatsapp', $NomorWhatsapp)->with('role')->first();

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
            'no_whatsapp' => formatWhatsappNumber($AuthRegisterDto->NomorWhatsapp),
            'password' => Hash::make($AuthRegisterDto->Password),
            'role_id' => 1 //default role sebagai pencari jasa
        ]);
    }

    public function ValidateNomorWhatsappIsExists(int $NomorWhatsapp): bool|User
    {
        return !User::where('no_whatsapp', $NomorWhatsapp)->exists() ? false : true; //gak boleh insert no whatsapp yang sudah ada sebelumnya
    }
}
