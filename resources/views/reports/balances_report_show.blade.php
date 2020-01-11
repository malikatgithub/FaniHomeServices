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
                    document.location.href = '/captains_report';
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
                        <h5 class="text-center text-dark font-weight-bold">وحــدة حســابات الارصــدة</h5>
                    </div>
        
                    <div class="col-md-3">
                        <center><img src="{{asset('/img/logo.jpeg')}}" alt="Logo" width="150px" height="150px" class="img-reponsive rounded shadow img-thumbnial"></center>
                    </div>
        
                </div>
        
            </div>
    <div class=" pt-3">
            <div class="alert alert-dark mt-3">
                    <center><h5 class="text-center font-weight-bold">إدارة الحسابات </h5> </center>
            </div>
            
        <ul class="m-4"> 
            <li><h6>وحدة السجلات الشركة</h6></li>
            <li><h6>تقرير رصيد كابتن</h6></li>
            <li><h6>التاريخ  : {{date('Y-m-d')}}</h6></li>
        </ul>


        @if (! isset($captain))
            <div class="alert alert-dark mt-3">
                    <center><h5 class="text-center font-weight-bold">لاتوجد واردات ارصدة لهذا الكابتن! </h5> </center>
            </div>
        @else

            <table class="table table-striped table-bordered text-right" >
                <br>
                    <thead >
                    <tr class='thead-dark'>
                        <th>الإسم</th>
                        <th>تاريخ الميلاد</th>
                        <th>الجنس</th>
                        <th>الجنسية</th>
                        <th>الهاتف</th>
                        <th>الهاتف البديل</th>
                        <th>المؤهل</th>
                        <th>الخدمة</th>
                        <th>العنوان</th>
                        </tr>
                    </thead>
                    <tbody class="text-right">
                        <tr>
                            <td>{{ $captain->name }}</td>
                            <td>{{ $captain->bod }}</td>
                            <td>{{ $captain->gender }}</td>
                            <td>{{ $captain->nationality }}</td>
                            <td>{{ $captain->phone}}</td>
                            <td>{{ $captain->phone2 }}</td>
                            <td>{{ $captain->edu_level }}</td>

                            @if ($services->count()>0)
                                @php
                                    $captain_services = unserialize($captain->service_id);
                                @endphp
                                <td>
                                    @foreach ($services as $service)
                                        
                                        @if(in_array($service->id, $captain_services))
                                            {{ $service->name }} <br>
                                        @endif

                                    @endforeach
                                </td>
                                @else
                                    <td>- لا توجد خدمات او تم مسح الخدمة الرجاء إضافة خدمات - </td>
                            @endif

                            <td>{{ $captain->address }}</td>
                        </tr>
                    </tbody>
            </table>




            <table class="table table-striped table-bordered text-right mt-5" >
                    <br>
                        <thead >
                            <tr class='thead-dark'>
                                <th>رقم الفاتورة</th>
                                <th>التاريخ</th>
                                <th>الرصيد الوارد</th>
                            </tr>
                        </thead>
                        <tbody class="text-right">
                            <tr>

                               
                                @foreach ($balances as $balance)
                                    @php
                                        // FUNCTION FOR GET THE DATE FORMAT 
                                        $newtime = strtotime($balance->created_at);
                                        $date = date('Y-m-d',$newtime);
                                        // FUNCTION FOR GET THE DATE FORMAT
                                    @endphp
                                    <tr>
                                        <td>{{ $balance->invoice_id }}</td>
                                        <td>{{ $date }}</td>
                                        {{-- <td>{{ $balance->service->name }}</td> --}}
                                        <td>{{ $balance->balance }}</td>
                                    </tr>
                                @endforeach
                            </tr>
                        </tbody>
                </table>


            <div class="p-4">
                <h6 class=" font-weight-bold">إدارة السجلات</h6>
                <h6>__________________</h6>
            </div>
        @endif

</div>







</body>

</html>
    