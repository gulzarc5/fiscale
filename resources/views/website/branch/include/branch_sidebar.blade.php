

<div class="col-md-2 p-s0">
    <nav class="my">
        <ul>
            <li>
                <a class="form-user-box" style="text-align: center; padding: 5px;">
                <img src="{{asset('web/img/user.png')}}" width="50" style="display: block; margin: auto;">
                <span class="text-capitalize">
                    @if (Auth::guard('branch'))
                        {{Auth::guard('branch')->user()->name}}
                    @endif
                </span>
                </a>
            </li>
            <li class="hidden-sm-xs">
                <a href="{{route('branch.deshboard')}}"><span> Open Job</span></a>
            </li>
            <li class="hidden-sm-xs">
                <a href="#eins" data-toggle="collapse" class="collapsed">
                    <span> Client</span>
                </a>
                <ul class="collapse" id="eins">
                    <li>
                        <a href="{{route('branch.add_client')}}"><span> Add Client</span></a>
                    </li>
                    <li>
                        <a href="{{route('branch.user_list')}}"><span> Client List</span></a>
                    </li>
                </ul>
            </li>
            <li class="hidden-sm-xs">
                <a href="#eins2" data-toggle="collapse" class="collapsed">
                    <span> Job</span>
                </a>
                <ul class="collapse" id="eins2">
                    <li>
                        <a href="{{route('branch.search_client_add_job')}}">
                            <span> Add Job</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="hidden-sm-xs">
                <a href="#eins4" data-toggle="collapse" class="collapsed">
                    <span> Search</span>
                </a>
                <ul class="collapse" id="eins4">
                    <li>
                        <a href="{{route('branch.client_search_form')}}"><span> Client Search</span></a>
                    </li>
                    <li>
                        <a href="{{route('branch.track_job_form')}}"><span> Job Search</span></a>
                    </li>
                </ul>
            </li>
            <li class="hidden-sm-xs">
                <a href="{{route('branch.client_report_form')}}"><span> Report </span></a>
            </li>
            {{-- <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <span><i class="fa fa-power-off"></i>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('branch.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
            </li> --}}            
        </ul>
    </nav>
</div>