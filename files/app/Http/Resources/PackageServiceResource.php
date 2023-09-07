<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\PackageMinResource;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\ClientMinResource;

class PackageServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "expiry_date" => $this->expiry_date,
            "host" => $this->host,
            "package_id" => $this->package_id,
            "service_id" => $this->service_id,
            "package" => new PackageMinResource($this->whenLoaded('package')),
            "service" => new ServiceResource($this->whenLoaded('service')),
            "client" => new ClientMinResource($this->whenLoaded('client'))
        ];
    }
}
