<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Storage;

use App\Models\Blacklisted_ip;

class BlacklistController extends Controller
{
	public function __construct()
	{
		$this->middleware('userauth');
	}
    
	public function blacklists()
	{
		$blacklists = Blacklisted_ip::all();

		return view('admin/blacklists', compact('blacklists'));
	}

	public function blacklist($id)
	{
		$blacklist = Blacklisted_ip::find($id);
		//dd($blacklist->blacklist_attempts);
		return view('admin/blacklist', compact('blacklist'));
	}

	public function delete($id)
	{
		$blacklist = Blacklisted_ip::find($id);
		$blacklist->delete();
		return back();
	}
	

}
