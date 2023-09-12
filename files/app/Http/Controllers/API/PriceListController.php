<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\AddPriceList;
use App\Http\Requests\UpdatePriceList;

use App\Services\PriceListService;

use App\Http\Resources\PriceListResource;

use App\Utilities;

class PriceListController extends Controller
{
    private $priceListService;

    public function __construct()
    {
        $this->priceListService = new PriceListService;
    }

    public function priceLists()
    {
        try{
            $priceLists = $this->priceListService->getPriceLists();
            return Utilities::ok(PriceListResource::collection($priceLists));
        }catch(\Exception $e){
            return Utilities::error($e);
        }
    }

    public function save(AddPriceList $request)
    {
        try{
            $priceList = $this->priceListService->save($request->validated());
            return Utilities::ok(new PriceListResource($priceList));
        }catch(\Exception $e){
            return Utilities::error($e);
        }
    }

    public function update(UpdatePriceList $request)
    {
        try{
            $priceList = $this->priceListService->getPriceList($request->get('price_list_id'));
            $priceList = $this->priceListService->update($priceList, $request->validated());
            return Utilities::ok(new PriceListResource($priceList));
        }catch(\Exception $e){
            return Utilities::error($e);
        }
    }
}
