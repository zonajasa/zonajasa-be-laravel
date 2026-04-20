<?php

namespace App\Internal\Api\v1\Auth\Handler;

use App\Infrastructure\Database\v1\Eloquent\User;
use App\Infrastructure\Http\v1\Request\LoginRequestInfrastructure;
use App\Infrastructure\Http\v1\Request\RegisterRequestInfrastructure;
use App\Infrastructure\Http\v1\Request\ResetPasswordRequestInfrastructure;
use App\Infrastructure\Http\v1\Request\VerifyOTPRequestInfrastructure;
use App\Internal\Api\v1\Auth\Constant\AuthConstant;
use App\Internal\Api\v1\Auth\DTOs\AuthLoginDTOs;
use App\Internal\Api\v1\Auth\DTOs\AuthRegisterDTOs;
use App\Internal\Api\v1\Auth\DTOs\AuthResetPasswordDTOs;
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

            $AuthVerifyOtpDTO = new AuthVerifyOtpDTOs($request->otp, $request->kode_user, $request->type); //store dto verify OTP
            return $this->usecase->AuthServiceVerifyOTP(
                $AuthVerifyOtpDTO,
                static::OTP_INVALID,
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
                return ErrorRes(static::MESSAGE_INPUT_KODE_USER_IS_NULL, 422);
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
        $AuthRegisterDto = new AuthRegisterDTOs($request->full_name, $request->nomor_whatsapp, $request->password); //simpan object

        DB::beginTransaction();
        try {
            $register = $this->usecase->AuthServiceRegister($AuthRegisterDto);
            DB::commit();

            if ($register instanceof JsonResponse) {
                return $register; //return json response whats if happen of service domain register
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

    public function ForgotPassword(Request $request)
    {
        DB::beginTransaction();
        try {
            $nomor_whatsapp = $request->post('nomor_whatsapp'); //should be body request
            if (empty($nomor_whatsapp)) {
                return ErrorRes(static::MESSAGE_FORGOT_INPUT_IS_NULL);
            }
            if (!is_numeric($nomor_whatsapp)) {
                return ErrorRes(static::MESSAGE_FORGOT_INPUT_INVALID_NUMERIC);
            }
            if (!isValidWhatsappNumber($nomor_whatsapp)) {
                return ErrorRes(static::MESSAGE_FORGOT_INPUT_INVALID_DIGIT);
            }

            $forgot = $this->usecase->AuthServiceForgotPassword($nomor_whatsapp, static::MESSAGE_SUCCESS_FORGOT_PASSWORD);
            DB::commit();

            if ($forgot instanceof JsonResponse) {
                return $forgot; //return json response whats if happen of service domain forgot password
            } else {
                //return response success
                return OkRes(static::MESSAGE_SUCCESS_FORGOT_PASSWORD, [
                    'kode_user' => $forgot->GetKodeUser(),
                    'expire' => $forgot->GetExpire(),
                    'label' => $forgot->GetLabel()
                ]);
            }
        } catch (\Exception $error) {
            DB::rollBack();
            Log::error('AuthServicesDomain Error: ' . $error->getMessage());
            return ErrorRes(static::MESSAGE_INTERNAL_SERVER_ERROR, 500);
        }
    }

    public function ResetPassword(Request $request, ResetPasswordRequestInfrastructure $Validation): JsonResponse
    {
        $Validated = $Validation->rules($request);

        if ($Validated->fails()) {
            return CustomError(collect($Validated->errors()), 'Data tidak lengkap');
        }

        DB::beginTransaction();
        try {
            $AuthResetPasswordDTO = new AuthResetPasswordDTOs($request->kode_user, $request->password, $request->password_confirmation); //store dto reset password
            $data = $this->usecase->AuthServiceResetPassword(
                $AuthResetPasswordDTO,
            );
            DB::commit();

            return OkRes(static::MESSAGE_SUCCESS_RESET_PASSWORD, true);
        } catch (\Exception $error) {
            DB::rollBack();
            Log::error('AuthServicesDomain Error: ' . $error->getMessage());
            return ErrorRes(static::MESSAGE_INTERNAL_SERVER_ERROR, 500);
        }
    }
}
