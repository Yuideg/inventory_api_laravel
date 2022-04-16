<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products=Product::all();
        if(count($products)==0){
            return response()->json(['Error'=>"Products Not Found!"]);
        }else{
             return response()->json(["data"=>$products],200);
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
            ['name'=>'required','description'=>'required','unit'=>'required','price'=>'required','quantity'=>'required','status'=>'required','supplier_id'=>'required','category_id'=>'required']

        );
        try {
            $product=Product::create($request->all());
            return response()->json(["data"=>$product], 200);
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
        //Get product by id
        $product=Product::find($id);
        if(is_null($product)){
            return response()->json(['Error'=>"Product Not Found!"]);
        }else{
             return response()->json(["data"=>$product]);
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
        $product=Product::find($id);
        if(is_null($product)){
           return response()->json(
               ['Error'=>"Product Not Found!"],400
           );

        }
       $product->update($request->all());
       $status=$product->save();
       if($status){
           return response()->json(['data'=>$product],200);
       }else{
           return response()->json(['Error'=>"Product Update Failed!"],400);
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
        $product=Product::find($id);
        if(is_null($product)){
            return response()->json(['Error'=>"Product with id ".$id." Not Found!"],400);
        }else{
            Product:: where('product_id',$id)->delete();
            return response()->json(["data" => "Product successfuly deleted!"],200);
        }
    }
}
