@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 text-right">

             {{-- Start of card Div  --}}

             <div class="card dir-rtl pb-4">
                    <div class="card-header main-border ">
                      
                      <div class="row">
                                <div class="col-md-6 d-flex align-items-center">
                                  <h6 class="font-weight-bold text-dark d-flex align-items-center"> <i class="fas fa-list-alt fa-2x brand-color pb-1"></i>&nbsp; بيانات الخدمات المتاحة</h6>
                                </div>

                              <div class="col-md-6">
                                <a href="{{ route('service_create') }}" class="btn btn-success text-white float-left"><i class="fa fa-plus-square"></i> إضافة</a> 
                              </div>
                      </div>
                    </div>
                        <br>
                        <div class="container">

                                
                                {{--
                                Start of the session status --}}

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

                                {{--
                                end of the session status --}}

                                
                                {{-- Start of Service Table  --}}
                                <table class="table table-striped table-bordered text-right">
                                        <thead class="thead-dark dir-rtl">
                                                <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">إسم الخدمة</th>
                                                <th scope="col">السعر المبدئي</th>
                                                <th scope="col">وصف الخدمة</th>
                                                <th scope="col" class="text-center">العمليات</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                                @php
                                                        $x=0;
                                                @endphp
                                                @foreach ($services as $service)
                                                        @php
                                                                $x++;
                                                        @endphp
                                                        <tr>
                                                                <th scope="row">{{ $x }}</th>
                                                                <td>{{ $service->name }}</td>
                                                                <td>{{ $service->initial_price }}</td>
                                                                <td>{{ $service->description }}</td>
                                                                <td class="text-center">
                                                                        <a href="{{  route('service_edit', ['id'=> $service->id]) }}"  onclick='return edit()' class="btn btn-success text-white mr-3 font-weight-bold"><i class="fa fa-edit"></i> تعديل </a> 
                                                                        <a href="{{ route('service_delete', ['id'=> $service->id]) }}" onclick='return del()' class="btn btn-danger text-white font-weight-bold"><i class="fa fa-ban"></i> إيقاف </a> 
                                                                                
                                                                </td>
                                                        </tr>
                                                @endforeach
                                        </tbody>
                                </table>
                                                

                              
                        </div>
                      
                    


                </div>

                {{-- End of Start of card Div  --}}



                <div class="card dir-rtl mt-4">
                        <div class="card-header main-border ">
                          
                          <div class="row">
                                    <div class="col-md-6">
                                      <h6 class="font-weight-bold text-dark d-flex align-items-center"> <i class="fas fa-ban text-danger fa-2x pb-1"></i>&nbsp; بيانات الخدمات الموقفة</h6>
                                    </div>
                          </div>
                        </div>
                            <br>
                            <div class="container">

                                    {{-- Start of Service Table  --}}
                                    <table class="table table-striped table-bordered text-right">
                                            <thead class="thead-dark dir-rtl">
                                                    <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">إسم الخدمة</th>
                                                    <th scope="col">السعر المبدئي</th>
                                                    <th scope="col">وصف الخدمة</th>
                                                    <th scope="col" class="text-center">العمليات</th>
                                                    </tr>
                                            </thead>
                                            <tbody>
                                                    @php
                                                            $x=0;
                                                    @endphp

                                                @if (! empty($services))

                                                <td colspan="5" class="text-center font-weight-bold text-danger">- لاتوجد خدمات موقوفة - </td>

                                                @else
                                                        @foreach ($services_off as $service)
                                                                @php
                                                                        $x++;
                                                                @endphp
                                                                <tr>
                                                                        <th scope="row">{{ $x }}</th>
                                                                        <td>{{ $service->name }}</td>
                                                                        <td>{{ $service->initial_price }}</td>
                                                                        <td>{{ $service->description }}</td>
                                                                        <td class="text-center"> 
                                                                        <a href="{{  route('service_restart', ['id'=> $service->id]) }}"  onclick='return restart()' class="btn btn-primary text-white mr-3 font-weight-bold"><i class="fas fa-recycle"></i> تشغيل </a>       
                                                                        </td>
                                                                </tr>
                                                        @endforeach
                                                @endif

                                                   
                                            </tbody>
                                    </table>
                                                    
    
                                  
                            </div>
                          
                        
    
    
                    </div>
    
                    {{-- End of Start of card Div  --}}
                    

        </div>
    </div>
</div>
<br>
@endsection