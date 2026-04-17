<?php

namespace App\Internal\Api\v1\Jasa\Handler;

use App\Internal\Api\v1\Jasa\Constant\JasaConstant;
use App\Internal\Api\v1\Jasa\Usecase\JasaUsecase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\JsonResponse;

class JasaHandler extends JasaConstant
{
    public function __construct(
        private JasaUsecase $usecase
    ) {}

    public function index() {}
    public function create(Request $request): JsonResponse
    {
        $req = $request->post();
        if (empty($req)) {
            return ErrorRes(self::INVALID_REQUEST);
        }

        DB::beginTransaction();
        try {
            $this->usecase->create($req);
            DB::commit();
            return OkRes(static::MESSAGE_SUCCESS_CREATE_JASA, true);
        } catch (\Exception $error) {
            DB::rollBack();
            Log::error('JasaServiceDomain Error: ' . $error->getMessage());
            return ErrorRes(static::MESSAGE_INTERNAL_SERVER_ERROR, 500);
        }
    }
    public function update($id, Request $request) {}
    public function delete($id, Request $request) {}
}
