@extends('layouts.app')

@section('content')

<div class="container text-right dir-rtl">
        {{--
        Start of the session status --}}

        @if (session('status'))
        <div class="alert alert-success" role="alert">
                <i class="fas fa-check-square fa-1x"></i> &nbsp; {{ session('status') }}    
        </div>
        @endif


        @if (Session::has('delete'))

        <div class="alert alert-danger">
                <i class="fas fa-check-square fa-1x"></i>  &nbsp;  {{Session::get('delete')}} 
        </div>  

        {{Session::forget('delete')}}
        @endif
        
        @if (Session::has('success'))

        <div class="alert alert-success">
                <i class="fas fa-check-square fa-1x"></i>  &nbsp;  {{Session::get('success')}} 
        </div>  

        {{Session::forget('success')}}
        @endif

        {{--
        end of the session status --}}
    <div class="row">               
        <div class="col-md-6 text-right">

             {{-- Start of card Div  --}}

             <div class="card dir-rtl pb-4">
                    <div class="card-header main-border ">
                      
                      <div class="row">
                                <div class="col-md-6 d-flex align-items-center">
                                  <h6 class="font-weight-bold text-dark d-flex align-items-center"> <i class="fas fa-list-alt fa-2x brand-color pb-1"></i>&nbsp; بيانات الولايات و المحليات المتاحة</h6>
                                </div>

                              <div class="col-md-6">
                                <a href="{{ route('state_create') }}" class="btn btn-success text-white float-left"><i class="fa fa-plus-square"></i> إضافة</a> 
                              </div>
                      </div>
                    </div>
                        <br>
                        <div class="container">

                                
                               
                                {{-- Start of State Table  --}}
                                <table class="table table-striped table-bordered text-right">
                                        <thead class="thead-dark dir-rtl">
                                                <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">الولاية</th>
                                                <th scope="col" class="text-center">العمليات</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                                @if ($states->count()>0)
                                                        @php
                                                                $x=0;
                                                        @endphp
                                                        @foreach ($states as $state)
                                                                @php
                                                                        $x++;
                                                                @endphp
                                                                <tr>
                                                                        <th scope="row">{{ $x }}</th>
                                                                        <td>{{ $state->name }}</td>
                                                                        <td class="text-center">
                                                                                <a href="{{  route('state_edit', ['id'=> $state->id]) }}"  onclick='return edit()' class="btn btn-success text-white mr-3 font-weight-bold"><i class="fa fa-edit"></i> تعديل </a> 
                                                                                <a href="{{ route('state_delete', ['id'=> $state->id]) }}" onclick='return del()' class="btn btn-danger text-white font-weight-bold"><i class="fa fa-ban"></i> إيقاف </a> 
                                                                                        
                                                                        </td>
                                                                </tr>
                                                        @endforeach
                                                @else
                                                        <td colspan="3" class="text-center font-weight-bold text-danger">- لاتوجد ولايات مضافة - </td>
                                                @endif
                                        </tbody>
                                </table>
                        </div>
                </div>

                {{-- End of Start of card Div  --}}



                <div class="card dir-rtl mt-4">
                        <div class="card-header main-border ">
                          
                          <div class="row">
                                    <div class="col-md-6">
                                      <h6 class="font-weight-bold text-dark d-flex align-items-center"> <i class="fas fa-ban text-danger fa-2x pb-1"></i>&nbsp; بيانات الولايات الموقفة</h6>
                                    </div>
                          </div>
                        </div>
                            <br>
                            <div class="container">

                                    {{-- Start of state Table  --}}
                                    <table class="table table-striped table-bordered text-right">
                                            <thead class="thead-dark dir-rtl">
                                                <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">الولاية</th>
                                                        <th scope="col" class="text-center">العمليات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    @php
                                                            $x=0;
                                                    @endphp

                                                @if ($state_off->count()>0)

                                                        @foreach ($state_off as $state)
                                                                @php
                                                                        $x++;
                                                                @endphp
                                                                <tr>
                                                                        <th scope="row">{{ $x }}</th>
                                                                        <td>{{ $state->name }}</td>
                                                                        <td class="text-center"> 
                                                                        <a href="{{  route('state_restart', ['id'=> $state->id]) }}"  onclick='return restart()' class="btn btn-primary text-white mr-3 font-weight-bold"><i class="fas fa-recycle"></i> تشغيل </a>       
                                                                        </td>
                                                                </tr>
                                                        @endforeach

                                                @else
                                                        <td colspan="3" class="text-center font-weight-bold text-danger">- لاتوجد ولايات موقوفة - </td>
                                                        
                                                @endif

                                                   
                                            </tbody>
                                    </table>
                                                    
    
                                  
                            </div>
                          
                        
    
    
                    </div>
    
                    {{-- End of Start of card Div  --}}
                    

        </div>

        <div class="col-md-6 text-right">

                {{-- Start of card Div  --}}
   
            
   
                   {{-- End of Start of card Div  --}}
   
   
   
                   <div class="card dir-rtl">
                           <div class="card-header main-border ">
                             
                             <div class="row">
                                       <div class="col-md-6">
                                         <h6 class="font-weight-bold text-dark d-flex align-items-center"> <i class="fas fa-ban text-danger fa-2x pb-1"></i>&nbsp; بيانات المحليات </h6>
                                       </div>
                             </div>
                           </div>
                               <br>
                               <div class="container">
   
                                       {{-- Start of state Table  --}}
                                       <table class="table table-striped table-bordered text-right">
                                               <thead class="thead-dark dir-rtl">
                                                   <tr>
                                                           <th scope="col">#</th>
                                                           <th scope="col">الولاية</th>
                                                           <th scope="col">المحلية</th>
                                                           <th scope="col" class="text-center">العمليات</th>
                                                   </tr>
                                               </thead>
                                               <tbody>
                                                       @php
                                                               $x=0;
                                                       @endphp
   
                                                   @if ($districts->count()>0)
   
                                                           @foreach ($districts as $district)
                                                                   @php
                                                                           $x++;
                                                                   @endphp
                                                                   <tr>
                                                                           <th scope="row">{{ $x }}</th>
                                                                           <td class="font-weight-bold">{{ $district->state->name ?? 'تم مسح او إيقاف الولاية '}}</td>
                                                                           <td>{{ $district->name }}</td>
                                                                           <td class="text-center"> 
                                                                            <a href="{{  route('district_edit', ['id'=> $district->id]) }}"  onclick='return edit()' class="btn btn-primary text-white mr-3 font-weight-bold"><i class="fas fa-edit"></i> تعديل </a>        
                                                                           </td>
                                                                   </tr>
                                                           @endforeach
   
                                                   @else
                                                           <td colspan="3" class="text-center font-weight-bold text-danger">- لاتوجد ولايات موقوفة - </td>
                                                           
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