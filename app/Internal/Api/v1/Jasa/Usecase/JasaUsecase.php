<?php

namespace App\Internal\Api\v1\Jasa\Usecase;

use App\Domain\Api\v1\Jasa\Services\JasaServicesDomain;
use Symfony\Component\HttpFoundation\JsonResponse;

class JasaUsecase
{
    public function __construct(
        private JasaServicesDomain $service
    ) {}

    public function index(string $KodeUser): array|null
    {
        //interact with domain index jasa
        return $this->service->index($KodeUser);
    }

    public function create($data, string $KodeUser): void
    {
        //interact with domain create jasa
        $this->service->create($data, $KodeUser);
    }

    public function delete(int $id, string $MessageInvalidIDService, string $MessageSuccessDeleteService, string $KodeUser): JsonResponse
    {
        //interact with domain delete jasa
        return $this->service->delete($id, $MessageInvalidIDService, $MessageSuccessDeleteService, $KodeUser);
    }
}
