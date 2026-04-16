<?php

namespace App\Internal\Api\v1\Jasa\Handler;

use App\Internal\Api\v1\Jasa\Constant\JasaConstant;
use App\Internal\Api\v1\Jasa\Usecase\JasaUsecase;
use Illuminate\Http\Request;

class JasaHandler extends JasaConstant
{
    public function __construct(
        private JasaUsecase $usecase
    ) {}

    public function list() {}
    public function index(Request $request)
    {
        $req = $request->post();
        if (empty($req)) {
            return ErrorRes(self::INVALID_REQUEST);
        }

        return $this->usecase->index($req);
    }
    public function update($id, Request $request) {}
    public function delete($id, Request $request) {}
}
