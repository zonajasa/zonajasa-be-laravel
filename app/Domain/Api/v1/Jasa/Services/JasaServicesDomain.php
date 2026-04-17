<?php

namespace App\Domain\Api\v1\Jasa\Services;

use App\Domain\Api\v1\Jasa\Repositories\JasaRepositoriesDomainInterface;

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
}
