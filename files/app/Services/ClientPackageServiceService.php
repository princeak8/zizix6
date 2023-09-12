<?php

namespace App\Services;

use Carbon\Carbon;
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

    public function getAllPackageServices($count=false)
    {
        return ($count) ? ClientPackageService::count() : ClientPackageService::all();
    }

    //Get services that is about to expire
    public function getExpiringPackageServices($days, $count=false)
    {
        $now = Carbon::now();
        $query = ClientPackageService::with(['client', 'service', 'package', 'host'])->whereRaw('DATEDIFF(expiry_date, ?) < ?')->setBindings([$now, $days])->whereDate('expiry_date', '>', Carbon::now());
        return ($count) ? $query->count() : $query->get();
    }

    public function getExpiredPackageServices($count=false)
    {
        $query = ClientPackageService::with(['client', 'service', 'package', 'host'])->whereDate('expiry_date', '<', Carbon::now());
        return ($count) ? $query->count() : $query->get();
    }

    public function save($data)
    {
        $packageService = new ClientPackageService;
        $packageService->client_id = $data['client_id'];
        $packageService->package_id = $data['package_id'];
        $packageService->service_id = $data['service_id'];
        if(isset($data['name'])) $packageService->name = $data['name'];
        if(isset($data['expiry_date'])) $packageService->expiry_date = $data['expiry_date'];
        if(isset($data['host_id'])) $packageService->host_id = $data['host_id'];
        $packageService->save();
        return $packageService;
    }

    public function update($packageService, $data)
    {
        $keys = array_keys($data);
        if(isset($data['client_id'])) $packageService->client_id = $data['client_id'];
        if(isset($data['package_id'])) $packageService->package_id = $data['package_id'];
        if(isset($data['service_id'])) $packageService->service_id = $data['service_id'];
        if(isset($data['host_id'])) $packageService->host_id = $data['host_id'];
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