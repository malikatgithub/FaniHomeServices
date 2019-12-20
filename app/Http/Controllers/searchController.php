<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Captain;
use App\Service;
use App\Balance;
use function Opis\Closure\unserialize;

class searchController extends Controller
{
    
    public function action(Request $request)
    {


        if ($request->ajax()) {
            $query = $request->get('query');
            if ($query != '') {
            $data = DB::table('captains')
             ->where('name', 'like', '%'.$query.'%')
             ->orWhere('reg_no', 'like', '%'.$query.'%')
             ->whereNull('deleted_at')
             ->orderBy('id', 'desc')
             ->get();
            } else {
                //    $data = DB::table('students')
            //      ->orderBy('id', 'desc')
            //      ->get();
            }

            $total_row = $data->count();
          
            if ($total_row > 0) {
                $output = '';
       
                $thead = "
                <tr class='thead-dark'>
                    <th>رقم التسجيل</th>
                    <th>إسم الكابتن</th>
                    <th>الجنسية</th>
                    <th>رقم الهاتف</th>
                    <th>المهنة</th>
                    <th>المؤهل</th>
                    <th>العنوان</th>
                    <th class='text-center'>العمليات</th>
                </tr>
                ";

                
                foreach ($data as $row) {

                    $output .= "
                        <tr>
                        <td>$row->reg_no</td>
                        <td>$row->name</td>
                        <td>$row->nationality</td>
                        <td>$row->phone</td>
                        <td>$row->service_id</td>
                        <td>$row->edu_level</td>
                        <td>$row->address</td>
                        <td class='text-center'>
                            <abbr title='تعديل بيانات الكابتن'><a onclick='return edit()' href='/captain_edit/$row->id'><i class='far fa-edit fa-2x pt-2 ml-1 text-primary'></i></a></abbr>
                            <abbr title='عرض بيانات الكابتن'><a  href='/captain_show/$row->id'><i class=' fas fa-address-card fa-2x pt-2 ml-1 text-success' ></i></a></abbr>
                            <abbr title='حذف بيانات الكابتن'><a onclick='return del()' href='/captain_delete/$row->id'><i class='fas fa-trash-alt fa-2x  pt-2 i text-danger' ></i></a></abbr>
                        </td>
                        </tr>
                        ";
                }
            } 
            
            if ($data->isEmpty()) {
                $output .='
                            <tr>
                                <td align="center" colspan="5" class="text-danger font-weight-bold"><i class="fas fa-exclamation-triangle fa-2x"> لاتوجد نتائج </i></td>
                            </tr>
                            ';
            }

            //   $data = array(
            //    "table_data"  => "$output"
           
            //    //'total_data'  => $total_row
            //   );

            $data['table_header'] = $thead;
            $data['result'] = $output;
    
            echo json_encode($data);
        }
    }


    public function balance(Request $request)
    {


        if ($request->ajax()) {
            $query = $request->get('query');
            if ($query != '') {
            $data = DB::table('captains')
             ->where('name', 'like', '%'.$query.'%')
             ->orWhere('reg_no', 'like', '%'.$query.'%')
             ->whereNull('deleted_at')
             ->orderBy('id', 'desc')
             ->get();
            } else {
                //    $data = DB::table('students')
            //      ->orderBy('id', 'desc')
            //      ->get();
            }

            $total_row = $data->count();
          
            if ($total_row > 0) {
                $output = '';
       
                $thead = "
                <tr class='thead-dark'> 
                    <th>رقم التسجيل</th>
                    <th>إسم الكابتن</th>
                    <th>الجنسية</th>
                    <th>رقم الهاتف</th>
                    <th>المهنة</th>
                    <th>المؤهل</th>
                    <th>العنوان</th>
                    <th class='text-center'>العمليات</th>
                </tr>
                ";

                
                foreach ($data as $row) {

                    $output .= "
                        <tr>
                        <td>$row->reg_no</td>
                        <td>$row->name</td>
                        <td>$row->nationality</td>
                        <td>$row->phone</td>
                        <td>$row->service_id</td>
                        <td>$row->edu_level</td>
                        <td>$row->address</td>
                        <td class='text-center'>
                         <a href='/balance_form/$row->id' class='btn btn-primary font-weight-bold'><i class='fas fa-plus-square'></i>&nbsp; إضافة رصيد </a>
                        </td>
                        </tr>
                        ";
                }
            } 
            
            if ($data->isEmpty()) {
                $output .='
                            <tr>
                                <td align="center" colspan="5" class="text-danger font-weight-bold"><i class="fas fa-exclamation-triangle fa-2x"> لاتوجد نتائج </i></td>
                            </tr>
                            ';
            }

            //   $data = array(
            //    "table_data"  => "$output"
           
            //    //'total_data'  => $total_row
            //   );

            $data['table_header'] = $thead;
            $data['result'] = $output;
    
            echo json_encode($data);
        }
    }



