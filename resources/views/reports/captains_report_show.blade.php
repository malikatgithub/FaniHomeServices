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
                        <h5 class="text-center text-dark font-weight-bold">وحــدة إدارة سجلات الكابتني</h5>
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
            <li><h6>تقرير بيانات الكابتن</h6></li>
            <li><h6>التاريخ  : {{date('Y-m-d')}}</h6></li>
        </ul>


        @if (isset($captains))
           
            
            @if ($captains-> isEmpty())
            <div class="alert alert-dark mt-3">
                    <center><h5 class="text-center font-weight-bold">لم يتم كابتن لهذه الخدمة ! </h5> </center>
            </div>
            @endif


        @if (count($captains)>0)
            <table class="table table-striped table-bordered text-right" >
                <br>
                    <thead >
                    <tr class="font-weight-bold">
                        <td>#</td>
                        <td>الإسم</td>
                        <td>تاريخ الميلاد</td>
                        <td>الجنس</td>
                        <td>الجنسية</td>
                        <td>الهاتف</td>
                        <td>الهاتف البديل</td>
                        <td>المؤهل</td>
                        <td>الخدمة</td>
                        <td>العنوان</td>
                        </tr>
                    </thead>
                    <tbody class="text-right">
                            
                                @php
                                    $x=0;
                                @endphp

                                @foreach ($captains as $captain)
                                    @php
                                        $x++;
                                    @endphp
                                        <tr>
                                            <td>{{ $x }}</td>
                                            <td>{{ $captain->name }}</td>
                                            <td>{{ $captain->bod }}</td>
                                            <td>{{ $captain->gender }}</td>
                                            <td>{{ $captain->nationality }}</td>
                                            <td>{{ $captain->phone}}</td>
                                            <td>{{ $captain->phone2 }}</td>
                                            <td>{{ $captain->edu_level }}</td>
                                            <td>{{ $captain->service->name }}</td>
                                            <td>{{ $captain->address }}</td>
                                            </tr>
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
    