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

    <title>سند قبض مالي</title>

</head>

{{-- === AUTO PRINT PAGE 
    
    onload="window.print()" 
    
    --}}

<body style='font-family: Tajawal, sans-serif; direction:rtl ' class="text-right mt-5 bg-white" >
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
    <div class=" pt-5">
        {{--  @foreach ($invoice_info as $invoice_info)  --}}
        <center>
            <div class='borber'>
                <h5 class="font-weight-bold">
                    [ سند توريد رصيد  - 
                        Reciept Voucher ]
                    </h5>
            </div>
        </center>

        <div class='cash_container'>

            <table class='table_cash'>
 


                <tr>
                    <td> - تاريخ الدفع : <ins> <strong> 
                                   
                        
                    @php
                        if(isset($created_at)){
                            $mytime = strtotime($created_at);
                            $date = date('Y-m-d', $mytime);
                            echo $date;

                            echo "<script type='text/javascript'>
                                    $(document).ready(function () {
                                        window.print();
                                        setTimeout('closePrintView()', 3000);
                                    });
                                    function closePrintView() {
                                        document.location.href = '/balance_op';
                                    }
                                </script>
                                }";
                            }
                        else {
                            $mytime = strtotime(Carbon\Carbon::now());
                            $date = date('Y-m-d', $mytime);
                            echo $date;
                            echo "<script type='text/javascript'>
                                    $(document).ready(function () {
                                        window.print();
                                        setTimeout('closePrintView()', 3000);
                                    });
                                    function closePrintView() {
                                        document.location.href = '/balance';
                                    }
                                </script>
                                }";
                        }
                    @endphp
                    

                       
                    </strong></ins>

                    </td>
                </tr>

                <tr>
                    <td> - رقم الإيصال : <ins> <strong> {{ $invoice_id }} </strong></ins> <span class=" float-left">  طريقه الدفع : <strong>  كاش  </strong> </span></td>
                </tr>

                <tr>
                    <td> 
                        </strong> - وصلني من السيد : <ins> {{ $name }} <strong> </ins> <span class=" float-left"> مبلغ و قدرة : <strong> ##  {{ $balance }} جنية ##</strong></span>
                    </td>
                </tr>

                <tr>
                    <td> -  و ذالك عباره عن رصيد إضافي علي الحساب &nbsp;<ins><strong>   
                </tr>
                <tr>
                    <td> - ملاحظات : <strong><br>&nbsp;&nbsp;&nbsp;  {{ $note }}</strong></td>
                </tr>
            </table>
            <br>
            <br>
            <table class='table_cash'>
                <tr>
                    <td> إسم المحاسب</td>
                    <td> توقيع و ختم المحاسب </td>
                </tr>
                <tr>
                    <td>________________________________</td>
                    <td></td>
                </tr>

                <tr>
                    <td> إسم المدير المالي</td>
                    <td> توقيع و ختم المدير المالي </td>
                </tr>
                <tr>
                    <td>________________________________</td>
                    <td></td>
                </tr>

            </table>
            {{--  @endforeach  --}}
        </div>
</body>

</html>