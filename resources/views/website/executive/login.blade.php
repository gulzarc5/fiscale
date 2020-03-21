@extends('website.template.master')
<!-- Head & Header Section -->
@section('content') 

<div class="container">
	<div class="login-form mx-auto d-block w-100">
		<div class="page-header text-center">
			<h1>Marketing Executive Login</h1>
		</div>
		{{ Form::open(array('route' => 'executive.login', 'method' => 'post')) }}
			<div class="form-group">
				<div class="control-label">
					<label id="username-lbl" for="username" class="required invalid">Email<span class="star">&nbsp;*</span></label>
				</div>
				<div class="controls">
				<input name="email" id="username" class="theme-input-style form-control" aria-required="true" autofocus="" type="text" value="{{old('email')}}" >
				</div>
				@if ($message = Session::get('login_error'))
					<span style="color:red" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@endif
				@error('email')
					<span style="color:red" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>
			<div class="form-group">
				<div class="control-label">
					<label id="password-lbl" for="password" class="required">Password<span class="star">&nbsp;*</span></label>
				</div>
				<div class="controls">
					<input name="password" id="password" class="theme-input-style form-control"  aria-required="true" type="password">
				</div>
				@error('password')
					<span style="color:red" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror
			</div>
			<div class="d-flex justify-content-between">
				<div class="form-group d-flex justify-content-start" style="width: 100%;">
					<div class="controls" style="width: 100%;">
						<button type="submit" class="btn btn-primary rounded" style="width: 100%;">Log in</button>
					</div>
				</div>
			</div>
		{{ Form::close() }}
	</div>
</div>

@endsection