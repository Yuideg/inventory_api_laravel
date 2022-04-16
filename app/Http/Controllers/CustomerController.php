<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customers=Customer::all();
        if(count($customers)==0){
            return response()->json(['Error'=>"Customers Not Found!"]);
        }else{
             return response()->json(["data"=>$customers],200);
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
            ['first_name'=>'required','last_name'=>'required','username'=>'required','password'=>'required','address'=>'required','email'=>'required','phone'=>'required','staff_id'=>'required']
        );
        try {
            $request->password=bcrypt($request->password);
            $customer=Customer::create($request->all());
            return response()->json(["data"=>$customer], 200);
        }catch(QueryException $e){
            return response()->json(["Error"=>$e->getMessage()],400);
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
        $customer=Customer::find($id);
        if(is_null($customer)){
            return response()->json(['Error'=>"Customer Not Found!"]);
        }else{
             return response()->json(["data"=>$customer]);
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
        $customer=Customer::find($id);
        if(is_null($customer)){
           return response()->json(
               ['Error'=>"Customer Not Found!"],400
           );
        }
       $customer->update($request->all());
       $status=$customer->save();
       if($status){
           return response()->json(['data'=>$customer],200);
       }else{
           return response()->json(['Error'=>"Customer Update Failed!"],400);
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
        //delete customer with given id number
        $customer=Customer::find($id);
        if(is_null($customer)){
            return response()->json(['Error'=>"Customer with id ".$id." Not Found!"],400);
        }else{
            Customer:: where('customer_id',$id)->delete();
            return response()->json(["data" => "Customer successfuly deleted!"],200);
        }
    }
}
