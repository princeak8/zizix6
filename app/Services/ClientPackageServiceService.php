<?php

namespace App\Services;

use App\Models\ClientPackageService;

class ClientPackageServiceService
{

    public function getPackageService($id)
    {
        return ClientPackageService::find($id);
    }

    public function getPackageServices($package_id)
    {
        return ClientPackageService::where('package_id', $package_id)->get();
    }

    public function getAllPackageServices()
    {
        return ClientPackageService::all();
    }

    public function save($data)
    {
        $packageService = new ClientPackageService;
        $packageService->client_id = $data['client_id'];
        $packageService->package_id = $data['package_id'];
        $packageService->service_id = $data['service_id'];
        if(isset($data['name'])) $packageService->name = $data['name'];
        if(isset($data['expiry_date'])) $packageService->expiry_date = $data['expiry_date'];
        if(isset($data['host'])) $packageService->host = $data['host'];
        $packageService->save();
        return $packageService;
    }

    public function update($packageService, $data)
    {
        $keys = array_keys($data);
        if(isset($data['client_id'])) $packageService->client_id = $data['client_id'];
        if(isset($data['package_id'])) $packageService->package_id = $data['package_id'];
        if(isset($data['service_id'])) $packageService->service_id = $data['service_id'];
        if(isset($data['name'])) $packageService->name = $data['name'];
        if(in_array('expiry_date', $keys)) {
            if(isset($data['expiry_date']) || is_null($data['expiry_date'])) {
                $packageService->expiry_date = $data['expiry_date'];
            }
        }
        if(isset($data['host'])) $packageService->host = $data['host'];
        $packageService->update();
        return $packageService;
    }

    public function delete($packageService)
    {
        $packageService->delete();
    }
}