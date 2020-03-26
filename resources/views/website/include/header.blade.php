<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>FISCALEINDIA</title>
    <link rel="shortcut icon" type="image/png" href="{{asset('web/img/favicon.png')}}">
    <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,600,700%7CPT+Sans:400,400i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('web/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('web/plugins/swiper/swiper.min.css')}}">
    <link rel="stylesheet" href="{{asset('web/plugins/color-switcher/color-switcher.css')}}">
    <link rel="stylesheet" href="{{asset('web/plugins/ui-slider/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('web/plugins/light-box/lightbox.min.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/shop-style.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/colors/theme-color-1.css')}}">
    <link rel="stylesheet" href="{{asset('web/css/custom.css')}}">
    <link href="{{asset('select2/css/select2.css')}}" rel="stylesheet" />

</head>
<body>
    <header class="header">
        <div class="main-header light-bg">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-2 col-md-4 col-sm-5 col-7">
                        <div class="logo" data-animate="fadeInUp" data-delay=".65">
                            <a href="{{route('website.web.index')}}"> <img src="{{asset('web/img/logo.png')}}" data-rjs="2" alt="fiscaleIndia"> </a>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-10 col-md-8 col-sm-7 col-5">
                        <div class="menu--inner-area clear-fix">
                            <div class="menu-wraper">
                                <nav data-animate="fadeInUp" data-delay=".8">
                                    <div class="header-menu pt-sans">
                                        <ul>
                                            <li class="active"><a href="{{route('website.web.index')}}">Home</a></li>
                                            <li><a href="{{route('website.web.contact')}}">Service</a></li>
                                            <li> <a href="#">Login <i class="fa fa-caret-down"></i></a>
                                                <ul>
                                                    <li><a href="{{route('employee.loginForm')}}">Member login<i style="font-size: 16px; padding-left: 5px;" class="fa fa-sign-in"></i></a></li>
                                                    <li><a href="{{route('branch.loginForm')}}">SP login<i style="font-size: 16px; padding-left: 5px;" class="fa fa-sign-in"></i></a></li>
                                                    <li><a href="{{route('executive.loginForm')}}">ME login<i style="font-size: 16px; padding-left: 5px;" class="fa fa-sign-in"></i></a></li>
                                                </ul>
                                            </li>
                                            <li><a href="{{route('website.web.contact')}}">Contact</a></li>
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