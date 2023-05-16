<?php

namespace App\Http\Requests;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Repositories\MyFunction;

use Illuminate\Http\Request;
use App\Captcha_fail;
use App\Blacklisted_ip;
use App\Blacklisted_attempt;

class ContactRequest extends FormRequest
{
    protected $redirect;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function __construct()
    {
        $this->redirect = '/#contact';
        // $this->myFunction = new MyFunction;
    }

    public function authorize(Request $request)
    {
        $return = true;
        // $ip = $request->ip();
        // $blacklisted = Blacklisted_ip::all();
        // if($blacklisted->count() > 0) {
        //     foreach($blacklisted as $blacklist) {
        //         if($blacklist->IP == $ip) {
        //             $attempt = Blacklisted_attempt::where('IP', $ip)->where('page', 'contact')->first();
        //             if(!empty($attempt)) {
        //                 $attempt->attempts = $attempt->attempts + 1;
        //                 $attempt->save();
        //             }else{
        //                 $blacklistAttempt = new Blacklisted_attempt;
        //                 $blacklistAttempt->IP = $ip;
        //                 $blacklistAttempt->attempts = 1;
        //                 $blacklistAttempt->page = 'contact';
        //                 $blacklistAttempt->save();
        //             }
        //             $return = false;
        //         }
        //     }
        // }
        return $return;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|string|max:255|min:2',
            'email' => 'required|string|email|max:255',
            'title' => 'required|string',
            'phone' => 'nullable|string|min:10|max:18',
            'content' => 'required|string',
        ];
        return $rules;
    }

    // public function failedValidation(Validator $validator)
    // {
    //         $ip = Request::ip();
    //         $failed = $validator->failed();
    //         foreach($failed as $key=>$value) {
    //             if($key=='captcha') {
    //                 $record = Captcha_fail::where('IP', $ip)->first();
    //                 if(!empty($record)) {
    //                     if($record->strike > 5) {
    //                         $blacklist = new Blacklisted_ip;
    //                         $blacklist->IP = $record->IP;
    //                         $blacklist->save();
    //                     }else{
    //                         $record->strike = $record->strike + 1;
    //                         $record->save();
    //                     }
    //                 }else{
    //                     $captchaFail = new Captcha_fail;
    //                     $captchaFail->IP = $ip;
    //                     $captchaFail->strike = 1;
    //                     $captchaFail->save();
    //                 }
    //             }
    //         }
    //     }
    // }
    

    /**
     * Handle a failed authorization attempt.
     *
     * @return void
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    protected function failedAuthorization()
    {
        // request()->session()->flash('error', 'You are not authorized to make this request');
        return redirect('/#contact')->with('error', 'You are not authorized to make this request');
    }

}
