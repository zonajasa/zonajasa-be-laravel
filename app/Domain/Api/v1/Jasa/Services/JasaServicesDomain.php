<?php

namespace App\Domain\Api\v1\Jasa\Services;

use App\Domain\Api\v1\Jasa\Repositories\JasaRepositoriesDomainInterface;
use Illuminate\Support\Facades\Auth;
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

        //update status true of status_service:menandakan bahwa user tersebut punya jasa & layanan
        $this->repository->Query('users')->where('kode_user', Auth::guard('user')->user()->kode_user)->update(['status_service', true]);
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

        //service::child delete with waktu
        $this->repository->DeleteServiceWithWaktu($service->id);

        //service::parent delete
        $this->repository->DeleteService($service->id);

        //update status false of status_service:menandakan bahwa user tersebut sudah tidak memiliki jasa atau layanan secara record
        $this->repository->Query('users')->where('kode_user', Auth::guard('user')->user()->kode_user)->update(['status_service', false]);

        return OkRes($MessageSuccessDeleteService, $service);
    }
}
