<?php

namespace App\Services;

use App\Models\PriceList;
use App\Models\ConversionRate;

class PriceListService
{

    public function getPriceList($id)
    {
        return PriceList::find($id);
    }

    public function getServicePriceLists($service_id)
    {
        return PriceList::where('service_id', $service_id)->get();
    }

    public function getHostPriceLists($host_id)
    {
        return PriceList::where('host_id', $host_id)->get();
    }

    public function getPriceListByHostAndService($service_id, $host_id)
    {
        return PriceList::where('host_id', $host_id)->where('service_id', $service_id)->first();
    }

    public function getPriceLists()
    {
        return PriceList::all();
    }

    public function save($data)
    {
        $list = new PriceList;
        $list->service_id = $data['service_id'];
        if(isset($data['dollar_amount'])) $list->dollar_amount = $data['dollar_amount'];
        if(isset($data['amount'])) $list->amount = $data['amount'];
        if(isset($data['host_id'])) $list->host_id =  $data['host_id'];
        $list->save();
        return $list;
    }

    public function update($priceList, $data)
    {
        if(isset($data['service_id'])) $priceList->service_id = $data['service_id'];
        if(isset($data['dollar_amount'])) $priceList->dollar_amount = $data['dollar_amount'];
        if(isset($data['amount'])) $priceList->amount = $data['amount'];
        if(isset($data['host_id'])) $priceList->host_id =  $data['host_id'];
        $priceList->update();
        return $priceList;
    }

    public function delete($priceList)
    {
        $priceList->delete();
    }
}