<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\SaveClient;

use App\Utilities;

use App\Http\Resources\ClientResource;

use App\Services\ClientService;

class ClientController extends Controller
{
    private $clientService;

    public function __construct()
    {
        $this->clientService = new ClientService;
    }

    public function getClients()
    {
        try{
            $clients = $this->clientService->getClients();
            return response()->json([
                'statusCode' => 200,
                'data' => ClientResource::collection($clients),
                'token' => Utilities::refreshToken(Auth::guard('api'))
            ], 200);
        }catch(\Exception $e){
            return Utilities::error($e);
        }
    }

    public function getClient($id)
    {
        try{
            $client = $this->clientService->getClientWithServices($id);
            return response()->json([
                'statusCode' => 200,
                'data' => new ClientResource($client),
                'token' => Utilities::refreshToken(Auth::guard('api'))
            ], 200);
        }catch(\Exception $e){
            return Utilities::error($e);
        }
    }

    public function client($id)
    {
        try{
            $client = $this->clientService->getClient($id);
            return response()->json([
                'statusCode' => 200,
                'data' => new ClientResource($client),
                'token' => Utilities::refreshToken(Auth::guard('api'))
            ], 200);
        }catch(\Exception $e){
            return Utilities::error($e);
        }
    }

    public function save(SaveClient $request)
    {
        try{
            $client = $this->clientService->save($request->validated());
            return response()->json([
                'statusCode' => 200,
                'data' => new ClientResource($client),
                'token' => Utilities::refreshToken(Auth::guard('api'))
            ], 200);
        }catch(\Exception $e){
            return Utilities::error($e);
        }
    }

}
