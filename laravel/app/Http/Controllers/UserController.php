<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
class UserController extends Controller
{
    public function AddStudent(Request $request){
        $validateData=Validator::make($request->all(),[
          'name'=>'required',
          'email'=>'required|email',
          'mobile'=>'required',
          'address'=>'required'
        ]);
        if($validateData->fails()){
            return response::json(['error'=>$validateData->errors()->all()],409);
        }
        $user=new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->mobile=$request->mobile;
        $user->address=$request->address;
        $user->save();
       
    }

    public function UpdateStudent(Request $request){
        $validateData=Validator::make($request->all(),[
         'id'=>'required',
          'name'=>'required',
          'email'=>'required|email',
          'mobile'=>'required',
          'address'=>'required'
        ]);
        if($validateData->fails()){
            return response::json(['error'=>$validateData->errors()->all()],409);
        }
        try{
          
            $user=User::find($request->id);
            $user->name=$request->name;
            $user->email=$request->email;
            $user->mobile=$request->mobile;
            $user->address=$request->address;
            $user->save();
         
            return response::json(["message"=>"record updated successfully","updated data"=>$user],200);
        }catch(Exception $e){
            return response::json(["message"=>"can't be update record"],409);
        }
   
    }

    public function deleteStudent(Request $request){
        // $validateData=validator::make($request->all(),[
        //   'id'=>'required'
        // ]);
        // if($validateData->fails()){
        //   return response()->json(['error'=>$validateData->errors()->all()],409);  
        // }
        try{
            $user=User::where('id',$request->id)->delete();
            return response::json(["message"=>"user deleted successfully"]);
        }catch(Exception $e){
            return response::json(['error'=>["user can't be deleted"]],409);
        } 
    }

    public function showStudent(){
        $user=User::all();
        // print_r($user);
$finalArray = array();
$rowCount="";
foreach($user as $key=>$value){
   array_push($finalArray, array(
                'id'=>$value['id'],
                'name'=>$value['name'],
                'email'=>$value['email'],
                'mobile'=>$value['mobile'],
                'address'=>$value['address']
   ));
}
try{
$rowCount=count($finalArray);
return response::json(["total number of Row"=>$rowCount,'student data'=>$finalArray,'message'=>"Student record show successfully"],200);
}catch(Exception $e){
    return response::json(['error'=>["user can't be show"]],409);
}
    }
}
