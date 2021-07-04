@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Datewise Wallet Ledger Report Export</h2>
                    <div class="clearfix"></div>
                </div>

                 <div>
                    @if (Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                    @endif 
                    @if (Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
                </div>

                <div>
                    <div class="x_content">
                        {{ Form::open(['method' => 'post','route'=>'admin.wallet_ledger_report_export']) }}

                         <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="type">Select User Type</label>
                                    <select class="form-control" name="type" >
                                        <option value="">Select User Type</option>
                                        <option value="1" {{old('type') == '1' ? 'selected' : ''}}>Member</option>
                                        <option value="2" {{old('type') == '2' ? 'selected' : ''}}>SP</option>
                                        <option value="3" {{old('type') == '3' ? 'selected' : ''}}>ME</option>
                                    </select>
                                    @if($errors->has('type'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </span>
                                    @enderror
                                </div>  
                                
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="user_id">Enter Member/Me Email ID OR SP ID</label>
                                    <input class="form-control" name="user_id" value="{{old('user_id')}}">
                                    @if($errors->has('user_id'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('user_id') }}</strong>
                                        </span>
                                    @enderror
                                </div>  
                            </div>
                            <div class="form-row mb-10">
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="s_date">Start Date</label>
                                    <input type="date" class="form-control" name="s_date"  value="{{ old('s_date')}}" >
                                    @if($errors->has('s_date'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('s_date') }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="e_date">End Date</label>
                                    <input type="date" class="form-control" name="e_date"  value="{{ old('e_date')}}" >
                                    @if($errors->has('e_date'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('e_date') }}</strong>
                                        </span>
                                    @enderror
                                </div>                                  
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::submit('Export', array('class'=>'btn btn-success')) }}
                        </div>
                        {{ Form::close() }}
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

</div>


@endsection
