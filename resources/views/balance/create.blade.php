@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 text-right">

             {{-- Start of card Div  --}}

             <div class="card dir-rtl pb-4">
                    <div class="card-header main-border ">
                      <h6 class="font-weight-bold text-dark "> <i class="fas fa-dollar-sign brand-color"></i>&nbsp; إضافة رصيد مالي </h6>
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


                                
                                {{-- Start of form  --}}
                              

                                <form action="{{route('balance_store')}}" method="POST" enctype="multipart/form-data">
                                {{@csrf_field()}}


                                <div class="form-row">

                                                <div class="col-md-3 mb-3">
                                                        <label for="validationDefault01"> رقم العميل</label>
                                                        <input type="text" class="form-control border-danger font-weight-bold" id="validationDefault01" placeholder="" value="{{ $captain->reg_no }}" required name="reg_no" readonly>
                                                        <input type="hidden" class="form-control" id="validationDefault01" placeholder="" value="{{ $captain->id }}" required name="captain_id" readonly>
                                                </div>
        
                                                <div class="col-md-3 mb-3">
                                                        <label for="validationDefault01"> إسم العميل</label>
                                                        <input type="text" class="form-control border-danger font-weight-bold" id="validationDefault01" placeholder="" value="{{ $captain->name }}" required name="name" readonly>
                                                </div>
                
                                                <div class="col-md-3 mb-3">
                                                        <label for="validationDefault01"> رقم الهاتف</label>
                                                        <input type="text" class="form-control border-danger font-weight-bold" id="validationDefault01" placeholder="" value="{{ $captain->phone }}" required name="phone" readonly>
                                                </div>
                                                
                
                                                <div class="col-md-3 mb-3">
                                                <label for="validationDefault01" class="text-danger"> الرصيد الحالي </label>
                                                <input type="number" class="form-control border-danger" id="validationDefault01" placeholder="" value="{{ $total_balance }}" required name="ava_balance" readonly>
                                                </div>
                                                
                                                <div class="col-md-3 mb-3">
                                                        <label for="validationDefault01"> الخدمات التي يقدمها </label>
                                                        <br>
                                                        <input type="hidden" class="form-control" id="validationDefault01" placeholder="" value="{{ $captain->service_id }}" required name="service_id" readonly> 

                                                        @if ($services->count()>0)
                                                        @php
                                                            $captain_services = unserialize($captain->service_id);
                                                            $x= 0;
                                                        @endphp
        
                                                            @foreach ($services as $service)
                                                                @php
                                                                    $x++; 
                                                                @endphp
                                                                @if(in_array($service->id, $captain_services))
                                                                    <span class="font-weight-bold">{{$x}} - {{ $service->name  }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                                                @endif
    
                                                            @endforeach
                                                  
                                                        @else
                                                           - لا توجد خدمات او تم مسح الخدمة الرجاء إضافة خدمات - 
                                                    @endif

                                                        
                                                </div>
                                                
                
                                              
                                              
                
                                                      
                                                
                                        </div>
                              
                                    <div class="card flex-row flex-wrap mt-3">
                                  
                                        <div class="card-header w-100 text-dark main-border">
                                                <span class="font-weight-bold fa-1x">
                                                        <i class="fa fa-plus"></i> &nbsp;  إضافة رصيد
                                                </span>
                                        </div>
                        
                                                 
                                    <div class="card-body border-0 flex-column w-100" >                  

                                    
                                    <div class="form-row">

                                            <div class="col-md-6 mb-3">
                                                    <label for="validationDefault01"><span class="required">*</span> المبلغ</label>
                                                    <input type="number" class="form-control" id="validationDefault01" placeholder="" value="" required name="balance">
                                            </div>
                                            
                                            <div class="col-md-12 mb-3">
                                                <label for="exampleFormControlTextarea1"> <span class="required">*</span>  ملاحظات</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="note">لاتوجد</textarea>
                                            </div>
            
                                                  
                                            
                                    </div>
            
            
                                    
                
            
                            
                            <br>

                           
                                    <br>
                                    
                                    <center>
                                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>  حفظ البيانات</button>
                                    </center>
                                   
                                </form>
                                {{-- End of form of card Div  --}}

                              
                        </div>
                      
                    


                </div>

                {{-- End of Start of card Div  --}}

        </div>
    </div>
</div>
<br>
@endsection