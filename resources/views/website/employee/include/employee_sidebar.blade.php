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
            <li class="hidden-sm-xs">
                <a href="{{route("employee.deshboard")}}" ><span>Open Jobs</span></a>
            </li>
            <li class="hidden-sm-xs">
                <a href="{{route('employee.close_job_form')}}"><span>Closed Jobs</span></a>
            </li>
            <li class="hidden-sm-xs">
                <a href="#eins3" data-toggle="collapse" class="collapsed">
                    <span> Search</span>
                </a>
                <ul class="collapse" id="eins3">
                    <li>
                        <a href="{{route('employee.client_search_form')}}"></i><span>Client Search</span></a>
                    </li>
                    <li>
                        <a href="{{route('employee.job_search_form')}}"></i><span>Jobs Search</span></a>
                    </li>
                </ul>
            </li>    
            <li class="hidden-sm-xs">
                <a href="#eins2" data-toggle="collapse" class="collapsed">
                    <span> Transaction</span>
                </a>
                <ul class="collapse" id="eins2">
                    <li>
                        <a href="{{route('employee.job_transaction_form')}}"><span> Job </span></a>
                    </li>
                    <li>
                        <a href="{{route('employee.job_wallet_history')}}"><span> Wallet </span></a>
                    </li>
                </ul>
            </li>
            <li class="hidden-sm-xs">
                <a href="{{route('employee.employee_report_form')}}"></i>Report</span></a>
            </li>
        </ul>
    </nav>
</div> 