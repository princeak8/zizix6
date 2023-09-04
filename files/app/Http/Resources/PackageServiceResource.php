<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\PackageResource;
use App\Http\Resources\ServiceResource;

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
            "package" => new PackageResource($this->whenLoaded('package')),
            "service" => new ServiceResource($this->whenLoaded('service'))
        ];
    }
}
