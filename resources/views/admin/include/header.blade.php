<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('web/img/favicon.png')}}" type="image/ico" />

    <title>CONNECT</title>
    <link rel="icon" href="{{asset('web/img/favicon.png')}}" type="image/icon type">


    <!-- Bootstrap -->
    <link href="{{asset('admin/src_files/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('admin/src_files/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('admin/src_files/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{asset('admin/src_files/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
  
    <!-- bootstrap-progressbar -->
    <link href="{{asset('admin/src_files/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{asset('admin/src_files/vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('admin/src_files/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    {{-- Datatables --}}
     <link href="{{asset('admin/src_files/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/src_files/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/src_files/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/src_files/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/src_files/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('select2/css/select2.css')}}" rel="stylesheet" />

    <link href="{{asset('admin/src_files/build/css/custom.min.css')}}" rel="stylesheet">
    <link href="{{asset('select2/css/select2.css')}}" rel="stylesheet" />
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">

              <a href="{{route('admin.deshboard')}}" class="site_title">
                <img src="{{asset('web/img/logo.png')}}" height="50" style=" width: 92%;margin-left:0px;">
              </a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_info">
                <span>Welcome,<b>Admin</b></span>
                
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="{{ route('admin.deshboard')}}"><i class="fa fa-home"></i> Home </span></a>
                  </li>
                  <li><a><i class="fa fa-edit"></i> Member <span class="fa fa-chevron-down"></span></a>
                     <ul class="nav child_menu">
                      <li class="sub_menu"><a href="{{route('admin.add_employee_form')}}">Add New Member</a>
                      </li>
                      <li class="sub_menu"><a href="{{route('admin.employee_list')}}">Member List</a>
                      </li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-edit"></i> Marketing Executive <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                     <li class="sub_menu"><a href="{{route('admin.add_executive_form')}}">Add New Executive</a>
                     </li>
                     <li class="sub_menu"><a href="{{route('admin.executive_list')}}">Executive List</a>
                     </li>
                   </ul>
                 </li>

                  <li><a><i class="fa fa-desktop"></i>Service Point<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('admin.add_branch_form')}}">Add New SP</a></li>
                      <li><a href="{{route('admin.branch_list')}}">SP List</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-desktop"></i>Client<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('admin.customer_list')}}">Client List</a></li>
                    </ul>
                  </li>

                  <li><a><i class="fa fa-desktop"></i>Job<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('admin.job_list')}}">Pending Job List</a></li>
                      <li><a href="{{route('admin.working_job_list')}}">Assigned Job List</a></li>     
                      <li><a href="{{route('admin.empRejected_job_list')}}">Rejected Job List</a></li>                      
                      <li><a href="{{route('admin.problem_job_list')}}">Correction Job List</a></li>                                            
                      <li><a href="{{route('admin.completed_job_list')}}">Complete Job List</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-desktop"></i>Wallet Report<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('admin.employee_job_report_form')}}">Employee Wallet</a></li>
                      <li><a href="{{route('admin.executive_job_report_form')}}">Marketing Executive</a></li>
                    </ul>
                  </li>                 

                  <li><a><i class="fa fa-desktop"></i>Report<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('admin.users_report_form')}}">Users</a></li>
                      <li><a href="{{route('admin.job_report_form')}}">Job</a></li>
                      <li><a href="{{route('admin.other_report_form')}}">Other Report</a></li>
                    </ul>
                  </li>
                  
                  
                  <li><a href="{{route('admin.contact_mail')}}"><i class="fa fa-edit"></i>Contact Mail</a></li>
                  <li><a href="{{route('admin.change_password_form')}}"><i class="fa fa-key" aria-hidden="true"></i>Change Password</a></li>

                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="#">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
             <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
              
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->