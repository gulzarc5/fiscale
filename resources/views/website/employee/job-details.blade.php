@extends('website.template.master')
<!-- Head & Header Section -->
@section('content') 

<section class="pb-120">
   <center style="padding-top: 20px;"><h3>JOB DETAILS</h3></center>
   <div class="container" style="margin-top: 20px;">
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
            <div class="cart-product animated fadeInUp" data-animate="fadeInUp" data-delay=".2" style="animation-duration: 0.6s; animation-delay: 0.2s;">
                 <div class="row">
            <div class="col-md-4">
                <p><b>Date Created : </b>20/12/19</p>
            </div>
            <div class="col-md-4">
                <p><b>Status : </b>Open</p>
            </div>
            <div class="col-md-4">
                <p><b>Description : </b>Income Tax</p>
            </div>
        </div>
                        <div class="table-responsive">
                            <table class="sope--cart-table table pt-sans">
                                <tbody>
                                    <tr>
                                        <td> Sl. </td>
                                        <td> Date </td>
                                        <td> Remarks </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>20/10/19</td>
                                        <td>Something</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>20/10/19</td>
                                        <td>Something</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>20/10/19</td>
                                        <td>Something</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>20/10/19</td>
                                        <td>Something</td>
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