@extends('website.branch.template.branch_master')
@section('content') 

   <div class="col p-t col-md-10">
      <div class="add-job-form contact-page-form animated fadeInUp" data-animate="fadeInUp" style="animation-duration: 0.6s; animation-delay: 0.1s;">
         <div class="form-response"></div>
         {{ Form::open(['method' => 'post','route'=>'branch.client_report']) }}
            <div id="">
               <h1 data-animate="fadeInUp" data-delay=".1s" class="text-uppercase" style="text-shadow: 1px -2px 1px white;">Generate<span> Report</span></h1>
               @if (Session::has('message'))
                  <div class="alert alert-success" >{{ Session::get('message') }}</div>
               @endif
               @if (Session::has('error'))
                  <div class="alert alert-danger">{{ Session::get('error') }}</div>
               @endif

               <div class="row half-gutter">
                  <div class="col-md-3">
                     <div class="form-group">
                        <label>Start Date</label>
                     <input type="date" name="start_date" value="{{old('start_date')}}" class="theme-input-style"> 
                        @if($errors->has('start_date'))
                              <span role="alert" style="color:red">
                                 <strong>{{ $errors->first('start_date') }}</strong>
                              </span>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label>End Date</label>
                        <input type="date" name="end_date" value="{{old('end_date')}}"  class="theme-input-style"> 
                        @if($errors->has('end_date'))
                              <span role="alert" style="color:red">
                                 <strong>{{ $errors->first('end_date') }}</strong>
                              </span>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label>Select Type</label>
                        <select name="type" class="theme-input-style">
                           <option value="">--Select Type--</option>
                           <option value="1">Processing</option>
                           <option value="2">Correction</option>
                           <option value="3">Closed</option>
                        </select> 
                        @if($errors->has('type'))
                              <span role="alert" style="color:red">
                                 <strong>{{ $errors->first('type') }}</strong>
                              </span>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-2">
                     <button  class="btn rounded" type="submit" style="margin-top: 28px;">Generate</button>
                  </div>
               </div>
               
            </div>
         {{ Form::close() }}
      </div>
   </div>

@endsection