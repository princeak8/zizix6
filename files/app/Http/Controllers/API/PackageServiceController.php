<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use App\Services\ClientPackageServiceService;
use App\Services\PackageService;

use App\Http\Requests\CreatePackageService;

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


}
