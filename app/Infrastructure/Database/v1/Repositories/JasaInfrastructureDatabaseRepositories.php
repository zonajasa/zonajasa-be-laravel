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

    public function ValidateServiceByID(int $Id): bool
    {
        return !$this->Query('services')->where('id', $Id)->exists() ? false : true;
    }

    public function GetServiceByID(int $Id)
    {
        return $this->Query('services')->where('id', $Id)->first();
    }

    public function GetServiceByKodeUser(string $KodeUser)
    {
        return $this->Query('services')->where('kode_user', $KodeUser)->first();
    }

    //list jasa
    public function GetAllKategori(int $limit)
    {
        return $this->Query('categories')->paginate($limit);
    }

    //index jasa
    public function GetKategoriByServiceID(int $ServiceId): array
    {
        return $this->Query('service_categories')->where('service_id', $ServiceId)->get()->toArray();
    }
    public function GetLayananByServiceID(int $ServiceId): array
    {
        return $this->Query('layanan_jasas')->where('service_id', $ServiceId)->get()->toArray();
    }
    public function GetGalleryByServiceID(int $ServiceId): array
    {
        return $this->Query('service_galleries')->where('service_id', $ServiceId)->get()->toArray();
    }
    public function GetOperationalByServiceID(int $ServiceId): array
    {
        return $this->Query('service_operationals')->where('service_id', $ServiceId)->get()->toArray();
    }
    public function GetWaktuByServiceID(int $ServiceId)
    {
        return $this->Query('service_times')->where('service_id', $ServiceId)->first();
    }

    //create jasa
    public function CreateService($Data): int
    {
        return $this->Query('services')->insertGetId([
            'kode_user' => Auth::guard('api')->user()->kode_user,
            'company' => $Data['service']['company'],
            'description' => $Data['service']['description'],
            'address' => $Data['service']['address'],
            'latitude' => $Data['service']['latitude'],
            'longitude' => $Data['service']['longitude'],
            'created_at' => now()->timezone(config('app.timezone')),
        ]);
    }

    public function CreateServiceWithCategory(int $ServiceId, $Data): void
    {

        $categories = $Data['service_kategori']['categoryId'] ?? [];
        $insertCategories = [];

        foreach ($categories as $category) {
            $insertCategories[] = [
                'service_id' => $ServiceId,
                'categories_id' => $category,
                'created_at' => now()->timezone(config('app.timezone'))
            ];
        }
        $this->Query('service_categories')->insert($insertCategories);
    }

    public function CreateServiceWithLayanan(int $ServiceId, $Data): void
    {
        $layanans = $Data['service_layanan'] ?? [];
        $insertLayanan = [];


        foreach ($layanans as $layanan) {
            $imagePath = null;

            //jika upload gambar maka jalankan helper base64 proses
            if (!empty($layanan['image'])) {
                $imagePath = Base64Image($layanan['image'], 'uploads/layanan');
            }
            $insertLayanan[] = [
                'service_id' => $ServiceId,
                'categories_id' => $layanan['categoryId'],
                'name' => $layanan['name'],
                'harga' => $layanan['harga'],
                'image' => $imagePath, //handle image with base64,compress 75%
                'created_at' => now()->timezone(config('app.timezone'))
            ];
        }
        $this->Query('layanan_jasas')->insert($insertLayanan);
    }

    public function CreateServiceWithGallery(int $ServiceId, $Data): void
    {
        $galleries = $Data['service_galeri']['image'] ?? [];
        $insertGallery = [];

        foreach ($galleries as $gallery) {
            $imagePath = null;

            //jika upload gambar maka jalankan helper base64 proses
            if (!empty($gallery)) {
                $imagePath = Base64Image($gallery, 'uploads/galeri');
            }
            $insertGallery[] = [
                'service_id' => $ServiceId,
                'image' => $imagePath,
                'created_at' => now()->timezone(config('app.timezone'))
            ];
        }
        $this->Query('service_galleries')->insert($insertGallery);
    }

    public function CreateServiceWithOperational(int $ServiceId, $Data): void
    {
        $operationals = $Data['service_operational']['day'] ?? [];
        $insertOperational = [];

        foreach ($operationals as $operational) {
            $insertOperational[] = [
                'service_id' => $ServiceId,
                'day' => $operational,
                'created_at' => now()->timezone(config('app.timezone'))
            ];
        }
        $this->Query('service_operationals')->insert($insertOperational);
    }

    public function CreateServiceWithWaktu(int $ServiceId, $Data): void
    {
        $this->Query('service_times')->insert([
            'service_id' => $ServiceId,
            'openTime' => $Data['service_waktu']['openTime'],
            'closeTime' => $Data['service_waktu']['closeTime'],
            'created_at' => now()->timezone(config('app.timezone'))
        ]);
    }

    //delete / tutup jasa

    public function DeleteService(int $Id)
    {
        return $this->Query('services')->delete($Id);
    }
    public function DeleteServiceWithCategory(int $ServiceId): void
    {
        $this->Query('service_categories')->where('service_id', $ServiceId)->delete();
    }
    public function DeleteServiceWithLayanan(int $ServiceId): void
    {
        $this->Query('layanan_jasas')->where('service_id', $ServiceId)->delete();
    }
    public function DeleteServiceWithGallery(int $ServiceId): void
    {
        $this->Query('service_galleries')->where('service_id', $ServiceId)->delete();
    }
    public function DeleteServiceWithOperational(int $ServiceId): void
    {
        $this->Query('service_operationals')->where('service_id', $ServiceId)->delete();
    }
    public function DeleteServiceWithWaktu(int $ServiceId): void
    {
        $this->Query('service_times')->where('service_id', $ServiceId)->delete();
    }
}
