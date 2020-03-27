@extends('website.employee.template.employee_master')
@section('content') 

   <div class="col p-t col-md-10">
      <div class="add-job-form contact-page-form animated fadeInUp" data-animate="fadeInUp" style="animation-duration: 0.6s; animation-delay: 0.1s;">
         <h1 data-animate="fadeInUp" data-delay=".1s" class="text-uppercase" style="text-shadow: 1px -2px 1px white;">Search <span>Job</span></h1>
         {{ Form::open(['method' => 'post','route'=>'employee.job_search_view']) }}
            <div class="">
               @if (Session::has('message'))
                  <div class="alert alert-success" >{{ Session::get('message') }}</div>
               @endif
               @if (Session::has('error'))
                  <div class="alert alert-danger">{{ Session::get('error') }}</div>
               @endif
               <div class="row half-gutter">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Enter Job ID </label>
                        <input type="text" name="job_id" class="theme-input-style home-search" placeholder="Enter your job id" required=""> 
                        @if($errors->has('client_serach_id'))
                              <span role="alert" style="color:red">
                                 <strong>{{ $errors->first('client_serach_id') }}</strong>
                              </span>
                        @enderror                     
                     </div>
                  </div>
               </div>
               <div class="col-md-12 text-right">
                  <button class="btn" style="border:0;" type="submit">Search</button> 
               </div>
            </div>
         {{ Form::close() }}
      </div>
   </div>


   {{-- <div class="col p-t col-md-10">
      <h1 data-animate="fadeInUp" data-delay=".3" class="text-uppercase" style="text-shadow: 1px -2px 1px white;">Enter <span>Job</span> ID </h1>
      @if (Session::has('message'))
         <div class="alert alert-success" >{{ Session::get('message') }}</div>
      @endif
      @if (Session::has('error'))
         <div class="alert alert-danger">{{ Session::get('error') }}</div>
      @endif
      <div class="primary-form">
         {{ Form::open(['method' => 'post','route'=>'employee.job_search_view']) }}
            <input type="text" name="job_id" class="theme-input-style home-search" placeholder="Enter your tracking id" required=""> 
            @if($errors->has('client_serach_id'))
                  <span role="alert" style="color:red">
                     <strong>{{ $errors->first('client_serach_id') }}</strong>
                  </span>
            @enderror
            <button class="btn" style="border:0;" type="submit">Search</button> 
         {{ Form::close() }}
      </div>
   </div> --}}

@endsection