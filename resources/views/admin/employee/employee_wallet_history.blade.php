@extends('admin.template.admin_master')

@section('content')
<style>
    .pagination{
        margin:0px !important;
    }
</style>
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    @if (isset($wallet))
                        <h2 style="float:left">Employee Transaction History</h2>
                        <h2 style="float:right;color:#34d1ea">Wallet Balance : 
                        <b id="show_value">{{$wallet->amount}}</b></h2>
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
                {{--////////////////////// Employee Wallet History  ////////////////////////--}}
                @if(isset($wallet_history) && !empty($wallet_history))
                @php
                    $count = 1;
                @endphp
                <div>
                    <div class="x_content">   
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
                                    <tr>
                                        <td colspan="7">
                                            {!! $wallet_history->onEachSide(2)->links() !!}
                                        </td>
                                    </tr>
                                    @else
                                        <tr>
                                            <td colspan="4" style="text-align: center">Sorry No Data Found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>    
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
