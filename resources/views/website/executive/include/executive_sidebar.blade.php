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
            <li class="hidden-sm-xs">
                <a href="{{route("executive.deshboard")}}" ><span>Job Transactions</span></a>
            </li>
            <li class="hidden-sm-xs">
                <a href="{{route('executive.wallet_history')}}"><span>Wallet</span></a>
            </li> 
        </ul>
    </nav>
</div> 