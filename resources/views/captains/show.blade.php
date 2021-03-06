@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 text-right">

             {{-- Start of card Div  --}}

             <div class="card dir-rtl">
                    <div class="card-header main-border">
                      <h6 class="font-weight-bold text-dark"> <i class="fas fa-user-plus brand-color"></i>&nbsp;  عرض بيانات كابتن</h6>
                    </div>
                        <br>
                        <div class="container">

                                {{-- Start of form  --}}
                                <form action="{{route('captain_update', ['id'=> $captain->id])}}" method="POST" enctype="multipart/form-data">
                                {{@csrf_field()}}
                              
                                    <div class="card flex-row flex-wrap">
                                  
                                                            <div class="card-header w-100 text-dark main-border">
                                                                   <span class="font-weight-bold fa-1x">
                                                                            معلومات الكابتن
                                                                   </span>
                                                            </div>
                        
                                                 
                                                            <div class="card-body border-0 flex-column w-100" >                  

                                    
                                    <div class="form-row d-flex align-items-center">

                                        <div class="col-md-3 mb-3">
                                                <center><img src="{{ asset('upload/captains/profiles/'.$captain->pic) }}" alt="" width="150px" height="150px;" class="img-thumbnail"></center>
                                                
                                        </div>
                        
                                     
                                        <div class="col-md-3 mb-3">
                                                <label for="validationDefault01">رقم الكابتن <span class="required">*</span> </label>
                                                <input type="text" class="form-control border-success" id="validationDefault01" placeholder="auto-genterate" readonly value="" name="{{ $captain->reg_no }}" value="{{ $captain->reg_no }}">
                                        </div>


                                        <div class="col-md-3 mb-3">
                                                <label for="validationDefault01">الإسم <span class="required">*</span> </label>
                                                <input type="text" class="form-control" id="validationDefault01" placeholder="" value="{{ $captain->name }}" required name="name" readonly>
                                        </div>
        
        
                                        <div class="col-md-3 mb-3">
                                                <label for="validationDefault01">تاريخ الميلاد <span class="required">*</span></label>
                                                <input type="date" class="form-control" id="validationDefault01" placeholder="" value="{{ $captain->bod }}" required name="bod" readonly>
                                        </div>
                                            
                                         
            
                                                  
                                            
                                    </div>
            
            
                                    <div class="form-row">

                                        <div class="col-md-3 mb-3">
                                                <label for="validationDefault01">الجنس <span class="required">*</span></label>
                                                <select class="custom-select" required name="gender" disabled>

                                                        @if ($captain->gender =='ذكر')
                                                        <option value="ذكر" selected>ذكر</option>
                                                        @else
                                                        <option value="أنثي" selected>أنثي</option>
                                                        @endif

                                                </select>
                                        </div> 

                                       
            
            
                                        <div class="col-md-3 mb-3">
                                                <label for="validationDefault01">الجنسية <span class="required">*</span></label>
                                                <select class="custom-select" required name="nationality" disabled>

                                                        @if ($captain->nationality == 'سوداني')
                                                        <option value="سوداني" selected>سوداني</option>
                                                        @else
                                                        <option value="أجنبي" selected>أجنبي</option>
                                                        @endif
                                                </select>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                                <label for="validationDefault01">رقم إثبات الهوية</label>
                                                <input type="text" class="form-control" id="validationDefault01" placeholder="" value=" {{ $captain->id_num }}" name="id_num" readonly>
                                        </div>


                                        <div class="col-md-3 mb-3">
                                                <label for="validationDefault01">الولاية <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="validationDefault01" placeholder="" value=" {{ $captain->state->name}}" name="state" readonly>
                                                
                                        </div>

                                        <div class="col-md-3 mb-3">
                                                <label for="validationDefault01">المحلية <span class="required">*</span></label>
                                                <input type="text" class="form-control" id="validationDefault01" placeholder="" value=" {{ $captain->district->name }}" name="district" readonly>
                                        </div>
                                        
                                        <div class="col-md-12 mb-3">
                                                <label for="validationDefault01">الخدمة التي يقدمها <span class="required">*</span></label>
                                                <hr class="border-secondary">
                                                <div class="row">
                                                        @if ($services->count()>0)

                                                        @php
                                                            $captain_services = unserialize($captain->service_id);
                                                        @endphp
                                                        
                                                        @foreach ($services as $service)
                                                               <div class="col-md-2">
                                                                        <div class="form-check">
                                                                                <input type="checkbox" class="form-check-input" id="Checkbox" name="service_id[]" disabled value="{{ $service->id }}" {{ in_array($service->id, $captain_services) ? "checked": ""}}>
                                                                                <label class="form-check-label mr-4 mt-1" for="Checkbox">{{ $service->name }}</label>
                                                                        </div>
                                                               </div>
                                                        @endforeach
                                                        @else
                                                                <div class="col-md-12">
                                                                        <span disabled class="text-center text-danger font-weight-bold">- لا توجد خدمات او تم مسح الخدمة الرجاء إضافة خدمات - </span>
                                                                </div>
                                                        @endif
                                                </div>
                                                <hr class="border-secondary">
                                        </div>

                                        
                                    

                                        <div class="col-md-12 mt-3">
                                                <center><label for="validationDefault01"> كلمة المرور للكابتن </label></center>
                                                <hr class="border-danger">
                                        </div>

                                        <div class="col-md-6  mb-3">
                                                <label for="validationDefault01"> كلمة المرور <span class="required">*</span></label>
                                                <input type="text" class="form-control border-success" id="validationDefault01" placeholder="إتركة فارغا ان كنت لاترغب في التغير" value="*********" name="password" readonly>
                                                <hr class="border-danger">
                                                
                                        </div>


                                        <div class="col-md-6 mb-3">
                                                <label for="validationDefault01"> تأكيد كلمة المرور <span class="required">*</span></label>
                                                <input type="text" class="form-control border-success" id="validationDefault01" placeholder="إتركة فارغا ان كنت لاترغب في التغير" value="*********" name="password_conf" readonly>
                                                <hr class="border-danger">
                                        </div>
                                        
            
                                                
                                            
                                    </div>
            
                                    <div class="form-row">
                                        <div class="col-md-12 mb-12">
                                                <div class="form-group">
                                                        <label for="exampleFormControlTextarea1">ملاحظات</label>
                                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="note" readonly>{{ $captain->note }}</textarea>
                                                </div>
                                        </div>
                                    </div>
                            </div>
                    </div>
            
            
                                <br>
            
                                <div class="card flex-row flex-wrap">
                                  
                                            <div class="card-header w-100 text-dark main-border">
                                                   <span class="font-weight-bold fa-1x">
                                                            معلومات التواصل
                                                   </span>
                                            </div>
        
                                 
                                            <div class="card-body border-0 flex-column w-100" > 
                                
                                        <div class="form-row">
                                                <div class="col-md-4 mb-4">
                                                        <label for="validationDefault01">رقم الهاتف<span class="required">*</span></label>
                                                        <input type="text" class="form-control" id="validationDefault01" placeholder="" value="{{ $captain->phone }}" required name="phone" readonly>
                                                </div>
        
                                                <div class="col-md-4 mb-4">
                                                        <label for="validationDefault01"> رقم آخر <span class="required">*</span></label>
                                                        <input type="text" class="form-control" id="validationDefault01" placeholder="" value="{{ $captain->phone2 }}" required name="phone2" readonly>
                                                </div>
            
                                        </div>
                
                                        <div class="form-row">
                                            <div class="col-md-12 mb-12">
                                                    <div class="form-group">
                                                            <label for="exampleFormControlTextarea1">عنوان السكن <span class="required">*</span> </label>
                                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" required name="address" readonly>{{ $captain->address }}</textarea>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                
                                
            
            
                                <br>

                                <div class="card flex-row flex-wrap">
                                  
                                            <div class="card-header w-100 text-dark main-border">
                                                   <span class="font-weight-bold fa-1x">
                                                            المؤهلات الأكاديمية
                                                   </span>
                                            </div>
        
                                    <div class="card-body border-0 flex-column w-100" > 
                                        <div class="form-row">

                                                <div class="col-md-4 mb-4">
                                                    <label for="validationDefault01">المؤهل الاكاديمي<span class="required">*</span> </label>
                                                    <input type="text" class="form-control" id="validationDefault01" placeholder="" value="{{ $captain->edu_level }}" name="edu_level"  readonly>
                                                </div>

                                        </div>
                                    </div>
                            </div>
                
                
            
                            
                            <br>

                           
                                    <br>
                                 
                                   
                                </form>
                                {{-- End of form of card Div  --}}

                                <br>
                                <br>
                        </div>
                       
                    


                </div>

                {{-- End of Start of card Div  --}}

        </div>
    </div>
</div>
<br>
@endsection