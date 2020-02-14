@extends('website.branch.template.branch_master')
@section('content') 

   <div class="col p-t col-md-10">
      <div class="add-job-form contact-page-form animated fadeInUp" data-animate="fadeInUp" style="animation-duration: 0.6s; animation-delay: 0.1s;">
         <div class="form-response"></div>
         {{ Form::open(['method' => 'post','route'=>'branch.payment_request_add','enctype'=>'multipart/form-data']) }}
            <div id="">
               <center><h3>Add Payment Request</h3></center>
               <div class="col-md-12" style="padding:5px;"></div>
               @if (Session::has('message'))
                  <div class="alert alert-success" >{{ Session::get('message') }}</div>
               @endif
               @if (Session::has('error'))
                  <div class="alert alert-danger">{{ Session::get('error') }}</div>
               @endif

               <div class="row half-gutter">
                  <div class="col-md-3">
                        <label>Select Trancaction Type <b style="color:red">*</b> :</label>
                  </div>
                  <div class="col-md-9">
                     <select name="transaction_type" class="theme-input-style"> 
                        <option value="" selected disabled>--Please Select Transaction Type--</option>
                        <option value="1" {{ old('transaction_type') == "1" ? 'selected' : '' }}> Bank Deposit </option>
                        <option value="2" {{ old('transaction_type') == "2" ? 'selected' : '' }}> Online Payment </option>
                     </select>
                     @if($errors->has('transaction_type'))
                           <span role="alert" style="color:red">
                              <strong>{{ $errors->first('transaction_type') }}</strong>
                           </span>
                     @enderror
                  </div>

                  <div class="col-md-12" style="padding:5px;"></div>

                  <div class="col-md-3">
                     <label>Enter Bank/UPI Name <b style="color:red">*</b> :</label>
                  </div>
                  <div class="col-md-9">
                     <input type="text" name="bank_name" placeholder="Enter Client PAN OR Mobile No" class="theme-input-style" value="{{old('bank_name')}}"> 
                     @if($errors->has('bank_name'))
                        <span role="alert" style="color:red">
                           <strong>{{ $errors->first('bank_name') }}</strong>
                        </span>
                     @enderror
                  </div>

                  <div class="col-md-12" style="padding:5px;"></div>

                  <div class="col-md-3">
                     <label>Select Transaction Date <b style="color:red">*</b> :</label>
                  </div>
                  <div class="col-md-9">
                     <input type="date" name="tr_date" placeholder="Enter Client PAN OR Mobile No" class="theme-input-style" value="{{old('tr_date')}}"> 
                     @if($errors->has('tr_date'))
                        <span role="alert" style="color:red">
                           <strong>{{ $errors->first('tr_date') }}</strong>
                        </span>
                     @enderror
                  </div>

                  <div class="col-md-12" style="padding:5px;"></div>

                  <div class="col-md-3">
                     <label>Enter Transaction Amount <b style="color:red">*</b> :</label>
                  </div>
                  <div class="col-md-9">
                     <input type="number" name="amount" placeholder="Enter Client PAN OR Mobile No" class="theme-input-style" value="{{old('amount')}}"> 
                     @if($errors->has('amount'))
                        <span role="alert" style="color:red">
                           <strong>{{ $errors->first('amount') }}</strong>
                        </span>
                     @enderror
                  </div>

                  <div class="col-md-12" style="padding:5px;"></div>

                  <div class="col-md-3">
                     <label>Upload Transaction Receipt :</label>
                  </div>
                  <div class="col-md-9">
                     <input type="file" name="image" placeholder="Enter Client PAN OR Mobile No" class="theme-input-style" style="padding-top:6px;"> 
                     @if($errors->has('image'))
                        <span role="alert" style="color:red">
                           <strong>{{ $errors->first('image') }}</strong>
                        </span>
                     @enderror
                  </div>

                  <div class="col-md-12" style="padding:5px;"></div>
               </div>
               <div class="col-md-12 text-right">
                  <button id="" class="btn rounded" type="submit">Search</button>
               </div>
            </div>
         {{ Form::close() }}
      </div>
   </div>

@endsection