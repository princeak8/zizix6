<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Request;
use App\Http\Requests\RegisterRequest;

use App\Models\User;

class RegisterController extends Controller
{
    public function __construct()
    {
        //$this->middleware('userauth');
    }

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

    public function create(RegisterRequest $request)
    {
        $user = Request::all();
        $userObj = new User;

        $userObj->name = $user['name'];
        $userObj->profile_name = $user['profile_name'];
        $userObj->email = $user['email'];
        $userObj->password = bcrypt($user['password']);
        $userObj->role = $user['role'];
        $userObj->accesslevel = $user['accesslevel'];

        if($userObj->save()) {
            auth()->login($userObj);
            return redirect('admin/home');
        }else{
            request()->session()->flash('register', 'Sorry! There was a problem, User could not be registered');
            return back();
        }
    }
}
