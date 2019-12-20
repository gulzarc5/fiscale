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
         @if (isset($job) && !empty($job))
         <div class="row">
            <div class="col-md-4">
               <p><b>Client Name : </b>{{$job->cl_name}}</p>
            </div>
            <div class="col-md-4">
               <p><b>Client PAN : </b>{{$job->cl_pan}}</p>
            </div>
            <div class="col-md-4">
               <p><b>Client Mobile : </b>{{$job->cl_mobile}}</p>
            </div>
            
            <div class="col-md-4">
               <p><b>Description : </b>{{$job->job_type_name}}</p>
            </div>
            <div class="col-md-4">
               <p><b>Status : </b>
                  @if ($job->status == '1')
                        <button class="status btn-sm btn-warning">Processing</button>
                  @elseif ($job->status == '2')
                     <button class="status btn-sm btn-info">Working</button>
                  @elseif($job->status == '3')
                     <button class="status btn-sm btn-danger">Document Correction</button>
                  @elseif($job->status == '3')
                     <button class="status btn-sm btn-success">Solved</button>
                  @endif
               </p>
            </div>
            <div class="col-md-4">
               <p><b>Date Created : </b>{{$job->created_at}}</p>
            </div>
         </div>
         @endif
         <div class="table-responsive">
            <table class="sope--cart-table table pt-sans">
               <tbody>
                  <tr>
                     <td> Sl. </td>
                     <td> Date </td>
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
                           <td>{{$item->remarks}}</td>
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
   </div>


@endsection