<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Captain;
use App\Service;

class CaptianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        return view('captains.index')->with('services', $services);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        return view('captains.create')->with('services', $services);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if ($request->hasFile('pic')) {
            $pic = $request->pic;
            $pic_new_name = time().$pic->getClientOriginalName();
            $pic->move('upload/captains/profiles', $pic_new_name);
        }
        else
        {
            $pic_new_name = 'default.png';
        }
        

        $captain_reg_no = Captain::all();

        /** To generate the reg_no */
        $captain_new_reg_no = $captain_reg_no->count()+1;
        
        /** To generate the reg_no */
        
   
        $captain = Captain::create([
            'reg_no'=> $captain_new_reg_no,
            'name'=> $request->name,
            'bod'=> $request->bod,
            'relegion'=> $request->relegion,
            'gender'=> $request->gender,
            'nationality'=> $request->nationality,
            'phone'=> $request->phone,
            'phone2'=> $request->phone2,
            'address'=> $request->address,
            'edu_level'=> $request->edu_level,
            'service_id'=> $request->service_id,
            'note'=> $request->note,
            'pic'=> $pic_new_name,
 
            
        ]);

        return redirect()->route('captain_create')->with('success', 'تم إضافة الكابتن.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $captain = Captain::find($id);
        return view('captains.show')->with('captain', $captain);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $services = Service::all();
        $captain = Captain::find($id);
        return view('captains.edit')->with('captain', $captain)->with('services', $services);
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
        $captain = Captain::find($id);

        if($request->hasFile('pic')){

            $captain = Captain::find($id);
            $file= $captain->pic;
            $filename = public_path().'/upload/captains/profiles/'.$file;
            \File::delete($filename);

            $pic = $request->pic;
            $pic_new_name = time().$pic->getClientOriginalName();
            $pic->move('upload/captains/profiles', $pic_new_name);
            $captain->pic = $pic_new_name;

        }


        $captain->name = $request->name;
        $captain->bod = $request->bod;
        $captain->relegion = $request->relegion;
        $captain->gender = $request->gender;

        $captain->nationality = $request->nationality;
        $captain->phone = $request->phone;
        $captain->phone2 = $request->phone2;
        $captain->address = $request->address;

        $captain->edu_level = $request->edu_level;
        $captain->service_id = $request->service_id;
        $captain->note = $request->note;
   
        $captain->save();

        return redirect()->route('captains_show_page')->with('success', 'تم تعديل بيانات الكابتن.');


        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $captain = Captain::find($id);
        $file= $captain->pic ;
      
        /*
        To Remove the image file
        ===========================*/
        $filename = public_path().'/upload/captains/profiles/'.$file;
        \File::delete($filename);

        $captain->delete();

        return redirect()->route('captains_show_page')->with('delete', 'تم مسح بيانات الكابتن.');
    }
}
