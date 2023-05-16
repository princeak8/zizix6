<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\UpdatePackage;
use App\Http\Requests\AddPackage;

use App\Services\PackageService;
use App\Services\ClientService;
use App\Services\Service;
use App\Services\ClientPackageServiceService;

class PackageController extends Controller
{
    private $packageService;
    private $serviceService;
    private $clientService;
    private $clientPackageService;

    public function __construct()
	{
		$this->middleware('userauth');
        $this->packageService = new PackageService;
        $this->clientService = new ClientService;
        $this->serviceService = new Service;
        $this->clientPackageService = new ClientPackageServiceService;
	}

    public function view($id)
    {
        $package = $this->packageService->getClientPackage($id);
        if($package) {
            $services = $this->serviceService->getServices();
            return view('admin.view_client_package', compact('package', 'services'));
        }else{
            return back();
        }
    }

    public function save(AddPackage $request)
    {
        try{
            $data = $request->all();
            $package = $this->packageService->save($data);
            foreach($data['services'] as $service) {
                $service['package_id'] = $package->id;
                $service['client_id'] = $data['client_id'];
                $this->clientPackageService->save($service);
            }
            return response()->json([
                'statusCode' => 200,
                'message' => "Successful"
            ], 200);
        }catch(\Exception $e){
            return response()->json([
                'statusCode' => 500,
                'message' => 'An error occured while trying to perform this operation, Please try again later or contact support',
                'debug' => $e->getMessage().' in '.$e->getFile().' at Line '.$e->getLine()
            ], 500);
        }
    }

    public function update(UpdatePackage $request)
    {
        try{
            $data = $request->all();
            $package = $this->packageService->getClientPackage($data['package_id']);
            if($package) {
                $this->packageService->update($package, $data);
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
}
