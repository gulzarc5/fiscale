@extends('website.executive.template.executive_master')
@section('content') 
<div class="col p-t col-md-10">
    <div class="section-title text-center animated fadeInUp" data-animate="fadeInUp" style="animation-duration: 0.6s; animation-delay: 0.1s;">
      <h1 data-animate="fadeInUp" data-delay=".1s" class="text-uppercase" style="float:left">Wallet <span>History</span></h1>
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
                            @if ($item->transaction_type == '2')
                            <a class="status btn-sm btn-danger" style="color:white">Debit</a>
                            @else
                            <a class="status btn-sm btn-success" style="color:white">Credit</a>
                            @endif
                         </td>
                         <td>{{$item->comment}}</td>                     
                         <td>{{ number_format($item->amount,2,".",'')}}</td>                     
                         <td>{{ number_format($item->total_amount,2,".",'')}}</td>
                      <td>{{$item->created_at}}</td>
                   </tr>
                      @endforeach
                @else
                      <tr>
                         <td colspan="6" align="center">No Data Found</td>
                      </tr>
                @endif
             </tbody>
          </table>

            @if (isset($wallet_history) && !empty($wallet_history) && count($wallet_history) > 0)
                <div class="col-lg-12 col-md-12 col-sm-12 book-mobile">
                    {!! $wallet_history->onEachSide(2)->links() !!}
                </div>
            @endif
       </div>
    </div>
 </div>
 
@endsection