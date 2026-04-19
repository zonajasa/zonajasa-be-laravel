<?php

namespace App\Internal\Api\v1\Jasa\Usecase;

use App\Domain\Api\v1\Jasa\Services\JasaServicesDomain;
use Symfony\Component\HttpFoundation\JsonResponse;

class JasaUsecase
{
    public function __construct(
        private JasaServicesDomain $service
    ) {}

    public function create($data): void
    {
        //interact with domain create jasa
        $this->service->create($data);
    }

    public function delete(int $id, string $MessageInvalidIDService, string $MessageSuccessDeleteService): JsonResponse
    {
        //interact with domain delete jasa
        return $this->service->delete($id, $MessageInvalidIDService, $MessageSuccessDeleteService);
    }
}
