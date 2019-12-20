<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::match(['get', 'post'], 'register', function(){
    return redirect('/');
});

Route::get('/home', 'HomeController@index')->name('home');


/*Main Application Routes
===================================*/
Route::middleware(['auth'])->group(function () { 

    /* Captain Routes
    ============================*/

    Route::get('/captain_create', 'CaptianController@create')->name('captain_create');
    Route::POST('/captain_store', 'CaptianController@store')->name('captain_store');
    Route::get('/captains_show_page', 'CaptianController@index')->name('captains_show_page');
    Route::get('captain_show/{id}', 'CaptianController@show')->name('captain_show');
    Route::get('/captain_edit/{id}', 'CaptianController@edit')->name('/captain_edit');
    Route::post('captain_update/{id}', 'CaptianController@update')->name('captain_update');
    Route::get('captain_delete/{id}', 'CaptianController@destroy')->name('captain_delete');
    /*==== Ajax Search Engine ====*/
    Route::get('/live_search/action', 'searchController@action')->name('live_search.action');
    /*==== End Ajax Search Engine ====*/


    /* Services Routes
    ============================*/
    
    Route::get('/service_service', 'ServiceController@create')->name('service_create');
    Route::POST('/service_store', 'ServiceController@store')->name('service_store');
    Route::get('/service_show', 'ServiceController@index')->name('service_show');
    Route::get('/service_edit/{id}', 'ServiceController@edit')->name('service_edit');
    Route::post('service_update/{id}', 'ServiceController@update')->name('service_update');
    Route::get('service_delete/{id}', 'ServiceController@destroy')->name('service_delete');
    Route::get('/service_restart/{id}', 'ServiceController@restart')->name('service_restart');


    /* States Routes
    ============================*/
    
    Route::get('/states', 'StatesController@index')->name('states');
    Route::get('/state_create', 'StatesController@create')->name('state_create');
    Route::POST('/state_store', 'StatesController@store')->name('state_store');
    Route::get('/state_edit/{id}', 'StatesController@edit')->name('state_edit');
    Route::post('/state_update/{id}', 'StatesController@update')->name('state_update');
    Route::get('/state_delete/{id}', 'StatesController@destroy')->name('state_delete');
    Route::get('/state_restart/{id}', 'StatesController@restart')->name('state_restart');



    /* States Routes
    ============================*/
    Route::POST('/district_store', 'DistrictsController@store')->name('district_store');
    Route::get('/district_edit/{id}', 'DistrictsController@edit')->name('district_edit');
    Route::post('/district_update/{id}', 'DistrictsController@update')->name('district_update');


    /* balance Routes
    ============================*/
    Route::get('/balance', 'BalanceController@index')->name('balance');
    Route::get('/balance_form/{id}', 'BalanceController@form')->name('/balance_form');
    Route::POST('/balance_store', 'BalanceController@store')->name('balance_store');
    Route::get('/balance_op', 'BalanceController@balance_op')->name('balance_op');
    Route::get('/balance_print/{id}', 'BalanceController@balance_print')->name('balance_print');
    Route::get('/balance_edit/{id}', 'BalanceController@edit')->name('balance_edit');
    Route::post('/balance_update/{id}', 'BalanceController@update')->name('balance_update');
    Route::get('/balance_delete/{id}', 'BalanceController@destroy')->name('balance_delete');

    /*==== Ajax Search Engine ====*/
    Route::get('/live_search/balance', 'searchController@balance')->name('live_search.balance');
    Route::get('/live_search/balance_op', 'searchController@balance_op')->name('live_search.balance_op');
    /*==== End Ajax Search Engine ====*/



    /* balance Routes
    ============================*/
    Route::get('/captains_report', 'ReportsController@captains_report')->name('captains_report');
    Route::get('/captains_report_show/{id}', 'ReportsController@captains_report_show')->name('captains_report_show');
    Route::POST('/captains_service_report', 'ReportsController@captains_service_report')->name('captains_service_report');

    Route::get('/balances_report', 'ReportsController@balances_report')->name('balances_report');
    Route::get('/captain_balance_report/{id}', 'ReportsController@captain_balance_report')->name('captain_balance_report');
    Route::get('/captain_balance_report_print/{id}', 'ReportsController@captain_balance_report_print')->name('captain_balance_report_print');

     /*==== Ajax Search Engine ====*/
     Route::get('/live_search/balance_report', 'searchController@balance_report')->name('live_search.balance_report');
     /*==== End Ajax Search Engine ====*/

    
});