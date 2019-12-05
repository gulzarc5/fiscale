@extends('website.template.master')
<!-- Head & Header Section -->
@section('content') 
<section class="pb-120">
    <center style="padding-top: 20px;"><h3>Welcome To Employee Dashboard</h3></center><hr>
        <div class="container" style="margin-top: 20px;">
           <div class="row">
            @include('website.employee.include.employee_sidebar')
            @yield('main_content')	
        </div>
    </div>
</section>
@endsection