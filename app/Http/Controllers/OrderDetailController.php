<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Database\QueryException;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $order_details=OrderDetail::all();
        if(count($order_details)==0){
            return response()->json(['Error'=>"OrderDetail Not Found!"]);
        }else{
             return response()->json(["data"=>$order_details],200);
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
        //create order details
        $request->validate(
            ['unit_price'=>'required','size'=>'required','quantity'=>'required','discount'=>'required','total'=>'required','date'=>'required','product_id'=>'required','order_id'=>'required','bill_number'=>'required']
        );
        try {
            $order_detail=OrderDetail::create($request->all());
            return response()->json(["data"=>$order_detail], 200);
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
        $order_detail=OrderDetail::find($id);
        if(is_null($order_detail)){
            return response()->json(['Error'=>"OrderDetail Not Found!"]);
        }else{
             return response()->json(["data"=>$order_detail]);
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
        $order_detail=OrderDetail::find($id);
        if(is_null($order_detail)){
           return response()->json(
               ['Error'=>"OrderDetail Not Found!"],400
           );

        }
       $order_detail->update($request->all());
       $status=$order_detail->save();
       if($status){
           return response()->json(['data'=>$order_detail],200);
       }else{
           return response()->json(['Error'=>"OrderDetail Update Failed!"],400);
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
        $order_details=OrderDetail::find($id);
        if(is_null($order_details)){
            return response()->json(['Error'=>"OrderDetail with id ".$id." Not Found!"],400);
        }else{
            OrderDetail:: where('product_id',$id)->delete();
            return response()->json(["data" => "OrderDetail successfuly deleted!"],200);
        }
    }
}
