@extends('website.template.master')
<!-- Head & Header Section -->
@section('content') 

<section class="pb-120">
   <div class="container" style="margin-top: 50px;">
      <div class="row">
         <div class="col-md-2">
            <nav class="my">
               <ul>
                  <li>
                     <a class="form-user-box" style="text-align: center; padding: 5px;">
                     <img src="img/user.png" width="50" style="display: block; margin: auto;">
                     <span class="text-capitalize">Ram Lal</span>
                     </a>
                  </li>
                  <li>
                     <a href="#eins" data-toggle="collapse" class="collapsed">
                     <span>
                     <i class="fa fa-user-circle-o"></i>
                     User
                     </span>
                     </a>
                     <ul class="collapse" id="eins">
                        <li>
                           <a href="branch_home.php">
                           <span>
                           <i class="fa fa-plus"></i>
                           Add User
                           </span>
                           </a>
                        </li>
                        <li>
                           <a href="user_list.php">
                           <span>
                           <i class="fa fa-list"></i>
                           User List
                           </span>
                           </a>
                        </li>
                     </ul>
                  </li>
                  <li>
                     <a href="branch_track.php">
                     <span>
                     <i class="fa fa-map-marker"></i>
                     Track
                     </span>
                     </a>
                  </li>
                  <li>
                     <a href="#eins2" data-toggle="collapse" class="collapsed">
                     <span>
                     <i class="fa fa-suitcase"></i>
                     Job
                     </span>
                     </a>
                     <ul class="collapse" id="eins2">
                        <li>
                           <a href="branch_add_job.php">
                           <span>
                           <i class="fa fa-plus"></i>
                           Add Job
                           </span>
                           </a>
                        </li>
                     </ul>
                  </li>
                  <li>
                     <a href="#">
                     <span>
                     <i class="fa fa-power-off"></i>
                     Logout
                     </span>
                     </a>
                  </li>
               </ul>
            </nav>
         </div>
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
                        </tr>
                        <tr>
                           <td>1</td>
                           <td>2144</td>
                           <td>Babu Rao</td>
                           <td>DD44555G</td>
                           <td>9854098540</td>
                           <td class="view-btn"><a class="btn text-white rounded" href="branch_tracking_details.php"><i class="fa fa-eye"></i></a></td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

@endsection