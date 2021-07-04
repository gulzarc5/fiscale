@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Edit Executive</h2>
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
                    @if (isset($executive) && !empty($executive))
                        <div class="x_content">
                            {{ Form::open(['method' => 'post','route'=>'admin.update_executive']) }}

                            <input type="hidden" name="id" value="{{$executive->id}}" >
                            <div class="well" style="overflow: auto">
                                <div class="form-row mb-10">
                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                      <label for="name">Executive Name</label>
                                      <input type="text" class="form-control" name="name"  placeholder="Enter Executive name" value="{{ $executive->name }}" >
                                        @if($errors->has('name'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
    
                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <label for="mobile">Mobile Number</label>
                                        <input type="text" class="form-control" name="mobile"  placeholder="Enter Executive Mobile Number" value="{{ $executive->mobile }}" >
                                        @if($errors->has('mobile'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('mobile') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row mb-10">   
                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <label for="pin">Pin</label>
                                        <input type="number" class="form-control" name="pin"  placeholder="Enter Pin Code" value="{{ $executive->pin }}" >
                                        @if($errors->has('pin'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('pin') }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <label for="size_wearing">Gender</label>
                                        <p style="padding-bottom: 6px; margin-top: 8px;">
                                            @if ($executive->gender == 'M')
                                                Male:
                                                <input type="radio" class="flat" name="gender" id="genderM" value="M" checked=""/> 
                                                FeMale:
                                                <input type="radio" class="flat" name="gender" id="genderF" value="F" />
                                            @else
                                                Male:
                                                <input type="radio" class="flat" name="gender" id="genderM" value="M"   /> 
                                                FeMale:
                                                <input type="radio" class="flat" name="gender" id="genderF" value="F" checked=""/>
                                          @endif
                                        </p>
                                        @if($errors->has('gender'))
                                              <span class="invalid-feedback" role="alert" style="color:red">
                                                  <strong>{{ $errors->first('gender') }}</strong>
                                              </span>
                                        @enderror
                                    </div> 
                                   
                                </div>
                                <div class="form-row mb-10"> 

                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <label for="state">State</label>
                                        <input type="text" class="form-control" name="state"  placeholder="Enter State Name" value="{{ $executive->state }}" >
                                        @if($errors->has('state'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('state') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" name="city"  placeholder="Enter City Name" value="{{ $executive->city }}" >
                                        @if($errors->has('city'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('city') }}</strong>
                                            </span>
                                        @enderror
                                    </div>                                 
    
                                    
                                </div>
                                <div class="form-row mb-10"> 
                                    <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                        <label for="address">Address</label>
                                        <textarea type="text" class="form-control" name="address">{{ $executive->address }}</textarea>
                                        @if($errors->has('address'))
                                            <span class="invalid-feedback" role="alert" style="color:red">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::submit('Save', array('class'=>'btn btn-success')) }}
                                <a href="{{route('admin.executive_list')}}" class="btn btn-warning">Back</a>
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
