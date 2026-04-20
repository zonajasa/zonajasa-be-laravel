<?php

namespace App\Infrastructure\Http\v1\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class ServiceCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray(Request $request): array
    {
        //include jasa,layanan,galeri,operational,time
        return [
            'id' => $this->service_id,
            'kode_user' => DB::table('services')->where('id', $this->service_id)->first()->kode_user,
            'company' => DB::table('services')->where('id', $this->service_id)->first()->company,
            'description' => DB::table('services')->where('id', $this->service_id)->first()->description,
            'address' => DB::table('services')->where('id', $this->service_id)->first()->address,
            'latitude' => DB::table('services')->where('id', $this->service_id)->first()->latitude,
            'longitude' => DB::table('services')->where('id', $this->service_id)->first()->longitude,
            'layanan' => DB::table('layanan_jasas')->where('service_id', $this->service_id)->get(),
            'galeri' => DB::table('service_galleries')->where('service_id', $this->service_id)->get(),
            'operational' => DB::table('service_operationals')->where('service_id', $this->service_id)->get(),
            'time' => DB::table('service_times')->where('service_id', $this->service_id)->first(),
        ];
    }
}
