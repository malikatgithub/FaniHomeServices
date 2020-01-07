<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



    /* User API Routes
    ============================*/
    Route::POST('/captain_login', 'APICaptainsController@login')->name('captain_login');
    Route::POST('/captain_register', 'APICaptainsController@register')->name('captain_register');


    /* User API Routes
    ============================*/
    Route::POST('/user_register', 'AppUserController@store')->name('user_register');
    Route::POST('/user_update/{id}', 'AppUserController@update')->name('user_update');
    Route::POST('/user_show/{id}', 'AppUserController@show')->name('user_show');
  
    /* User Order API Routes
    ============================*/
    Route::POST('/post_order', 'OrderController@post_order')->name('post_order');
    Route::POST('/accepted_orders', 'OrderController@accepted_orders')->name('accepted_orders');
    Route::POST('/decline_orders', 'OrderController@decline_orders')->name('decline_orders');
    Route::GET('/cancel_order/{order_id}', 'OrderController@cancel_order')->name('cancel_order');



    
    
    Route::middleware(['jwt.auth', 'auth:api'])->group( function(){
        Route::GET('/show_profile/{captain_phone_num}', 'APICaptainsController@show_profile')->name('show_profile');
        Route::GET('/update_profile/{captain_phone_num}', 'APICaptainsController@update_profile')->name('update_profile');
        Route::GET('/update_password/{captain_phone_num}', 'APICaptainsController@update_password')->name('update_password');
    

        /* Order API Routes
        ============================*/
        Route::POST('/go_Online', 'APICaptainsController@go_Online')->name('go_Online');
        Route::get('/go_Offline/{onlineTicketId}', 'APICaptainsController@go_Offline')->name('go_Offline');


    });

   

    /* Services API Routes
    ============================*/
    Route::get('/fetch_services', 'ServiceController@fetch_services')->name('fetch_services');

     /* States API Routes
    ============================*/
    Route::get('/fetch_states', 'StatesController@fetch_states')->name('fetch_states');

     /* Districts API Routes
    ============================*/  
    Route::get('/fetch_districts/{state_id}', 'DistrictsController@fetch_districts')->name('fetch_districts');


    