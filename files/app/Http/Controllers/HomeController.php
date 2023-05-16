<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Http\Requests\ContactRequest;

use App\Services\Service;
use App\Services\MessageService;

use App\Mail\ContactMessage;

use Illuminate\Support\Facades\Mail;

use App\Helpers;

class HomeController extends Controller
{

    private $serviceService;
    private $messageService;

    public function __construct() 
    {
        $this->serviceService = new Service;
        $this->messageService = new MessageService;
	}

    public function index()
    {
        $services = $this->serviceService->getServices();
        return view('home', compact('services'));
    }

    public function save_contact_message(ContactRequest $request)
    {
        try{
            $data = $request->all();
            if(Helpers::valid_google_captcha($data['g-recaptcha-response'])) {
                $message = $this->messageService->save($data);
                Mail::to('contact@zizix6.com')->send(new ContactMessage($message));
                return redirect('/#contact')->with('success', 'Your message was delivered successfuly');
            }else{
                return redirect('/#contact')->with('error', 'Captcha Robot verification failed, please try again')->withInput();
            }
            dd($data);
        }catch(\Exception $e){
            Log::stack(['project'])->info($e->getMessage().' in '.$e->getFile().' at Line '.$e->getLine());
            return redirect('/#contact')->with('error', 'An error occured')->withInput();
        }
    }
}
