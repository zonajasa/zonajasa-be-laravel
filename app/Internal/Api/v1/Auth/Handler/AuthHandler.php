<?php

namespace App\Internal\Api\v1\Auth\Handler;

use App\Infrastructure\Database\v1\Eloquent\User;
use App\Infrastructure\Http\v1\Request\LoginRequestInfrastructure;
use App\Infrastructure\Http\v1\Request\RegisterRequestInfrastructure;
use App\Infrastructure\Http\v1\Request\VerifyOTPRequestInfrastructure;
use App\Internal\Api\v1\Auth\Constant\AuthConstant;
use App\Internal\Api\v1\Auth\DTOs\AuthLoginDTOs;
use App\Internal\Api\v1\Auth\DTOs\AuthRegisterDTOs;
use App\Internal\Api\v1\Auth\DTOs\AuthVerifyOtpDTOs;
use App\Internal\Api\v1\Auth\Usecase\AuthUsecase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthHandler extends AuthConstant
{
    public function __construct(
        private AuthUsecase $usecase
    ) {}

    public function Login(Request $request, LoginRequestInfrastructure $Validation): JsonResponse
    {
        try {
            $Validated = $Validation->rules($request);

            if ($Validated->fails()) {
                return CustomError(collect($Validated->errors()), 'Data tidak lengkap');
            }

            $AuthLoginDto = new AuthLoginDTOs($request->nomor_whatsapp, $request->password); //simpan object 

            return $this->usecase->AuthServiceLogin(
                $AuthLoginDto,
                static::MESSAGE_ERROR_EMAIL_OR_NO_WHATSAPP,
                static::MESSAGE_SUCCESS_LOGIN,
                static::MESSAGE_VERIFY_ACCOUNT
            );
        } catch (\Exception $error) {
            Log::error('AuthServicesDomain Error: ' . $error->getMessage());
            return ErrorRes(static::MESSAGE_INTERNAL_SERVER_ERROR, 500);
        }
    }

    public function VerifyOTP(Request $request, VerifyOTPRequestInfrastructure $Validation): JsonResponse|array|User
    {
        try {
            $Validated = $Validation->rules($request);

            if ($Validated->fails()) {
                return CustomError(collect($Validated->errors()), 'Data tidak lengkap');
            }

            $AuthVerifyOtpDTO = new AuthVerifyOtpDTOs($request->otp, $request->kode_user); //store dto verify OTP
            return $this->usecase->AuthServiceVerifyOTP(
                $AuthVerifyOtpDTO,
                static::OTP_INVALID,
                static::MESSAGE_VERIFICATION_OTP_FAILED,
                static::MESSAGE_SUCCESS_VERIFY_OTP,
                static::MESSAGE_OTP_EXPIRED
            );
        } catch (\Exception $error) {
            Log::error('AuthServicesDomain Error: ' . $error->getMessage());
            return ErrorRes(static::MESSAGE_INTERNAL_SERVER_ERROR, 500);
        }
    }

    public function ResendOTP(Request $request): JsonResponse
    {
        try {
            $kode_user = $request->post('kode_user'); //should be body request
            if (empty($kode_user)) {
                return ErrorRes(static::MESSAGE_INPUT_INVALID, 422);
            }

            return $this->usecase->AuthServiceResendOtp($kode_user, static::MESSAGE_SUCCESS_RESEND_OTP);
        } catch (\Exception $error) {
            Log::error('AuthServicesDomain Error: ' . $error->getMessage());
            return ErrorRes(static::MESSAGE_INTERNAL_SERVER_ERROR, 500);
        }
    }

    public function Register(Request $request, RegisterRequestInfrastructure $validation)
    {
        $validated = $validation->rules($request);

        if ($validated->fails()) {
            return CustomError(collect($validated->errors()), 'Data tidak lengkap');
        }

        //store in dto for object request
        $AuthRegisterDto = new AuthRegisterDTOs($request->nama_lengkap, $request->nomor_whatsapp, $request->password); //simpan object

        DB::beginTransaction();
        try {
            $register = $this->usecase->AuthServiceRegister($AuthRegisterDto);
            DB::commit();

            if ($register instanceof JsonResponse) {
                return $register; //return response error jika nomor whatsapp sudah terdaftar
            } else {
                //return response success
                return OkRes(static::MESSAGE_SUCCESS_REGISTER, [
                    'kode_user' => $register->GetKodeUser(),
                    'expire' => $register->GetExpire(),
                    'label' => $register->GetLabel()
                ]);
            }
        } catch (\Exception $error) {
            DB::rollBack();
            Log::error('AuthServicesDomain Error: ' . $error->getMessage());
            return ErrorRes('Maaf terjadi kesalahan pada sistem', 500);
        }
    }

    public function Logout(): JsonResponse
    {
        try {
            // Revoke the current access token and associated refresh token for Passport
            $logout = Auth::guard('api')->user()->token()->delete();
            return OkRes(static::MESSAGE_SUCCESS_LOGOUT, $logout);
        } catch (\Exception $error) {
            Log::error('AuthServicesDomain Error: ' . $error->getMessage());
            return ErrorRes(static::MESSAGE_INTERNAL_SERVER_ERROR, 500);
        }
    }

    public function Profile(): JsonResponse
    {
        try {
            return OkRes(static::MESSAGE_SUCCESS_PROFILE, Auth::guard('api')->user()); //return user by session
        } catch (\Exception $error) {
            Log::error('AuthServicesDomain Error: ' . $error->getMessage());
            return ErrorRes(static::MESSAGE_INTERNAL_SERVER_ERROR, 500);
        }
    }
}
