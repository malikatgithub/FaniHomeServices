@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 text-right">

             {{-- Start of card Div  --}}

             <div class="card dir-rtl pb-4">
                    <div class="card-header main-border ">
                      <h6 class="font-weight-bold text-dark "> <i class="fas fa-user-plus brand-color"></i>&nbsp; إضافة خدمة جديدة</h6>
                    </div>
                        <br>
                        <div class="container">

                                
                                {{--
                                Start of the session status
                                ============================= --}}

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
                                end of the session status 
                                ============================= --}}

                                
                                {{-- Start of form  --}}
                                <form action="{{route('service_update',['id'=> $service->id])}}" method="POST" enctype="multipart/form-data">
                                {{@csrf_field()}}
                              
                                    <div class="card flex-row flex-wrap">
                                  
                                                            <div class="card-header w-100 text-dark">
                                                                   <span class="font-weight-bold fa-1x">
                                                                                <i class="fa fa-server brand-color"></i> &nbsp; معلومات الخدمة
                                                                   </span>
                                                            </div>
                        
                                                 
                                                            <div class="card-body border-0 flex-column w-100" >                  

                                    
                                    <div class="form-row">

                                            <div class="col-md-6 mb-3">
                                                    <label for="validationDefault01"><span class="required">*</span> إسم الخدمة</label>
                                                    <input type="text" class="form-control" id="validationDefault01" placeholder="" value="{{ $service->name }}" required name="name">
                                            </div>
            
            
                                            <div class="col-md-6 mb-3">
                                                    <label for="validationDefault01"><span class="required">*</span> السعر المبدئي</label>
                                                    <input type="number" class="form-control" id="validationDefault01" placeholder="" value="{{ $service->initial_price }}" required name="initial_price">
                                            </div>
                                            
                                            <div class="col-md-12 mb-3">
                                                <label for="exampleFormControlTextarea1"> <span class="required">*</span>  وصف الخدمة</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">{{ $service->description }}</textarea>
                                            </div>
            
                                                  
                                            
                                    </div>
            
            
                                    
                
            
                            
                            <br>

                           
                                    <br>
                                    
                                    <center>
                                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>  تعديل البيانات</button>
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