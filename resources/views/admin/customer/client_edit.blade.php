@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Edit Client Information</h2>
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
                        {{ Form::open(['method' => 'post','route'=>'admin.client_update']) }}
                        @if (isset($client) && !empty($client))
                        <input type="hidden" name="client_id" value="{{$client->id}}">
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
                                        <label for="gender">Gender</label>
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
                                        <input type="text" class="form-control" name="email"  placeholder="Enter Client Email Id" value="{{ $client->email }}" >
                                        @if($errors->has('email'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @enderror
                                    </div>                             
                                </div>
                            </div>                            
                        @endif
                        
                        @if (isset($residential) && !empty($residential))
                        <input type="hidden" name="res_addr_id" value="{{$residential->id}}">
                        <div class="well" style="overflow: auto">                            
                            <h2>Client Residential Address</h2>
                            <div class="form-row mb-10">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="flat_addr">Flat No/H No.</label>
                                  <input type="text" class="form-control" name="flat_addr"  placeholder="Enter Flat No/H No." value="{{ $residential->flat_no }}" >
                                    @if($errors->has('flat_addr'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('flat_addr') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="village_addr">Building/village </label>
                                    <input type="text" class="form-control" name="village_addr"  placeholder="Enter Building/Village" value="{{ $residential->village}}" >
                                    @if($errors->has('village_addr'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('village_addr') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="po_addr">P.O</label>
                                    <input type="text" class="form-control" name="po_addr"  placeholder="Enter Post Office Name" value="{{ $residential->po}}" >
                                    @if($errors->has('po_addr'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('po_addr') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="ps_addr">P.S.</label>
                                    <input type="text" class="form-control" name="ps_addr"  placeholder="Enter Police Station Name" value="{{ $residential->ps}}" >
                                    @if($errors->has('ps_addr'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('ps_addr') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="area_addr">Area</label>
                                    <input type="text" class="form-control" name="area_addr"  placeholder="Enter Area Name" value="{{ $residential->area}}" >
                                    @if($errors->has('area_addr'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('area_addr') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="district_addr">District</label>
                                    <input type="text" class="form-control" name="district_addr"  placeholder="Enter District" value="{{ $residential->dist}}" >
                                    @if($errors->has('district_addr'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('district_addr') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="state_addr">State</label>
                                    <input type="text" class="form-control" name="state_addr"  placeholder="Enter State" value="{{ $residential->state}}" >
                                    @if($errors->has('state_addr'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('state_addr') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="pin_addr">Pin</label>
                                    <input type="number" class="form-control" name="pin_addr"  placeholder="Enter Pin Number" value="{{ $residential->pin}}" >
                                    @if($errors->has('pin_addr'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('pin_addr') }}</strong>
                                        </span>
                                    @enderror
                                </div>                         
                            </div>
                        </div>
                        @endif

                        @if (isset($business) && !empty($business))
                        <input type="hidden" name="business_addr_id" value="{{$business->id}}">
                        <div class="well" style="overflow: auto">
                            <h2>Client Business Address</h2>
                            <div class="form-row mb-10">
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                  <label for="flat">Flat No/H No.</label>
                                  <input type="text" class="form-control" name="flat"  placeholder="Enter Employee name" value="{{ $business->flat_no}}" >
                                    @if($errors->has('flat'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('flat') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="village">Building/village </label>
                                    <input type="text" class="form-control" name="village"  placeholder="Enter Employee Mobile Number" value="{{ $business->village}}" >
                                    @if($errors->has('village'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('village') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="po">P.O</label>
                                    <input type="text" class="form-control" name="po"  placeholder="Enter Employee Mobile Number" value="{{ $business->po}}" >
                                    @if($errors->has('po'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('po') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="ps">P.S.</label>
                                    <input type="text" class="form-control" name="ps"  placeholder="Enter Employee Mobile Number" value="{{ $business->ps}}" >
                                    @if($errors->has('ps'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('ps') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="area">Area</label>
                                    <input type="text" class="form-control" name="area"  placeholder="Enter Employee Mobile Number" value="{{ $business->area}}" >
                                    @if($errors->has('area'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('area') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="district">District</label>
                                    <input type="text" class="form-control" name="district"  placeholder="Enter Employee Mobile Number" value="{{ $business->dist}}" >
                                    @if($errors->has('district'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('district') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control" name="state"  placeholder="Enter Employee Mobile Number" value="{{$business->state}}" >
                                    @if($errors->has('state'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('state') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="pin">Pin</label>
                                    <input type="number" class="form-control" name="pin"  placeholder="Enter Employee Mobile Number" value="{{ $business->pin}}" >
                                    @if($errors->has('pin'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('pin') }}</strong>
                                        </span>
                                    @enderror
                                </div>   
                                
                                <div class="col-md-4 col-sm-12 col-xs-12 mb-3">
                                    <label for="trade_name">Trade Name</label>
                                    <input type="text" class="form-control" name="trade_name"  placeholder="Enter Trade Name" value="{{ $client->trade_name}}" >
                                    @if($errors->has('trade_name'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('trade_name') }}</strong>
                                        </span>
                                    @enderror
                                </div> 
                            </div>
                        </div>
                        @endif

                        <div class="form-group">
                            {{ Form::submit('Save', array('class'=>'btn btn-success')) }}
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
