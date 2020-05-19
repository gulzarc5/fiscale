<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>FISCALEINDIA</title>
    <link rel="shortcut icon" type="image/png" href="{{asset('web/img/favicon.png')}}">
    <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,600,700%7CPT+Sans:400,400i,700,700i"
        rel="stylesheet">
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
    <style>
        .table-header-cl{
            font-weight: bold !important;
            color:black !important;
        }
    </style>
</head>

<body>

    <section class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 col-sm-12 pt-5 pb-5 m-auto">
                <div class="row upper-headings text-center mb-3">
                        <div class="col-md-12" style="display: flex; justify-content: center;">
                            <img src="{{asset('web/img/logo.png')}}" width="250" alt="logo" style="margin-right: 10px">
                            {{-- <h1>FISCALEINDIA</h1> --}}
                        </div>
                        <div class="col-md-12">
                            <h3>CLIENT REGISTRATION FORM</h3>
                        </div>
                </div>
                @if (isset($client_personal) && !empty($client_personal))
                    <div class="col-md-12 p-0">
                        <div class="row">
                            <div class="col-md-6">
                                    {{-- <h4>REGISTRATION ID : 2164431346</h4> --}}
                            </div>
                            <div class="col-md-6 text-right">
                                <h4>DATE : {{$client_personal->created_at}}</h4>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <tbody>
                            <tr class="text-center">
                                <td colspan="4" class="table-header-cl"><b>CLIENT PERSONAL DETAILS</b></td>
                            </tr>
                            <tr>
                                <th class="table-header-cl">Name</th>
                                <td>{{$client_personal->name}}</td>
                                <th class="table-header-cl">Father's name</th>
                                <td>{{$client_personal->father_name}}</td>
                            </tr>
                            <tr>
                                <th class="table-header-cl">D.O.B</th>
                                <td>{{$client_personal->dob}}</td>
                                <th class="table-header-cl">PAN</th>
                                <td>{{$client_personal->pan}}</td>
                            </tr>
                            <tr>
                                <th class="table-header-cl">Constitution</th>
                                <td>{{$client_personal->constitution}}</td>
                                <th class="table-header-cl">Gender</th>
                                <td>
                                    @if ($client_personal->gender == "M")
                                        Male
                                    @elseif ($client_personal->gender == "F")
                                        Femeale
                                    @else
                                            Other
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="table-header-cl">Mobile</th>
                                <td>{{$client_personal->mobile}}</td>
                                <th class="table-header-cl">Email</th>
                                <td>{{$client_personal->email}}</td>
                            </tr>
                        </tbody>
                    </table>
                @endif
                <table class="table table-bordered">
                    <tbody>
                        @if (isset($res_addr) && !empty($res_addr))
                        <tr class="text-center">
                            <td colspan="4" class="table-header-cl"><b>CLIENT RESIDENTIAL ADDRESS</b></td>
                        </tr>
                        <tr>
                            <th class="table-header-cl">Flat No/H No.</th>
                            <td>{{$res_addr->flat_no}}</td>
                            <th class="table-header-cl">Building/village</th>
                            <td>{{$res_addr->village}}</td>
                        </tr>
                        <tr>
                            <th class="table-header-cl">P.O</th>
                            <td>{{$res_addr->po}}</td>
                            <th class="table-header-cl">P.S</th>
                            <td>{{$res_addr->ps}}</td>
                        </tr>
                        <tr>
                            <th class="table-header-cl">Area</th>
                            <td>{{$res_addr->area}}</td>
                            <th class="table-header-cl">District</th>
                            <td>{{$res_addr->dist}}</td>
                        </tr>
                        <tr>
                            <th class="table-header-cl">State</th>
                            <td>{{$res_addr->state}}</td>
                            <th class="table-header-cl">Pin</th>
                            <td>{{$res_addr->pin}}</td>
                        </tr>
                        @endif
                        @if (isset($res_addr) && !empty($res_addr))
                        <tr>
                            <th colspan="4" class="text-center table-header-cl">CLIENT BUSINESS ADDRESS</th>
                        </tr>
                        <tr>
                                <th class="table-header-cl">Flat No/H No.</th>
                                <td>{{$res_addr->flat_no}}</td>
                                <th class="table-header-cl">Building/village</th>
                                <td>{{$res_addr->village}}</td>
                            </tr>
                            <tr>
                                <th class="table-header-cl">P.O</th>
                                <td>{{$res_addr->po}}</td>
                                <th class="table-header-cl">P.S</th>
                                <td>{{$res_addr->ps}}</td>
                            </tr>
                            <tr>
                                <th class="table-header-cl">Area</th>
                                <td>{{$res_addr->area}}</td>
                                <th class="table-header-cl">District</th>
                                <td>{{$res_addr->dist}}</td>
                            </tr>
                            <tr>
                                <th class="table-header-cl">State</th>
                                <td>{{$res_addr->state}}</td>
                                <th class="table-header-cl">Pin</th>
                                <td>{{$res_addr->pin}}</td>
                            </tr>
                            @if (isset($client_personal) && !empty($client_personal))
                            <tr>
                                <th class="table-header-cl">Trade Name</th>
                                <td colspan="3">{{$client_personal->trade_name}}</td>
                            </tr>
                            @endif
                        @endif
                    </tbody>
                </table>
                @if (isset($job_det) && !empty($job_det))
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th colspan="4" class="text-center table-header-cl">CLIENT JOB DETAIL</th>
                        </tr>
                        <tr>
                            <th class="table-header-cl">Sl No. </th>
                            <th class="table-header-cl">Job Id</th>
                            <th class="table-header-cl">Job Description</th>
                            <th class="table-header-cl">Date</th>
                        </tr>
                        @php
                            $job_count = 1 ; 
                        @endphp
                        @foreach ($job_det as $item)
                            <tr>
                                <td>{{$job_count++}}</td>
                                <td>{{$item->job_id}}</td>
                                <td>{{$item->job_desc}}</td>
                                <td>{{$item->created_at}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </section>

    <script src="{{asset('web/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('web/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('web/plugins/waypoints/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('web/plugins/waypoints/sticky.min.js')}}"></script>
    <script src="{{asset('web/plugins/swiper/swiper.min.js')}}"></script>
    <script src="{{asset('web/plugins/parsley/parsley.min.js')}}"></script>
    <script src="{{asset('web/plugins/color-switcher/color-switcher.js')}}"></script>
    <script src="{{asset('web/plugins/retinajs/retina.min.js')}}"></script>
    <script src="{{asset('web/plugins/isotope/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('web/plugins/ui-slider/jquery-ui.min.js')}}"></script>
    <script src="{{asset('web/plugins/light-box/lightbox.min.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBK9f7sXWmqQ1E-ufRXV3VpXOn_ifKsDuc"></script>
    <script src="{{asset('web/js/menu.min.js')}}"></script>
    <script src="{{asset('web/js/scripts.js')}}"></script>

    <script type="text/javascript">
    window.print();
    window.onafterprint = function(event) {
        window.close();
    };
    </script>
</body>

</html>