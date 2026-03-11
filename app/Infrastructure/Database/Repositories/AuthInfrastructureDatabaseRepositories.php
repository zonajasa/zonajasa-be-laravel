<?php

namespace App\Infrastructure\Database\Repositories;

use App\Domain\Api\Auth\Repositories\AuthRepositoriesDomainInterface;
use App\Infrastructure\Database\Eloquent\Otp;
use App\Infrastructure\Database\Eloquent\User;
use App\Internal\Api\Auth\DTOs\AuthRegisterDTOs;
use Carbon\Carbon;
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
            "text" => "*{$code_otp} Kode OTP Anda {$full_name}*\n\n"
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

    public function GenerateOTP(string $ephone, string $full_name): int
    {
        $otp = rand(100000, 999999);
        filter_var($ephone, FILTER_VALIDATE_EMAIL)
            ? $this->OTPSendRequestByEmail($otp, $ephone, $full_name) :
            $this->OTPSendRequestByWhatsapp($otp, $ephone, $full_name);
        return $otp;
    }

    public function SubmitOTPVerify(int $code_otp, string $ephone): Otp
    {

        if (!filter_var($ephone, FILTER_VALIDATE_EMAIL)) {
            return Otp::create([
                'code' => Crypt::encryptString($code_otp),
                'no_whatsapp' => Crypt::encryptString(formatWhatsappNumber($ephone)),
                'expired_at' => now()->timezone(config('app.timezone'))->addMinute(1),
                'created_at' => now()->timezone(config('app.timezone')),
            ]);
        }

        //default nya email kalo bukan whatsapp
        return Otp::create([
            'code' => Crypt::encryptString($code_otp),
            'email' => Crypt::encryptString($ephone),
            'expired_at' => now()->timezone(config('app.timezone'))->addMinute(1),
            'created_at' => now()->timezone(config('app.timezone')),
        ]);
    }

    public function FindOTPByPhone(string $phone): ?Otp
    {
        return Otp::where('no_whatsapp', $phone)->first(); //wa yang terenkripsi
    }
    public function FindOTPByEmailAddress(string $email): ?Otp
    {
        return Otp::where('email', $email)->first(); //email yang terenkripsi
    }

    public function GenerateSession(string $ephone): array|User
    {
        $field = filter_var($ephone, FILTER_VALIDATE_EMAIL) ? 'email' : 'no_whatsapp';

        $data['user'] = User::where($field, $ephone)->first();

        $tokenResult = $data['user']->createToken('zonajasa');
        $tokenModel = $tokenResult->token;

        $expires = Carbon::now(config('app.timezone'))->addMonth();

        $tokenModel->expires_at = $expires;
        $tokenModel->save();

        $data['token'] = $tokenResult->accessToken;
        $data['expired_at'] = $expires;

        return $data;
    }

    public function UserRegister(AuthRegisterDTOs $data): User
    {

        if (filter_var($data->ephone, FILTER_VALIDATE_EMAIL)):
            return User::create([
                'nama_lengkap' => $data->nama_lengkap,
                'email' => $data->ephone,
                'password' => Hash::make($data->password),
            ]);
        endif;

        //default nya whatssapp
        return User::create([
            'nama_lengkap' => $data->nama_lengkap,
            'no_whatsapp' => formatWhatsappNumber($data->ephone),
            'password' => Hash::make($data->password),
        ]);
    }

    public function ValidateEmailIsExists(string $email): bool|User
    {
        return !User::where('email', $email)->exists() ? false : true; //gak boleh insert email yang sudah ada sebelumnya
    }

    public function ValidateNoWhatsappIsExists(string $no_whatsapp): bool|User
    {
        return !User::where('no_whatsapp', $no_whatsapp)->exists() ? false : true; //gak boleh insert no whatsapp yang sudah ada sebelumnya
    }
}
