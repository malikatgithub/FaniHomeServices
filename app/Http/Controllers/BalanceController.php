<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Captain;
use App\Balance;
use DB;

class BalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('balance.index');
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
        $invoice_id_numbers = Balance::all();

        /** To generate the reg_no */
        $invoice_id = $invoice_id_numbers->count()+1;
        
        /** To generate the reg_no */
        
   
        $balance = Balance::create([

            'invoice_id'=> $invoice_id,
            'captain_id'=> $request->captain_id,
            'name'=> $request->name,
            'reg_no'=> $request->reg_no,
            'balance'=> $request->balance,
            'service_id'=> $request->service_id,
            'phone'=> $request->phone,
            'note'=> $request->note,

        ]);

        // return redirect()->route('balance')->with('success', 'تمت إضافة رصيد للكابتن .');

        return view('balance.invoice_print')->with('invoice_id', $invoice_id)
                                                    ->with('name', $request->name)
                                                    ->with('balance', $request->balance)
                                                    ->with('note', $request->note);
                                                
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

        $balance = Balance::find($id);
        $captain_name = $balance->captain->name;
        return view('balance.edit')->with('captain_name', $captain_name)->with('balance', $balance);

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
        $balance = Balance::find($id);
        $balance->balance = $request->balance;
        $balance->note = $request->note;
   
        $balance->save();
        return redirect()->route('balance_op')->with('success', 'تم تعديل بيانات الإيصال المالي.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $balance = Balance::find($id);
        $balance->delete();

        return redirect()->route('balance_op')->with('delete', 'تم مسح بيانات الإيصال المالي.');
    }



    /* Custom made function
    ===============================*/

      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function form($id)
    {
        
        $captain = Captain::find($id);
        $balances = DB::table('balances')
        ->where('captain_id', '=', $id)
        ->whereNull('deleted_at')
        ->orderBy('id', 'desc')
        ->get();

        $total_balance=0;
        foreach ($balances as $balance){
            $total_balance = $total_balance + $balance->balance;
        }

        return view('balance.create')->with('captain', $captain)->with('total_balance', $total_balance);
    }

      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function balance_op()
    {
        return view('balance.balance_op');
    }


    public function balance_print($id)
    {

        $balance = Balance::find($id);

        return view('balance.invoice_print')->with('invoice_id', $balance->invoice_id)
                                                    ->with('name', $balance->name)
                                                    ->with('created_at', $balance->created_at)
                                                    ->with('balance', $balance->balance)
                                                    ->with('note', $balance->note);
    }

}
