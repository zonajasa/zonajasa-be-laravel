<?php

namespace App\Domain\Web\MasterData\User\Services;

use App\Domain\Web\MasterData\User\Repositories\UserMasterRepositoriesDomainInterface;

class UserMasterServicesDomain
{
    public function __construct(
        private UserMasterRepositoriesDomainInterface $repository
    ) {}

    public function list()
    {
        return $this->repository->GetAllUser()->paginate();
    }
}
