<?php

namespace App\Infrastructure\Database\Repositories;

use App\Domain\Api\Auth\Repositories\AuthRepositoriesDomainInterface;
use App\Infrastructure\Database\Eloquent\Otp;
use App\Infrastructure\Database\Eloquent\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AuthInfrastructureDatabaseRepositories implements AuthRepositoriesDomainInterface
{
    public function ValidateEmailOrNoWhatsapp(string $ephone): ?User
    {
        $field = filter_var($ephone, FILTER_VALIDATE_EMAIL) ? 'email' : 'no_whatsapp';
        return User::where($field, $ephone)->first();
    }

    public function ValidatePassword(string $password, string $hashPassword): bool
    {
        return !Hash::check($password, $hashPassword) ? false : true;
    }

    public function OTPSendRequestByWhatsapp(int $code_otp, int $no_whatsapp): void
    {
        //send api whatsapp
        Http::withHeaders([
            'X-Api-Key' => config('services.waha.api_key'),
            'Accept' => config('services.waha.accept')
        ])->post(config('services.waha.api_base_url') . "/api/sendText", [
            "chatId" => $no_whatsapp . "@c.us",
            "text" => "*Kode OTP Anda:* {$code_otp}\n\n"
                . "Gunakan kode ini untuk verifikasi akun Anda.\n"
                . "Jangan bagikan kode ini kepada siapa pun.\n"
                . "Kode berlaku selama *1 menit*.",
            "session" => "default"
        ]);

        Otp::create([
            'code' => Crypt::encryptString($code_otp),
            'no_whatsapp' => Crypt::encryptString($no_whatsapp),
            'expired_at' => now()->timezone(config('app.timezone'))->addMinute(1),
            'created_at' => now()->timezone(config('app.timezone')),
        ]);
    }

    public function OTPSendRequestByEmail(int $code_otp, string $email): void
    {
        //send otp by email via smtp
    }
}
