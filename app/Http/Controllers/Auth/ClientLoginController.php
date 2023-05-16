<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\MyFunction;

use Request;
use Auth;

use App\Models\Client;

class ClientLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating admin for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->myFunction = new MyFunction;
    }

    public function loginPage()
    {
      //check if it was redirected from another page
        if(isset($_SERVER['HTTP_REFERER'])) {
          $url = $_SERVER['HTTP_REFERER'];
          if($this->myFunction->isInternal($url)) {
            $redirect = $url;
          }
        }
        if(isset($redirect)) {
          $data['redirect'] = $redirect;
        }else{
          $data['redirect'] = '';
        }

        return view('client/login', $data);
    }

   public function login()
   {
       // Attempt to authenticate the user
        if( !auth()->attempt(request(['email', 'password']))) {
            // If not, redirect back
            return back()->withErrors([
                'message' => 'Please chek your credentials and try again.'
            ]); 

        }
        $loggedInUser = Client::find(Auth::user()->id);
        $loggedInUser->last_seen = \Carbon\Carbon::now();
        $loggedInUser->update();
        if(!empty($_POST['redirect'])) {
          return redirect($_POST['redirect']); //go to the page that redirected to the homepage
        }else{
          return redirect('client/index'); //Redirect to the home page 
        }
   }

   public function logout()
   {
        auth()->logout();

        return redirect('client/login');
   }
}
