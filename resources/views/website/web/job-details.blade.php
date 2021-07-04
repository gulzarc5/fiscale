@extends('website.template.master')
<!-- Head & Header Section -->
@section('content') 
<section class="pb-120">
   <center style="padding-top: 20px;"><h3>JOB DETAILS</h3></center>
   <div class="container" style="margin-top: 20px;">
      <div class="row">
         <div class="col p-t col-md-12">
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