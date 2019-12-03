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
           <div class="add-job-form contact-page-form animated fadeInUp" data-animate="fadeInUp" style="animation-duration: 0.6s; animation-delay: 0.1s;">
               <div class="form-response"></div>
               <form action="branch_submit_job.php">
                  <div id="">
                     <h4>Add Job Here</h4>
                     <div class="row half-gutter">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label>Enter Your User ID*</label>
                              <input type="text" name="name" placeholder="Enter your user id" class="theme-input-style" required=""> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-12 text-right">
                        <button id="" class="btn rounded" type="submit">ADD</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>

@endsection