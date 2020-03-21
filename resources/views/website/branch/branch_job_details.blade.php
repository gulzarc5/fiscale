@extends('website.branch.template.branch_master')
@section('content') 

   <div class="col p-t col-md-10">
      @if (isset($job) && !empty($job))      
      <div class="row">
         <div class="col-md-12">
            <h3 style="float:left">JOB DETAILS            
                  FOR JOB ID : <b>{{$job->job_id}}</b>            
            </h3>
            <a target="_blank" href="{{route('branch.client_edit',['client_id'=>encrypt($job->client_id)])}}" class="btn btn-sm btn-info" style="float:right;margin-right: 5px;">View Client Info</a>
         </div>
         <div class="col-md-4">
         <p> <b>Name : </b>{{$job->cl_name}}</p>
         </div>
         <div class="col-md-4">
            <p<b>D.O.B/D.O.I : </b>{{$job->dob}}</p<b>
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
                   <button class="status btn-sm btn-warning">Processing</button>
               @elseif ($job->status == '2')
                  <button class="status btn-sm btn-warning">Processing</button>
               @elseif($job->status == '3')
                  <button class="status btn-sm btn-danger">Document Correction</button>
               @elseif($job->status == '4')
                  <button class="status btn-sm btn-success">Completed</button>
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
                                 {{$item->remarks_by_name}}
                              @elseif ($item->remarks_by == '2')
                                 {{$item->remarks_by_name}} (Member)
                              @else
                                 {{$item->remarks_by_name}} (SP)
                              @endif
                           </td>
                           <td>{{$item->remarks}}</td>
                        </tr>
                     @endforeach
                  @else
                     <tr>
                        <td colspan="4" align="celter">No Remarks Found</td>
                     </tr>
                  @endif
               </tbody>
            </table>
         </div>
      </div>

         <div class="form-response"></div>
         <form action="{{route('branch.add_new_remark')}}" method="post">
            @csrf
            @if (isset($job_input_id) && !empty($job_input_id))                
               <input type="hidden" name="job_id" value="{{$job_input_id}}">
            @endif
             <div class="form-group">
                 <label>Add New Remarks *</label>
                 <textarea name="message" placeholder="Type Remarks" class="theme-input-style" required></textarea>
             </div>
             <button class="btn" type="submit">Add Remark</button>
         </form>
   </div>


@endsection