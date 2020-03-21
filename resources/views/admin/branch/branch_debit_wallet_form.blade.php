@extends('admin.template.admin_master')

@section('content')
<style>
    .select2-selection__rendered{
        line-height: 30px!important;
    }
    .select2-container--default .select2-selection--single{
        border-color: #ccc!important;
        border: 1px solid;
        height: 34px;
        min-height: 34px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered{
        padding-top: 0px;
    }
</style>
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6" style="margin-top:50px;">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Employee Wallet Debit Form</h2>
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
                        @if (isset($wallet) && !empty($wallet))
                        {{ Form::open(['method' => 'post','route'=>'admin.branch_debit_wallet']) }}
                            <input type="hidden" name="wallet_id" value="{{$wallet->id}}">
                            <div class="well" style="overflow: auto">
                                <div class="form-row mb-10">
                                    <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name"  value="{{$wallet->name}}" disabled>
                                    </div>
                                    
                                    <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                        <label for="mobile">Mobile Number</label>
                                        <input type="text" class="form-control" name="mobile"  value="{{$wallet->mobile}}" disabled>
                                    </div> 
                                    
                                    <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                        <label for="balance">Wallet Balance</label>
                                        <input type="text" class="form-control" name="balance"  value="{{$wallet->amount}}" disabled>
                                    </div> 

                                    <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                        <label for="amount">Debit Amount</label>
                                        <input type="number" class="form-control" name="amount" min="1" max="{{$wallet->amount}}"  value="{{old('amount')}}" >
                                        @if($errors->has('amount'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('amount') }}</strong>
                                            </span>
                                        @enderror
                                    </div> 
                                    <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                        <label for="comment">Comment</label>
                                        <textarea type="text" class="form-control" name="comment">{{ old('comment')}}</textarea>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::submit('Submit', array('class'=>'btn btn-success')) }}
                            </div>
                        {{ Form::close() }}                            
                        @endif
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

</div>
@endsection
