<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\CreateService;
use App\Http\Requests\UpdateService;

use App\Services\Service;

class ServiceController extends Controller
{

    private $serviceService;

    public function __construct()
    {
        $this->middleware('userauth');
        $this->serviceService = new Service;
    }
    

    public function index()
    {
        $services = $this->serviceService->getServices();
        return view('admin/services', compact('services'));
    }

    public function save(CreateService $request)
    {
        $data = $request->all();
        // dd($data);
        $this->serviceService->save($data);
        return redirect('admin/services');
    }

    public function update(UpdateService $request)
    {
        $data = $request->all();
        $service = $this->serviceService->getService($data['service_id']);
        $service = $this->serviceService->update($service, $data);
        return redirect('admin/services');
    }

    public function delete($service_id)
    {
        try{
            $service = $this->serviceService->getService($service_id);
            if($service) {
                $this->serviceService->delete($service);
                return response()->json([
                    'statusCode' => 200,
                    'message' => "Successful"
                ], 200);
            }else{
                return response()->json([
                    'statusCode' => 402,
                    'message' => "an error occured, service could not be deleted"
                ], 402);
            }
        }catch(\Exception $e){
            return response()->json([
                'statusCode' => 500,
                'message' => 'An error occured while trying to perform this operation, Please try again later or contact support'
            ], 500);
        }
        

        
    }
}
