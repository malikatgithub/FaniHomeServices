<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\TempOrder;
use App\Orders;
use App\AcceptedOrders;
use App\DeclineOrders;
use JWTFactory;
use JWTAuth;
use Validator;
use Response;


class OrderController extends Controller
{
    
    /***********************************************************
         * Order Operation Functions.
         * Here you will find the Operation the handled with captain  and service provide and are
         * 1- Post_order function (For request the service)
         * 2- Accepted Order Function
         * 3- Rejected Order Function
         * 4- User Cancel Order Function
         * 
         * 
    ********************************************************/


    /*
    ==============================================================
        Functions Controlling the orders
    ==============================================================
    */

    public function post_order(Request $request){

        $validator = Validator::make($request->all(), [

            'location' => 'required',
            'user_id' => 'required',
            'user_name' => 'required',
            'service_list' => 'required',

        ]);

        if ($validator->fails()){
            return response()->json($validator->errors());
        }

        else{

            try {
                
                $order = TempOrder::create($request -> all());
                return response()->json([$order ,'Order Created successfully']);

            } catch (\Throwable $th) {
                
                return response()->json("$th : Error");
            }
        }


    }

    /* Ordering Accept
    **************************************/

    public function accepted_orders(Request $request){

        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'location' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors());
        }

        else{

            try {
                
                $order = AcceptedOrders::create($request -> all());
                $order_info = TempOrder::find($request->order_id);
                $order = Orders::create([
                    'order_id'=>$order_info->id, 
                    'location'=>$order_info->location, 
                    'user_id'=>$order_info->user_id, 
                    'user_name'=>$order_info->user_name, 
                    'service_list'=>$order_info->service_list,  
                    'status'=>true, 
                ]);

                $order_info = TempOrder::find($request->order_id);
                $order_info->delete();

                return response()->json('Order accepted successfully');

            } catch (\Throwable $th) {
                
                return response()->json("$th : Error");
            }
        }
    }


    /* Ordering Decline
    **************************************/

    public function decline_orders(Request $request){

        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'location' => 'required',
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors());
        }

        else{

            try {
                
                $order = DeclineOrders::create($request -> all());
                $order_info = TempOrder::find($request->order_id);
               
                return response()->json('Order Rejected successfully');

            } catch (\Throwable $th) {
                
                return response()->json("$th : Error");
            }
        }
    }


    /* User Cancel Order
    **************************************/

    public function cancel_order($order_id){
            try {
                
                $order_info = TempOrder::find($order_id);
                $order_info->delete();

                return response()->json('Order cancelled successfully');

            } catch (\Throwable $th) {
                
                return response()->json("$th : Error");
            }
        }
}
