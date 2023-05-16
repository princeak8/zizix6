<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Service;

use App\Http\Resources\ServiceResource;

class ServiceController extends Controller
{
    private $serviceService;

    public function __construct()
    {
        $this->serviceService = new Service;
    }

    public function services()
    {
        try{
            $services = $this->serviceService->getServices();
            return response()->json([
                'statusCode' => 200,
                'data' => ServiceResource::collection($services)
            ], 200);
        }catch(\Exception $e){
            return response()->json([
                'statusCode' => 500,
                'message' => 'An error occured while trying to perform this operation, Please try again later or contact support'
            ], 500);
        }
    }
}
