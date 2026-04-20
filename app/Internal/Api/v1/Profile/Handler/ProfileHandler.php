<?php

namespace App\Internal\Api\v1\Profile\Handler;

use App\Internal\Api\v1\Profile\Constant\ProfileConstant;
use App\Internal\Api\v1\Profile\Usecase\ProfileUsecase;
use Illuminate\Http\Request;

class ProfileHandler extends ProfileConstant
{
    public function __construct(
        private ProfileUsecase $usecase
    ) {}

    public function update(int $id, Request $request) {}
}
