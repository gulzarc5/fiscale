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
         <div class="form-response"></div>
         {{ Form::open(['method' => 'post','route'=>'branch.client_update']) }}
            @if (isset($client))
            <input type="hidden" name="client_id" value="{{$client->id}}">
            <div id="form-1">
               <h4>Personal Details</h4>
               <div class="row half-gutter">
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Name *</label>
                        <input type="text" name="name" id="name" placeholder="Enter your name" class="theme-input-style jk" value="{{$client->name}}" disabled> 
                        @if($errors->has('name'))
                           <span class="invalid-feedback" role="alert" style="color:red">
                              <strong>{{ $errors->first('name') }}</strong>
                           </span>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Father's Name</label>
                        <input type="text" name="father_name" id="father_name" placeholder="Enter your father's name" class="theme-input-style" value="{{$client->father_name}}" disabled> 
                        @if($errors->has('father_name'))
                           <span class="invalid-feedback" role="alert" style="color:red">
                              <strong>{{ $errors->first('father_name') }}</strong>
                           </span>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>D.O.B *</label>
                        <input type="date" name="dob" placeholder="Enter your dob" class="theme-input-style" id="dob" value="{{$client->dob}}" disabled > 
                        @if($errors->has('dob'))
                           <span class="invalid-feedback" role="alert" style="color:red">
                              <strong>{{ $errors->first('dob') }}</strong>
                           </span>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>PAN *</label>
                        <input type="text" name="pan" id="pan" placeholder="Enter your pan" class="theme-input-style" value="{{$client->pan}}" disabled>
                        @if($errors->has('pan'))
                           <span class="invalid-feedback" role="alert" style="color:red">
                              <strong>{{ $errors->first('pan') }}</strong>
                           </span>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Constitution *</label>
                        <select class="theme-input-style" id="constitution" name="constitution" disabled
                           <option selected="" disabled="">--SELECT CONSTITUTION FROM THE LIST--</option>
                           <option value="Individual" {{ $client->constitution == "Individual" ? 'selected' : '' }}>Individual</option>
                           <option value="Firm" {{ $client->constitution == "Firm" ? 'selected' : '' }}>Firm</option>
                           <option value="Company" {{ $client->constitution == "Company" ? 'selected' : '' }}>Company</option>
                           <option value="Others" {{ $client->constitution == "Others" ? 'selected' : '' }}>Others</option>
                        </select>
                        @if($errors->has('constitution'))
                           <span class="invalid-feedback" role="alert" style="color:red">
                              <strong>{{ $errors->first('constitution') }}</strong>
                           </span>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Gender *</label>
                        <select class="theme-input-style" id="gender" name="gender" disabled>
                           <option selected="" disabled="">--SELECT YOUR GENDER--</option>
                           <option value="M" {{ $client->gender == "M" ? 'selected' : '' }}>Male</option>
                           <option value="F" {{ $client->gender == "F" ? 'selected' : '' }}>Female</option>
                        </select>
                        @if($errors->has('gender'))
                           <span class="invalid-feedback" role="alert" style="color:red">
                              <strong>{{ $errors->first('gender') }}</strong>
                           </span>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Mobile *</label>
                        <input type="number" name="mobile" placeholder="Enter your mobile number" class="theme-input-style" id="mobile" value="{{$client->mobile}}" disabled> 
                        @if($errors->has('mobile'))
                           <span class="invalid-feedback" role="alert" style="color:red">
                              <strong>{{ $errors->first('mobile') }}</strong>
                           </span>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Email </label>
                        <input type="text" name="email" id="email" placeholder="Enter your email" class="theme-input-style" value="{{$client->email}}" disabled>
                        @if($errors->has('email'))
                           <span class="invalid-feedback" role="alert" style="color:red">
                              <strong>{{ $errors->first('email') }}</strong>
                           </span>
                        @enderror
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-response"></div>
            <div id="form-2">
               <h4>Residential Address</h4>
               <div class="row half-gutter">
                   @if (isset($residential) && !empty($residential))
                  <input type="hidden" name="res_addr_id" value="{{$residential->id}}">
                    <div class="col-md-4">
                        <div class="form-group">
                           <label>Flat No/H No.</label>
                           <input type="text" name="flat_addr" id="flat_addr" placeholder="Enter your flat/house number." class="theme-input-style" value="{{$residential->flat_no}}" disabled> 
                           @if($errors->has('flat_addr'))
                              <span class="invalid-feedback" role="alert" style="color:red">
                                 <strong>{{ $errors->first('flat_addr') }}</strong>
                              </span>
                           @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                           <label>Building/village *</label>
                           <input type="text" name="village_addr" id="village_addr" placeholder="Enter your building or village name" class="theme-input-style" value="{{$residential->village}}" disabled> 
                           @if($errors->has('village_addr'))
                              <span class="invalid-feedback" role="alert" style="color:red">
                                 <strong>{{ $errors->first('village_addr') }}</strong>
                              </span>
                           @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>P.O *</label>
                            <input type="text" name="po_addr" id="po_addr" placeholder="Enter your post office" class="theme-input-style" value="{{$residential->po}}" disabled>
                           @if($errors->has('po_addr'))
                              <span class="invalid-feedback" role="alert" style="color:red">
                                 <strong>{{ $errors->first('po_addr') }}</strong>
                              </span>
                           @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                           <label>P.S *</label>
                           <input type="text" name="ps_addr" id="ps_addr" placeholder="Enter your police station" class="theme-input-style" value="{{$residential->ps}}" disabled>
                           @if($errors->has('ps_addr'))
                              <span class="invalid-feedback" role="alert" style="color:red">
                                 <strong>{{ $errors->first('ps_addr') }}</strong>
                              </span>
                           @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Area </label>
                            <input type="text" name="area_addr" id="area_addr" placeholder="Enter your area" class="theme-input-style" value="{{$residential->area}}" disabled> 
                           @if($errors->has('area_addr'))
                              <span class="invalid-feedback" role="alert" style="color:red">
                                 <strong>{{ $errors->first('area_addr') }}</strong>
                              </span>
                           @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                           <label>District *</label>
                           <input type="text" name="district_addr" id="district_addr" placeholder="Enter your district" class="theme-input-style" value="{{$residential->dist}}" disabled> 
                           @if($errors->has('district_addr'))
                              <span class="invalid-feedback" role="alert" style="color:red">
                                 <strong>{{ $errors->first('district_addr') }}</strong>
                              </span>
                           @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                           <label>State *</label>
                           <input type="text" name="state_addr" id="state_addr" placeholder="Enter your state" class="theme-input-style" value="{{$residential->state}}" disabled> 
                           @if($errors->has('state_addr'))
                              <span class="invalid-feedback" role="alert" style="color:red">
                                 <strong>{{ $errors->first('state_addr') }}</strong>
                              </span>
                           @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                           <label>Pin *</label>
                           <input type="text" name="pin_addr" id="pin_addr" placeholder="Enter your pin" class="theme-input-style" value="{{$residential->pin}}" disabled> 
                           @if($errors->has('pin_addr'))
                              <span class="invalid-feedback" role="alert" style="color:red">
                                 <strong>{{ $errors->first('pin_addr') }}</strong>
                              </span>
                           @enderror
                        </div>
                    </div>
                  @endif
                  @if (isset($business) && !empty($business))
                  <input type="hidden" name="business_addr_id" value="{{$business->id}}">
                  <div class="col-md-12">
                     <h4>Business Address</h4>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Flat No/H No.</label>
                        <input type="text" name="flat" id="flat" placeholder="Enter your flat/house number." class="theme-input-style" value="{{$business->flat_no}}" disabled> 
                        @if($errors->has('flat'))
                           <span class="invalid-feedback" role="alert" style="color:red">
                              <strong>{{ $errors->first('flat') }}</strong>
                           </span>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Building/village *</label>
                        <input type="text" name="village" id="village" placeholder="Enter your building or village name" class="theme-input-style" value="{{$business->village}}" disabled> 
                        @if($errors->has('village'))
                           <span class="invalid-feedback" role="alert" style="color:red">
                              <strong>{{ $errors->first('village') }}</strong>
                           </span>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>P.O</label>
                        <input type="text" name="po" id="po" placeholder="Enter your post office" class="theme-input-style" value="{{$business->po}}" disabled> 
                        @if($errors->has('po'))
                           <span class="invalid-feedback" role="alert" style="color:red">
                              <strong>{{ $errors->first('po') }}</strong>
                           </span>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>P.S *</label>
                        <input type="text" name="ps" id="ps" placeholder="Enter your police station" class="theme-input-style" value="{{$business->ps}}" disabled>
                        @if($errors->has('ps'))
                           <span class="invalid-feedback" role="alert" style="color:red">
                              <strong>{{ $errors->first('ps') }}</strong>
                           </span>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Area </label>
                        <input type="text" name="area" id="area" placeholder="Enter your area" class="theme-input-style" value="{{$business->area}}" disabled> 
                        @if($errors->has('area'))
                           <span class="invalid-feedback" role="alert" style="color:red">
                              <strong>{{ $errors->first('area') }}</strong>
                           </span>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>District *</label>
                        <input type="text" name="district" id="district" placeholder="Enter your district" class="theme-input-style" value="{{$business->dist}}" disabled> 
                        @if($errors->has('district'))
                           <span class="invalid-feedback" role="alert" style="color:red">
                              <strong>{{ $errors->first('district') }}</strong>
                           </span>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>State *</label>
                        <input type="text" name="state" id="state" placeholder="Enter your state" class="theme-input-style" value="{{$business->state}}" disabled> 
                        @if($errors->has('state'))
                           <span class="invalid-feedback" role="alert" style="color:red">
                              <strong>{{ $errors->first('state') }}</strong>
                           </span>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Pin *</label>
                        <input type="text" name="pin" id="pin" placeholder="Enter your pin" class="theme-input-style" value="{{$business->pin}}" disabled> 
                        @if($errors->has('pin'))
                           <span class="invalid-feedback" role="alert" style="color:red">
                              <strong>{{ $errors->first('pin') }}</strong>
                           </span>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-8">
                     <div class="form-group">
                        <label>Trade Name (if any) </label>
                        <input type="text" name="trade_name" id="trade_name" placeholder="Enter your trade name" class="theme-input-style" value="{{$client->trade_name}}" disabled> 
                     </div>
                  </div>
                  @endif
                  <div class="col-md-12 text-right" id="button-div">
                    <button class="btn rounded" type="button" onclick="enableButton()">Edit</button>
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