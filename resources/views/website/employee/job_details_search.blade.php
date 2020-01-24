@extends('website.employee.template.employee_master')
@section('content') 

   <div class="col p-t col-md-10">
         <center >
            <h3>JOB DETAILS</h3>
         </center>
         @if (isset($job) && !empty($job))
            <div class="row">
               <div class="col-md-5">
                  <p><b>Job Desc : </b>{{$job->job_type_name}}</p>
               </div>
               <div class="col-md-5">
                  <p><b>Date : </b>{{$job->created_at}}</p>
               </div>
               <div class="col-md-2">
                  <p><a href="{{route('employee.job_edit_form',['job_id'=>encrypt($job->id)])}}" class="btn btn-sm btn-warning">Edit</a></p></p>
               </div>
            </div>
         @endif
      <div class="cart-product animated fadeInUp" data-animate="fadeInUp" data-delay=".2" style="animation-duration: 0.6s; animation-delay: 0.2s;">
         <div class="table-responsive">
            <table class="sope--cart-table table pt-sans">
               <tbody>
                  <tr>
                     <td> Sl. </td>
                     <td> Date </td>
                     <td> Commented By </td>
                     <td> Remarks </td>
                     <td> Action </td>
                  </tr>
                  @if (isset($comments) && !empty($comments) && (count($comments) > 0))
                  @php
                      $remark_count = 1;
                  @endphp
                     @foreach ($comments as $item)
                        <tr>
                           <td>{{ $remark_count++ }}</td>
                           <td>{{$item->created_at}}</td>
                           <td>
                              @if ($item->remarks_by == '1')
                                  Admin
                              @elseif ($item->remarks_by == '2')
                                  Employee
                              @else
                                 Branch
                              @endif
                           </td>
                           <td>{{$item->remarks}}</td>
                           <td>
                               @if ($item->remarks_by == '2')
                           <a  class="status btn-sm btn-warning" href="{{route('employee.remark_edit',['remark_id'=>encrypt($item->id),'job_id'=>encrypt($job_id),'page'=>'job_srch'])}}">Edit</a>
                                @endif
                            </td>
                        </tr>
                     @endforeach
                  @else
                     <tr>
                        <td colspan="3" align="celter">No Remarks Found</td>
                     </tr>
                  @endif
               </tbody>
            </table>
         </div>
      </div>

         <div class="form-response"></div>
         <form action="{{route('employee.add_new_remark')}}" method="post">
            @csrf
            @if (isset($job_input_id) && !empty($job_input_id))                
               <input type="hidden" name="job_id" value="{{$job_input_id}}">
               <input type="hidden" name="page" value="job_srch">
            @endif
             <div class="form-group">
                 <label>Add New Remarks *</label>
                 <textarea name="message" placeholder="Type Remarks" class="theme-input-style" required></textarea>
             </div>
            @if (isset($job) && !empty($job))
               <div class="form-group" id="job_desc">
                  <label>Status *</label>
                  <select class="theme-input-style job-d text-uppercase" required name="status" id="status_c" onchange="checkStatus()">
                     <option selected="" disabled="" value="">--SELECT JOB STATUS--</option>
                     <option value="1" {{ $job->status == "1" ? 'selected' : '' }}>Processing</option>
                     <option value="2" {{ $job->status == "2" ? 'selected' : '' }}>Working</option>
                     <option value="3" {{ $job->status == "3" ? 'selected' : '' }}>Document Problem</option>
                     <option value="4" {{ $job->status == "4" ? 'selected' : '' }}>Completed</option>
                  </select>
               </div>
            @endif
            <div  class="form-group" id="date-div">
                  
            </div>
             <button class="btn" type="submit">Add Remark</button>
         </form>
   </div>
@endsection

@section('script')
   <script>
      function checkStatus(){
         if ($("#status_c").val() == '4') {
            $("#date-div").html('<label>Add Completion Date</label><input type="date" name="comp_date" placeholder="Type Remarks" class="theme-input-style" required>');
         }else{
            $("#date-div").html("");
         }
      }
   </script>
@endsection