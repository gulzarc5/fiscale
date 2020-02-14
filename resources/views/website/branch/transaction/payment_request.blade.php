@extends('website.branch.template.branch_master')
<!-- Head & Header Section -->
@section('content') 
<div class="col p-t col-md-10">
   <div class="section-title text-center animated fadeInUp" data-animate="fadeInUp" style="animation-duration: 0.6s; animation-delay: 0.1s;">
      <h1 style="float:left">Payment Request List</h1>
      <a style="float:right;color:white" class="btn btn-info" href="{{route('branch.payment_request_add_form')}}">Add New</a>
   </div>
   <div class="cart-product animated fadeInUp" data-animate="fadeInUp" data-delay=".2" style="animation-duration: 0.6s; animation-delay: 0.2s;">
      <div class="table-responsive">
         <table class="sope--cart-table table pt-sans">
            <tbody>
               <tr>
                  <td> Sl. </td>
                  <td> Amount </td>
                  <td> Transaction Type </td>
                  <td> Bank/UPI Name </td>
                  <td> Date</td>
                  <td> Status</td>
               </tr>
               @if (isset($p_rqst) && count($p_rqst) > 0)
               @php
                     $user_count = 1;
               @endphp
                     @foreach ($p_rqst as $item)
                     <tr>
                     <td>{{$user_count++}}</td>
                     <td>{{$item->amount}}</td>
                     <td>
                        @if ($item->transaction_type == '1')
                            Bank Deposit
                        @else
                            Online Payment
                        @endif
                     </td>
                     <td>{{$item->bank_name}}</td>
                     <td>{{$item->created_at}}</td>
                     <td>                     
                        @if ($item->status == '1')
                           <a class="status btn-sm btn-warning" style="color:white">Waiting</a>
                        @elseif($item->status == '2')
                           <a class="status btn-sm btn-success" style="color:white">Accepted</a>
                        @else
                           <a class="status btn-sm btn-danger" style="color:white">Rejected</a>
                        @endif
                     </td>
                  </tr>
                     @endforeach
               @else
                     <tr>
                        <td colspan="6" align="center">No Data Found</td>
                     </tr>
               @endif
               {{-- <tr>
                  <td>1</td>
                  <td>2144</td>
                  <td>Babu Rao</td>
                  <td>DD44555G</td>
                  <td>9854098540</td>
                  <td class="view-btn"><a class="btn text-white rounded" href="branch_tracking_details.php"><i class="fa fa-eye"></i></a></td>
               </tr>
               <tr>
                  <td>1</td>
                  <td>2144</td>
                  <td>Babu Rao</td>
                  <td>DD44555G</td>
                  <td>9854098540</td>
                  <td class="view-btn"><a class="btn text-white rounded" href="branch_tracking_details.php"><i class="fa fa-eye"></i></a></td>
               </tr>
               <tr>
                  <td>1</td>
                  <td>2144</td>
                  <td>Babu Rao</td>
                  <td>DD44555G</td>
                  <td>9854098540</td>
                  <td class="view-btn"><a class="btn text-white rounded" href="branch_tracking_details.php"><i class="fa fa-eye"></i></a></td>
               </tr>
               <tr>
                  <td>1</td>
                  <td>2144</td>
                  <td>Babu Rao</td>
                  <td>DD44555G</td>
                  <td>9854098540</td>
                  <td class="view-btn"><a class="btn text-white rounded" href="branch_tracking_details.php"><i class="fa fa-eye"></i></a></td>
               </tr> --}}

            </tbody>
         </table>
      </div>
   </div>
</div>

@endsection