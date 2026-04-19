<?php

namespace App\Domain\Api\v1\Jasa\Services;

use App\Domain\Api\v1\Jasa\Repositories\JasaRepositoriesDomainInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class JasaServicesDomain
{
    public function __construct(
        private JasaRepositoriesDomainInterface $repository
    ) {}

    public function create($data): void
    {

        //service::parent
        $id = $this->repository->CreateService($data);

        //service::child with category
        $this->repository->CreateServiceWithCategory($id, $data);

        //service::child with layanan
        $this->repository->CreateServiceWithLayanan($id, $data);

        //service::child with galery
        $this->repository->CreateServiceWithGallery($id, $data);

        //service::child with operational
        $this->repository->CreateServiceWithOperational($id, $data);

        //service::child with waktu
        $this->repository->CreateServiceWithWaktu($id, $data);
    }

    public function delete(int $id, string $MessageInvalidIDService, string $MessageSuccessDeleteService): JsonResponse
    {
        if (!$this->repository->ValidateServiceByID($id)) {
            return ErrorRes($MessageInvalidIDService);
        }

        //service::parent
        $service = $this->repository->GetServiceByID($id);

        //service::child delete with category
        $this->repository->DeleteServiceWithCategory($service->id);

        //service::child delete service with layanan
        $this->repository->DeleteServiceWithLayanan($service->id);

        //service::child delete with gallery
        $this->repository->DeleteServiceWithGallery($service->id);

        //service::child delete with operational
        $this->repository->DeleteServiceWithOperational($service->id);

        $this->repository->DeleteServiceWithWaktu($service->id);

        $this->repository->DeleteService($service->id);

        return OkRes($MessageSuccessDeleteService, $service);
    }
}
