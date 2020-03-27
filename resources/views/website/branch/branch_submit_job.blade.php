@extends('website.branch.template.branch_master')
@section('content')
   <div class="col p-t col-md-10">
      <div class="section-title text-center animated fadeInUp" data-animate="fadeInUp" style="animation-duration: 0.6s; animation-delay: 0.1s;">
      <h1 data-animate="fadeInUp" data-delay=".3" class="text-uppercase" style="text-shadow: 1px -2px 1px white;">Add New <span>Job</span></h1>
         <h1></h1>
      </div>
      @if (isset($client) && !empty($client))
      <div class="row">
         <div class="col-md-3">
            <p><b>Name : </b>{{$client->name}}</p>
         </div>
         <div class="col-md-3">
            <p><b>Father's Name : </b>{{$client->father_name}}</p>
         </div>
         <div class="col-md-3">
            <p><b>D.O.B/D.O.I : </b>{{$client->dob}}</p>
         </div>
         <div class="col-md-3">
            <p><b>PAN : </b>{{$client->pan}}</p>
         </div>
         <div class="col-md-3">
            <p><b>Constitution : </b>{{$client->constitution}}</p>
         </div>
         <div class="col-md-3">
            <p><b>Gender : </b>
               @if ($client->gender == 'M')
                   Male
               @else
                   FeMale
               @endif
            </p>
         </div>
      </div>
      <div class="submit-job-form contact-page-form animated fadeInUp" data-animate="fadeInUp" style="animation-duration: 0.6s; animation-delay: 0.1s;">
         <div class="form-response"></div>
         @if (Session::has('message'))
            <div class="alert alert-success" >{{ Session::get('message') }}</div>
         @endif
         @if (Session::has('error'))
            <div class="alert alert-danger" >{{ Session::get('error') }}</div>
         @endif
         @if($errors->any())
            {!! implode('', $errors->all('<p style="color:red">:message</p>')) !!}
         @endif
            {{ Form::open(['method' => 'post','route'=>'branch.add_job']) }}
            <input type="hidden" name="client_id" value="{{$client->id}}">
            <div id="">
                  <div id="job_desc_div">
                        <div class="row half-gutter">
                           <div id="first-job-des" class="col-md-10">
                              <div class="form-group" id="job_desc">
                                 <label>Job Description *</label>
                                 <select class="job_desc theme-input-style job-d text-uppercase" required name="job_type[]">
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
                  <button id="" class="btn rounded" type="submit">SUBMIT</button>
               </div>
            </div>
         {{ Form::close() }}
      </div>
      @endif
   </div>
@endsection

@section('script')
   <script src="{{asset('web/js/brance_wizered.js')}}"></script>
   <script>
      $(document).ready(function() {
         $('.job_desc').select2();
      });
   </script>
@endsection