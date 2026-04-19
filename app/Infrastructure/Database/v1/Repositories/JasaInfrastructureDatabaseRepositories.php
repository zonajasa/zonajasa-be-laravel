<?php

namespace App\Infrastructure\Database\v1\Repositories;

use App\Domain\Api\v1\Jasa\Repositories\JasaRepositoriesDomainInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JasaInfrastructureDatabaseRepositories implements JasaRepositoriesDomainInterface
{
    //query builder
    public static function Query(string $TableName): Builder
    {
        return DB::table($TableName);
    }

    public function ValidateServiceByID(int $id): bool
    {
        return !$this->Query('services')->where('id', $id)->exists() ? false : true;
    }

    public function GetServiceByID(int $id)
    {
        return $this->Query('services')->where('id', $id)->first();
    }

    public function GetServiceByKodeUser(string $KodeUser)
    {
        return $this->Query('services')->where('kode_user', $KodeUser)->first();
    }

    //list jasa

    //create jasa
    public function CreateService($data): int
    {
        return $this->Query('services')->insertGetId([
            'kode_user' => Auth::guard('api')->user()->kode_user,
            'company' => $data['service']['company'],
            'description' => $data['service']['description'],
            'address' => $data['service']['address'],
            'latitude' => $data['service']['latitude'],
            'longitude' => $data['service']['longitude'],
            'created_at' => now()->timezone(config('app.timezone')),
        ]);
    }

    public function CreateServiceWithCategory(int $service_id, $data): void
    {

        $categories = $data['service_kategori']['categoryId'] ?? [];
        $insertCategories = [];

        foreach ($categories as $category) {
            $insertCategories[] = [
                'service_id' => $service_id,
                'categories_id' => $category,
                'created_at' => now()->timezone(config('app.timezone'))
            ];
        }
        $this->Query('service_categories')->insert($insertCategories);
    }

    public function CreateServiceWithLayanan(int $service_id, $data): void
    {
        $layanans = $data['service_layanan'] ?? [];
        $insertLayanan = [];


        foreach ($layanans as $layanan) {
            $insertLayanan[] = [
                'service_id' => $service_id,
                'categories_id' => $layanan['categoryId'],
                'name' => $layanan['name'],
                'harga' => $layanan['harga'],
                'image' => $layanan['image'],
                'created_at' => now()->timezone(config('app.timezone'))
            ];
        }
        $this->Query('layanan_jasas')->insert($insertLayanan);
    }

    public function CreateServiceWithGallery(int $service_id, $data): void
    {
        $galleries = $data['service_galeri']['image'] ?? [];
        $insertGallery = [];

        foreach ($galleries as $gallery) {
            $insertGallery[] = [
                'service_id' => $service_id,
                'image' => $gallery,
                'created_at' => now()->timezone(config('app.timezone'))
            ];
        }
        $this->Query('service_galleries')->insert($insertGallery);
    }

    public function CreateServiceWithOperational(int $service_id, $data): void
    {
        $operationals = $data['service_operational']['day'] ?? [];
        $insertOperational = [];

        foreach ($operationals as $operational) {
            $insertOperational[] = [
                'service_id' => $service_id,
                'day' => $operational,
                'created_at' => now()->timezone(config('app.timezone'))
            ];
        }
        $this->Query('service_operationals')->insert($insertOperational);
    }

    public function CreateServiceWithWaktu(int $service_id, $data): void
    {
        $this->Query('service_times')->insert([
            'service_id' => $service_id,
            'openTime' => $data['service_waktu']['openTime'],
            'closeTime' => $data['service_waktu']['closeTime'],
            'created_at' => now()->timezone(config('app.timezone'))
        ]);
    }

    //delete / tutup jasa

    public function DeleteService(int $id)
    {
        return $this->Query('services')->delete($id);
    }
    public function DeleteServiceWithCategory(int $service_id): void
    {
        $this->Query('service_categories')->where('service_id', $service_id)->delete();
    }
    public function DeleteServiceWithLayanan(int $service_id): void
    {
        $this->Query('layanan_jasas')->where('service_id', $service_id)->delete();
    }
    public function DeleteServiceWithGallery(int $service_id): void
    {
        $this->Query('service_galleries')->where('service_id', $service_id)->delete();
    }
    public function DeleteServiceWithOperational(int $service_id): void
    {
        $this->Query('service_operationals')->where('service_id', $service_id)->delete();
    }
    public function DeleteServiceWithWaktu(int $service_id): void
    {
        $this->Query('service_times')->where('service_id', $service_id)->delete();
    }
}
