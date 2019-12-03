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
                     <a href="empl_home.php">
                     <span>
                     <i class="fa fa-window-maximize"></i>
                     Open Jobs
                     </span>
                     </a>
                  </li>
                  <li>
                     <a href="closed_jobs.php">
                     <span>
                     <i class="fa fa-window-close"></i>
                     Closed Jobs
                     </span>
                     </a>
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
            <div class="contact-form contact-page-form animated fadeInUp" data-animate="fadeInUp" style="animation-duration: 0.6s; animation-delay: 0.1s;">
               <div class="form-response"></div>
               <form action="#">
                  <div id="">
                     <h4>Job Remarks Form</h4>
                     <div class="row half-gutter">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>User Name *</label>
                              <input type="text" name="name" placeholder="Enter your name" class="theme-input-style" required=""> 
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Job *</label>
                              <input type="" name="email" placeholder="Enter your father's name" class="theme-input-style" required=""> 
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="form-group">
                              <label>Remarks</label>
                              <textarea type="text" name="name" placeholder="Enter your pan" class="theme-input-style" required=""></textarea>
                           </div>
                        </div>
                         <div class="col-md-12">
                           <div class="form-group">
                              <label style="padding-right: 10px;">Job Status * </label>
                              <label class="checkbox-inline" style="padding-right: 20px;">
                                <input name="job-status" type="radio" value="">Open 
                              </label>
                              <label class="checkbox-inline">
                                <input name="job-status" type="radio" value="">Close
                              </label>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-12 text-right">
                        <button id="" class="btn rounded" type="button">SUBMIT &gt;</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>

@endsection