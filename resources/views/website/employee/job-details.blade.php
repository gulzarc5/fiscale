@extends('website.employee.template.employee_master')
@section('content') 

   <div class="col p-t col-md-10">
      @if (Session::has('message'))
         <div class="alert alert-success" >{{ Session::get('message') }}</div>
      @endif
      @if (Session::has('error'))
         <div class="alert alert-danger" >{{ Session::get('error') }}</div>
      @endif
      
      @if (isset($job) && !empty($job))
      
         <div class="row">
            <div class="col-md-12">
               <h3 style="float:left">JOB DETAILS            
                     FOR JOB ID : <b>{{$job->job_id}}</b>            
               </h3>
               <a href="{{route('employee.job_edit_form',['job_id'=>encrypt($job->id)])}}" class="btn btn-sm btn-warning" style="float:right;margin-right: 5px;">Edit Job</a>
               <a target="_blank" href="{{route('employee.client_details_new',['client_id'=>encrypt($job->client_id)])}}" class="btn btn-sm btn-info" style="float:right;margin-right: 5px;">View Client Info</a>
            </div>
            <div class="col-md-4">
              <p> <b>Name : </b>{{$job->cl_name}}</p>
            </div>
            <div class="col-md-4">
               <p><b>D.O.B/D.O.I : </b>{{$job->dob}}</p>
            </div>
            <div class="col-md-4">
               <p><b>PAN : </b>{{$job->cl_pan}}</p>
            </div>
            <div class="col-md-4">
               <p><b>Mobile : </b>{{$job->cl_mobile}}</p>
            </div>
            <div class="col-md-4">
               <p><b>Constitution : </b>{{$job->constitution}}</p>
            </div>
            <div class="col-md-4">
               <p><b>Gender : </b>
                  @if ($job->gender == 'M')
                      Male
                  @else
                      Female
                  @endif
               </p>
            </div> 
            <div class="col-md-4">
               <p><b>Job Desc : </b>{{$job->job_type_name}}</p>
            </div>
            <div class="col-md-4">
               <p><b>Date : </b>{{$job->created_at}}</p>
            </div>
            <div class="col-md-4">
               <p><b>Status : </b>
                  @if ($job->status == '1')
                     <a style="color: #ffb100;font-weight: bold;">Processing</a>
                  @elseif($job->status == '2')
                     <a style="color: #004eff;font-weight: bold;">Working</a>
                  @elseif($job->status == '3')
                     <a style="color: red;font-weight: bold;">Document Problem</a>
                  @else
                     <a style="color: #00b8ff;font-weight: bold;">Completed</a>
                  @endif                  
               </p>
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
                     {{-- <td> Action </td> --}}
                  </tr>
                  @if (isset($comments) && !empty($comments) && (count($comments) > 0))
                  @php
                      $remark_count = 1;
                  @endphp
                     @foreach ($comments as $item)
                        <tr>
                           <td>{{ $remark_count++ }}</td>
                           <td>{{$item->created_at}}</td>
                           <td>{{$item->remarks_by_name}}
                              @if ($item->remarks_by == '1')
                                 
                              @elseif ($item->remarks_by == '2')
                                 ( Member )
                              @else
                                ( SP )
                              @endif
                           </td>
                           <td>{{$item->remarks}}</td>
                           {{-- <td>
                               @if ($item->remarks_by == '2')
                           <a  class="status btn-sm btn-warning" href="{{route('employee.remark_edit',['remark_id'=>encrypt($item->id),'job_id'=>encrypt($job_id)])}}">Edit</a>
                                @endif
                            </td> --}}
                        </tr>
                     @endforeach
                  @else
                     <tr>
                        <td colspan="5" align="celter">No Remarks Found</td>
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
            @endif
             <div class="form-group">
                 <label>Add New Remarks *</label>
                 <textarea name="message" placeholder="Type Remarks" class="theme-input-style" required></textarea>
             </div>
            @if (isset($job) && !empty($job) && ($job->assign_to_id == Auth::guard('employee')->id()) && $job->status != '4')
               <div class="form-group" id="job_desc">
                  <label>Status *</label>
                  <select class="theme-input-style job-d text-uppercase" required name="status" onchange="checkStatus()" id="status_c">
                     <option selected="" disabled="" value="">--SELECT JOB STATUS--</option>
                     <option value="1" {{ $job->status == "1" ? 'selected' : '' }}>Processing</option>
                     <option value="2" {{ $job->status == "2" ? 'selected' : '' }}>Working</option>
                     <option value="3" {{ $job->status == "3" ? 'selected' : '' }}>Document Problem</option>
                     <option value="4" {{ $job->status == "4" ? 'selected' : '' }}>Completed</option>
                  </select>
               </div>
               <div  class="form-group" id="date-div">
                  
               </div>
            @endif
             <button class="btn" type="submit">Add Remark</button>
         </form>
   </div>


@endsection

@section('script')
   <script>
      function checkStatus(){
         if ($("#status_c").val() == '4') {
            $("#date-div").html('<label>Deduct Job Amount From SP</label><input type="number" name="amount" placeholder="Type Amount To Be Deduct" class="theme-input-style" required>');
         }else{
            $("#date-div").html("");
         }
      }
   </script>
@endsection