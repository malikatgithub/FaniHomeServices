<?php
namespace App\Http\Controllers;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Response;
use JWTFactory;
use JWTAuth;
use App\Captain;
use App\Service;
use App\States;
use App\District;

class CaptianController extends BaseController
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
        $states = States::all();
        $districts = District::all();
        return view('captains.create')->with('services', $services)->with('states', $states)->with('districts', $districts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name'=> 'required',
            'bod'=> 'required',
            'gender'=> 'required',
            'nationality'=> 'required',
            'id_num'=>'min:16|max:16|required',
            'phone'=> 'required',
            'address'=> 'required',
            'edu_level'=> 'required',
            'service_id.*'=> 'required',
            'state_id'=> 'required',
            'district_id'=> 'required',
            'password' => 'min:6|required_with:password_conf|same:password_conf',
            'password_conf' => 'min:6|required'
            ]);

       try {

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
                'id_num'=> $request->id_num,
                'phone'=> $request->phone,
                'phone2'=> $request->phone2,
                'password' => Hash::make($request['password']),
                'address'=> $request->address,
                'edu_level'=> $request->edu_level,
                'service_id'=> serialize($request->service_id),
                'state_id'=> $request->state_id,
                'district_id'=> $request->district_id,
                'note'=> $request->note,
                'pic'=> $pic_new_name, 
            ]);

            return redirect()->route('captain_create')->with('success', 'تم إضافة الكابتن.')->with('success', $request->all(['service_id']));

       } catch (\Throwable $th) {
        return redirect()->route('captain_create')->with('fail', 'تم التسجيل مسبقا بهذا الرقم الوطني أو رقم الهاتف');
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
        $states = States::all();
        $districts = District::all();
        return view('captains.edit')->with('captain', $captain)->with('services', $services)->with('states', $states)->with('districts', $districts);
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

        $this->validate($request, [
            'name'=> 'required',
            'bod'=> 'required',
            'gender'=> 'required',
            'nationality'=> 'required',
            'id_num'=>'min:16|max:16|required',
            'phone'=> 'required',
            'address'=> 'required',
            'edu_level'=> 'required',
            'service_id.*'=> 'required',
            'state_id'=> 'required',
            'district_id'=> 'required',
            ]);

        try {
            
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


            if ($request->password){

                $this->validate($request, [
                    'password' => 'min:6|required_with:password_conf|same:password_conf',
                    'password_conf' => 'min:6'
                    ]);

            }

            $captain->name = $request->name;
            $captain->bod = $request->bod;
            $captain->relegion = $request->relegion;
            $captain->gender = $request->gender;

            $captain->nationality = $request->nationality;
            $captain->id_num = $request->id_num;
            
            $captain->phone = $request->phone;
            $captain->phone2 = $request->phone2;
            $captain->address = $request->address;
            $captain->password = Hash::make($request['password']);

            $captain->edu_level = $request->edu_level;
            $captain->service_id = serialize($request->service_id);
            $captain->state_id = $request->state_id;
            $captain->district_id = $request->district_id;
            $captain->note = $request->note;
    
            $captain->save();

            return redirect()->route('captains_show_page')->with('success', 'تم تعديل بيانات الكابتن.');

        } catch (\Throwable $th) {
            $services = Service::all();
            $captain = Captain::find($id);
            $states = States::all();
            $districts = District::all();
            return redirect()->back()->with('captain', $captain)->with('services', $services)->with('states', $states)->with('districts', $districts)->with('fail', 'تم التسجيل مسبقا بهذا الرقم الوطني أو رقم الهاتف');
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
