@extends('website.template.master')
<!-- Head & Header Section -->
@section('content') 

<section class="pb-120">
   <center style="padding-top: 20px;"><h3>OPEN JOBS</h3></center>
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
                        <div class="table-responsive">
                            <table class="sope--cart-table table pt-sans">
                                <tbody>
                                    <tr>
                                        <td> Date </td>
                                        <td> Job Description </td>
                                        <td> Status </td>
                                        <td> View </td>
                                        <td> Remarks </td>
                                    </tr>
                                    <tr>
                                        <td>20/10/19</td>
                                        <td>Income tax</td>
                                        <td>Something</td>
                                        <td class="view-btn"><a class="btn text-white rounded" href="job-details.php"><i class="fa fa-eye"></i></a></td>
                                        <td class="view-btn"><a class="btn text-white rounded" href="remark-form.php"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>20/10/19</td>
                                        <td>Income tax</td>
                                        <td>Something</td>
                                        <td class="view-btn"><a class="btn text-white rounded" href="job-details.php"><i class="fa fa-eye"></i></a></td>
                                        <td class="view-btn"><a class="btn text-white rounded" href="remark-form.php"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>20/10/19</td>
                                        <td>Income tax</td>
                                        <td>Something</td>
                                        <td class="view-btn"><a class="btn text-white rounded" href="job-details.php"><i class="fa fa-eye"></i></a></td>
                                        <td class="view-btn"><a class="btn text-white rounded" href="remark-form.php"><i class="fa fa-edit"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>20/10/19</td>
                                        <td>Income tax</td>
                                        <td>Something</td>
                                        <td class="view-btn"><a class="btn text-white rounded" href="job-details.php"><i class="fa fa-eye"></i></a></td>
                                        <td class="view-btn"><a class="btn text-white rounded" href="remark-form.php"><i class="fa fa-edit"></i></a></td>
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