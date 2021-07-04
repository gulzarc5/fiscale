@extends('website.template.master')
<!-- Head & Header Section -->
@section('content')

<section class="pt-120 pb-120 default-bg" style="padding-bottom: 0; padding-top: 50px;">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-xl-12 col-lg-8">
            <div class="section-title text-center animated fadeInUp" data-animate="fadeInUp" style="animation-duration: 0.6s; animation-delay: 0.1s;">
               <h1>Your Tracking Details</h1>
            </div>
         </div>
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
   </div>
</section>
<section class="pt-120 pb-120 default-bg" style="padding-top: 0;">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="cart-product animated fadeInUp" data-animate="fadeInUp" data-delay=".2" style="animation-duration: 0.6s; animation-delay: 0.2s;">
               <div class="table-responsive">
                  <table class="sope--cart-table table pt-sans">
                     <tbody>
                        <tr>
                           <td> Date </td>
                           <td> Job Description </td>
                           <td> Status </td>
                           <td> View </td>
                        </tr>
                        <tr>
                           <td>20/10/19</td>
                           <td>Income tax</td>
                           <td>Something</td>
                           <td class="view-btn"><a class="btn btn-warning text-white rounded" href="job-details.php"><i class="fa fa-eye"></i></a></td>
                        </tr>
                        <tr>
                           <td>20/10/19</td>
                           <td>Income tax</td>
                           <td>Something</td>
                           <td class="view-btn"><a class="btn btn-warning text-white rounded" href="job-details.php"><i class="fa fa-eye"></i></a></td>
                        </tr>
                        <tr>
                           <td>20/10/19</td>
                           <td>Income tax</td>
                           <td>Something</td>
                           <td class="view-btn"><a class="btn btn-warning text-white rounded" href="job-details.php"><i class="fa fa-eye"></i></a></td>
                        </tr>
                        <tr>
                           <td>20/10/19</td>
                           <td>Income tax</td>
                           <td>Something</td>
                           <td class="view-btn"><a class="btn btn-warning text-white rounded" href="job-details.php"><i class="fa fa-eye"></i></a></td>
                        </tr>
                        <tr>
                           <td>20/10/18</td>
                           <td>Income tax</td>
                           <td>Something</td>
                           <td class="view-btn"><a class="btn btn-warning text-white rounded" href="job-details.php"><i class="fa fa-eye"></i></a></td>
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