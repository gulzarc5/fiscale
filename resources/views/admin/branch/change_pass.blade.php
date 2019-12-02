@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Change Password Of Branch</h2>
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
                    @if (isset($branch) && !empty($branch))                        
                        <div class="x_content">
                            {{ Form::open(['method' => 'post','route'=>'admin.change_pass_branch']) }}
                            <input type="hidden" value="{{$branch->id}}" name="id">
                            <div class="well" style="overflow: auto">
                                <div class="form-row mb-10">

                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <label for="name">Branch Name</label>
                                        <input type="text" class="form-control" name="name"  placeholder="Enter Branch name" value="{{ $branch->name }}" disabled >
                                    </div>


                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <label for="password">Password</label>
                                        <input type="text" class="form-control" name="password"  placeholder="Enter Password" value="{{ old('password')}}" >
                                        @if($errors->has('password'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::submit('Submit', array('class'=>'btn btn-success')) }}
                                <a href="{{route('admin.branch_list')}}" class="btn btn-warning">Back</a>
                            </div>
                            {{ Form::close() }}                       
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

</div>


@endsection
