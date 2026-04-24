<?php

namespace App\Domain\Api\v1\Profile\Services;

use App\Domain\Api\v1\Profile\Repositories\ProfileRepositoriesDomainInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProfileServicesDomain
{
    public function __construct(
        private ProfileRepositoriesDomainInterface $repository
    ) {}

    private static function UpdateMapping($request): array
    {
        return array(
            'role_id' => $request['role_id'],
            'full_name' => $request['full_name'],
            'image' => $request['image'] ? Base64Image($request['image'], 'uploads/profile') : null
        );
    }
    public function update(int $id, $request, string $MessageInvalidUserID, string $MessageSuccessFullyUpdateProfile): JsonResponse
    {
        if (!$this->repository->ValidateUserByID($id)) {
            return ErrorRes($MessageInvalidUserID);
        }

        $this->repository->UpdateProfile($id, $this->UpdateMapping($request));

        return OkRes($MessageSuccessFullyUpdateProfile, true);
    }
}
