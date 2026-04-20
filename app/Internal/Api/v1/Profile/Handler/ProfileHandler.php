<?php

namespace App\Internal\Api\v1\Profile\Handler;

use App\Internal\Api\v1\Profile\Constant\ProfileConstant;
use App\Internal\Api\v1\Profile\Usecase\ProfileUsecase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProfileHandler extends ProfileConstant
{
    public function __construct(
        private ProfileUsecase $usecase
    ) {}

    public function index(): Auth|JsonResponse
    {
        try {
            $user = Auth::guard('api')->user();
            return OkRes(static::MESSAGE_SUCCESS_GET_PROFILE, $user);
        } catch (\Exception $error) {
            Log::error('ProfileServiceDomain index Error: ' . $error->getMessage());
            return ErrorRes(static::MESSAGE_INTERNAL_SERVER_ERROR, 500);
        }
    }

    public function update(int $id, Request $request)
    {
        try {
            $request = $request->post();
            if (empty($request)) {
                return ErrorRes(static::INVALID_REQUEST);
            }

            return $this->usecase->update($id, $request, static::INVALID_USER_ID, static::MESSAGE_SUCCESS_FULLY_UPDATE_PROFILE);
        } catch (\Exception $error) {
            Log::error('ProfileServiceDomain update Error: ' . $error->getMessage());
            return ErrorRes(static::MESSAGE_INTERNAL_SERVER_ERROR, 500);
        }
    }
}
