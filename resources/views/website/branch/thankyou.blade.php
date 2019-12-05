@extends('website.branch.template.branch_master')
<!-- Head & Header Section -->
@section('content')
<div class="col p-t col-md-10">
    <div class="contact-form contact-page-form animated fadeInUp" data-animate="fadeInUp"
        style="animation-duration: 0.6s; animation-delay: 0.1s; margin-top: 70px;">
        @if (Session::has('message'))
        <div class="alert alert-success text-center"><h2>{{ Session::get('message') }}</h2></div>
        <div class="text-center"><h3>Your Resgistration ID is: 1642336875</h3></div>
        <div class="text-center">
            <a href="{{route('branch.registration_print')}}"><button class="btn btn-primary rounded">PRINT</button></a>
            </div>
        @endif
        @if (Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif
        @if($errors->any())
        {!! implode('', $errors->all('<p style="color:red">:message</p>')) !!}
        @endif
    </div>
</div>
@endsection
