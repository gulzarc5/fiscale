@extends('website.branch.template.branch_master')
@section('content')

   <div class="col p-t col-md-10">
      <div class="add-job-form contact-page-form animated fadeInUp" data-animate="fadeInUp" style="animation-duration: 0.6s; animation-delay: 0.1s;">
         <div class="form-response"></div>
         {{ Form::open(['method' => 'post','route'=>'branch.add_job_client_search']) }}
            <div id="">
               <h4>Search Client</h4>
               @if (Session::has('message'))
                  <div class="alert alert-success" >{{ Session::get('message') }}</div>
               @endif
               @if (Session::has('error'))
                  <div class="alert alert-danger">{{ Session::get('error') }}</div>
               @endif

               <div class="row half-gutter">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Enter Client User PAN OR Mobile No.</label>
                        <input type="text" name="client_serach_id" placeholder="Enter Client PAN OR Mobile No" class="theme-input-style"> 
                        @if($errors->has('client_serach_id'))
                              <span role="alert" style="color:red">
                                 <strong>{{ $errors->first('client_serach_id') }}</strong>
                              </span>
                        @enderror
                     </div>
                  </div>
               </div>
               <div class="col-md-12 text-right">
                  <button id="" class="btn rounded" type="submit">Search</button>
               </div>
            </div>
         {{ Form::close() }}
      </div>
   </div>

@endsection