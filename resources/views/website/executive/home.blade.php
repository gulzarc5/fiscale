@extends('website.executive.template.executive_master')
@section('content') 
   <div class="col p-t col-md-10">
      <div class="cart-product animated fadeInUp" data-animate="fadeInUp" data-delay=".2" style="animation-duration: 0.6s; animation-delay: 0.2s;">
         <center><h3>Wallet History</h3></center>
         <div class="table-responsive">
               <table class="sope--cart-table table pt-sans">
                  <tbody>
                     <tr>
                           <td> Date </td>
                           <td> Job Id </td>
                           <td> Amount </td>
                           <td> Status </td>
                     </tr>
                     @if (isset($wallet) && !empty($wallet) && count($wallet) > 0)
                     @foreach ($wallet as $item)
                        <tr>
                           <td>{{$item->created_at}}</td>
                           <td>{{$item->job_id}}</td>
                           <td>{{$item->amount}}</td>
                           <td>
                              @if ($item->status == '1')
                                  <button class="status btn-sm btn-success">Paid</button>
                              @else
                                 <button class="status btn-sm btn-warning">Waiting</button>
                              @endif
                           </td>
                        </tr>
                     @endforeach                      
                  @else
                      <tr>
                         <td colspan="4" align="center">No Job Found</td>
                      </tr>
                  @endif
                  </tbody>
               </table>
         </div>
      </div>
   </div>
@endsection