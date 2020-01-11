<html>


        <head>
                <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
                <meta name="viewport" content="width=device-width, initial-scale=1">
            
                <!-- CSRF Token -->
                <meta name="csrf-token" content="{{ csrf_token() }}">
            
                <!-- Fonts -->
                <link rel="dns-prefetch" href="//fonts.gstatic.com">
                <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
                <script src="{{asset('js/font-awsome.js')}}"></script>
            
            
                <link href="https://fonts.googleapis.com/css?family=Tajawal&display=swap" rel="stylesheet">
                <!-- Styles -->
                <link href="{{ asset('css/app.css') }}" rel="stylesheet">
                <link href="{{ asset('css/style.css') }}" rel="stylesheet">
                <link href="{{ asset('css/font-awsome.css') }}" rel="stylesheet">
            
            
                {{-- Ajax Js --}}
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
            
                {{-- Some plugins --}}
                <script src="{{asset('js/plugins.js')}}"></script>   
            
                <title>وحدة التقارير</title>
            
            </head>

{{-- === AUTO PRINT PAGE 
    
    onload="window.print()" 
    
    --}}

<body style='font-family: Tajawal, sans-serif; direction:rtl ' class="text-right mt-5 bg-white">

        @if ($operation == 'print')
            <script type="text/javascript">
                $(document).ready(function () {
                    window.print();
                    setTimeout("closePrintView()", 3000);
                });
                function closePrintView() {
                    document.location.href = '/orders_report';
                }
            </script>
        @else

        @endif

        <div class="pt-5 container">

                <div class="row">
        
                    <div class="col-md-3">
                        <center><img src="{{asset('/img/logo.jpeg')}}" alt="Logo" width="150px" height="150px" class="img-reponsive rounded shadow img-thumbnial"></center>
                    </div>
        
                    <div class="col-md-6 mt-5">
                        <h5 class="text-center text-dark font-weight-bold">فـني للصيـــــانـة المـــــنزلـية</h5>
                        <h5 class="text-center text-dark font-weight-bold">وحــدة إدارة سجلات طلبات المستخدمين</h5>
                    </div>
        
                    <div class="col-md-3">
                        <center><img src="{{asset('/img/logo.jpeg')}}" alt="Logo" width="150px" height="150px" class="img-reponsive rounded shadow img-thumbnial"></center>
                    </div>
        
                </div>
        
            </div>
    <div class=" pt-3">
            <div class="alert alert-dark mt-3">
                    <center><h5 class="text-center font-weight-bold">إدارة السجلات </h5> </center>
            </div>
            
        <ul class="m-4"> 
            <li><h6>وحدة السجلات الشركة</h6></li>
            <li><h6>تقرير بيانات الطلبات</h6></li>
            <li><h6>التاريخ  : {{date('Y-m-d')}}</h6></li>
        </ul>


        @if (isset($orders))
           
            
            @if ($orders-> isEmpty())
            <div class="alert alert-dark mt-3">
                    <center><h5 class="text-center font-weight-bold"> لاتوجد طلبات حالية من خلال التطبيق</h5> </center>
            </div>
            @endif


        @if (count($orders)>0)
            <table class="table table-striped table-bordered text-right" >
                <br>
                    <thead>

                    <tr class="font-weight-bold">
                        <td>رقم الطلب</td>
                        <td>إسم المستخدم</td>
                        <td>الخدمة</td>
                        <td>الموقع</td>
                        <td>حالة الطلب</td>
                    </tr>

                    </thead>
                    <tbody class="text-right">
                            
                                @php
                                    $x=0;
                                @endphp

                                @foreach ($orders as $order)
                                    @php
                                        $x++;

                                        if($order->status == '0'){
                                            $status = 'تم الرفض';
                                        }

                                        else{
                                            $status = 'تم قبول الطلب';
                                        }
                                    @endphp
                                        
                                            {{--  <td>{{ $order->service_list }}</td>  --}}
                                            {{--  
                                            ===============================================================
                                            Function for check report type and return the service name 
                                            two types of report are here 
                                            service report and general order report  
                                            ===============================================================
                                            --}}

                                            @if ($report_type == 'service_report')

                                                @if ($services->count()>0)
                                                @php
                                                    $order_services = unserialize($order->service_list);
                                                @endphp
                                                
                                                    @foreach ($services as $service)
                                                        
                                                        @if(in_array($service_id, $order_services) and $service_id == $service->id)
                                                            <tr>
                                                                <td>{{ $x }}</td>
                                                                <td>{{ $order->user->name }}</td>
                                                                <td>{{ $service->name }} <br></td>
                                                                <td>{{ $order->location }}</td>
                                                                <td>{{ $status}}</td>
                                                            </tr>
                                                        @endif

                                                    @endforeach
                                               
                                                @else
                                                    <td>- لا توجد خدمات او تم مسح الخدمة الرجاء إضافة خدمات - </td>
                                                @endif

                                            @else

                                                @if ($services->count()>0)
                                                @php
                                                    $order_services = unserialize($order->service_list);
                                                @endphp
                                               
                                                    @foreach ($services as $service)
                                                        
                                                        @if(in_array($service->id, $order_services))
                                                        <tr>
                                                            <td>{{ $x }}</td>
                                                            <td>{{ $order->user->name }}</td>
                                                            <td>{{ $service->name }} <br></td>
                                                            <td>{{ $order->location }}</td>
                                                            <td>{{ $status}}</td>
                                                        </tr>
                                                        @endif

                                                    @endforeach
                                                @else
                                                    <td>- لا توجد خدمات او تم مسح الخدمة الرجاء إضافة خدمات - </td>
                                                @endif

                                            @endif

                                  
                                        
                                @endforeach

                                
                                
                            
                     
                        
                    </tbody>
            </table>

            <div class="p-4">
                <h6 class=" font-weight-bold">إدارة السجلات</h6>
                <h6>__________________</h6>
            </div>
        @endif
    @else

    @endif
</div>



</body>

</html>
    