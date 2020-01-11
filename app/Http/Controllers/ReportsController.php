<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Captain;
use App\Balance;
use App\Orders;
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
            $services = Service::all();
            $report_type = 'general';
            return view('reports.captains_report_show')->with('captains', $captains)->with('services', $services)->with('report_type', $report_type)
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

            $report_type = 'service_report';
            $services = Service::all();
            $service_id = $request->service_id;
            $captains = Captain::all();

            return view('reports.captains_report_show')->with('captains', $captains)
            ->with('operation', $operation)->with('service_id', $service_id)->with('report_type', $report_type)->with('services', $services);
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
            $services = Service::all();
            $balances = Balance::where('captain_id', '=', $id)->get();

            return view('reports.balances_report_show')->with('captain', $captain)
            ->with('operation', $operation)
            ->with('services', $services)
            ->with('balances', $balances);

        }


        public function captain_balance_report_print($id)
        {

            $operation = 'print';

            $captain = Captain::find($id);
            $services = Service::all();
            $balances = Balance::where('captain_id', '=', $id)->get();

            return view('reports.balances_report_show')->with('captain', $captain)
            ->with('operation', $operation)
            ->with('services', $services)
            ->with('balances', $balances);

        }



        /* 
        ================================================
            Orders Report Controller
        ================================================
        */

         public function orders_report()
         {
            $services = Service::all();
            return view('reports.orders_report')->with('services', $services);
         }


        /*
            show and print all service order report 
        */
        
        public function orders_report_show($id)
        {

            if ($id == '1'){
                $operation = 'print';
            }

            if ($id == '2'){
                $operation = 'show';
            }

            $orders = Orders::all();
            $services = Service::all();
            $report_type = 'general';
            return view('reports.orders_report_show')->with('orders', $orders)->with('services', $services)->with('operation', $operation)->with('report_type', $report_type);
        }


        public function order_service_report(Request $request)
        {
            if ($request->print){
                $operation = 'print';
            }

            if ($request->show){
                $operation = 'show';
            }

            $report_type = 'service_report';
            $services = Service::all();
            $service_id = $request->service_id;
            $orders = Orders::all();

            return view('reports.orders_report_show')->with('orders', $orders)->with('operation', $operation)->with('service_id', $service_id)->with('report_type', $report_type)->with('services', $services);
        }


        /* Accepted and rejected order */ 

        public function accepted_orders_report($id)
        {

            if ($id == '1'){
                $operation = 'print';
            }

            if ($id == '2'){
                $operation = 'show';
            }

            $orders = Orders::where('status', '1')->get();
            $services = Service::all();
            $report_type = 'general';
            return view('reports.order_status_report')->with('orders', $orders)->with('services', $services)->with('operation', $operation)->with('report_type', $report_type);
        }


        public function rejected_orders_report($id)
        {

            if ($id == '1'){
                $operation = 'print';
            }

            if ($id == '2'){
                $operation = 'show';
            }

            $orders = Orders::where('status', '0')->get();
            $services = Service::all();
            $report_type = 'general';
            return view('reports.order_status_report')->with('orders', $orders)->with('services', $services)->with('operation', $operation)->with('report_type', $report_type);
        }

        public function  order_status_service_report(Request $request)
        {
            if ($request->print){
                $operation = 'print';
            }

            if ($request->show){
                $operation = 'show';
            }

            $report_type = 'service_report';
            $services = Service::all();
            $service_id = $request->service_id;
            
            if($request->accepted){
                $orders = Orders::where('status', '1')->get();
            }

            if($request->rejected){
                $orders = Orders::where('status', '0')->get();
            }

            return view('reports.order_status_report')->with('orders', $orders)->with('operation', $operation)->with('service_id', $service_id)->with('report_type', $report_type)->with('services', $services);
        }

       
        
}
