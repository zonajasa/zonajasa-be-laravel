<?php

namespace App\Internal\Api\Auth\Handler;

use App\Infrastructure\Database\Eloquent\User;
use App\Infrastructure\Http\Request\LoginRequestInfrastructure;
use App\Infrastructure\Http\Request\RegisterRequestInfrastructure;
use App\Infrastructure\Http\Request\VerifyOTPRequestInfrastructure;
use App\Internal\Api\Auth\Constant\AuthConstant;
use App\Internal\Api\Auth\DTOs\AuthLoginDTOs;
use App\Internal\Api\Auth\DTOs\AuthRegisterDTOs;
use App\Internal\Api\Auth\DTOs\AuthVerifyOtpDTOs;
use App\Internal\Api\Auth\Usecase\AuthUsecase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthHandler extends AuthConstant
{
    public function __construct(
        private AuthUsecase $usecase
    ) {}

    public function Login(Request $request, LoginRequestInfrastructure $validation): JsonResponse
    {
        $validated = $validation->rules($request);

        if ($validated->fails()) {
            return CustomError(collect($validated->errors()), 'Data tidak lengkap');
        }

        $dto_login = new AuthLoginDTOs($request->no_whatsapp, $request->password); //simpan object 

        return $this->usecase->AuthServiceLogin($dto_login, static::MESSAGE_ERROR_EMAIL_OR_NO_WHATSAPP, static::MESSAGE_SUCCESS_LOGIN, static::MESSAGE_VERIFY_ACCOUNT);
    }

    public function VerifyOTP(Request $request, VerifyOTPRequestInfrastructure $validation): JsonResponse|array|User
    {
        $validated = $validation->rules($request);

        if ($validated->fails()) {
            return CustomError(collect($validated->errors()), 'Data tidak lengkap');
        }

        $dto_verify_otp = new AuthVerifyOtpDTOs($request->otp, $request->no_whatsapp); //simpan object
        return $this->usecase->AuthServiceVerifyOTP($dto_verify_otp, static::OTP_INVALID, static::MESSAGE_VERIFICATION_OTP_FAILED, static::MESSAGE_SUCCESS_VERIFY_OTP);
    }

    public function Register(Request $request, RegisterRequestInfrastructure $validation)
    {
        $validated = $validation->rules($request);

        if ($validated->fails()) {
            return CustomError(collect($validated->errors()), 'Data tidak lengkap');
        }

        //static request(menentukan request yang akan di kirim)
        $dto_register = new AuthRegisterDTOs($request->nama_lengkap, $request->no_whatsapp, $request->password); //simpan object
        return $this->usecase->AuthServiceRegister($dto_register, static::MESSAGE_SUCCESS_REGISTER);
    }

    public function Logout(): JsonResponse
    {
        try {
            // Revoke the current access token and associated refresh token for Passport
            $logout = Auth::guard('api')->user()->token()->delete();
            return OkRes(static::MESSAGE_SUCCESS_LOGOUT, $logout);
        } catch (\Exception $error) {
            Log::error('AuthServicesDomain Error: ' . $error->getMessage());
            return ErrorRes('Maaf terjadi kesalahan pada sistem', 500);
        }
    }

    public function Profile(): JsonResponse
    {
        return OkRes(static::MESSAGE_SUCCESS_PROFILE, Auth::guard('api')->user()); //return user by session
    }
}
