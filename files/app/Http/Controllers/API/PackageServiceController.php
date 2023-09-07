<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use App\Services\ClientPackageServiceService;
use App\Services\PackageService;

use App\Http\Requests\CreatePackageService;
use App\Http\Requests\UpdatePackageService;

use App\Http\Resources\PackageServiceResource;

use App\Utilities;

class PackageServiceController extends Controller
{
    private $clientPackageService;
    private $packageService;

    public function __construct()
    {
        $this->clientPackageService = new ClientPackageServiceService;
        $this->packageService = new PackageService;
    }

    public function getPackageServices($id)
    {
        try{
            if($this->packageService->getClientPackage($id)) {
                $packageServices = $this->clientPackageService->getPackageServices($id);
                return response()->json([
                    'statusCode' => 200,
                    'data' => PackageServiceResource::collection($packageServices),
                    'token' => Utilities::refreshToken(Auth::guard('api'))
                ], 200);
            }else{
                return response()->json([
                    'statusCode' => 402,
                    'message' => 'Package not found'
                ], 402);
            }
        }catch(\Exception $e){
            return Utilities::error($e);
        }
    }

    public function save(CreatePackageService $request)
    {
        try{
            $data = $request->validated();
            $package = $this->packageService->getClientPackage($data['package_id']);
            $data['client_id'] = $package->client_id;
            $this->clientPackageService->save($data);
        }catch(\Exception $e){
            return Utilities::error($e);
        }
    }

    public function update(UpdatePackageService $request)
    {
        try{
            $data = $request->validated();
            $packageService = $this->clientPackageService->getPackageService($data['package_service_id']);
            $packageService = $this->clientPackageService->update($packageService, $data);
            return Utilities::ok(new PackageServiceResource($packageService));
        }catch(\Exception $e){
            return Utilities::error($e);
        }
    }

    // Gets package services that about to expire
    public function expiring()
    {
        try{
            $days = 30;
            $expiringPackageServices = $this->clientPackageService->getExpiringPackageServices($days);
            return Utilities::ok(PackageServiceResource::collection($expiringPackageServices));
        }catch(\Exception $e){
            return Utilities::error($e);
        }
    }

     // Gets package services that has expired
     public function expired()
     {
         try{
             $days = 30;
             $expiredPackageServices = $this->clientPackageService->getExpiredPackageServices();
             return Utilities::ok(PackageServiceResource::collection($expiredPackageServices));
         }catch(\Exception $e){
             return Utilities::error($e);
         }
     }


}
