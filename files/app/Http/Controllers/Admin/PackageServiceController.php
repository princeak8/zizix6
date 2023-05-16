<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\AddPackageService;
use App\Http\Requests\UpdatePackageService;

use App\Services\PackageService;
use App\Services\ClientPackageServiceService;
use App\Services\Service;

class PackageServiceController extends Controller
{
    private $packageService;
    private $clientPackageService;
    private $serviceService;

    public function __construct()
	{
		$this->middleware('userauth');
        $this->packageService = new PackageService;
        $this->clientPackageService = new ClientPackageServiceService;
        $this->serviceService = new Service;
	}

    public function save(AddPackageService $request)
    {
        try{
            $data = $request->all();
            $package = $this->packageService->getClientPackage($data['package_id']);
            if($package) {
                $data['client_id'] = $package->client_id;
                $this->clientPackageService->save($data);
                return response()->json([
                    'statusCode' => 200,
                    'message' => "Successful"
                ], 200);
            }else{
                return response()->json([
                    'statusCode' => 400,
                    'message' => "Package not found"
                ], 400);
            }
        }catch(\Exception $e){
            return response()->json([
                'statusCode' => 500,
                'message' => 'An error occured while trying to perform this operation, Please try again later or contact support',
                'debug' => $e->getMessage().' in '.$e->getFile().' at Line '.$e->getLine()
            ], 500);
        }
    }

    public function view($id)
    {
        $clientService = $this->clientPackageService->getPackageService($id);
        if($clientService) {
            return view('admin.client.view_service', compact('clientService'));
        }else{
            return back();
        }
    }

    public function update(UpdatePackageService $request)
    {
        try{
            $data = $request->all();
            $packageService = $this->clientPackageService->getPackageService($data['package_service_id']);
            if($packageService) {
                $this->clientPackageService->update($packageService, $data);
                return response()->json([
                    'statusCode' => 200,
                    'message' => "Successful"
                ], 200);
            }else{
                return response()->json([
                    'statusCode' => 400,
                    'message' => "Package Service not found"
                ], 400);
            }
        }catch(\Exception $e){
            return response()->json([
                'statusCode' => 500,
                'message' => 'An error occured while trying to perform this operation, Please try again later or contact support',
                'debug' => $e->getMessage().' in '.$e->getFile().' at Line '.$e->getLine()
            ], 500);
        }
    }
}
