@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Job Edit 
                        @if (isset($job) && !empty($job))
                            For Job Id - <b>{{$job->job_id}}</b>
                        @endif
                    </h2>
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
                        @if (isset($job) && !empty($job))
                            {{ Form::open(['method' => 'post','route'=>'admin.job_update']) }}
                            <input type="hidden" name="job_id" value="{{$job->id}}">
                            <div class="well" style="overflow: auto">
                                <center style="    margin-top: -16px;color: #ea4b27;"><h2 style="font-size: 24px;font-weight: 600;">Job Info</h2></center>
                                <div class="form-row mb-10">

                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <label for="name">Client Name</label>
                                        <input type="text" class="form-control" value="{{ $job->cl_name }}" disabled>
                                    </div>

                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <label for="mobile">Pan</label>
                                        <input type="text" class="form-control" value="{{ $job->cl_pan }}" disabled>
                                    </div>

                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <label for="email">Job Description</label>
                                        <input type="text" class="form-control" value="{{ $job->job_type_name }}" disabled>
                                    </div>  

                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <label for="email">Mobile Number</label>
                                        <input type="text" class="form-control" value="{{ $job->cl_mobile }}" disabled>
                                    </div>

                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <label for="email">Date</label>
                                        <input type="text" class="form-control" value="{{ $job->created_at }}" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="well" style="overflow: auto">
                                <center style="    margin-top: -16px;color: #2787ea;"><h2 style="font-size: 24px;font-weight: 600;">Job Edit</h2></center>
                                <div class="form-row mb-10">
                                    <div class="col-md-2 col-sm-12 col-xs-12 mb-3"></div>
                                    <div class="col-md-2 col-sm-12 col-xs-12 mb-3">
                                    <label for="name" style="font-size: 18px;">Job Description </label>
                                    </div>

                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <select class="form-control" name="job_type">
                                            <option value="" disabled selected>-- Please Select Job Description -- </option>
                                            @if (isset($job_type) && !empty($job_type))
                                                @foreach ($job_type as $item)
                                                    @if ($job->job_type == $item->id)
                                                        <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                                    @else
                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @endif
                                                    
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::submit('Submit', array('class'=>'btn btn-success')) }}
                                <button class="btn btn-danger" onclick="window.close(0);">Window Close</button>
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
