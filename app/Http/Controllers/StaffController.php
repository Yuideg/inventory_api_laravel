<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $staffs=Staff::all();
        if(count($staffs)==0){
            return response()->json(['Error'=>"Staffs Not Found!"]);
        }else{
             return response()->json(["data"=>$staffs],200);
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
            ['first_name'=>'required','last_name'=>'required','username'=>'required','password'=>'required','address'=>'required','email'=>'required','phone'=>'required','role_id'=>'required']
        );

        try {
            $staff=Staff::create($request->all());
            return response()->json(["data"=>$staff], 200);
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
        $staff=Staff::find($id);
        if(is_null($staff)){
            return response()->json(['Error'=>"Staff Not Found!"]);
        }else{
             return response()->json(["data"=>$staff]);
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
        //
        $staff=Staff::find($id);
        if(is_null($staff)){
           return response()->json(
               ['Error'=>"Staff Not Found!",400]
           );

        }
       $staff->update($request->all());
       $status=$staff->save();
       if($status){
           return response()->json(['data'=>$staff],200);
       }else{
           return response()->json(['Error'=>"Staff Update Failed!"],400);
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
        $staff=Staff::find($id);
        if(is_null($staff)){
            return response()->json(['Error'=>"Staff with id ".$id." Not Found!"],400);
        }else{
            Staff:: where('customer_id',$id)->delete();
            return response()->json(["data" => "Staff successfuly deleted!"],200);
        }

    }
}
