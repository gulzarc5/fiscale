@extends('website.branch.template.branch_master')
<!-- Head & Header Section -->
@section('content') 


         <div class="col p-t col-md-10">
            <div class="section-title text-center animated fadeInUp" data-animate="fadeInUp" style="animation-duration: 0.6s; animation-delay: 0.1s;">
               <h1>Users List</h1>
            </div>
            <div class="cart-product animated fadeInUp" data-animate="fadeInUp" data-delay=".2" style="animation-duration: 0.6s; animation-delay: 0.2s;">
               <div class="table-responsive">
                  <table class="sope--cart-table table pt-sans">
                     <tbody>
                        <tr>
                           <td> Sl. </td>
                           <td> Id </td>
                           <td> Name </td>
                           <td> PAN </td>
                           <td> Mobile </td>
                           <td> View Jobs</td>
                        </tr>
                        @if (isset($users) && count($users) > 0)
                        @php
                            $user_count = 1;
                        @endphp
                            @foreach ($users as $item)
                            <tr>
                              <td>{{$user_count++}}</td>
                              <td>{{$item->id}}</td>
                              <td>{{$item->name}}</td>
                              <td>{{$item->pan}}</td>
                              <td>{{$item->mobile}}</td>
                              <td class="view-btn"><a class="btn text-white rounded" href="{{route('branch.user_view',['user_id'=>encrypt($item->id)])}}"><i class="fa fa-eye"></i></a></td>
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