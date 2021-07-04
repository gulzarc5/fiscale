@extends('website.branch.template.branch_master')
<!-- Head & Header Section -->
@section('content')
<div class="col p-t col-md-10">
    <div class="contact-form contact-page-form animated fadeInUp" data-animate="fadeInUp"
        style="animation-duration: 0.6s; animation-delay: 0.1s; margin-top: 70px;">
        @if (isset($pan) && isset($client_id) && !empty($pan) && !empty($client_id))
            <div class="alert alert-success text-center"><h2>Client Registered Successfully</h2></div>
            <div class="text-center"><h3>Client Pan No : {{$pan}}</h3></div>
            <div class="text-center">
                <a target="_blank" href="{{route('branch.registration_print',['user_id'=>encrypt($client_id)])}}"><button class="btn btn-primary rounded" type="button">PRINT</button></a>
            </div>
        @else
            <div class="alert alert-danger">Something Went Wrong Please Try Again</div>
        @endif
    </div>
</div>
@endsection
