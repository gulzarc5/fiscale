<div class="col-md-2">
    <nav class="my" id="my">
        <ul>
            <li>
                <a class="form-user-box" style="text-align: center; padding: 5px;">
                    <img src="{{asset('web/img/user.png')}}" width="50" style="display: block; margin: auto;">
                    <span class="text-capitalize">
                        @if (Auth::guard('employee'))
                            {{Auth::guard('employee')->user()->name}}
                        @endif
                    </span>
                </a>
            </li>
            <li>
                <a href="{{route("employee.deshboard")}}" ><span>Open Jobs</span></a>
            </li>
            <li>
                <a href="{{route('employee.close_job_form')}}"><span>Closed Jobs</span></a>
            </li>
            <li>
                <a href="{{route('employee.job_search_form')}}"></i>Search Jobs</span></a>
            </li>
            <li>
                <a href="{{route('employee.client_search_form')}}"></i>Search Client</span></a>
            </li>
            <li>
                <a href="#eins2" data-toggle="collapse" class="collapsed">
                    <span> Transaction</span>
                </a>
                <ul class="collapse" id="eins2">
                    <li><a href="{{route('employee.job_transaction_form')}}">
                            <span> Job </span>
                    </a></li>
                    <li><a href="#">
                        <span> Wallet </span>
                </a></li>
                </ul>
            </li>
            <li>
                <a href="{{route('employee.employee_report_form')}}"></i>Report</span></a>
            </li>
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span><i class="fa fa-power-off"></i>Logout</span></a>
                <form id="logout-form" action="{{ route('employee.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
</div> 