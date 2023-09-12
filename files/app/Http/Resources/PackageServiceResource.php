<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\PackageMinResource;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\ClientMinResource;
use App\Http\Resources\HostResource;

use App\Services\PriceListService;
use App\Models\ConversionRate;

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
            "package_id" => $this->package_id,
            "service_id" => $this->service_id,
            "host_id" => $this->host_id,
            "package" => new PackageMinResource($this->whenLoaded('package')),
            "service" => new ServiceResource($this->whenLoaded('service')),
            "host" => new HostResource($this->whenLoaded('host')),
            "client" => new ClientMinResource($this->whenLoaded('client')),
            "amount" => $this->price()['amount'],
            "dollar_amount" => $this->price()['dollar_amount']
        ];
    }

    private function price()
    {
        $priceListService = new PriceListService;
        $prices = ['amount' => null, 'dollar_amount' => null];
        if($this->host) {
            $rate = ConversionRate::first();
            $price = $priceListService->getPriceListByHostAndService($this->service_id, $this->host_id);
            if($price->dollar_amount && $price->dollar_amount > 0) $prices['dollar_amount'] = number_format($price->dollar_amount);
            $prices['amount'] = ($price->dollar_amount && $price->dollar_amount > 0) 
                                ? 
                                number_format($price->dollar_amount * $rate->dollar) 
                                :
                                (($price->amount && $price->amount > 0) ? number_format($price->amount) : null);
            return $prices;
        }
    }
}
