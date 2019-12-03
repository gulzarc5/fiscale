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
            <h1 data-animate="fadeInUp" data-delay=".3" class="text-uppercase" style="text-shadow: 1px -2px 1px white;">Enter <span>tracking</span> ID </h1>
            <div class="primary-form">
               <form action="branch_tracking_details.php" method="post" name=""  novalidate=""> <input type="text" name="tracking-id" class="theme-input-style home-search" placeholder="Enter your tracking id" required=""> <button class="btn" style="border:0;" type="submit">Search</button> </form>
            </div>
         </div>
      </div>
   </div>
</section>

@endsection