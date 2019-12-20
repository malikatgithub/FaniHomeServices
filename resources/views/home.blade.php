@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 dir-rtl">
            <div class="card">
                <div class="card-header text-right">
                    <h5 class="font-weight-bold"><i class="fa fa-object-group text-danger"></i>&nbsp;  لوحة التحكم في التطبيق </h5>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row ">

                            <div class="col-md-6 p-3 ">
                                <div class="card text-right ">
                                    <h5 class="card-header"><i class="fa fa-user text-danger"></i>&nbsp;  بيانات الكباتن </h5>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="card-body"> 
                                                <h6 class="card-title">إضافة و تعديل و حذف بيانات الكابتن</h6>
                                                <p class="card-text">
                                                    <a href="{{ route('captain_create') }}" class="btn btn-success text-white"><i class="fa fa-plus-square"></i> إضافة</a> 
                                                    <a href="{{ route('captains_show_page') }}" class="btn btn-primary text-white"><i class="fa fa-eye"></i> عرض الكابتن</a>    
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="card-body float-left opacity-50"> 
                                                    <i class="fa fa-users text-primary fa-5x"></i>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6 p-3 ">
                                <div class="card text-right ">
                                    <h5 class="card-header"><i class="fa fa-window-restore text-danger"></i>&nbsp;  بيانات خدمات التطبيق   </h5>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="card-body"> 
                                                <h6 class="card-title">إضافة و تعديل و حذف بيانات الخدمات المقدمة</h6>
                                                <p class="card-text">
                                                    <a href="{{ route('service_create') }}" class="btn btn-success text-white"><i class="fa fa-plus-square"></i> إضافة</a> 
                                                    <a href="{{ route('service_show') }}" class="btn btn-primary text-white"><i class="fa fa-eye"></i> عرض الخدامات</a> 
                                                    <a href="{{ route('states') }}" class="btn btn-dark text-white"><i class="fa fa-map-marker-alt"></i> المناطق </a>    
   
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="card-body float-left opacity-50"> 
                                                    <i class="fa fa-server text-primary fa-5x"></i>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6 p-3 ">
                                <div class="card text-right ">
                                    <h5 class="card-header"><i class="fas fa-hand-holding-usd text-danger"></i>&nbsp; بيانات أرصدة الكابتن </h5>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="card-body"> 
                                                <h6 class="card-title">إضافة و تعديل و حذف بيانات المالية للكابتن</h6>
                                                <p class="card-text">
                                                    <a href="{{ route('balance') }}" class="btn btn-success text-white"><i class="fa fa-plus-square"></i> إضافة</a> 
                                                    <a href="{{ route('balance_op') }}" class="btn btn-primary text-white"><i class="fa fa-file-alt"></i> العمليات المالية </a>    
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="card-body float-left opacity-50"> 
                                                <i class="fas fa-money-check-alt text-primary fa-5x"></i>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 p-3 ">
                                <div class="card text-right ">
                                    <h5 class="card-header"><i class="fas fa-file text-danger"></i>&nbsp; نافذة التقارير العامة </h5>
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="card-body"> 
                                                <h6 class="card-title">التقارير المالية و تقارير الخدمات و الكابتن</h6>
                                                <p class="card-text">
                                                    <a href="{{ route('captains_report') }}" class="btn btn-success text-white"><i class="fa fa-file-alt"></i> تقارير الكابتن</a> 
                                                    {{--  <a href="{{ route('service_show') }}" class="btn btn-primary text-white"><i class="fa fa-file-alt"></i> تقارير الخدمات </a>      --}}
                                                    <a href="{{ route('balances_report') }}" class="btn btn-dark text-white"><i class="fa fa-file-invoice-dollar"></i> التقارير المالية </a>    
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="card-body float-left opacity-50"> 
                                                <i class="fas fa-file-contract text-primary fa-5x"></i>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
    
                        </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
