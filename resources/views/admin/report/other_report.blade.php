@extends('admin.template.admin_master')

@section('content')
<style>
    .user-btn{
        font-size: 24px;
        font-weight: bold;    
        margin: 42px;
    }
</style>

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Wallet Report Export</h2>
                    <div class="clearfix"></div>
                </div>

                 <div>
                    @if (Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                    @endif @if (Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
                </div>

                <div>
                    <div class="x_content">
                         <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                    <a href="{{route('admin.payment_receive_report_search')}}" class="btn btn-info user-btn">Payment Receive Report</a>
                                    <a href="{{route('admin.wallet_balance_report_form')}}" class="btn btn-warning user-btn">Wallet Balance Report</a>
                                    {{-- <a href="{{route('admin.executive_list_report')}}" class="btn btn-primary user-btn">Marketing Executive List</a> --}}
                                </div>
                            </div>
                        </div>                       
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

</div>


@endsection