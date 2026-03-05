<?php

namespace App\Infrastructure\Database\Repositories;

use App\Domain\Api\Auth\Repositories\AuthRepositoriesDomainInterface;
use App\Infrastructure\Database\Eloquent\Otp;
use App\Infrastructure\Database\Eloquent\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class AuthInfrastructureDatabaseRepositories implements AuthRepositoriesDomainInterface
{
    public function ValidateEmailOrNoWhatsapp(string $ephone): ?User
    {
        $field = filter_var($ephone, FILTER_VALIDATE_EMAIL) ? 'email' : 'no_whatsapp';
        return User::where($field, $ephone)->first();
    }

    public function ValidatePassword(string $password, string $hash_password): bool
    {
        return !Hash::check($password, $hash_password) ? false : true;
    }

    public function OTPSendRequestByWhatsapp(int $code_otp, int $no_whatsapp, string $full_name): void
    {
        //send api whatsapp
        Http::withHeaders([
            'X-Api-Key' => config('services.waha.api_key'),
            'Accept' => config('services.waha.accept')
        ])->post(config('services.waha.api_base_url') . "/api/sendText", [
            "chatId" => $no_whatsapp . "@c.us",
            "text" => "*Halo {$full_name}, Kode OTP Anda:* {$code_otp}\n\n"
                . "Gunakan kode ini untuk verifikasi akun Anda.\n"
                . "Jangan bagikan kode ini kepada siapa pun.\n"
                . "Kode berlaku selama *1 menit*.",
            "session" => "default"
        ]);
    }

    public function OTPSendRequestByEmail(int $code_otp, string $email, string $full_name): void
    {
        //send otp by email via smtp
        Mail::to($email)->send(new \App\Mail\OtpMail($code_otp, $full_name));
    }

    public function SubmitOTPVerify(int $code_otp, string $ephone): Otp
    {

        if (!filter_var($ephone, FILTER_VALIDATE_EMAIL)) {
            return Otp::create([
                'code' => Crypt::encryptString($code_otp),
                'no_whatsapp' => Crypt::encryptString($ephone),
                'expired_at' => now()->timezone(config('app.timezone'))->addMinute(1),
                'created_at' => now()->timezone(config('app.timezone')),
            ]);
        }

        return Otp::create([
            'code' => Crypt::encryptString($code_otp),
            'email' => Crypt::encryptString($ephone),
            'expired_at' => now()->timezone(config('app.timezone'))->addMinute(1),
            'created_at' => now()->timezone(config('app.timezone')),
        ]);
    }
}
