@extends('website.branch.template.branch_master')
<!-- Head & Header Section -->
@section('content') 
<div class="col p-t col-md-10">
   <div class="section-title text-center animated fadeInUp" data-animate="fadeInUp" style="animation-duration: 0.6s; animation-delay: 0.1s;">
      <h1 data-animate="fadeInUp" data-delay=".1s" class="text-uppercase" style="float:left">Wallet <span>History</span></h1>
      <a href="{{route('branch.wallet_balance_add')}}" class="btn-success" style="float: right;padding: 10px 30px;-webkit-appearance: button;">Add Balance</a>
      <h1 style="float:right;margin-right: 5px;" class="btn btn-info">Wallet Balance : 
         @if (isset($wallet) && !empty($wallet))
            {{ number_format($wallet->amount,2,".",'')}}
         @endif
      </h1>
   </div>
   <div class="cart-product animated fadeInUp" data-animate="fadeInUp" data-delay=".2" style="animation-duration: 0.6s; animation-delay: 0.2s;">
      <div class="table-responsive">
         <table class="sope--cart-table table pt-sans">
            <tbody>
               <tr>
                  <td> Sl. </td>
                  <td> Transaction Type </td>
                  <td> Comments </td>
                  <td> Amount </td>                  
                  <td> Total Balance </td>
                  <td> Date</td>
               </tr>
               @if (isset($wallet_history) && !empty($wallet_history) && count($wallet_history) > 0)
               @php
                     $user_count = 1;
               @endphp
                     @foreach ($wallet_history as $item)
                     <tr>
                        <td>{{$user_count++}}</td>
                        <td>
                           @if ($item->transaction_type == '1')
                           <a class="status btn-sm btn-danger" style="color:white">Debit</a>
                           @else
                           <a class="status btn-sm btn-success" style="color:white">Credit</a>
                           @endif
                        </td>
                        <td>{{$item->comment}}</td>                     
                        <td>{{ number_format($item->amount,2,".",'')}}</td>                     
                        <td>{{ number_format($item->balance,2,".",'')}}</td>
                     <td>{{$item->created_at}}</td>
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