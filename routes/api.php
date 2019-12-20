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


Route::middleware('jwt.auth')->group( function(){
    Route::resource('books', 'API\BookController');
});




    /* User API Routes
    ============================*/
    Route::POST('/app_captain_register', 'APICaptainsController@register')->name('app_captain_register');
    Route::POST('/captain_login', 'APICaptainsController@login')->name('captain_login');

    Route::middleware('jwt.auth')->group( function(){
        Route::GET('/show_profile/{captain_phone_num}', 'APICaptainsController@show_profile')->name('show_profile');
        Route::GET('/update_profile/{captain_phone_num}', 'APICaptainsController@update_profile')->name('update_profile');
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


    