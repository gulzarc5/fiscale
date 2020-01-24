@extends('website.employee.template.employee_master')
@section('content') 
   <div class="col p-t col-md-10">
      <div class="section-title text-center animated fadeInUp" data-animate="fadeInUp" style="animation-duration: 0.6s; animation-delay: 0.1s;">
         <h1>Job Edit For Job Id <b style="color:red"> - </b>
            @if (isset($job))
                {{$job->job_id}}
            @endif
         </h1>
      </div>
      @if (isset($job) && !empty($job))
      <div class="row">
         <div class="col-md-3">
            <p><b>Client Name : </b>{{$job->cl_name}}</p>
         </div>
         <div class="col-md-3">
            <p><b>PAN : </b>{{$job->cl_pan}}</p>
         </div>
         <div class="col-md-3">
            <p><b>Mobile No : </b>{{$job->cl_mobile}}</p>
         </div>
         <div class="col-md-3">
            <p><b>Job Desc : </b>{{$job->cl_pan}}</p>
         </div>
         <div class="col-md-3">
            <p><b>Date : </b>{{$job->cl_pan}}</p>
         </div>
      </div>
      <div class="submit-job-form contact-page-form animated fadeInUp" data-animate="fadeInUp" style="animation-duration: 0.6s; animation-delay: 0.1s;">
         <div class="form-response"></div>
            {{ Form::open(['method' => 'post','route'=>'employee.job_update']) }}
            <input type="hidden" name="job_id" value="{{$job->id}}">
            <div id="">
                  <div id="job_desc_div">
                        <div class="row half-gutter">
                           <div id="first-job-des" class="col-md-10">
                              <div class="form-group" id="job_desc">
                                 <label>Job Description *</label>
                                 <select class="theme-input-style job-d text-uppercase" required name="job_type">
                                    <option selected="" disabled="" value="">--SELECT JOB DESCRIPTION FROM LIST--</option>
                                    @if (isset($job_type) && !empty($job_type))
                                       @foreach ($job_type as $item)
                                          @if ($job->job_type == $item->id)
                                             <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                          @else
                                             <option value="{{$item->id}}">{{$item->name}}</option>
                                          @endif
                                          
                                       @endforeach
                                    @endif
                                 
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <button id="" class="btn rounded" type="submit" style="margin-top: 28px;">SUBMIT</button>
                           </div>
                        </div>
                     </div>
            </div>
         {{ Form::close() }}
      </div>
      @endif
   </div>
@endsection

@section('script')
   <script src="{{asset('web/js/brance_wizered.js')}}"></script>
@endsection