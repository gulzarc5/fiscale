@extends('website.employee.template.employee_master')
@section('main_content') 
   <div class="col p-t col-md-10">
      <div class="cart-product animated fadeInUp" data-animate="fadeInUp" data-delay=".2" style="animation-duration: 0.6s; animation-delay: 0.2s;">
         <h3>OPEN JOBS</h3>
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
@endsection