@include('website.branch.include.branch_header') 
<header class="header">
    <div class="main-header light-bg">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-2 col-md-4 col-sm-5 col-7">
                    <div class="logo">
                        <a> <img src="{{asset('web/img/logo.png')}}" data-rjs="2" alt="fiscaleIndia45"> </a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-8 col-sm-7 col-5">
                    <div class="menu--inner-area clear-fix">
                        <div class="menu-wraper">
                            <nav class="mobile-panel-nav">
                                <div class="header-menu pt-sans">
                                    <ul>
                                        <li class="dropdown hidden-til-md">
                                            <a href="{{route('branch.deshboard')}}"><span> Open Job</span></a>
                                        </li>
                                        <li class="dropdown hidden-til-md">
                                            <a>
                                               Client<i class="fa fa-caret-down"></i>
                                            </a>
                                            <ul>
                                                <li>
                                                    <a href="{{route('branch.add_client')}}"><span> Add Client</span></a>
                                                </li>
                                                <li>
                                                    <a href="{{route('branch.user_list')}}"><span> Client List</span></a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown hidden-til-md">
                                            <a>
                                                Job<i class="fa fa-caret-down"></i>
                                            </a>
                                            <ul>
                                                <li>
                                                    <a href="{{route('branch.search_client_add_job')}}">
                                                        <span> Add Job</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown hidden-til-md">
                                            <a>
                                                 Search<i class="fa fa-caret-down"></i>
                                            </a>
                                            <ul>
                                                <li>
                                                    <a href="{{route('branch.client_search_form')}}"><span> Client Search</span></a>
                                                </li>
                                                <li>
                                                    <a href="{{route('branch.track_job_form')}}"><span> Job Search</span></a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown hidden-til-md">
                                            <a href="{{route('branch.client_report_form')}}"><span> Report </span></a>
                                        </li>

                                        <li class="hidden-sm-xs"><a href="{{route('branch.add_client')}}">Add Client</a></li>
                                        <li class="hidden-sm-xs"><a href="{{route('branch.search_client_add_job')}}">Add Job</a></li>
                                        <li><a href="{{route('branch.wallet_history')}}">Wallet</a></li>
                                        <li>
                                        	<a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout <i style="font-size: 15px;" class="fa fa-power-off"></i></a>
							                <form id="logout-form" action="{{ route('branch.logout') }}" method="POST" style="display: none;">
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
                        <a style="float: right;"> <img src="{{asset('web/img/connect-logo.png')}}" data-rjs="2" alt="fiscaleIndia"> </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<section class="pt-50 pb-60">
    <div class="container" style="margin-top: 5px;">
        <div class="row">
            @include('website.branch.include.branch_sidebar')
            @yield('content')
        </div>
    </div>
</section>
	 
@include('website.include.footer')
@yield('script')