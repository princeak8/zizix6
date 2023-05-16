<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Services\Service;

class HomeController extends Controller
{
    private $serviceService;

	public function __construct()
	{
		$this->middleware('userauth');
        $this->serviceService = new Service;
	}
    
	public function index()
	{
		// Get the currently authenticated user...
		$user = Auth::user();
		// $orders = Order::where('status_id', '<', '7')->get();
		// $clients = Client::all();
		// $messages = contact::where('unread', '1')->get();
		// $blacklists = Blacklisted_ip::all();
		return view('admin/index', compact('user'));
	}

	

}
