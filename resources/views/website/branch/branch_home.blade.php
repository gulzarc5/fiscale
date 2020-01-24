@extends('website.branch.template.branch_master')
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
         <center class="form-steps">
            <div id="step-1" style="background-color: #23d823; color: #fff;"><span>step 1</span></div>
            <div id="step-2"><span>step 2</span></div>
            <div id="step-3"><span>step 3</span></div>
         </center>
      </div>
   
      <div class="contact-form contact-page-form animated fadeInUp" data-animate="fadeInUp" style="animation-duration: 0.6s; animation-delay: 0.1s;">
         <div class="form-response"></div>
         {{ Form::open(['method' => 'post','route'=>'branch.register_user']) }}
	  
            <div id="form-1">
               <h4>Enter Client Personal Details</h4>
               <div class="row half-gutter">
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Name *</label>
                        <input type="text" name="name" id="name" placeholder="Enter your name" class="theme-input-style" value="{{old('name')}}"> 
                        <span id="name_error"></span>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Father's Name</label>
                        <input type="text" name="father_name" placeholder="Enter your father's name" class="theme-input-style" value="{{old('father_name')}}"> 
                        <span id="email_error"></span>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>D.O.B *</label>
                        <input type="date" name="dob" placeholder="Enter your dob" class="theme-input-style" id="dob" value="{{old('father_name')}}"> 
                        <span id="dob_error"></span>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>PAN *</label>
                        <input type="text" name="pan" id="pan" placeholder="Enter your pan" class="theme-input-style" value="{{old('father_name')}}">
                        <span id="pan_error"></span>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Constitution *</label>
                        <select class="theme-input-style" id="constitution" name="constitution">
                           <option selected="" disabled="">--SELECT CONSTITUTION FROM THE LIST--</option>
                           <option value="Individual" {{ old('constitution') == "Individual" ? 'selected' : '' }}>Individual</option>
                           <option value="Firm" {{ old('constitution') == "Firm" ? 'selected' : '' }}>Firm</option>
                           <option value="Company" {{ old('constitution') == "Company" ? 'selected' : '' }}>Company</option>
                           <option value="Others" {{ old('constitution') == "Others" ? 'selected' : '' }}>Others</option>
                        </select>
                        <span id="constitution_error"></span>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Gender *</label>
                        <select class="theme-input-style" id="gender" name="gender">
                           <option selected="" disabled="">--SELECT YOUR GENDER--</option>
                           <option value="M" {{ old('constitution') == "M" ? 'selected' : '' }}>Male</option>
                           <option value="F" {{ old('constitution') == "F" ? 'selected' : '' }}>Female</option>
                        </select>
                        <span id="gender_error"></span>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Mobile *</label>
                        <input type="number" name="mobile" placeholder="Enter your mobile number" class="theme-input-style" id="mobile" value="{{old('mobile')}}"> 
                        <span id="mobile_error"></span>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Email </label>
                        <input type="text" name="email" id="email" placeholder="Enter your email" class="theme-input-style" value="{{old('email')}}">
                        <span id="email_error"></span> 
                     </div>
                  </div>
               </div>
               <div class="col-md-12 text-right">
                  <button id="next-1" class="btn rounded" type="button">NEXT &gt;</button>
               </div>
            </div>
            <div class="form-response"></div>
            <div id="form-2" style="display: none;">
               <h4>Enter Client Residential Address</h4>
               <div class="row half-gutter">
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Flat No/H No.</label>
                        <input type="text" name="flat_addr" id="flat_addr" placeholder="Enter your flat/house number." class="theme-input-style" value="{{old('flat_addr')}}"> 
                        <span id="flat_addr_error"></span>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Building/village *</label>
                        <input type="text" name="village_addr" id="village_addr" placeholder="Enter your building or village name" class="theme-input-style" value="{{old('village_addr')}}"> 
                        <span id="village_addr_error"></span>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>P.O *</label>
                        <input type="text" name="po_addr" id="po_addr" placeholder="Enter your post office" class="theme-input-style" value="{{old('po_addr')}}">
                        <span id="po_addr_error"></span>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>P.S *</label>
                        <input type="text" name="ps_addr" id="ps_addr" placeholder="Enter your police station" class="theme-input-style" value="{{old('ps_addr')}}">
                        <span id="ps_addr_error"></span>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Area </label>
                        <input type="text" name="area_addr" id="area_addr" placeholder="Enter your area" class="theme-input-style" value="{{old('area_addr')}}"> 
                        <span id="area_addr_error"></span>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>District *</label>
                        <input type="text" name="district_addr" id="district_addr" placeholder="Enter your district" class="theme-input-style" value="{{old('district_addr')}}"> 
                        <span id="district_addr_error"></span>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>State *</label>
                        <input type="text" name="state_addr" id="state_addr" placeholder="Enter your state" class="theme-input-style" value="{{old('state_addr')}}"> 
                        <span id="state_addr_error"></span>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Pin *</label>
                        <input type="text" name="pin_addr" id="pin_addr" placeholder="Enter your pin" class="theme-input-style" value="{{old('pin_addr')}}"> 
                        <span id="pin_addr_error"></span>
                     </div>
                  </div>
                 
                  <div class="col-md-12">
                     <h4>Enter Client Business Address</h4>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <b>Select if same as residential address:</b>
                        <input type="checkbox" name="same" id="same" onclick="sameCheck()">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Flat No/H No.</label>
                        <input type="text" name="flat" id="flat" placeholder="Enter your flat/house number." class="theme-input-style" value="{{old('flat')}}"> 
                        <span id="flat_error"></span>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Building/village *</label>
                        <input type="text" name="village" id="village" placeholder="Enter your building or village name" class="theme-input-style" value="{{old('village')}}"> 
                        <span id="village_error"></span>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>P.O</label>
                        <input type="text" name="po" id="po" placeholder="Enter your post office" class="theme-input-style" value="{{old('po')}}"> 
                        <span id="po_error"></span>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>P.S *</label>
                        <input type="text" name="ps" id="ps" placeholder="Enter your police station" class="theme-input-style" value="{{old('ps')}}">
                        <span id="ps_error"></span>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Area </label>
                        <input type="text" name="area" id="area" placeholder="Enter your area" class="theme-input-style" value="{{old('area')}}"> 
                        <span id="area_error"></span>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>District *</label>
                        <input type="text" name="district" id="district" placeholder="Enter your district" class="theme-input-style" value="{{old('district')}}"> 
                        <span id="district_error"></span>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>State *</label>
                        <input type="text" name="state" id="state" placeholder="Enter your state" class="theme-input-style" value="{{old('state')}}"> 
                        <span id="state_error"></span>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Pin *</label>
                        <input type="text" name="pin" id="pin" placeholder="Enter your pin" class="theme-input-style" value="{{old('pin')}}"> 
                        <span id="pin_error"></span>
                     </div>
                  </div>
                  <div class="col-md-8">
                     <div class="form-group">
                        <label>Trade Name (if any) </label>
                        <input type="text" name="trade_name" id="trade_name" placeholder="Enter your trade name" class="theme-input-style" value="{{old('trade_name')}}"> 
                     </div>
                  </div>
               </div>
               <div class="col-md-12 text-right">
                  <button type="button" id="form-2-previous" class="btn rounded">&lt; PREVIOUS</button>
                  <button id="next-2" class="btn rounded"  type="button">NEXT &gt;</button>
               </div>
            </div>
            <div class="form-response"></div>
            <div id="form-3" style="display: none;">
               <h4>Client Job Details</h4>
               <div id="job_desc_div">
                  <div class="row half-gutter">
                     <div id="first-job-des" class="col-md-10">
                        <div class="form-group" id="job_desc">
                           <label>Job Description *</label>
                           <select class="theme-input-style job-d text-uppercase" required name="job_type[]">
                              <option selected="" disabled="" value="">--SELECT JOB DESCRIPTION FROM LIST--</option>
                              @if (isset($job_type) && !empty($job_type))
                                 @foreach ($job_type as $item)
                                    <option value="{{$item->id}}" {{ old('job_type') == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                                 @endforeach
                              @endif
                           
                           </select>
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="form-group add-more">
                           <label>Add More</label>
                           <input id="add-more" style="background-color: #f4ba1f;" type="button" class=" btn rounded theme-input-style" value="+"> 
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-12 text-right">
                  <button id="form-3-previous" class="btn rounded" type="button">&lt; PREVIOUS</button>
                  <button class="btn rounded" type="submit">SUBMIT &gt;</button>
               </div>
            </div>
         {{ Form::close() }}
      </div>
   </div>    
@endsection

@section('script')
   <script src="{{asset('web/js/brance_wizered.js')}}"></script>
@endsection