    public function balance_op(Request $request)
    {


        if ($request->ajax()) {
            $query = $request->get('query');
            if ($query != '') {
            $data = DB::table('balances')
             ->Where('invoice_id', '=', $query)
            //  ->orWhere('reg_no', '=', $query)
             ->orwhere('name', 'like', '%'.$query.'%')
             ->whereNull('deleted_at')
             ->orderBy('id', 'desc')
             ->get();
            } else {
                //    $data = DB::table('students')
            //      ->orderBy('id', 'desc')
            //      ->get();
            }

            $total_row = $data->count();
          
            if ($total_row > 0) {

                $output = '';
                $thead = "
                <tr class='thead-dark'>
                    <th>رقم الفاتورة</th>
                    <th>التاريخ</th>
                    <th>رقم التسجيل</th>
                    <th>إسم الكابتن</th>
                    <th>الخدمة</th>
                    <th>الرصيد الوارد</th>
                   
                    <th class='text-center'>العمليات</th>
                </tr>
                ";

                foreach ($data as $row) {

                // FUNCTION FOR CHECK THE SERVICE NAME 
                    $balance = DB::table('services')
                    ->where('id', $row->service_id)
                    ->whereNull('deleted_at')
                    ->get();

                    $array_count = count($balance);
                    
                    if ($array_count == 0){
                        $service_name = 'تم إيقاف الخدمة';
                    }
                    else{
                        foreach ($balance as $se){

                            $service_name = $se->name;

                        }
                    }
                // FUNCTION FOR CHECK THE SERVICE NAME 


                
                // FUNCTION FOR RETURN THE CAPTAIN NAME 
                    $balance = Balance::find($row->id);
                    $captain_name = $balance->captain->name;
                // FUNCTION FOR RETURN THE CAPTAIN NAME 
         
 

                // FUNCTION FOR GET THE DATE FORMAT 
                    $newtime = strtotime($row->created_at);
                    $date = date('Y-m-d',$newtime);
                // FUNCTION FOR GET THE DATE FORMAT

                    $output .= "
                        <tr>
                        <td>$row->invoice_id</td>
                        <td>$date</td>
                        <td>$row->reg_no</td>
                        <td>$captain_name</td>
                        <td>$service_name</td>
                        <td>$row->balance</td>
                        <td class='text-center'>
                         <a href='/balance_print/$row->id' class='btn btn-primary font-weight-bold'><i class='fas fa-print'></i>&nbsp; طباعة </a>
                         <a href='/balance_edit/$row->id' class='btn btn-success font-weight-bold'><i class='fas fa-edit'></i>&nbsp; تعديل </a>
                         <a href='/balance_delete/$row->id' class='btn btn-danger font-weight-bold'><i class='fas fa-trash-alt'></i>&nbsp; حذف </a>
                        </td>
                        </tr>
                        ";
                }

            } 
            
            if ($data->isEmpty()) {
                $output .='
                            <tr>
                                <td align="center" colspan="5" class="text-danger font-weight-bold"><i class="fas fa-exclamation-triangle fa-2x"> لاتوجد نتائج </i></td>
                                
                            </tr>
                            ';
            }

            //   $data = array(
            //    "table_data"  => "$output"
           
            //    //'total_data'  => $total_row
            //   );

            $data['table_header'] = $thead;
            $data['result'] = $output;
    
            echo json_encode($data);
        }
    }



    public function balance_report(Request $request)
    {


        if ($request->ajax()) {
            $query = $request->get('query');
            if ($query != '') {
            $data = DB::table('captains')
             ->where('name', 'like', '%'.$query.'%')
             ->orWhere('reg_no', 'like', '%'.$query.'%')
             ->whereNull('deleted_at')
             ->orderBy('id', 'desc')
             ->get();
            } else {
                //    $data = DB::table('students')
            //      ->orderBy('id', 'desc')
            //      ->get();
            }

            $total_row = $data->count();
          
            if ($total_row > 0) {
                $output = '';
       
                $thead = "
                <tr class='thead-dark'>
                    <th>رقم التسجيل</th>
                    <th>إسم الكابتن</th>
                    <th>الجنسية</th>
                    <th>رقم الهاتف</th>
                    <th>المهنة</th>
                    <th>المؤهل</th>
                    <th>العنوان</th>
                    <th class='text-center'>العمليات</th>
                </tr>
                ";

                
                foreach ($data as $row) {

                    $output .= "
                        <tr>
                        <td>$row->reg_no</td>
                        <td>$row->name</td>
                        <td>$row->nationality</td>
                        <td>$row->phone</td>
                        <td>$row->service_id</td>
                        <td>$row->edu_level</td>
                        <td>$row->address</td>
                        <td class='text-center'>
                            <a href='/captain_balance_report/$row->id' class='btn btn-success font-weight-bold'><i class='fas fa-file-alt'></i>&nbsp;  عرض التقرير </a>
                            <a href='/captain_balance_report_print/$row->id' class='btn btn-primary font-weight-bold'><i class='fas fa-print'></i>&nbsp; طباعة التقرير </a>
                        </td>
                        </tr>
                        ";
                }
            } 
            
            if ($data->isEmpty()) {
                $output .='
                            <tr>
                                <td align="center" colspan="5" class="text-danger font-weight-bold"><i class="fas fa-exclamation-triangle fa-2x"> لاتوجد نتائج </i></td>
                            </tr>
                            ';
            }

            //   $data = array(
            //    "table_data"  => "$output"
           
            //    //'total_data'  => $total_row
            //   );

            $data['table_header'] = $thead;
            $data['result'] = $output;
    
            echo json_encode($data);
        }
    }

}
