@include('website.branch.include.branch_header') 

<section class="pb-120">
    <div class="container" style="margin-top: 5px;">
        <h3>Welcome To Service Point Dashboard</h3><hr>
        <div class="row">
            @include('website.branch.include.branch_sidebar')
            @yield('content')
        </div>
    </div>
</section>
	 
@include('website.include.footer')
@yield('script')