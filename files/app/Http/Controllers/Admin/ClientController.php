<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\SaveClient;
use App\Http\Requests\UpdateClient;
use App\Services\ClientService;
use App\Services\PackageService;
use App\Services\ClientPackageServiceService;
use App\Services\Service;


class ClientController extends Controller
{

    private $clientService;
    private $packageService;
    private $clientPackageServiceService;
    private $serviceService;

	public function __construct()
	{
		$this->middleware('userauth');
        $this->clientService = new ClientService;
        $this->packageService = new PackageService;
        $this->clientPackageServiceService = new ClientPackageServiceService;
        $this->serviceService = new Service;
	}
    
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = $this->clientService->getClients();
        dd($clients);
        return view('admin.client.index', compact('clients'));
    }

    public function add_client()
    {
        return view('admin.client.add');
    }

    public function view($id)
    {
        $client = $this->clientService->getClient($id);
        $services = $this->serviceService->getServices();
        return ($client) ? view('admin.client.view', compact('client', 'services')) : redirect('admin/clients')->withErrors("Client not Found");
    }

    public function save(SaveClient $request)
    {
        try{
            $data = $request->all();
            // return response()->json([
            //     'statusCode' => 200,
            //     'data' => $data
            // ], 200);
            $client = $this->clientService->save($data);
            if(isset($data['packages']) && count($data['packages']) > 0) {
                foreach($data['packages'] as $packageData) {
                    $packageData['client_id'] = $client->id;
                    if(!isset($packageData['email']) || empty($packageData['email'])) $packageData['email'] = $client->email;
                    if((!isset($packageData['phone_number']) || empty($packageData['phone_number'])) && ($client->phone_number)) $packageData['phone_number'] = $client->phone_number;
                    $package = $this->packageService->save($packageData);
                    foreach($packageData['services'] as $serviceData) {
                        $serviceData['client_id'] = $client->id;
                        $serviceData['package_id'] = $package->id;
                        $this->clientPackageServiceService->save($serviceData);
                    }
                }
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

    /**
     * Update Client
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClient $request)
    {
        try{
            $data = $request->all();
            $client = $this->clientService->getClient($data['client_id']);
            $this->clientService->update($client, $data);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        DB::beginTransaction();
        try{
            $client->delete();
            DB::commit();
            return back()->with([
                'flash_message' => 'client deleted successfully',
                'flash_message_important' => true
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors('Error Message ', $e->getMessage());
        }
        
    }

    public function blacklist($id)
    {
        $client = Client::find($id);
        $ip = $client->IP;
        $blacklist = new Blacklisted_ip;
        $blacklist->ip = $ip;
        $blacklist->save();
        $client->delete();

        return back();
    }

    public function active_inactive() {
        $client_id = $_POST['client_id'];
        $visible = $_POST['visible'];
        $clientObj = Client::find($client_id);
        $clientObj->visible = $visible;
        if($clientObj->save()){
            $new_client = client::find($client_id);
            return $new_client->visible;
        } else {
            return 'failed';
        }
    }

	

}
