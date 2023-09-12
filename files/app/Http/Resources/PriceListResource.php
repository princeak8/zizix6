<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\ServiceResource;
use App\Http\Resources\HostResource;

class PriceListResource extends JsonResource
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
            "service" => new ServiceResource($this->service),
            "host" => new HostResource($this->host),
            "amount" => number_format($this->amount),
            "dollar_amount" => number_format($this->dollar_amount)
        ];
    }
}
