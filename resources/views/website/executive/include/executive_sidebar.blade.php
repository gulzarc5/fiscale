<div class="col-md-2">
    <nav class="my" id="my">
        <ul>
            <li>
                <a class="form-user-box" style="text-align: center; padding: 5px;">
                    <img src="{{asset('web/img/user.png')}}" width="50" style="display: block; margin: auto;">
                    <span class="text-capitalize">
                        @if (Auth::guard('executive'))
                            {{Auth::guard('executive')->user()->name}}
                        @endif
                    </span>
                </a>
            </li>
            <li>
                <a href="{{route("executive.deshboard")}}" ><span>Wallet History</span></a>
            </li>
            <li>
                <a href="{{route('employee.close_job_form')}}"><span>Transaction History</span></a>
            </li>
            
            <li>
                <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span><i class="fa fa-power-off"></i>Logout</span></a>
                <form id="logout-form" action="{{ route('executive.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
</div> 