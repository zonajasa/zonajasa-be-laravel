<?php

namespace App\Internal\Api\v1\Jasa\Handler;

use App\Internal\Api\v1\Jasa\Constant\JasaConstant;
use App\Internal\Api\v1\Jasa\Usecase\JasaUsecase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\JsonResponse;

class JasaHandler extends JasaConstant
{
    public function __construct(
        private JasaUsecase $usecase
    ) {}

    public function index(): array|JsonResponse|null
    {
        try {
            $data = $this->usecase->index(Auth::guard('api')->user()->kode_user);
            return !empty($data) ? OkRes(static::MESSAGE_SUCCESS_GET_SERVICE, $data) : ErrorRes(static::MESSAGE_UNSUCCESS_GET_SERVICE);
        } catch (\Exception $error) {
            Log::error('JasaServiceDomain index Error: ' . $error->getMessage());
            return ErrorRes(static::MESSAGE_INTERNAL_SERVER_ERROR, 500);
        }
    }

    public function create(Request $request): JsonResponse
    {
        $req = $request->post();
        if (empty($req)) {
            return ErrorRes(self::INVALID_REQUEST);
        }

        DB::beginTransaction();
        try {
            $this->usecase->create($req, Auth::guard('api')->user()->kode_user);
            DB::commit();
            return OkRes(static::MESSAGE_SUCCESS_CREATE_JASA, true);
        } catch (\Exception $error) {
            DB::rollBack();
            Log::error('JasaServiceDomain create Error: ' . $error->getMessage());
            return ErrorRes(static::MESSAGE_INTERNAL_SERVER_ERROR, 500);
        }
    }

    public function update($id, Request $request) {}

    public function delete(int $id): JsonResponse
    {
        try {
            return $this->usecase->delete($id, static::MESSAGE_INVALID_ID_SERVICE, static::MESSAGE_SUCCESS_DELETE_SERVICE, Auth::guard('api')->user()->kode_user);
        } catch (\Exception $error) {
            DB::rollBack();
            Log::error('JasaServiceDomain delete Error: ' . $error->getMessage());
            return ErrorRes(static::MESSAGE_INTERNAL_SERVER_ERROR, 500);
        }
    }
}
