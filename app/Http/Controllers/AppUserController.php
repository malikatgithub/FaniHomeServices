<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\AppUsers;
use App\Captain;
use JWTFactory;
use JWTAuth;
use Validator;
use Response;


class AppUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'phone' => 'required',
                'pic' => 'required',
            ]);
    
            if ($validator->fails()){
                return response()->json($validator->errors());
            }
    
            else{
                $new_user = AppUsers::create($request -> all());
                return response()->json('User account created successfully');
            }
        }

        catch (\Throwable $th) {
            return response()->json("$th :  تم التسجيل مسبقا بهذا الرقم سابقا");
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

        $user = AppUsers::find($id);
        if(!empty($user)){
            return response()->json(['User data find successfully =>' , $user ]);

        }
        
        else{
            return response()->json(" يوجد خطأ في عرض البيانات ");
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
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
        try{
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'phone' => 'required',
                'pic' => 'required',
            ]);
    
            if ($validator->fails()){
                return response()->json($validator->errors());
            }
    
            else{
                $new_user = AppUsers::whereId($id)->update($request -> all());
                $new_user = AppUsers::find($id);
                return response()->json(['User data updated successfully =>' , $new_user ]);
            }
        }

        catch (\Throwable $th) {
            return response()->json("$th : يوجد خطأ");
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
    }
}
