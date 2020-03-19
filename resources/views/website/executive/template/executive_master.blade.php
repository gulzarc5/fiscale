@include('website.executive.include.executive_header') 
<!-- Head & Header Section -->

<section>
    <div class="container" style="margin-top: 10px;">
        <h3>Welcome To Executive Member Dashboard</h3><hr>
        <div class="row">
            @include('website.executive.include.executive_sidebar')
            @yield('content')
        </div>
    </div>
</section>
	 
@include('website.include.footer')
@yield('script')