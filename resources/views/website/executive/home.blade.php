@extends('website.executive.template.executive_master')
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
         {{ Form::open(['method' => 'post','route'=>'executive.job_transaction_search']) }}
            <div id="">
               <h4 style="text-align:center">Search Job Transactions</h4>

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
                    @if (isset($executivge_jobs) && !empty($executivge_jobs) && count($executivge_jobs) > 0)
                    @php
                        $count = 1;
                    @endphp
                    @foreach ($executivge_jobs as $item)
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
               @if (isset($executivge_jobs) && !empty($executivge_jobs) && count($executivge_jobs) > 0)
                  <div class="col-lg-12 col-md-12 col-sm-12 book-mobile">
                     {!! $executivge_jobs->onEachSide(2)->links() !!}
                  </div>
               @endif
           
        </div>
     </div>
  </div>
@endsection