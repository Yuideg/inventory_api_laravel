<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $payments=Payment::all();
        if(count($payments)==0){
            return response()->json(['Error'=>"Payments Not Found!"]);
        }else{
             return response()->json(["data"=>$payments],200);
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
            ['payment_type' => 'required','description'=>'required']
        );
        try {
            $payment=Payment::create($request->all());
            return response()->json(["data"=>$payment], 200);
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
        $payment=Payment::find($id);
        if(is_null($payment)){
            return response()->json(['Error'=>"Payment Not Found!"]);
        }else{
             return response()->json(["data"=>$payment]);
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
        $payment=Payment::find($id);
        if(is_null($payment)){
           return response()->json(
               ['Error'=>"Payment Not Found!"],400
           );

        }
       $payment->update($request->all());
       $status=$payment->save();
       if($status){
           return response()->json(['data'=>$payment],200);
       }else{
           return response()->json(['Error'=>"Payment Update Failed!"],400);
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

        $payment=Payment::find($id);
        if(is_null($payment)){
            return response()->json(['Error'=>"Category with id ".$id." Not Found!"],400);
        }else{
            Payment:: where('bill_number',$id)->delete();
            return response()->json(["data" => "Payment successfuly deleted!"],200);
        }
    }
}
