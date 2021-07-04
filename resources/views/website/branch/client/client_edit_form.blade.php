@extends('website.branch.template.branch_master')
<!-- Head & Header Section -->
@section('content') 
   <div class="col p-t col-md-10">
      <div class="col-md-12">
         @if (Session::has('message'))
            <div class="alert alert-success" >{{ Session::get('message') }}</div>
         @endif
         @if (Session::has('error'))
            <div class="alert alert-danger" >{{ Session::get('error') }}</div>
         @endif
         @if($errors->any())
            {!! implode('', $errors->all('<p style="color:red">:message</p>')) !!}
         @endif
      </div>
   
      <div class="contact-form contact-page-form animated fadeInUp form-margin" data-animate="fadeInUp" style="animation-duration: 0.6s; animation-delay: 0.1s;">
         <h1 data-animate="fadeInUp" data-delay=".1s" class="text-uppercase" style="text-align: center;">View Client <span>Details</span></h1>
         <div class="form-response"></div>
         {{ Form::open(['method' => 'post','route'=>'branch.client_update']) }}
            @if (isset($client))
            <input type="hidden" name="client_id" value="{{$client->id}}">
            <div id="form-1">
               <br><h4>Personal Details</h4><hr>
               <div class="row half-gutter">
                  <div class="col-md-6">
                     <div class="form-group">
                        <p><strong>Name: </strong>{{$client->name}}</p>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <p><strong>Father's Name: </strong>{{$client->father_name}}</p>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <p><strong>DOB: </strong>{{$client->dob}}</p>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <p><strong>PAN: </strong>{{$client->pan}}</p>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <p><strong>Constitution: </strong>{{$client->constitution}}</p>                        
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <p><strong>Gender: </strong>
                           @if ($client->gender == "M")
                               Male
                           @elseif ($client->gender == "F")
                              Femeale
                           @else
                               Other
                           @endif
                        </p>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <p><strong >Mobile : </strong>{{$client->mobile}}</p>  
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <p><strong >Email : </strong>{{$client->email}}</p>  
                     </div>
                  </div>
               </div>   

               
               <div class="row half-gutter">
                   @if (isset($residential) && !empty($residential))
                   <div class="col-md-6">
                     <br><h4>Residential Address</h4><hr>
                     <div class="form-group">
                        <p><strong>Flat No/H No : </strong>{{$residential->flat_no}}</p>
                     </div>
                     <div class="form-group">
                        <p><strong>Building/village : </strong>{{$residential->village}}</p>
                     </div>
                     <div class="form-group">
                        <p><strong>P.O : </strong>{{$residential->po}}</p>
                     </div>
                     <div class="form-group">
                        <p><strong>P.S : </strong>{{$residential->ps}}</p>
                     </div>
                     <div class="form-group">
                        <p><strong>Area : </strong>{{$residential->area}}</p>
                     </div>
                     <div class="form-group">
                        <p><strong>District : </strong>{{$residential->dist}}</p>
                     </div>
                     <div class="form-group">
                        <p><strong>State : </strong>{{$residential->state}}</p>
                     </div>
                     <div class="form-group">
                        <p><strong>Pin : </strong>{{$residential->pin}}</p>
                     </div>
                   </div>
                   @endif
                   @if (isset($business) && !empty($business))
                   <div class="col-md-6">
                     <br><h4>Business Address</h4><hr>
                     <div class="form-group">
                        <p><strong>Flat No/H No : </strong>{{$business->flat_no}}</p>
                     </div>
                     <div class="form-group">
                        <p><strong>Building/village : </strong>{{$business->village}}</p>
                     </div>
                     <div class="form-group">
                        <p><strong>P.O : </strong>{{$business->po}}</p>
                     </div>
                     <div class="form-group">
                        <p><strong>P.S : </strong>{{$business->ps}}</p>
                     </div>
                     <div class="form-group">
                        <p><strong>Area : </strong>{{$business->area}}</p>
                     </div>
                     <div class="form-group">
                        <p><strong>District : </strong>{{$business->dist}}</p>
                     </div>
                     <div class="form-group">
                        <p><strong>State : </strong>{{$business->state}}</p>
                     </div>
                     <div class="form-group">
                        <p><strong>Pin : </strong>{{$business->pin}}</p>
                     </div>
                   </div>
                  @endif
                  
                  <div class="col-md-8">
                     <div class="form-group">
                        <hr><p><strong>Trade name : </strong>{{$client->trade_name}}</p>
                     </div>
                  </div>
                  
                  <div class="col-md-12 text-right" id="button-div">
                    <button class="btn-danger" style="    padding: 5px 25px;border: 0;border-radius: 3px;" type="button" onclick="window.close()">Close</button>
                 </div>
               </div>
            </div>
            @endif

         {{ Form::close() }}
      </div>
   </div>    
@endsection

@section('script')
<script src="{{asset('web/js/employee_client_edit.js')}}"></script>
@endsection