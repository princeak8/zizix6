<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Request;
use App\Http\Requests\PasswordChangeRequest;

use App\Repositories\Email;
use App\Models\Password_reset;
use App\Models\User;
use App\Notifications\Reset_password_link;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

   // use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function send_reset_link()
    {
        $passReset = new Password_reset;
        $post = Request::all();
        $email = $post['email'];
        $user = User::where('email', $email)->first();
        if(!$user) {
            return back()->withErrors([
                'message' => 'Email Does not exist in the database.'
            ]);
        }
        $reset_token = Password::getRepository()->createNewToken();
        $passReset->email = $email;
        $passReset->token = $reset_token;
        if($passReset->save()) {
            $user->notify(new Reset_password_link($user, $passReset));
            // Send mail subscriber
              /* $mail = new Email;
               $to['email'] = $email;
               $to['name'] = $user->profile_name;
               $subject = 'PASSWORD RESET LINK';
               $view = 'emails.password_reset';
               $data = $passReset;
               $mail->sendNotifyEmail($to, $subject, $view, $data);
            */
            return redirect('admin/reset_link_sent');
        }else{
            return back()->withErrors([
                'message' => 'Something seems to go wrong.. Try again, or contact the administrators.'
            ]);
        }
    }

    public function change_password_form($token)
    {
        $passReset = Password_reset::where('token', $token)->first();
        if(!$passReset) {
            return view('admin.passwords.invalid_token');
        }else{
            if (session('success')){
                $passReset->delete();
            }
            return view('admin.passwords.change_password', compact('token'));
        }
    }

    public function change_password(PasswordChangeRequest $request)
    {
        $post = Request::all();
        $userObj = User::where('email', $post['email'])->first();
        if($userObj) {
            $passReset = Password_reset::where('token', $post['token'])->first();
            if($passReset) {
                $userObj->password = bcrypt($post['password']);
                if($userObj->save())
                {
                     request()->session()->flash('success', 'YOU HAVE CHANGED YOUR PASSWORD SUCCESSFULLY. YOU CAN NOW LOGIN WITH YOUR NEW PASSWORD');
                }else{
                    request()->session()->flash('error', 'Sorry! Something went wrong, try again');
                }
            }else{
                request()->session()->flash('error', 'Sorry! The token seems not to be correct, Go back to your email and click the link');
            }
        }else{
            request()->session()->flash('error', 'Sorry! The Email does not exist');
        }

        return back();
    }

}
