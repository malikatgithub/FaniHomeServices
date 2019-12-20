<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use DB;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        $services_off = DB::table('services')->whereNotNull('deleted_at')->get();
        return view('services.index')->with('services', $services)
        ->with('services_off', $services_off);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $service = Service::create([
            'name'=> $request->name,
            'initial_price'=> $request->initial_price,
            'description'=> $request->description,
            
        ]);

        return redirect()->route('service_create')->with('success', 'تم إضافة الخدمة قد يوثر هذا علي عمليات البحث و التقارير.');
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
        $service = Service::find($id);
        return view('services.edit')->with('service', $service);
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
        $service = Service::find($id);
        $service->name = $request->name;
        $service->initial_price = $request->initial_price; 
        $service->description = $request->description;
   
        $service->save();

        return redirect()->route('service_show')->with('success', 'تم تعديل بيانات الخدمة.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);
        $service->delete();

        return redirect()->route('service_show')->with('delete', 'تم مسح بيانات الخدمة.');
    }


    /**
    * Restart the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function restart($id)
    {
        $service = Service::withTrashed()->where('id', $id)->first();
        $service->restore();
        return redirect()->route('service_show')->with('success', 'تم تشغيل بيانات الخدمة.');
    }
}
