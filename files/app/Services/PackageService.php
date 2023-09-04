<?php

namespace App\Services;

use App\Models\ClientPackage;

class PackageService
{

    public function getClientPackage($id)
    {
        return ClientPackage::find($id);
    }

    public function getClientPackageWithServices($id)
    {
        return ClientPackage::with(['services.service'])->where('id', $id)->first();
    }

    public function getClientPackages($client_id, $includeClient=false)
    {
        $with = ($includeClient) ? ['client', 'services', 'services.service'] : ['services', 'services.service'];
        return ClientPackage::with($with)->where('client_id', $client_id)->get();
    }

    public function getPackages()
    {
        return ClientPackage::all();
    }

    public function save($data)
    {
        $package = new ClientPackage;
        $package->client_id = $data['client_id'];
        $package->name = $data['name'];
        if(isset($data['email'])) $package->email = $data['email'];
        if(isset($data['phone_number'])) $package->phone_number = $data['phone_number'];
        $package->save();
        return $package;
    }

    public function update($package, $data)
    {
        if(isset($data['client_id'])) $package->client_id = $data['client_id'];
        if(isset($data['name'])) $package->name = $data['name'];
        // if(isset($data['expiry_date'])) $package->expiry_date = $data['expiry_date'];
        if(isset($data['email'])) $package->email = $data['email'];
        if(isset($data['phone_number'])) $package->phone_number = $data['phone_number'];
        $package->update();
        return $package;
    }

    public function delete($package)
    {
        $package->delete();
    }
}