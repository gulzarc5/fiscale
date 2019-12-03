<div class="col-md-2">
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
            <li>
                <a href="#eins" data-toggle="collapse" class="collapsed">
                    <span><i class="fa fa-user-circle-o"></i>User</span>
                </a>
                <ul class="collapse" id="eins">
                <li>
                    <a href="branch_home.php"><span><i class="fa fa-plus"></i> Add User</span></a>
                </li>
                <li>
                    <a href="user_list.php"><span><i class="fa fa-list"></i> User List</span></a>
                </li>
                </ul>
            </li>
            <li>
                <a href="branch_track.php"><span><i class="fa fa-map-marker"></i>Track</span></a>
            </li>
            <li>
                <a href="#eins2" data-toggle="collapse" class="collapsed">
                    <span><i class="fa fa-suitcase"></i>Job</span>
                </a>
                <ul class="collapse" id="eins2">
                    <li>
                        <a href="branch_add_job.php">
                            <span><i class="fa fa-plus"></i>Add Job</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <span><i class="fa fa-power-off"></i>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('branch.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
            </li>
        </ul>
    </nav>
</div>