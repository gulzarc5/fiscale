@extends('website.employee.template.employee_master')
@section('content') 
   <div class="col p-t col-md-10">
      <div class="cart-product animated fadeInUp" data-animate="fadeInUp" data-delay=".2" style="animation-duration: 0.6s; animation-delay: 0.2s;">
         <h1 data-animate="fadeInUp" data-delay=".1s" class="text-uppercase text-center" style="text-shadow: 1px -2px 1px white;">Open <span>Jobs</span></h1>
         <div class="table-responsive">
               <table class="sope--cart-table table pt-sans">
                  <tbody>
                     <tr>
                           <td> Assigned Date </td>
                           <td> Client Name </td>
                           <td> Client PAN </td>
                           <td> SP Name </td>
                           <td> Job Description </td>
                           <td> Status </td>
                           <td style="min-width: 150px;"> View </td>
                     </tr>
                     @if (isset($job) && !empty($job) && count($job) > 0)
                     @foreach ($job as $item)
                        <tr>
                           <td>{{$item->assigned_date}}</td>
                           <td>{{$item->c_name}}</td>
                           <td>{{$item->pan}}</td>
                           <td>{{ $item->branch_name}}</td>
                           <td>{{$item->job_type_name}}</td>
                           <td>
                              @if ($item->status == '1')
                                  <button class="status btn-sm btn-warning">Processing</button>
                              @elseif ($item->status == '2')
                                 <button class="status btn-sm btn-info">Working</button>
                              @elseif($item->status == '3')
                                 <button class="status btn-sm btn-danger">Document Correction</button>
                              @elseif($item->status == '4')
                                 <button class="status btn-sm btn-success">Completed</button>
                              @endif
                           </td>
                           <td class="view-btn reject-btn">
                              <a style="padding: 7px;" class="btn btn-success text-white rounded" href="{{route('employee.job_view',['job_id'=>encrypt($item->job_id)])}}"><i class="fa fa-eye"></i></a>
                              <a style="padding: 7px;" class="btn btn-danger text-white rounded" href="{{route('employee.reject_job',['job_id'=>encrypt($item->id)])}}"  onclick="return confirm('Are You Sure To Reject The Job?')">Reject</a>
                           </td>
                        </tr>
                     @endforeach                      
                  @else
                      <tr>
                         <td colspan="5" align="center">No Job Found</td>
                      </tr>
                  @endif
                  </tbody>
               </table>
         </div>
      </div>
   </div>
@endsection