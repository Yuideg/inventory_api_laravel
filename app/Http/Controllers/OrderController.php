<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders=Order::all();
        if(count($orders)==0){
            return response()->json(['Error'=>"Orders Record Not Found!"]);
        }else{
             return response()->json(["data"=>$orders],200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate(
            ['date_of_order' => 'required','order_detail'=>'required']
        );
        try {
            $order=Order::create($request->all());
            return response()->json(["data"=>$order], 200);
        }catch(QueryException $e){
            return response()->json(["Error"=>$e->getMessage()], 400);
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
        $order=Order::find($id);
        if(is_null($order)){
            return response()->json(['Error'=>"Order record Not Found!"]);
        }else{
             return response()->json(["data"=>$order]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $order=Order::find($id);
        if(is_null($order)){
           return response()->json(
               ['Error'=>"Order Record Not Found!"],400
           );

        }
       $order->update($request->all());
       $status=$order->save();
       if($status){
           return response()->json(['data'=>$order],200);
       }else{
           return response()->json(['Error'=>"Order Update Failed!"],400);
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
        //
        $order=Order::find($id);
        if(is_null($order)){
            return response()->json(['Error'=>"Order with id ".$id." Not Found!"],400);
        }else{
            Order:: where('order_id',$id)->delete();
            return response()->json(["data" => "Order successfuly deleted!"],200);
        }
    }
}
