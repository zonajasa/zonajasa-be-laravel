<?php

namespace App\Internal\Web\MasterData\User\Usecase;

use App\Domain\Web\MasterData\User\Services\UserMasterServicesDomain;

class UserMasterUsecase
{

    public function __construct(
        private UserMasterServicesDomain $service
    ) {}

    public function list()
    {
        //domain interact: with list user master domain
        return $this->service->list();
    }
}
