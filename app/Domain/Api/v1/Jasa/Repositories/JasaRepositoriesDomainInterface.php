<?php

namespace App\Domain\Api\v1\Jasa\Repositories;

use Illuminate\Database\Query\Builder;

interface JasaRepositoriesDomainInterface
{
    //query builder
    public static function Query(string $TableName): Builder;
    public function ValidateServiceByID(int $Id): bool;
    public function GetServiceByID(int $Id);
    public function GetServiceByKodeUser(string $KodeUser);

    //index
    public function GetKategoriByServiceID(int $ServiceId): array;
    public function GetLayananByServiceID(int $ServiceId): array;
    public function GetGalleryByServiceID(int $ServiceId): array;
    public function GetOperationalByServiceID(int $ServiceId): array;
    public function GetWaktuByServiceID(int $ServiceId);
    //create
    public function CreateService($Data): int;
    public function CreateServiceWithCategory(int $ServiceId, $data): void;
    public function CreateServiceWithLayanan(int $ServiceId, $data): void;
    public function CreateServiceWithGallery(int $ServiceId, $data): void;
    public function CreateServiceWithOperational(int $ServiceId, $data): void;
    public function CreateServiceWithWaktu(int $ServiceId, $data): void;

    //delete
    public function DeleteService(int $Id);
    public function DeleteServiceWithCategory(int $ServiceId): void;
    public function DeleteServiceWithLayanan(int $ServiceId): void;
    public function DeleteServiceWithGallery(int $ServiceId): void;
    public function DeleteServiceWithOperational(int $ServiceId): void;
    public function DeleteServiceWithWaktu(int $ServiceId): void;
}
