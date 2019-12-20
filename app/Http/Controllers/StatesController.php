<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\States;
use App\District;

class StatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = States::all();
        $state_off = States::onlyTrashed()->get();
        $districts = District::all();
        return view('states.index')->with('states', $states)->with('state_off', $state_off)->with('districts', $districts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = States::all();
        return view('states.create')->with('states', $states);
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
            
        $state = states::create([
            'name'=> $request->state,
        ]);

        $states = States::all();
        return redirect()->route('states')->with('success', 'تمت إضافة الولاية بنجاح .')->with('states', $states);

        } catch (\Throwable $th) {
            $states = States::all();
            return redirect()->route('states')->with('delete', 'إسم الولاية مكرر ! ')->with('states', $states);
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
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $state = States::find($id);
        return view('states.edit')->with('state', $state);
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

            $state = States::find($id);
            $state->name = $request->state;
            $state->save();
            return redirect()->route('states')->with('success', 'تم تعديل بيانات الولاية.');
            
        } 
        catch (\Throwable $th) {
            $states = States::all();
            return redirect()->route('states')->with('delete', 'إسم الولاية مكرر ! ')->with('states', $states);
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
        $state = States::find($id);
        $state->delete();

        return redirect()->route('states')->with('delete', 'تم إيقاف بيانات الولاية قد  يؤثر هذا علي عمليات البحث و التقارير.');
    }

    public function restart($id)
    {
        $state = States::withTrashed()->where('id', $id)->first();
        $state->restore();
        return redirect()->route('states')->with('success', 'تم تشغيل بيانات الخدمة قد  يؤثر هذا علي عمليات البحث و التقارير.');
    }





    /*
        * API ROUTE  
        ***********************
        Here you find the customize route for the api routes.
    */
    
    # API Function Retrive state 
     public function fetch_states(){
       
        $states = States::all();

        if(is_null($states)){
            return $this->sendError('states not found !');
        }
        return response()->json($states);
     }


}


