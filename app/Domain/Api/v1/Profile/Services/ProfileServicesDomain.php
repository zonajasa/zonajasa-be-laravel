<?php

namespace App\Domain\Api\v1\Profile\Services;

use App\Domain\Api\v1\Profile\Repositories\ProfileRepositoriesDomainInterface;

class ProfileServicesDomain
{
    public function __construct(
        private ProfileRepositoriesDomainInterface $repository
    ) {}
}
