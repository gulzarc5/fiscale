@extends('website.branch.template.branch_master')
@section('content')
         
   <div class="col p-t col-md-10">
      <div class="section-title text-center animated fadeInUp" data-animate="fadeInUp" style="animation-duration: 0.6s; animation-delay: 0.1s;">
         <h1>Correction Jobs</h1>
      </div>
      
      <div class="cart-product animated fadeInUp" data-animate="fadeInUp" data-delay=".2" style="animation-duration: 0.6s; animation-delay: 0.2s;">
         <div class="table-responsive">
            <table class="sope--cart-table table pt-sans">
               <tbody>
                  <tr>
                     <td> Date </td>
                     <td> Client Name </td>
                     <td> Client PAN </td>
                     <td> Job Description </td>
                     <td> Status </td>
                     <td> View Details</td>
                  </tr>
                  @if (isset($job) && !empty($job) && count($job) > 0)
                     @foreach ($job as $item)
                        <tr>
                           <td>{{$item->created_at}}</td>
                           <td>{{$item->c_name}}</td>
                           <td>{{$item->pan}}</td>
                           <td>{{$item->job_type_name}}</td>
                           <td>
                              @if ($item->status == '1')
                                  <button class="status btn-sm btn-warning">Processing</button>
                              @elseif ($item->status == '2')
                                 <button class="status btn-sm btn-warning">Processing</button>
                              @elseif($item->status == '3')
                                 <button class="status btn-sm btn-danger">Document Correction</button>
                              @elseif($item->status == '3')
                                 <button class="status btn-sm btn-success">Solved</button>
                              @endif
                           </td>
                           <td class="view-btn"><a class="btn btn-success text-white rounded" href="{{route('branch.job_view',['job_id'=>encrypt($item->job_id)])}}"><i class="fa fa-eye"></i></a></td>
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