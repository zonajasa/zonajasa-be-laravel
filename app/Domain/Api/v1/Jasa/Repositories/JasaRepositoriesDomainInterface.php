<?php

namespace App\Domain\Api\v1\Jasa\Repositories;

interface JasaRepositoriesDomainInterface
{

    public function CreateService($data): int;
    public function CreateServiceWithCategory(int $service_id, $data): void;
    public function CreateServiceWithLayanan(int $service_id, $data): void;
    public function CreateServiceWithGallery(int $service_id, $data): void;
    public function CreateServiceWithOperational(int $service_id, $data): void;
    public function CreateServiceWithWaktu(int $service_id, $data): void;
}
