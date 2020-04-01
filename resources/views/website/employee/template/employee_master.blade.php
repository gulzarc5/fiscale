@include('website.employee.include.employee_header') 
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
                <div class="col-xl-6 col-lg-6 col-md-8 col-sm-7 col-5">
                    <div class="menu--inner-area clear-fix">
                        <div class="menu-wraper">
                            <nav class="mobile-panel-nav">
                                <div class="header-menu pt-sans">
                                    <ul>
                                        <li>
                                            <a href="{{route("employee.deshboard")}}" ><span>Open Jobs</span></a>
                                        </li>
                                        <li>
                                            <a href="{{route('employee.close_job_form')}}"><span>Closed Jobs</span></a>
                                        </li>
                                        <li class="dropdown hidden-til-md">
                                            <a>
                                                 Search<i class="fa fa-caret-down"></i>
                                            </a>
                                            <ul>
                                                <li>
                                                    <a href="{{route('employee.client_search_form')}}"></i><span>Client Search</span></a>
                                                </li>
                                                <li>
                                                    <a href="{{route('employee.job_search_form')}}"></i><span>Jobs Search</span></a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown hidden-til-md">
                                            <a>
                                                 Transaction<i class="fa fa-caret-down"></i>
                                            </a>
                                            <ul>
                                                <li>
                                                    <a href="{{route('employee.job_transaction_form')}}"><span> Job </span></a>
                                                </li>
                                                <li>
                                                    <a href="{{route('employee.job_wallet_history')}}"><span> Wallet </span></a>
                                                </li>
                                            </ul>
                                        </li>                                        
                                        <li class=" hidden-til-md">
                                            <a href="{{route('employee.employee_report_form')}}"></i>Report</span></a>
                                        </li>
                                        <li class="hidden-sm-xs"><a href="{{route('employee.job_wallet_history')}}">Wallet</a></li>
                                        <li>
                                        	<a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout <i style="font-size: 15px;" class="fa fa-power-off"></i></a>
							                <form id="logout-form" action="{{ route('employee.logout') }}" method="POST" style="display: none;">
						                        @csrf
						                    </form>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-2 col-md-4 col-sm-5 col-7 hidden-sm-xs">
                    <div class="logo">
                        <a style="float: right;"> <img src="{{asset('web/img/logo2.png')}}" data-rjs="2" alt="fiscaleIndia"> </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<section class="pt-50 pb-60">
    <div class="container" style="margin-top: 10px;">
        <div class="row">
            @include('website.employee.include.employee_sidebar')
            @yield('content')
        </div>
    </div>
</section>
	 
@include('website.include.footer')
@yield('script')