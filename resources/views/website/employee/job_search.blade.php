@extends('website.employee.template.employee_master')
@section('content') 

   <div class="col p-t col-md-10">
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
   </div>

@endsection