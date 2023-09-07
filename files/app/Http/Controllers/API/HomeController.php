<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\ClientPackageServiceService;
use App\Services\ClientService;
use App\Services\PackageService;
use App\Services\Service;
use App\Services\MessageService;

use App\Utilities;

class HomeController extends Controller
{
    private $clientPackageService;
    private $clientService;
    private $packageService;
    private $service;
    private $messageService;

    public function __construct()
    {
        $this->clientPackageService = new ClientPackageServiceService;
        $this->clientService = new ClientService;
        $this->packageService = new PackageService;
        $this->service = new Service;
    }

    public function home()
    {
        try{
            // $services = $this->service->getServices();
            $clientsCount = $this->clientService->getClients(true);
            $packagesServicesCount = $this->clientPackageService->getAllPackageServices(true);
            $expiringServicesCount = $this->clientPackageService->getExpiringPackageServices(30, true);
            $expiredServicesCount = $this->clientPackageService->getExpiredPackageServices(true);
            $data = [
                'clientsCount' => $clientsCount,
                'packagesServicesCount' => $packagesServicesCount,
                'expiringServicesCount' => $expiringServicesCount,
                'expiredServicesCount' => $expiredServicesCount
            ];
            return Utilities::ok($data);
        }catch(\Exception $e){
            return Utilities::error($e);
        }
    }
}
