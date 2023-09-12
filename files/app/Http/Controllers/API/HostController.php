<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\AddHost;
use App\Http\Requests\updateHost;

use App\Services\HostService;

use App\Http\Resources\HostResource;

use App\Utilities;

class HostController extends Controller
{
    private $hostService;

    public function __construct()
    {
        $this->hostService = new HostService;
    }

    public function hosts()
    {
        try{
            $hosts = $this->hostService->getHosts();
            return Utilities::ok(HostResource::collection($hosts));
        }catch(\Exception $e){
            return Utilities::error($e);
        }
    }

    public function save(AddHost $request)
    {
        try{
            $host = $this->hostService->save($request->validated());
            return Utilities::ok(new HostResource($host));
        }catch(\Exception $e){
            return Utilities::error($e);
        }
    }

    public function update(UpdateHost $request)
    {
        try{
            $host = $this->hostService->getHost($request->get('host_id'));
            $host = $this->hostService->update($host, $request->validated());
            return Utilities::ok(new HostResource($host));
        }catch(\Exception $e){
            return Utilities::error($e);
        }
    }
}
