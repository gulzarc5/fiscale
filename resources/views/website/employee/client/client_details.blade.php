@extends('website.employee.template.employee_master')
@section('content') 
         
   <div class="col p-t col-md-10">
      <div class="section-title text-center animated fadeInUp" data-animate="fadeInUp" style="animation-duration: 0.6s; animation-delay: 0.1s;">
            <h1>Client Details</h1>
         
      </div>
      @if (isset($user) && !empty($user))
         <div class="row">
            <div class="col-md-3">
               <p><b>Name : </b>{{$user->name}}</p>
            </div>
            <div class="col-md-3">
               <p><b>Father's Name : </b>{{$user->father_name}}</p>
            </div>
            <div class="col-md-3">
               <p><b>D.O.B/D.O.I : </b>{{$user->dob}}</p>
            </div>
            <div class="col-md-3">
               <p><b>PAN : </b>{{$user->pan}}</p>
            </div>
            <div class="col-md-3">
               <p><b>Constitution : </b>{{$user->constitution}}</p>
            </div>
            <div class="col-md-3">
               <p><b>Gender : 
                  @if ($user->gender == 'M')
                     </b>Male</p>
                  @else
                     </b>FeMale</p>
                  @endif
            </div>
            <div class="col-md-6">
            <a href="{{route('employee.client_edit_form',['client_id'=>encrypt($user->id)])}}" class="btn btn-sm btn-info" style="float:right">Edit Client Info</a>
            </div>
         </div>
      @endif
      
      <div class="cart-product animated fadeInUp" data-animate="fadeInUp" data-delay=".2" style="animation-duration: 0.6s; animation-delay: 0.2s;">
         <div class="table-responsive">
            <table class="sope--cart-table table pt-sans">
               <tbody>
                  <tr>
                     <td> Date </td>
                     <td> Job Description </td>
                     <td> Status </td>
                     <td> View Details</td>
                  </tr>
                  @if (isset($job) && count($job) > 0)
                     @foreach ($job as $item)
                        <tr>
                           <td>{{$item->created_at}}</td>
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
                           <td class="view-btn"><a class="btn btn-success text-white rounded" href="{{route('employee.job_search_view_page',['job_id'=>encrypt($item->job_id)])}}"><i class="fa fa-eye"></i></a></td>
                        </tr>
                     @endforeach                      
                  @else
                      <tr>
                         <td colspan="5" align="center">No Job Found</td>
                      </tr>
                  @endif
                  {{-- <tr>
                     <td>20/10/19</td>
                     <td>Income tax</td>
                     <td>Something</td>
                     <td class="view-btn"><a class="btn btn-warning text-white rounded" href="branch_job_details.php"><i class="fa fa-eye"></i></a></td>
                  </tr>
                  <tr>
                     <td>20/10/19</td>
                     <td>Income tax</td>
                     <td>Something</td>
                     <td class="view-btn"><a class="btn btn-warning text-white rounded" href="branch_job_details.php"><i class="fa fa-eye"></i></a></td>
                  </tr>
                  <tr>
                     <td>20/10/19</td>
                     <td>Income tax</td>
                     <td>Something</td>
                     <td class="view-btn"><a class="btn btn-warning text-white rounded" href="branch_job_details.php"><i class="fa fa-eye"></i></a></td>
                  </tr>
                  <tr>
                     <td>20/10/19</td>
                     <td>Income tax</td>
                     <td>Something</td>
                     <td class="view-btn"><a class="btn btn-warning text-white rounded" href="branch_job_details.php"><i class="fa fa-eye"></i></a></td>
                  </tr>
                  <tr>
                     <td>20/10/18</td>
                     <td>Income tax</td>
                     <td>Something</td>
                     <td class="view-btn"><a class="btn btn-warning text-white rounded" href="branch_job_details.php"><i class="fa fa-eye"></i></a></td>
                  </tr> --}}
               </tbody>
            </table>
         </div>
      </div>
   </div>


@endsection