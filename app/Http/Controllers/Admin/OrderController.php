<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Storage;
use DB;

use App\Models\Blacklisted_ip;
use App\Client;
use App\Models\Order;
use App\Models\Service;

class OrderController extends Controller
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
        $orders = Order::orderBy('created_at', 'DESC')->get();
        return view('admin.orders', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(orderRequest $request)
    {
        //
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        return view('admin.order', compact('order'));
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
    public function update(orderRequest $request)
    { 
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        DB::beginTransaction();
        try{
            $order->delete();
            DB::commit();
            return back()->with([
                'flash_message' => 'order deleted successfully',
                'flash_message_important' => true
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors('Error Message ', $e->getMessage());
        }
        
    }

    public function active_inactive() {
        $order_id = $_POST['order_id'];
        $visible = $_POST['visible'];
        $orderObj = Order::find($order_id);
        $orderObj->visible = $visible;
        if($orderObj->save()){
            $new_order = Order::find($order_id);
            return $new_order->visible;
        } else {
            return 'failed';
        }
    }

	

}
