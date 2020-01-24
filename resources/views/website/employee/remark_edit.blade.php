@extends('website.employee.template.employee_master')
@section('content') 

   <div class="col p-t col-md-10">
         <center style="padding-top: 20px;">
            <h3>Remark Edit
               @if (isset($job_id) && !empty($job_id))
                  FOR JOB ID : <b>{{$job_id}}</b>
               @endif
            </h3>
         </center>

         <div class="form-response"></div>
         <form action="{{route('employee.remark_update')}}" method="post">
            @csrf
            @if (isset($job_input_id) && !empty($job_input_id))                
               <input type="hidden" name="job_id" value="{{$job_input_id}}">
            @endif
            @if (isset($page) && !empty($page))
               <input type="hidden" value="{{$page}}" name="page">
            @else
               <input type="hidden" value="" name="page">
            @endif
            @if (isset($comments) && !empty($comments))
                <div class="form-group">
                    <label>Remarks *</label>
                <input type="hidden" name="rem_id" value="{{$comments->id}}">
                <textarea name="message" placeholder="Type Remarks" class="theme-input-style" required>{{$comments->remarks}}</textarea>
                </div>
                <button class="btn" type="submit">Save</button>
            @endif
             
         </form>
   </div>


@endsection