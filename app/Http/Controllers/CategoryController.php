<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Database\QueryException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //fetch all category record
        $categories=Category::all();
        if(count($categories)==0){
            return response()->json(['Error'=>"Categories Not Found!"]);
        }else{
             return response()->json(["data"=>$categories],200);
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
            ['category_name' => 'required','description'=>'required']
        );
        try {
            $category=Category::create($request->all());
            return response()->json(["data"=>$category], 200);
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
        //get category single item
         $category=Category::find($id);
        if(is_null($category)){
            return response()->json(['Error'=>"Category Not Found!"]);
        }else{
             return response()->json(["data"=>$category]);
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
        $category=Category::find($id);
        if(is_null($category)){
           return response()->json(
               ['Error'=>"Category Not Found!"],400
           );

        }
       $category->update($request->all());
       $status=$category->save();
       if($status){
           return response()->json(['data'=>$category],200);
       }else{
           return response()->json(['Error'=>"Category Update Failed!"],400);
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


        $category=Category::find($id);
        if(is_null($category)){
            return response()->json(['Error'=>"Category with id ".$id." Not Found!"],400);
        }else{
            Category:: where('category_id',$id)->delete();
            return response()->json(["data" => "Category successfuly deleted!"],200);
        }
    }
}
