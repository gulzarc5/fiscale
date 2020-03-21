@extends('admin.template.admin_master')

@section('content')
<style>
    .select2-selection {
  height: 34px !important;
}
</style>

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Add New Service Point</h2>
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
                        {{ Form::open(['method' => 'post','route'=>'admin.add_branch']) }}

                         <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                    <label for="name">Select Executive</label>
                                    <select class="form-control executive" name="executive_id">
                                        <option value="">--Select Executive--</option>
                                        @if (isset($executive) && !empty($executive))
                                            @foreach ($executive as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        @endif
                                        
                                    </select>
                                      @if($errors->has('name'))
                                          <span class="invalid-feedback" role="alert" style="color:red">
                                              <strong>{{ $errors->first('name') }}</strong>
                                          </span>
                                      @enderror
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                  <label for="name">Service Point Name</label>
                                  <input type="text" class="form-control" name="name"  placeholder="Enter Service Point name" value="{{ old('name')}}" >
                                    @if($errors->has('name'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="mobile">Mobile Number</label>
                                    <input type="text" class="form-control" name="mobile"  placeholder="Enter SP Mobile Number" value="{{ old('mobile')}}" >
                                    @if($errors->has('mobile'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" name="email"  placeholder="Enter SP Email Id" value="{{ old('email')}}" >
                                    @if($errors->has('email'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @enderror
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

                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="state">State</label>
                                    <input type="text" class="form-control" name="state"  placeholder="Enter State Name" value="{{ old('state')}}" >
                                    @if($errors->has('state'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('state') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" name="city"  placeholder="Enter City Name" value="{{ old('city')}}" >
                                    @if($errors->has('city'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="pin">Pin</label>
                                    <input type="number" class="form-control" name="pin"  placeholder="Enter Pin Code" value="{{ old('pin')}}" >
                                    @if($errors->has('pin'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('pin') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                    <label for="address">Address</label>
                                    <textarea type="text" class="form-control" name="address">{{ old('address')}}</textarea>
                                    @if($errors->has('address'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('address') }}</strong>
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
      });
   </script>
@endsection
