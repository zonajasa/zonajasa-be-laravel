<?php

namespace App\Internal\Api\v1\Profile\Usecase;

use App\Domain\Api\v1\Profile\Services\ProfileServicesDomain;

class ProfileUsecase
{
    public function __construct(
        private ProfileServicesDomain $service
    ) {}
}
