<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Repositories\MyFunction;

use Illuminate\Http\Request;
use Storage;
use DB;
use App\Http\Requests\PromoRequest;

use App\Models\Promo;
use App\Models\Promo_code;

class promoController extends Controller
{
	public function __construct()
	{
		$this->middleware('userauth');
        $this->myFunction = new MyFunction;
	}
    
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promos = Promo::orderBy('created_at', 'DESC')->get();
        return view('admin.promos', compact('promos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PromoRequest $request)
    {
    	if(empty($request->input('discount'))) {
            $discount = 0.0;
        }
        $promo = Promo::create([
            'name' => $request->input('name'),
            'discount' => $discount,
            'duration' => $request->input('duration'),
            'description' => $request->input('description'),
            'token' => $request->input('token')
        ]);
        if($promo){
            //Create Promo Codes for the Promo
            for($i=0; $i<5; $i++) {
                $promoCode = new Promo_code;
                $promoCode->promo_id = $promo->id;
                $code_exists = True;
                while($code_exists===True) {
                    $code = $this->myFunction->getToken(5);
                    $promo_code = Promo_code::where('code', $code)->first();
                    if(empty($promo_code)) {
                        $code_exists = False;
                    }
                }
                $promoCode->code = $code;
                $promoCode->save();
            }
            // request()->session()->flash('photos_addition', 'Photos Added Successfullly!');
            return back()->with([
                'flash_message' => 'promo added successfully!!',
                'flash_message_important' => true
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $promo = promo::find($id);
        return view('admin.promo', compact('promo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $promo = Promo::find($id);
        return view('promo_edit', compact('promo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PromoRequest $request)
    { 
        $promo = Promo::find($id);
        $input = $request->all();

        $promo->update($input);
        return back()->with([
            'flash_message' => 'Promo updated successfully!!',
            'flash_message_important' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promo = Promo::find($id);
        DB::beginTransaction();
        try{
            $promo->delete();
            DB::commit();
            return back()->with([
                'flash_message' => 'promo deleted successfully',
                'flash_message_important' => true
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors('Error Message ', $e->getMessage());
        }
        
    }

    public function active_inactive() {
        $promo_id = $_POST['promo_id'];
        $visible = $_POST['visible'];
        $promoObj = Promo::find($promo_id);
        $promoObj->visible = $visible;
        if($promoObj->save()){
            $new_promo = promo::find($promo_id);
            return $new_promo->visible;
        } else {
            return 'failed';
        }
    }

	

}
