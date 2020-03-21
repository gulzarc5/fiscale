@extends('website.employee.template.employee_master')
@section('content') 
<div class="col p-t col-md-10">
    <div class="cart-product animated fadeInUp" data-animate="fadeInUp" data-delay=".2" style="animation-duration: 0.6s; animation-delay: 0.2s;">
       <center><h3>Closed JOBS</h3></center>
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
                         <td> Closed Date </td>
                   </tr>
                   @if (isset($job) && !empty($job) && count($job) > 0)
                   @foreach ($job as $item)
                      <tr>
                         <td>{{$item->assigned_date}}</td>
                         <td>{{$item->c_name}}</td>
                         <td>{{$item->c_pan}}</td>
                         <td>{{$item->branch_name}}</td>
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
                         <td>{{$item->completed_date}}</td>
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