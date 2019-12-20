<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Captain;
use App\Balance;
use DB;
class ReportsController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function captains_report()
    {
        $services = Service::all();
        return view('reports.captains_report')->with('services', $services);
    }



    /*** show and print all captain report */
        public function captains_report_show($id)
        {

            if ($id == '1'){
                $operation = 'print';
            }

            if ($id == '2'){
                $operation = 'show';
            }

            $captains = Captain::all();
            return view('reports.captains_report_show')->with('captains', $captains)
            ->with('operation', $operation);
        }

        public function captains_service_report(Request $request)
        {
            if ($request->print){
                $operation = 'print';
            }

            if ($request->show){
                $operation = 'show';
            }

            $captains = Captain::where('service_id', '=', $request->service_id)->get();
            return view('reports.captains_report_show')->with('captains', $captains)
            ->with('operation', $operation);
        }


        
        /* Balance Report Controller*/
        public function balances_report()
        {
            return view('reports.balances_report');
        }

        public function captain_balance_report($id)
        {


            $operation = 'show';

            $captain = Captain::find($id);
            $balances = Balance::where('captain_id', '=', $id)->get();

            return view('reports.balances_report_show')->with('captain', $captain)
            ->with('operation', $operation)
            ->with('balances', $balances);

        }


        public function captain_balance_report_print($id)
        {

            $operation = 'print';

            $captain = Captain::find($id);
            $balances = Balance::where('captain_id', '=', $id)->get();

            return view('reports.balances_report_show')->with('captain', $captain)
            ->with('operation', $operation)
            ->with('balances', $balances);

        }

}
