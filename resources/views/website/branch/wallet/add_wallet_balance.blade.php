@extends('website.branch.template.branch_master')
@section('content') 

   <div class="col p-t col-md-6 offset-md-2" style="padding-top: 100px;">
      <div class="add-job-form contact-page-form animated fadeInUp" data-animate="fadeInUp" style="animation-duration: 0.6s; animation-delay: 0.1s;">
         <div class="form-response"></div>
         {{ Form::open(['method' => 'post','route'=>'branch.wallet_balance_add_submit']) }}
            <div id="">
               <h1 data-animate="fadeInUp" data-delay=".1s" class="text-uppercase text-center" >Add Wallet <span>Balance</span></h1>
               <div class="col-md-12" style="padding:5px;"></div>
               @if (Session::has('message'))
                  <div class="alert alert-success" >{{ Session::get('message') }}</div>
               @endif
               @if (Session::has('error'))
                  <div class="alert alert-danger">{{ Session::get('error') }}</div>
               @endif

               <div class="row half-gutter">
               
                  <div class="col-md-3">
                     <label>Enter Amount <b style="color:red">*</b> :</label>
                  </div>
                  <div class="col-md-9">
                     <input type="number" name="amount" placeholder="Enter Amount In Rs." class="theme-input-style" value="{{old('amount')}}"> 
                     @if($errors->has('amount'))
                        <span role="alert" style="color:red">
                           <strong>{{ $errors->first('amount') }}</strong>
                        </span>
                     @enderror
                  </div>
                  <div class="col-md-12" style="padding:5px;"></div>
               </div>
               <div class="col-md-12 text-right">
                  <button id="" class="btn rounded" type="submit">Proceed And Pay</button>
               </div>
            </div>
         {{ Form::close() }}
      </div>
   </div>

@endsection