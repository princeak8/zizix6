<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\CreateService;
use App\Http\Requests\UpdateService;

use App\Services\Service;

use App\Http\Resources\ServiceResource;

use App\Utilities;

class ServiceController extends Controller
{
    private $service;

    public function __construct()
    {
        $this->service = new Service;
    }

    public function services()
    {
        try{
            $services = $this->service->getServices();
            return Utilities::ok(ServiceResource::collection($services));
        }catch(\Exception $e){
            return Utilities::error($e);
        }
    }

    public function save(CreateService $request)
    {
        try{
            $service = $this->service->save($request->validated());
            return Utilities::ok(new ServiceResource($service));
        }catch(\Exception $e){
            return Utilities::error($e);
        }
    }

    public function update(UpdateService $request)
    {
        try{
            $service = $this->service->getService($request->get('service_id'));
            $service = $this->service->update($service, $request->validated());
            return Utilities::ok(new ServiceResource($service));
        }catch(\Exception $e){
            return Utilities::error($e);
        }
    }
    
}
