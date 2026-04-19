<?php

namespace App\Domain\Api\v1\Jasa\Repositories;

use Illuminate\Database\Query\Builder;

interface JasaRepositoriesDomainInterface
{
    //query builder
    public static function Query(string $TableName): Builder;

    //create
    public function CreateService($data): int;
    public function CreateServiceWithCategory(int $service_id, $data): void;
    public function CreateServiceWithLayanan(int $service_id, $data): void;
    public function CreateServiceWithGallery(int $service_id, $data): void;
    public function CreateServiceWithOperational(int $service_id, $data): void;
    public function CreateServiceWithWaktu(int $service_id, $data): void;

    //delete
    public function ValidateServiceByID(int $id): bool;
    public function GetServiceByID(int $id);
    public function DeleteService(int $id);
    public function DeleteServiceWithCategory(int $service_id): void;
    public function DeleteServiceWithLayanan(int $service_id): void;
    public function DeleteServiceWithGallery(int $service_id): void;
    public function DeleteServiceWithOperational(int $service_id): void;
    public function DeleteServiceWithWaktu(int $service_id): void;
}
