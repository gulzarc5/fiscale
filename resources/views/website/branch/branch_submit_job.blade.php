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
               <h1>User Details</h1>
            </div>
            <div class="row">
               <div class="col-md-3">
                  <p><b>Name : </b>Babu Sona</p>
               </div>
               <div class="col-md-3">
                  <p><b>Father's Name : </b>Angel Priya</p>
               </div>
               <div class="col-md-3">
                  <p><b>D.O.B/D.O.I : </b>20/08/1990</p>
               </div>
               <div class="col-md-3">
                  <p><b>PAN : </b>DZYD45DD54</p>
               </div>
               <div class="col-md-3">
                  <p><b>Constitution : </b>Individual(p)</p>
               </div>
               <div class="col-md-3">
                  <p><b>Gender : </b>Male</p>
               </div>
            </div>
                <div class="submit-job-form contact-page-form animated fadeInUp" data-animate="fadeInUp" style="animation-duration: 0.6s; animation-delay: 0.1s;">
               <div class="form-response"></div>
               <form action="branch_submit_job.php">
                  <div id="">
                     <div class="row half-gutter">
                        <div id="first-job-des" class="col-md-10">
                           <div class="form-group">
                              <label>Job Description *</label>
                              <select class="theme-input-style job-d text-uppercase" required="">
                                 <option selected="" disabled="">--SELECT JOB DESCRIPTION FROM LIST--</option>
                                 <option>Income tax(B)</option>
                                 <option>Income tax(E)</option>
                                 <option>Gst Regd</option>
                                 <option>Gst Ret</option>
                                 <option>Dsc II</option>
                                 <option>Dsc III</option>
                                 <option>Epf</option>
                                 <option>Esi</option>
                                 <option>tc</option>
                                 <option>Company Registration</option>
                                 <option>Company Compliance</option>
                                 <option>Ngo Registration</option>
                                 <option>Project report</option>
                                 <option>Cma</option>
                                 <option>Fcra</option>
                                 <option>Trade Mark</option>
                                 <option>Iso Certification</option>
                                 <option>Others</option>
                                 <option>E-Tender</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group add-more">
                              <label>Add More</label>
                              <input id="add-more" style="background-color: #f4ba1f;" type="button" class=" btn rounded theme-input-style" value="+"> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-12 text-right">
                        <button id="" class="btn rounded" type="submit">SUBMIT</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>

@endsection