<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Captain;
use JWTFactory;
use JWTAuth;
use Validator;
use Response;


class APICaptainsController extends Controller
{

    /*
    ==============================================================
        Function for Login of the captain and return Token
    ==============================================================
    */
    public function login(Request $request)
    {


        /* Simple method to Return  the Token
        **********************************************/

        //$credentials = $request->only('phone', 'password');
        // if ($token = JWTAuth::attempt($credentials)) {
        //     return $this->respondWithToken($token);
        // }
        // return response()->json(['error' => 'Unauthorized'], 401);

        /********************************************/    

        $validator = Validator::make($request -> all(),[
            'phone' => 'required',
            'password' => 'required',
        ]);

        if($validator -> fails()){
            return response()->json($validator->errors());
        }

        
        $credentials = $request->only('phone', 'password');

        try{
            if(! $token = JWTAuth::attempt($credentials)){
                return response()->json(['error' => 'invalid phone or password', [401]]);
            }
        }

        catch(JWTException $e){
            return response()->json(['error' => $e, [500]]);
        }
        return response()->json(compact('token'));  
    }




    /*
    ==============================================================
        Function for Registration new Captain to the app
    ==============================================================
    */

    public function register(Request $request){

        $validator = Validator::make($request -> all(),[
            'name'=> 'required',
            'bod'=> 'required',
            'relegion'=> 'required',
            'gender'=> 'required',
            'nationality'=> 'required',
            'id_num'=>'min:16',
            'phone'=> 'required',
            'password'=> 'required',
            'address'=> 'required',
            'edu_level'=> 'required',
            'service_id'=> 'required',
            'state_id'=> 'required',
            'district_id'=> 'required',
            ]);
            
            if($validator -> fails()){
            return response()->json($validator->errors());
            }

            else{
              
                try {

                    /** To generate the reg_no 
                     ******************************/
                        $captain_reg_no = Captain::all();
                        $captain_new_reg_no = $captain_reg_no->count()+1;
                    /** End of generate the reg_no */


                    $captain = Captain::create([
                        'reg_no'=> $captain_new_reg_no,
                        'name'=> $request->name,
                        'bod'=> $request->bod,
                        'relegion'=> $request->relegion,
                        'gender'=> $request->gender,
                        'nationality'=> $request->nationality,
                        'id_num'=> $request->id_num,
                        'phone'=> $request->phone,
                        'phone2'=> $request->phone2,
                        'password' => Hash::make($request['password']),
                        'address'=> $request->address,
                        'edu_level'=> $request->edu_level,
                        'service_id'=> $request->service_id,
                        'state_id'=> $request->state_id,
                        'district_id'=> $request->district_id,
                        'note'=> $request->note,
                    ]);

                    // $captain = Captain::create(['reg_no' => $captain_new_reg_no ,$request -> all()]);
                    return response()->json('Captian data created successfully');

                } catch (\Throwable $th) {
                    return response()->json("$request->name :  تم التسجيل مسبقا بهذا الرقم الوطني أو رقم الهاتف");
                }
            }  
    }



    /*
    ==============================================================
        Function for view captain informations
    ==============================================================
    */

     public function show_profile($captain_phone_num){

        $captain = Captain::where('phone', "$captain_phone_num")->get();

        if(is_null($captain)){
            return response()->json('Not found 404');
        }

        return response()->json(['Captian data founded successfully =>' , $captain ]);
     }




    /*
    ==============================================================
        Function for Update Captain profile information
    ==============================================================
    */

    public function update_profile(Request $request ,$captain_phone_num){

        $validator = Validator::make($request -> all(),[
            'name'=> 'required',
            'bod'=> 'required',
            'relegion'=> 'required',
            'gender'=> 'required',
            'nationality'=> 'required',
            'id_num'=>'min:16',
            'phone'=> 'required',
            'address'=> 'required',
            'edu_level'=> 'required',
            'service_id'=> 'required',
            'state_id'=> 'required',
            'district_id'=> 'required',
            ]);
            
            if($validator -> fails()){
            return response()->json($validator->errors());
            }

            else{
                
                $captain = Captain::where('phone', $captain_phone_num)->get();

                if(is_null($captain)){
                    return response()->json('Not found 404');
                }
        
                else{
                    
                    foreach ($captain as $captain_id) {
                        $id = $captain_id->id;
                    }

                    $data = $request->all();
                    Captain::whereId($id)->update($data);
                    $new_captain = Captain::find($id);
                    return response()->json(['Captian data updated successfully =>' , $new_captain ]);
                }
            }
        
     }




}
