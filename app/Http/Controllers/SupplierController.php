<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $suppliers=Supplier::all();
        if(count($suppliers)==0){
            return response()->json(['Error'=>"Suppliers Not Found!"]);
        }else{
             return response()->json(["data"=>$suppliers],200);
        }    }

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
            ['name'=>'required','username'=>'required','password'=>'required','address'=>'required','email'=>'required','phone'=>'required','fax'=>'required']
        );
        try {
            $supplier=Supplier::create($request->all());
            return response()->json(["data"=>$supplier], 200);
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
        $supplier=Supplier::find($id);
        if(is_null($supplier)){
            return response()->json(['Error'=>"Supplier Not Found!"]);
        }else{
             return response()->json(["data"=>$supplier]);
        }    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //update supplier
        $supplier=Supplier::find($id);
        if(is_null($supplier)){
           return response()->json(
               ['Error'=>"Supplier Not Found!"],400
           );

        }
       $supplier->update($request->all());
       $status=$supplier->save();
       if($status){
           return response()->json(['data'=>$supplier],200);
       }else{
           return response()->json(['Error'=>"Supplier Update Failed!"],400);
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
        //delete supplier
        $supplier=Supplier::find($id);
        if(is_null($supplier)){
            return response()->json(['Error'=>"Supplier with id ".$id." Not Found!"],400);
        }else{
            Supplier:: where('supplier_id',$id)->delete();
            return response()->json(["data" => "Supplier successfuly deleted!"],200);
        }
    }
}
