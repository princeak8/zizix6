<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Storage;
use DB;
use App\Http\Requests\PromoRequest;

use App\Models\Promo;
use App\Models\Promo_code;

class PromoCodeController extends Controller
{
	public function __construct()
	{
		$this->middleware('userauth');
	}
    
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PromoCodeRequest $request)
    {
        $promoCode = Promo_code::create([
            'code' => $request->input('code'),
            'promo_id' => $request->input('promo_id')
        ]);
        if($promoCode){
            // request()->session()->flash('photos_addition', 'Photos Added Successfullly!');
            return back()->with([
                'flash_message' => 'promo code added successfully!!',
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PromoCodeRequest $request)
    { 
        $id = $request->input('id');
        $promo_code = Promo_code::find($id);
        $input = $request->all();
        //echo json_encode($input);
  
        if($promo_code->update($input)){
            $new_code = Promo_code::find($id);
            return $new_code->code;
        } else {
            return 'failed';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promo_code = Promo_code::find($id);
        DB::beginTransaction();
        try{
            $promo_code->delete();
            DB::commit();
            return back()->with([
                'flash_message' => 'promo code deleted successfully',
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
