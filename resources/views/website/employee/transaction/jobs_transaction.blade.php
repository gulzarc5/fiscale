@extends('website.employee.template.employee_master')
@section('content') 

   <div class="col p-t col-md-10">
      <div class="add-job-form contact-page-form animated fadeInUp jobtran" data-animate="fadeInUp" style="animation-duration: 0.6s; animation-delay: 0.1s;">
        @if (Session::has('message'))
            <div class="alert alert-success" >{{ Session::get('message') }}</div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif
         <div class="form-response"></div>
         {{ Form::open(['method' => 'post','route'=>'employee.job_transaction_search']) }}
            <div id="">
               <h1 data-animate="fadeInUp" data-delay=".1s" class="text-uppercase text-center" style="text-shadow: 1px -2px 1px white;">Search Job<span> Transactions</span></h1>
               <div class="row half-gutter">
                <div class="col-md-2"></div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label>Start Date</label>
                     <input type="date" name="start_date" value="{{old('start_date')}}" class="theme-input-style"> 
                        @if($errors->has('start_date'))
                              <span role="alert" style="color:red">
                                 <strong>{{ $errors->first('start_date') }}</strong>
                              </span>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label>End Date</label>
                        <input type="date" name="end_date" value="{{old('end_date')}}"  class="theme-input-style"> 
                        @if($errors->has('end_date'))
                              <span role="alert" style="color:red">
                                 <strong>{{ $errors->first('end_date') }}</strong>
                              </span>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-2">
                     <button  class="btn rounded" type="submit" style="margin-top: 28px;">Search</button>
                  </div>
               </div>
               
            </div>
         {{ Form::close() }}
      </div>

      <div class="cart-product animated fadeInUp " data-animate="fadeInUp" data-delay=".2" style="animation-duration: 0.6s; animation-delay: 0.2s;">
        <center><br><h3>Job Transactions</h3></center>
        <div class="table-responsive">
              <table class="sope--cart-table table pt-sans">
                 <tbody>
                    <tr>
                          <td>Sl No </td>
                          <td> Job Id </td>
                          <td> Job Name </td>
                          <td> Amount </td>
                          <td> Status </td>
                          <td> Date </td>
                    </tr>
                    @if (isset($job_transaction) && !empty($job_transaction) && count($job_transaction) > 0)
                    @php
                        $count = 1;
                    @endphp
                    @foreach ($job_transaction as $item)
                       <tr>
                          <td>{{$count++}}</td>
                          <td>{{$item->job_id}}</td>
                          <td>{{$item->job_name}}</td>
                          <td>{{$item->amount}}</td>
                          <td>
                             @if ($item->status == '1')
                                 <b style="color:goldenrod">Waiting</button>
                             @else
                                <b style="color:green">Credited to Wallet</b>
                             @endif
                          </td>
                          <td>{{$item->created_at}}</td>
                       </tr>
                    @endforeach                      
                 @else
                     <tr>
                        <td colspan="6" align="center">No Job Found</td>
                     </tr>
                 @endif
                 </tbody>
              </table>
        </div>
     </div>
   </div>

@endsection