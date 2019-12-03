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
         <div class="col-md-12">
            <center class="form-steps">
               <div id="step-1" style="background-color: #23d823; color: #fff;"><span>step 1</span></div>
               <div id="step-2"><span>step 2</span></div>
               <div id="step-3"><span>step 3</span></div>
            </center>
         </div>
         
            <div class="contact-form contact-page-form animated fadeInUp" data-animate="fadeInUp" style="animation-duration: 0.6s; animation-delay: 0.1s;">
               <div class="form-response"></div>
               <form action="">
                  <div id="form-1">
                     <h4>Enter Your PAN Details</h4>
                     <div class="row half-gutter">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>Name *</label>
                              <input type="text" name="name" placeholder="Enter your name" class="theme-input-style" required=""> 
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>Father's Name *</label>
                              <input type="" name="email" placeholder="Enter your father's name" class="theme-input-style" required=""> 
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>D.O.B/D.O.I</label>
                              <input type="text" name="subject" placeholder="Enter your dob" class="theme-input-style" required=""> 
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>PAN *</label>
                              <input type="text" name="name" placeholder="Enter your pan" class="theme-input-style" required="">
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>Constitution *</label>
                              <select class="theme-input-style" required="">
                                 <option selected="" disabled="">--SELECT CONSTITUTION FROM THE LIST--</option>
                                 <option>Individual</option>
                                 <option>Firm</option>
                                 <option>Company</option>
                                 <option>Others</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>Gender *</label>
                              <select class="theme-input-style" required="">
                                 <option selected="" disabled="">--SELECT YOUR GENDER--</option>
                                 <option>Male</option>
                                 <option>Female</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-12 text-right">
                        <button id="next-1" class="btn rounded" type="button">NEXT &gt;</button>
                     </div>
                  </div>
                  <div class="form-response"></div>
                  <div id="form-2" style="display: none;">
                     <h4>Enter Your Residential Address</h4>
                     <div class="row half-gutter">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>Flat No/H No. *</label>
                              <input type="text" name="name" placeholder="Enter your flat/house number." class="theme-input-style" required=""> 
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>Building/village *</label>
                              <input type="" name="email" placeholder="Enter your building or village name" class="theme-input-style" required=""> 
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>P.O</label>
                              <input type="text" name="subject" placeholder="Enter your post office" class="theme-input-style" required=""> 
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>P.S *</label>
                              <input type="text" name="name" placeholder="Enter your police station" class="theme-input-style" required="">
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>Area *</label>
                              <input type="text" name="name" placeholder="Enter your area" class="theme-input-style" required=""> 
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>District *</label>
                              <input type="text" name="name" placeholder="Enter your district" class="theme-input-style" required=""> 
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>State *</label>
                              <input type="text" name="name" placeholder="Enter your state" class="theme-input-style" required=""> 
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>Pin *</label>
                              <input type="text" name="name" placeholder="Enter your pin" class="theme-input-style" required=""> 
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>Mobile *</label>
                              <input type="text" name="name" placeholder="Enter your mobile number" class="theme-input-style" required=""> 
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>Email *</label>
                              <input type="text" name="name" placeholder="Enter your email" class="theme-input-style" required=""> 
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group">
                              <label>Trade Name (if any) *</label>
                              <input type="text" name="name" placeholder="Enter your trade name" class="theme-input-style" required=""> 
                           </div>
                        </div>
                        <div class="col-md-12">
                           <h4>Enter Your Business Address</h4>
                        </div>
                        <div class="col-md-12">
                           <div class="form-group">
                              <b>Select if same as residential address:</b>
                              <input type="checkbox" name="">
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>Flat No/H No. *</label>
                              <input type="text" name="name" placeholder="Enter your flat/house number." class="theme-input-style" required=""> 
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>Building/village *</label>
                              <input type="" name="email" placeholder="Enter your building or village name" class="theme-input-style" required=""> 
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>P.O</label>
                              <input type="text" name="subject" placeholder="Enter your post office" class="theme-input-style" required=""> 
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>P.S *</label>
                              <input type="text" name="name" placeholder="Enter your police station" class="theme-input-style" required="">
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>Area *</label>
                              <input type="text" name="name" placeholder="Enter your area" class="theme-input-style" required=""> 
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>District *</label>
                              <input type="text" name="name" placeholder="Enter your district" class="theme-input-style" required=""> 
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>State *</label>
                              <input type="text" name="name" placeholder="Enter your state" class="theme-input-style" required=""> 
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>Pin *</label>
                              <input type="text" name="name" placeholder="Enter your pin" class="theme-input-style" required=""> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-12 text-right">
                        <button type="button" id="form-2-previous" class="btn rounded">&lt; PREVIOUS</button>
                        <button id="next-2" class="btn rounded"  type="button">NEXT &gt;</button>
                     </div>
                  </div>
                  <div class="form-response"></div>
                  <div id="form-3" style="display: none;">
                     <h4>Your Job Details</h4>
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
                        <button id="form-3-previous" class="btn rounded" type="button">&lt; PREVIOUS</button>
                        <button id="next-3" class="btn rounded" type="submit">SUBMIT &gt;</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</section>

@endsection