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
        <div class="col-md-12" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Search Employee Wallet</h2>
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
                        {{ Form::open(['method' => 'post','route'=>'admin.employee_job_report_search']) }}

                         <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-6 col-sm-6 col-xs-12 mb-3">
                                    <label for="name">Select Employee</label>
                                    <select class="form-control executive" name="employee_id">
                                        <option value="">--Select Employee--</option>
                                        @if (isset($employee) && !empty($employee))
                                            @foreach ($employee as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        @endif
                                        
                                    </select>
                                      @if($errors->has('employee_id'))
                                          <span class="invalid-feedback" role="alert" style="color:red">
                                              <strong>{{ $errors->first('employee_id') }}</strong>
                                          </span>
                                      @enderror
                                </div>

                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="name">Select Search Type</label>
                                    <select class="form-control" name="search_type" id="search_type">
                                        <option value="">--Select Search Type--</option>
                                        <option value="1">Employee Jobs</option>
                                        <option value="2">Employee Transactions</option>
                                    </select>
                                      @if($errors->has('search_type'))
                                          <span class="invalid-feedback" role="alert" style="color:red">
                                              <strong>{{ $errors->first('search_type') }}</strong>
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
                            <div class="form-row mb-10" id="job_type">
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="name">Select Job Type</label>
                                    <select class="form-control" name="job_type">
                                        <option value="">--Select Job Type--</option>
                                        <option value="2">Credited Jobs</option>
                                        <option value="1">Waiting Credit</option>
                                    </select>
                                      @if($errors->has('job_type'))
                                          <span class="invalid-feedback" role="alert" style="color:red">
                                              <strong>{{ $errors->first('job_type') }}</strong>
                                          </span>
                                      @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::submit('Submit', array('class'=>'btn btn-success')) }}
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
@section('script')
<script src="{{asset('select2/js/select2.min.js')}}"></script>
   <script>
      $(document).ready(function() {
         $('.executive').select2();

         $("#search_type").change(function(){
            if ($(this).val() == '1') {
                $("#job_type").show();
            }else{
                $("#job_type").hide();
            }
         });
         $("#job_type").hide();
      });
      
   </script>


@endsection
