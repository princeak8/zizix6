<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Repositories\MyFunction;

use Request;
use App\Http\Requests\ContactMessageRequest;
use Storage;
use DB;

use App\Notifications\Contact_msg_received;
use App\Models\Message;

class MessageController extends Controller
{
	public function __construct()
	{
		$this->middleware('superUserAuth');
		$this->myFunction = new MyFunction;
	}
    
	public function messages()
	{
		$messages = Message::orderBy('created_at', 'DESC')->get();
		$unread_messages = Message::Unread()->get();
		return view('admin/messages', compact('messages', 'unread_messages'));
	}

	public function message($id)
	{
		$message = Message::find($id);
		if(!empty($message)) {
			$message->unread = 0;
			$message->save();
			return view('admin/message', compact('message'));
		}else{
			return redirect('admin/contact_messages');
		}
		
	}

	public function mark_read(Request $request)
	{
        $data = Input::all();

        if(isset($data['id'])) {
			$message_id = $data['id'];
			$messageObj = Message::find($message_id);
			if(!empty($messageObj)) {
				$messageObj->unread = 0;
			
				if($messageObj->save()) {
					echo 1;
				}else{
					echo 0;
				}
			}else{
				echo -1;
			}
		}else{
			echo -2;
		}
	}

	public function delete($id)
	{
		//Check if its an admin and its logged in

		$messageObj = Message::find($id);
		if(!empty($messageObj)) {
			DB::beginTransaction();
			try{
				$deleted = $messageObj->delete();
	            DB::commit();
	        } catch (\Exception $e) {
    			DB::rollback();
	        }
		}

		return back();
	}

}
