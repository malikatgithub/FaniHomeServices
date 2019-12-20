@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 text-right">

             {{-- Start of card Div  --}}

             <div class="card dir-rtl pb-4">
                    <div class="card-header main-border ">
                      <h6 class="font-weight-bold text-dark "> <i class="fas fa-plus-circle brand-color"></i>&nbsp; إضافة بيانات ولايات و محليات</h6>
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
                                <form action="{{route('state_store')}}" method="POST" enctype="multipart/form-data">
                                {{@csrf_field()}}
                              
                                    <div class="card flex-row flex-wrap">
                                  
                                                            <div class="card-header w-100 text-dark">
                                                                   <span class="font-weight-bold fa-1x">
                                                                                <i class="fa fa-server brand-color"></i> &nbsp; معلومات الولاية
                                                                   </span>
                                                            </div>
                        
                                                 
                                                            <div class="card-body border-0 flex-column w-100" >                  

                                    
                                    <div class="form-row">

                                            <div class="col-md-6 mb-3">
                                                    <label for="validationDefault01"><span class="required">*</span> إسم الولاية</label>
                                                    <input type="text" class="form-control" id="validationDefault01" placeholder="" value="" required name="state">
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <center>
                                                        <br>
                                                        <button type="submit" class="btn btn-primary mt-2"><i class="fa fa-plus-circle mt-1"></i> إضافة الولاية </button>
                                                </center>
                                            </div>

                                    </div>
                                </div>

                          
                                    
                                   
                                </form>
                                {{-- End of form   --}}
                        </div>


                                    
                                {{-- Start of form  --}}
                                <form action="{{route('district_store')}}" method="POST" enctype="multipart/form-data">
                                {{@csrf_field()}}
                              
                                    <div class="card flex-row flex-wrap mt-4">
                                  
                                                            <div class="card-header w-100 text-dark">
                                                                   <span class="font-weight-bold fa-1x">
                                                                                <i class="fa fa-server brand-color"></i> &nbsp; معلومات المحلية
                                                                   </span>
                                                            </div>
                        
                                                 
                                                            <div class="card-body border-0 flex-column w-100" >                  

                                    
                                    <div class="form-row">

                                            <div class="col-md-5 mb-3">
                                                    <label for="validationDefault01"><span class="required">*</span> إختر الولاية</label>
                                                    <select class="custom-select" required name="state_id">
                                                        
                                                        @if ($states->count()>0)
                                                                <option value=""></option>
                                                                @foreach ($states as $state)
                                                                        <option value="{{ $state->id }}" class="font-weight-bold">{{ $state->name }}</option>
                                                                @endforeach
                                                
                                                                

                                                        @else
                                                                <option disabled class="text-danger font-weight-bold"> لا توجد ولايات حاليا الرجاء إضافة ولايات</option>
                                                        @endif
                                                        
                                                        
                                                    </select>
                                            </div>


                                            <div class="col-md-5 mb-3">
                                                <label for="validationDefault01"><span class="required">*</span> إسم المحلية</label>
                                                <input type="text" class="form-control" id="validationDefault01" placeholder="" value="" required name="district_name">
                                            </div>


                                            <div class="col-md-2 mb-3">
                                                <center>
                                                        <br>
                                                        <button type="submit" class="btn btn-success mt-2"><i class="fa fa-plus-circle mt-1"></i>  حفظ البيانات</button>
                                                </center>
                                            </div>

                                    </div>

                          
                                    
                                   
                                </form>
                                {{-- End of form   --}}

                              
                        </div>
                      
                    
                      


                </div>

                {{-- End of Start of card Div  --}}

        </div>
    </div>
</div>
<br>
@endsection