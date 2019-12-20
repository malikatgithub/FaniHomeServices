<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\States;
use App\District;

class DistrictsController extends Controller
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
        try {
            
                $district = District::create([
                'state_id'=> $request->state_id,
                'name'=> $request->district_name,
            ]);
    
            $states = States::all();
            $district = District::all();
            return redirect()->route('states')->with('success', 'تمت إضافة المحلية بنجاح .')->with('states', $states)->with('district', $district);
    
            } catch (\Throwable $th) {
                $states = States::all();
                $districts = District::all();
                return redirect()->route('states')->with('delete', 'إسم المحلية مكرر ! ')->with('states', $states)->with('districts', $districts);
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $district = District::find($id);
        $states = States::all();
        return view('states.district_edit')->with('district', $district)->with('states', $states);
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
        try {

            $district = District::find($id);
            $states = States::all();
            $district->state_id = $request->state_id;
            $district->name = $request->district_name;
            $district->save();
            return redirect()->route('states')->with('success', 'تم تعديل بيانات المحليه.')->with('district', $district);
            
        } 
        catch (\Throwable $th) {
            $states = States::all();
            $district = District::find($id);
            return redirect()->route('states')->with('delete', 'إسم المحلية مكرر ! ')->with('states', $states)->with('district', $district);
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



    /*
        * API ROUTE  
        ***********************
        Here you find the customize route for the api routes.
    */

    # API Function Retrive state 
    public function fetch_districts($state_id){
       
        $districts = District::where('state_id', "$state_id")->get();

        if(is_null($districts)){
            return $this->sendError('district not found !');
        }
        return response()->json($districts);
     }
     
}
