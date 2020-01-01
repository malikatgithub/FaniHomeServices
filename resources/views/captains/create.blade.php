@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 text-right">

             {{-- Start of card Div  --}}

             <div class="card dir-rtl">
                    <div class="card-header main-border">
                      <h6 class="font-weight-bold text-dark"> <i class="fas fa-user-plus brand-color"></i>&nbsp; إضافة طالب جديد</h6>
                    </div>
                        <br>
                        <div class="container">
                                
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                <ul>
                                        @foreach ($errors->all() as $error)
                                        <li class="text-left">{{ $error }}</li>
                                        @endforeach
                                </ul>
                                </div>
                                @endif

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
                                <form action="{{route('captain_store')}}" method="POST" enctype="multipart/form-data">
                                {{@csrf_field()}}
                              
                                    <div class="card flex-row flex-wrap">
                                  
                                                            <div class="card-header w-100 text-dark">
                                                                   <span class="font-weight-bold fa-1x">
                                                                            معلومات الكابتن
                                                                   </span>
                                                            </div>
                        
                                                 
                                                            <div class="card-body border-0 flex-column w-100" >                  

                                    
                                    <div class="form-row">

                                            <div class="col-md-3 mb-3">
                                                    <label for="validationDefault01">رقم الكابتن <span class="required">*</span> </label>
                                                    <input type="text" class="form-control border-success" id="validationDefault01" placeholder="auto-genterate" readonly value="" name="reg_no" >
                                            </div>


                                            <div class="col-md-3 mb-3">
                                                    <label for="validationDefault01">الإسم <span class="required">*</span> </label>
                                                    <input type="text" class="form-control" id="validationDefault01" placeholder="" value="" required name="name">
                                            </div>
            
            
                                            <div class="col-md-3 mb-3">
                                                    <label for="validationDefault01">تاريخ الميلاد <span class="required">*</span></label>
                                                    <input type="date" class="form-control" id="validationDefault01" placeholder="" value="" required name="bod">
                                            </div>
                                            
                                            <div class="col-md-3 mb-3">
                                                <label for="validationDefault01">الديانة <span class="required">*</span></label>
                                                <select class="custom-select" required name="relegion">
                                                        <option value=""></option>
                                                        <option value="مسلم">مسلم</option>
                                                        <option value="مسيحي">مسيحي</option>
                                                </select>
                                            </div>

                                    </div>
            
            
                                    <div class="form-row">

                                        <div class="col-md-3 mb-3">
                                                <label for="validationDefault01">الجنس <span class="required">*</span></label>
                                                <select class="custom-select" required name="gender">
                                                        <option value=""></option>
                                                        <option value="ذكر">ذكر</option>
                                                        <option value="أنثي">أنثي</option>
                                                </select>
                                        </div> 

                                       
            
            
                                        <div class="col-md-3 mb-3">
                                            <label for="validationDefault01">الجنسية <span class="required">*</span></label>
                                            <select class="custom-select" required name="nationality">
                                                    <option value=""></option>
                                                    <option value="سوداني">سوداني</option>
                                                    <option value="أجنبي">أجنبي</option>
                                            </select>
                                        </div>


                                        <div class="col-md-6 mb-3">
                                                <label for="validationDefault01">رقم إثبات الهوية <span class="required">*</span></label>
                                                <input type="number" class="form-control" id="validationDefault01" placeholder="" value="" required name="id_num">
                                                
                                        </div>


                                        <div class="col-md-6 mb-3">
                                                <label for="validationDefault01"> كلمة المرور <span class="required">*</span></label>
                                                <input type="password" class="form-control border-danger" id="validationDefault01" placeholder="" value="" required name="password">
                                                
                                        </div>


                                        <div class="col-md-6 mb-3">
                                                <label for="validationDefault01"> تأكيد كلمة المرور <span class="required">*</span></label>
                                                <input type="password" class="form-control border-danger" id="validationDefault01" placeholder="" value="" required name="password_conf">
                                                
                                        </div>


                                        <div class="col-md-3 mb-3">
                                                <label for="validationDefault01">الخدمة التي يقدمها <span class="required">*</span></label>
                                                <select class="custom-select" required name="service_id">
                                                        @if ($services->count()>0)
                                                        <option value=""></option>
                                                        @foreach ($services as $service)
                                                                <option value="{{ $service->id }}" class="font-weight-bold">{{ $service->name }}</option>
                                                        @endforeach
                                                        @else
                                                                <option disabled class="text-danger font-weight-bold"> لا توجد خدمات او تم مسح الخدمة الرجاء إضافة خدمات</option>
                                                        @endif
                                                </select>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                                <label for="validationDefault01">الولاية <span class="required">*</span></label>
                                                <select class="custom-select" required name="state_id">
                                                        @if ($states->count()>0)
                                                                <option value=""></option>
                                                                @foreach ($states as $state)
                                                                        <option value="{{ $state->id }}" class="font-weight-bold">{{ $state->name }}</option>
                                                                @endforeach
                                                        @else
                                                                <option disabled class="text-danger font-weight-bold"> لا توجد ولايات او تم مسح الولاية  الرجاء إضافة ولايات</option>
                                                        @endif
                                                                
                                                </select>
                                        </div>

                                        <div class="col-md-3 mb-3">
                                                <label for="validationDefault01">المحلية <span class="required">*</span></label>
                                                <select class="custom-select" required name="district_id">
                                                        @if ($states->count()>0)
                                                                <option value=""></option>
                                                                @foreach ($districts as $district)
                                                                        <option value="{{ $district->id }}" class="font-weight-bold">{{ $district->name }}</option>
                                                                @endforeach
                                                        @else
                                                                <option disabled class="text-danger font-weight-bold"> لا توجد ولايات او تم مسح الولاية  الرجاء إضافة ولايات</option>
                                                        @endif
                                                        
                                                </select>
                                        </div>
                                    
                                        <div class="col-md-3 mb-3">
                                            <label for="validationDefault01">الصورة</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="pic">
                                                <label class="custom-file-label text-center" for="inputGroupFile01">أضغط للتحميل</label>
                                            </div>
                                        </div>
            
                                                
                                            
                                    </div>
            
                                    <div class="form-row">
                                        <div class="col-md-12 mb-12">
                                                <div class="form-group">
                                                        <label for="exampleFormControlTextarea1">ملاحظات</label>
                                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="note"></textarea>
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
                                                        <input type="text" class="form-control" id="validationDefault01" placeholder="" value="" required name="phone">
                                                </div>
        
                                                <div class="col-md-4 mb-4">
                                                        <label for="validationDefault01"> رقم آخر <span class="required">*</span></label>
                                                        <input type="text" class="form-control" id="validationDefault01" placeholder="" value="" required name="phone2">
                                                </div>
            
                                        </div>
                
                                        <div class="form-row">
                                            <div class="col-md-12 mb-12">
                                                    <div class="form-group">
                                                            <label for="exampleFormControlTextarea1">عنوان السكن <span class="required">*</span> </label>
                                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" required name="address"></textarea>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                
                                
            
            
                                <br>

                                <div class="card flex-row flex-wrap">
                                  
                                            <div class="card-header w-100 text-muted main-border">
                                                   <span class="font-weight-bold fa-1x">
                                                            المؤهلات الأكاديمية
                                                   </span>
                                            </div>
        
                                    <div class="card-body border-0 flex-column w-100" > 
                                        <div class="form-row">

                                                <div class="col-md-4 mb-4">
                                                    <label for="validationDefault01">المؤهل الاكاديمي<span class="required">*</span> </label>
                                                    <input type="text" class="form-control" id="validationDefault01" placeholder="" value="" name="edu_level" >
                                                </div>

                                        </div>
                                    </div>
                            </div>
                
                
            
                            
                            <br>

                           
                                    <br>
                                    
                                    <center>
                                        <button type="submit" class="btn btn-success">حفظ البيانات</button>
                                    </center>
                                   
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