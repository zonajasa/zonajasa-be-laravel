<?php

namespace App\Internal\Web\MasterData\User\Handler;

use App\Infrastructure\Http\v1\Request\UserMasterRequestInfrastructure;
use App\Internal\Web\MasterData\User\Usecase\UserMasterUsecase;
use Illuminate\Http\Request;

class UserMasterHandler
{
    public function __construct(
        private UserMasterUsecase $usecase
    ) {}

    public function list()
    {
        try {
            return $this->usecase->list();
        } catch (\Exception $error) {
        }
    }
    public function store(Request $request, UserMasterRequestInfrastructure $validate)
    {
        try {
            $validate = $validate->rules($request);
            if ($validate->fails()) {
                return CustomError($validate->errors(), 'Data tidak lengkap');
            }
        } catch (\Exception $error) {
        }
    }
    public function update()
    {
        try {
        } catch (\Exception $error) {
        }
    }
    public function delete()
    {
        try {
        } catch (\Exception $error) {
        }
    }
}
