@include('website.executive.include.executive_header') 
<!-- Head & Header Section -->
<header class="header">
    <div class="main-header light-bg">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-2 col-md-4 col-sm-5 col-7">
                    <div class="logo">
                        <a> <img src="{{asset('web/img/logo.png')}}" data-rjs="2" alt="fiscaleIndia"> </a>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-10 col-md-8 col-sm-7 col-5">
                    <div class="menu--inner-area clear-fix">
                        <div class="menu-wraper">
                            <nav class="mobile-panel-nav">
                                <div class="header-menu pt-sans">
                                    <ul>
                                        <li class="hidden-til-md">
                                            <a href="{{route("executive.deshboard")}}" ><span>Job Transactions</span></a>
                                        </li>
                                        <li><a href="{{route('executive.wallet_history')}}">Wallet</a></li>
                                        <li>
                                        	<a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout <i style="font-size: 15px;" class="fa fa-power-off"></i></a>
							                <form id="logout-form" action="{{ route('executive.logout') }}" method="POST" style="display: none;">
						                        @csrf
						                    </form>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<section class="pt-50 pb-60">
    <div class="container" style="margin-top: 10px;">
        <div class="row">
            @include('website.executive.include.executive_sidebar')
            @yield('content')
        </div>
    </div>
</section>
	 
@include('website.include.footer')
@yield('script')