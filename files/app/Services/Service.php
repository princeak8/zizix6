<?php

namespace App\Services;

use App\Models\Service as ServiceModel;

class Service
{

    public function getService($id)
    {
        return ServiceModel::find($id);
    }

    public function getServiceByName($name)
    {
        return ServiceModel::where('name', $name)->first();
    }

    public function getServices()
    {
        return ServiceModel::all();
    }

    public function save($data)
    {
        $service = new ServiceModel;
        $service->name = $data['name'];
        $service->description = $data['description'];
        if(isset($data['expiry'])) $service->expiry =  $data['expiry'];
        $service->save();
        return $service;
    }

    public function update($service, $data)
    {
        if(isset($data['name'])) $service->name = $data['name'];
        if(isset($data['description'])) $service->description = $data['description'];
        if(isset($data['expiry'])) $service->expiry =  $data['expiry'];
        $service->update();
        return $service;
    }

    public function delete($service)
    {
        $service->delete();
    }
}