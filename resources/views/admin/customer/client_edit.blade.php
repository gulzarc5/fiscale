@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Add New Employee</h2>
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
                        {{ Form::open(['method' => 'post','route'=>'admin.add_employee']) }}
                        @if (isset($client) && !empty($client))
                            <div class="well" style="overflow: auto">
                                <h2>Client Personal Information</h2>
                                <div class="form-row mb-10">
                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="name">Client Name</label>
                                    <input type="text" class="form-control" name="name"  placeholder="Enter Client name" value="{{$client->name}}" >
                                        @if($errors->has('name'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="father_name">Fathers Name</label>
                                        <input type="text" class="form-control" name="father_name"  placeholder="Enter Father Name" value="{{ $client->father_name}}" >
                                        @if($errors->has('father_name'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('father_name') }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="dob">Date Of Birth</label>
                                        <input type="date" class="form-control" name="dob"  value="{{ $client->dob}}" >
                                        @if($errors->has('dob'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('dob') }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="pan">Pan No</label>
                                        <input type="text" class="form-control" name="pan"  placeholder="Enter PAN Number" value="{{ $client->pan }}" >
                                        @if($errors->has('pan'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('pan') }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="constitution">Constitution</label>
                                        <input type="text" class="form-control" name="constitution"  placeholder="Enter Constitution" value="{{ $client->constitution }}" >
                                        @if($errors->has('constitution'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('constitution') }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="size_wearing">Gender</label>
                                        <p style="padding-bottom: 6px; margin-top: 8px;">
                                            @if ($client->gender == 'M')
                                                Male:
                                                <input type="radio" class="flat" name="gender" id="genderM" value="M" checked=""/> FeMale:
                                                <input type="radio" class="flat" name="gender" id="genderF" value="F" />
                                            @else
                                                Male:
                                                <input type="radio" class="flat" name="gender" id="genderM" value="M" /> FeMale:
                                                <input type="radio" class="flat" name="gender" id="genderF" value="F" checked=""/>
                                            @endif
                                        
                                        </p>
                                        @if($errors->has('gender'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('gender') }}</strong>
                                            </span>
                                        @enderror
                                    </div> 

                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="mobile">Mobile Number</label>
                                        <input type="text" class="form-control" name="mobile"  placeholder="Enter Employee Mobile Number" value="{{ $client->mobile}}" >
                                        @if($errors->has('mobile'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('mobile') }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" name="email"  placeholder="Enter Employee Email Id" value="{{ $client->email }}" >
                                        @if($errors->has('email'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @enderror
                                    </div>                             
                                </div>
                            </div>                            
                        @endif

                        <div class="well" style="overflow: auto">
                            <h2>Client Residential Address</h2>
                            <div class="form-row mb-10">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="name">Flat No/H No.</label>
                                  <input type="text" class="form-control" name="name"  placeholder="Enter Employee name" value="{{ old('name')}}" >
                                    @if($errors->has('name'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="mobile">Building/village </label>
                                    <input type="text" class="form-control" name="mobile"  placeholder="Enter Employee Mobile Number" value="{{ old('mobile')}}" >
                                    @if($errors->has('mobile'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="mobile">P.O</label>
                                    <input type="text" class="form-control" name="mobile"  placeholder="Enter Employee Mobile Number" value="{{ old('mobile')}}" >
                                    @if($errors->has('mobile'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="mobile">P.S.</label>
                                    <input type="text" class="form-control" name="mobile"  placeholder="Enter Employee Mobile Number" value="{{ old('mobile')}}" >
                                    @if($errors->has('mobile'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="mobile">Area</label>
                                    <input type="text" class="form-control" name="mobile"  placeholder="Enter Employee Mobile Number" value="{{ old('mobile')}}" >
                                    @if($errors->has('mobile'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="mobile">District</label>
                                    <input type="text" class="form-control" name="mobile"  placeholder="Enter Employee Mobile Number" value="{{ old('mobile')}}" >
                                    @if($errors->has('mobile'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="mobile">State</label>
                                    <input type="text" class="form-control" name="mobile"  placeholder="Enter Employee Mobile Number" value="{{ old('mobile')}}" >
                                    @if($errors->has('mobile'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="mobile">Pin</label>
                                    <input type="text" class="form-control" name="mobile"  placeholder="Enter Employee Mobile Number" value="{{ old('mobile')}}" >
                                    @if($errors->has('mobile'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                    @enderror
                                </div>                         
                            </div>
                        </div>

                        <div class="well" style="overflow: auto">
                            <h2>Client Business Address</h2>
                            <div class="form-row mb-10">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="name">Flat No/H No.</label>
                                  <input type="text" class="form-control" name="name"  placeholder="Enter Employee name" value="{{ old('name')}}" >
                                    @if($errors->has('name'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="mobile">Building/village </label>
                                    <input type="text" class="form-control" name="mobile"  placeholder="Enter Employee Mobile Number" value="{{ old('mobile')}}" >
                                    @if($errors->has('mobile'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="mobile">P.O</label>
                                    <input type="text" class="form-control" name="mobile"  placeholder="Enter Employee Mobile Number" value="{{ old('mobile')}}" >
                                    @if($errors->has('mobile'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="mobile">P.S.</label>
                                    <input type="text" class="form-control" name="mobile"  placeholder="Enter Employee Mobile Number" value="{{ old('mobile')}}" >
                                    @if($errors->has('mobile'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="mobile">Area</label>
                                    <input type="text" class="form-control" name="mobile"  placeholder="Enter Employee Mobile Number" value="{{ old('mobile')}}" >
                                    @if($errors->has('mobile'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="mobile">District</label>
                                    <input type="text" class="form-control" name="mobile"  placeholder="Enter Employee Mobile Number" value="{{ old('mobile')}}" >
                                    @if($errors->has('mobile'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="mobile">State</label>
                                    <input type="text" class="form-control" name="mobile"  placeholder="Enter Employee Mobile Number" value="{{ old('mobile')}}" >
                                    @if($errors->has('mobile'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="mobile">Pin</label>
                                    <input type="text" class="form-control" name="mobile"  placeholder="Enter Employee Mobile Number" value="{{ old('mobile')}}" >
                                    @if($errors->has('mobile'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                    @enderror
                                </div>   
                                
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="mobile">Trade Name</label>
                                    <input type="text" class="form-control" name="mobile"  placeholder="Enter Employee Mobile Number" value="{{ old('mobile')}}" >
                                    @if($errors->has('mobile'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('mobile') }}</strong>
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
