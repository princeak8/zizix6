<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\PackageServiceResource;
use App\Http\Resources\ClientResource;

class PackageMinResource extends JsonResource
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
            'total_services' => $this->services->count(),
            'client_id' => $this->client_id,
            'services' => PackageServiceResource::collection($this->whenLoaded('services'))
        ];
    }
}
