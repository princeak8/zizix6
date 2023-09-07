<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Utilities;

use App\Http\Requests\SaveParentPackage;
use App\Http\Requests\SavePackage;
use App\Http\Requests\UpdatePackage;

use App\Services\PackageService;
use App\Services\ClientService;

use App\Http\Resources\PackageResource;
use App\Http\Resources\PackageMinResource;

class PackageController extends Controller
{
    private $packageService;
    private $clientService;

    public function __construct()
    {
            $this->packageService = new PackageService;
            $this->clientService = new ClientService;   
    }

    public function getParentPackages()
    {
        try{
            $parent = $this->clientService->getParent();
            if($parent) {
                $packages = $this->packageService->getClientPackages($parent->id, true);
                return response()->json([
                    'statusCode' => 200,
                    'data' => PackageResource::collection($packages),
                    'token' => Utilities::refreshToken(Auth::guard('api'))
                ], 200);
            }else{
                return response()->json([
                    'statusCode' => 402,
                    'message' => 'No Parent'
                ], 402);
            }
        }catch(\Exception $e){
            return Utilities::error($e);
        }
    }

    public function getPackage($id)
    {
        try{
            $package = $this->packageService->getClientPackage($id);
            if($package) {
                return response()->json([
                    'statusCode' => 200,
                    'data' => new PackageResource($package),
                    'token' => Utilities::refreshToken(Auth::guard('api'))
                ], 200);
            }else{
                return response()->json([
                    'statusCode' => 402,
                    'message' => 'No Package found'
                ], 402);
            }
        }catch(\Exception $e){
            return Utilities::error($e);
        }
    }

    public function getPackageWithServices($id)
    {
        try{
            $package = $this->packageService->getClientPackageWithServices($id);
            if($package) {
                return response()->json([
                    'statusCode' => 200,
                    'data' => new PackageMinResource($package),
                    'token' => Utilities::refreshToken(Auth::guard('api'))
                ], 200);
            }else{
                return response()->json([
                    'statusCode' => 402,
                    'message' => 'No Package found'
                ], 402);
            }
        }catch(\Exception $e){
            return Utilities::error($e);
        }
    }

    public function saveParentPackage(SaveParentPackage $request)
    {
        try{
            $data = $request->validated();
            $parent = $this->clientService->getParent();
            if($parent) {
                $data['client_id'] = $parent->id;
                $package = $this->packageService->save($data);
                return response()->json([
                    'statusCode' => 200,
                    'data' => new PackageResource($package),
                    'token' => Utilities::refreshToken(Auth::guard('api'))
                ], 200);
            }else{
                return response()->json([
                    'statusCode' => 402,
                    'message' => 'No Parent'
                ], 402);
            }
        }catch(\Exception $e){
            return Utilities::error($e);
        }
    }

    public function save(SavePackage $request)
    {
        try{
            $data = $request->validated();
            $package = $this->packageService->save($data);
            return response()->json([
                'statusCode' => 200,
                'data' => new PackageResource($package),
                'token' => Utilities::refreshToken(Auth::guard('api'))
            ], 200);
        }catch(\Exception $e){
            return Utilities::error($e);
        }
    }

    public function update(UpdatePackage $request)
    {
        try{
            $data = $request->validated();
            $package = $this->packageService->getClientPackage($data['package_id']);
            $package = $this->packageService->update($package, $data);
            return response()->json([
                'statusCode' => 200,
                'data' => new PackageResource($package),
                'token' => Utilities::refreshToken(Auth::guard('api'))
            ], 200);
        }catch(\Exception $e){
            return Utilities::error($e);
        }
    }
}
