@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 text-right mt-4 dir-rtl">

                {{-- Start of card Div  --}}

                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    <i class="fas fa-check-square fa-1x"></i> &nbsp;  {{ session('status') }}
                </div>
                @endif


                @if (Session::has('delete'))

                <div class="alert alert-danger">
                    <i class="fas fa-check-square fa-1x"></i> &nbsp;  {{Session::get('delete')}}
                </div>  

                {{Session::forget('delete')}}
                @endif
                
                @if (Session::has('success'))

                <div class="alert alert-success">
                    <i class="fas fa-check-square fa-1x"></i> &nbsp;  {{Session::get('success')}}
                </div>  

                {{Session::forget('success')}}
                @endif

                <div class="card">

                    <div class="card-header main-border">
                        <h5 class="font-weight-bold "> <i class="fa fa-file-alt fa-1x "></i> &nbsp; لوحه تقارير كابتن 
                                <span class="float-left">
                                        <a href="{{ route ('captain_create')}}" class="btn btn-primary text-white font-weight-bold"><i class="fa fa-plus-square"></i> إضافة كابتن</a>
                                </span>

                        </h5>
                        
                    </div>
                        <br>
                        <div class="container">  
                            <div class="row">
                                <div class="col-md-8">
                                    <form action='#'>
                                        <div class="form-group">
                                                <input type="text" name="search" id="search" class="form-control font-weight-bold" placeholder="تقرير عن جميع الكابتن في التطبيق" readonly/>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-md-2">
                                    <a href="{{ route ('captains_report_show', ['id'=>'1'])}}" class="btn btn-primary text-white w-100 font-weight-bold"> <i class="fa fa-print"></i> طباعة التقرير </a>
                                </div>

                                <div class="col-md-2">
                                    <a href="{{ route ('captains_report_show', ['id'=>'2'])}}" class="btn btn-dark text-white w-100 font-weight-bold"> <i class="fa fa-file-alt"></i> عرض  التقرير</a>
                                </div>
                                
                            </div>
                        </div>
                        </div>



                        <div class="card mt-4">

                            <div class="card-header main-border">
                                <h5 class="font-weight-bold "> <i class="fa fa-file-alt fa-1x "></i> &nbsp; تقرير الكابتن بالخدمة
                                    <span class="float-left">
                                                <a href="{{ route ('service_show')}}" class="btn btn-success text-white font-weight-bold"><i class="fa fa-eye"></i> عرض الخدمات </a>
                                    </span> 
                                </h5>
                                
                            </div>
                                <br>
                                <form action="{{route('captains_service_report')}}" method="POST" enctype="multipart/form-data">
                                    {{@csrf_field()}}
                            <div class="container">  
                                <div class="row mb-3">
                                        <div class="col-md-8">
                                            <select class="custom-select" required name="service_id">
                                                    @foreach ($services as $service)
                                                    
                                                        <option value="{{ $service->id }}" selected>{{ $service->name }}</option>
                                                        
                                                    @endforeach
                                            </select>
                                        </div>
                            
    
                                        <div class="col-md-2">
                                            <input type="submit" class="btn btn-primary w-100" name="print" value=" طباعة التقرير ">
                                        </div>
                                        
                                        <div class=" col-md-2">
                                            <input type="submit" class="btn btn-dark w-100" name="show" value="عرض التقرير">
                                        </div>
                                            
                                    </form>
                                    
                                </div>
                            </div>
                            </div>
                        </div>
                </div>

                {{-- End of Start of card Div  --}}


                    
                

  


 
   
@endsection
