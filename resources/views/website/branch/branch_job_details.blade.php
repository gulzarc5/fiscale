@extends('website.branch.template.branch_master')
@section('content') 

   <div class="col p-t col-md-10">
         <center style="padding-top: 20px;">
            <h3>JOB DETAILS
               @if (isset($job_id) && !empty($job_id))
                  FOR JOB ID : <b>{{$job_id}}</b>
               @endif
            </h3>
         </center>
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
                                  Admin
                              @elseif ($item->remarks_by == '2')
                                  Employee
                              @else
                                 Branch
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