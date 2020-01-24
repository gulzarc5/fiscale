@include('website.employee.include.employee_header') 
<!-- Head & Header Section -->

<section class="pb-120">
    <div class="container" style="margin-top: 10px;">
        <h3>Welcome To Employee Deshboard</h3><hr>
        <div class="row">
            @include('website.employee.include.employee_sidebar')
            @yield('content')
        </div>
    </div>
</section>
	 
@include('website.include.footer')
@yield('script')