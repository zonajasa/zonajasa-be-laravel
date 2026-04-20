<?php

namespace App\Internal\Api\v1\Profile\Usecase;

use App\Domain\Api\v1\Profile\Services\ProfileServicesDomain;

class ProfileUsecase
{
    public function __construct(
        private ProfileServicesDomain $service
    ) {}

    public function update(int $id, $request, string $MessageInvalidUserID, string $MessageSuccessFullyUpdateProfile)
    {
        return $this->service->update($id, $request, $MessageInvalidUserID, $MessageSuccessFullyUpdateProfile);
    }
}
