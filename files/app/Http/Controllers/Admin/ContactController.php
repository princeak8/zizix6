<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;
use Storage;

use App\Models\Contact;
use App\Models\Blacklisted_ip;

class ContactController extends Controller
{
	public function __construct()
	{
		$this->middleware('userauth');
	}
    
	public function messages()
	{
		$messages = Contact::all();

		return view('admin/contact_messages', compact('messages'));
	}

	public function message($id)
	{
		$message = Contact::find($id);

		return view('admin/contact_message', compact('message'));
	}

	public function mark_read(Request $request)
	{
        $data = Input::all();
        $json = array();
        if(isset($data['id'])) {
			$message_id = $data['id'];
			$messageObj = Contact::find($message_id);
			if(!empty($messageObj)) {
				$messageObj->unread = 0;
			
				if($messageObj->save()) {
					$status = 1;
				}else{
					$status = 0;
				}
			}else{
				$status = -1;
			}
		}else{
			$status = -2;
		}
		$json['status'] = $status;

		return response()->json($json);
	}

	public function blacklist($id)
	{
		$message = Contact::find($id);
		$ip = $message->IP;
		$blacklist = new Blacklisted_ip;
		$blacklist->ip = $ip;
		$blacklist->save();
		$message->delete();

		return back();
	}

	public function delete($id)
	{
		$message = Contact::find($id);
		$message->delete();

		return back();
	}

}
