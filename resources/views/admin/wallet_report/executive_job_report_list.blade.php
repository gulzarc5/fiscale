@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    @if (isset($wallet_balance))
                        <h2 style="float:left">Employee Transaction History</h2>
                        <h2 style="float:right;color:#34d1ea">Wallet Balance : 
                        <b id="show_value">{{$wallet_balance->amount}}</b></h2>
                    @else 
                        <h2 style="float:left">Employee Jobs</h2>
                        <h2 style="float:right;color:#34d1ea">Amount : 
                        <b id="show_value">
                            @if (isset($jobs_amount_total) && !empty($jobs_amount_total))
                                {{$jobs_amount_total}}
                            @else   
                                0
                            @endif
                        </b></h2>
                    @endif
                    
                    <div class="clearfix"></div>
                </div>

                 <div>
                    @if (Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                    @endif @if (Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
                </div>
                {{--////////////////////// Employee Credit  Waiting Jobs  ////////////////////////--}}
                @if(isset($jobs) && !empty($jobs))
                @php
                    $count = 1;
                @endphp
                <div>
                    <div class="x_content">
                        {{ Form::open(['method' => 'post','route'=>'admin.executive_job_comm_credit']) }}   
                        @if (isset($exe_id) && !empty($exe_id))
                        <input type="hidden" name="exe_id" value="{{$exe_id}}">
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">                
                                        <th class="column-title">Sl No. </th>
                                        <th class="column-title">Job Id</th>
                                        <th class="column-title">Job Name</th>
                                        <th class="column-title">Amount</th>
                                </thead>
    
                                <tbody>
                                    @if( count($jobs) > 0)
                                    @foreach($jobs as $item)
                                    <tr class="even pointer">
                                        <td class=" ">{{ $count++ }}</td>
                                        <td class=" ">{{ $item->emp_job_id }}</td>
                                        <td>{{ $item->job_type_name}}</td>
                                        <td>
                                            <input type="hidden" name="id[]" value="{{ $item->id }}">
                                            <input type="number" onkeyup="countAmount();" name="amount[]" value="{{ $item->amount }}">
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" style="text-align: center">Sorry No Data Found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <input type="submit" class="btn btn-info" name="submit" value="Submit">
                        </div>    
                       {{Form::close()}}
                    </div>
                </div>
                @endif


                {{--////////////////////// Employee Credited Jobs  ////////////////////////--}}
                @if(isset($credited_jobs) && !empty($credited_jobs))
                @php
                    $count = 1;
                @endphp
                <div>
                    <div class="x_content">
                        {{ Form::open(['method' => 'post','route'=>'admin.employee_job_comm_credit']) }}   
                        @if (isset($emp_id) && !empty($emp_id))
                        <input type="hidden" name="emp_id" value="{{$emp_id}}">
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">                
                                        <th class="column-title">Sl No. </th>
                                        <th class="column-title">Job Id</th>
                                        <th class="column-title">Job Name</th>
                                        <th class="column-title">Amount</th>
                                </thead>
    
                                <tbody>
    
                                    @if(isset($credited_jobs) && !empty($credited_jobs) && count($credited_jobs) > 0)
                                    @php
                                        $count = 1;
                                    @endphp
    
                                    @foreach($credited_jobs as $item)
                                    <tr class="even pointer">
                                        <td class=" ">{{ $count++ }}</td>
                                        <td class=" ">{{ $item->emp_job_id }}</td>
                                        <td>{{ $item->job_type_name}}</td>
                                        <td> {{ $item->amount }} </td>
                                    </tr>
                                    @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" style="text-align: center">Sorry No Data Found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>    
                       {{Form::close()}}
                    </div>
                </div>
                @endif
                

                {{--////////////////////// Employee Wallet History  ////////////////////////--}}
                @if(isset($wallet_history) && !empty($wallet_history))
                @php
                    $count = 1;
                @endphp
                <div>
                    <div class="x_content">
                        {{ Form::open(['method' => 'post','route'=>'admin.employee_job_comm_credit']) }}   
                        @if (isset($emp_id) && !empty($emp_id))
                        <input type="hidden" name="emp_id" value="{{$emp_id}}">
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">                
                                        <th class="column-title">Sl No. </th>
                                        <th class="column-title">Date</th>
                                        <th class="column-title">Type</th>
                                        <th class="column-title">Amount</th>
                                        <th class="column-title">Comment</th>
                                        <th class="column-title">Total Amount</th>
                                        <th class="column-title">Action</th>
                                </thead>
    
                                <tbody>
    
                                    @if( count($wallet_history) > 0)
    
                                    @foreach($wallet_history as $item)
                                    <tr class="even pointer">
                                        <td class=" ">{{ $count++ }}</td>
                                        <td class=" ">{{ $item->created_at }}</td>
                                        <td>
                                            @if ($item->transaction_type == '1')
                                                <b style="color:#00c4ff">Credit</b>
                                            @else  
                                                <b style="color:red">Debit</b>
                                            @endif
                                        </td>
                                        <td> {{ $item->amount }} </td>                                        
                                        <td> {{ $item->total_amount }} </td>
                                        <td> {{ $item->comment }} </td>
                                        <td>  
                                            @if ($item->type == '1')
                                                <a href="#" class="btn btn-sm btn-info">View Details</a>
                                            @else  
                                                --
                                            @endif 
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" style="text-align: center">Sorry No Data Found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>    
                       {{Form::close()}}
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

</div>
@endsection
@section('script')
<script src="{{asset('select2/js/select2.min.js')}}"></script>
   <script>
      $(document).ready(function() {
         $('.executive').select2();
      });

      function countAmount(event) {
        var data = $('input[name^=amount]').map(function(idx, elem) {
            return $(elem).val();
        }).get();

        console.log(data);
        sum = 0;
        $.each(data,function(){
            sum+=parseFloat(this) || 0;
        });
        $('#show_value').html(sum);
    }
   </script>
@endsection
