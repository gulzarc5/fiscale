@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Client Detail</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row vpanel">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>PERSONAL DETAIL </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <section class="content invoice">
                            {{-- <div class="row">
                                <div class="col-xs-12 invoice-header">
                                    <h3>
                                       Client Tracking ID: <span> 0FGS45GHY56D</span>
                                    </h3>
                                </div>
                            </div> --}}
                            <!-- info row -->
                            @if (isset($client_personal) && !empty($client_personal))
                                <div class="row invoice-info">
                                    <div class="col-sm-3 invoice-col">
                                        <address class="font-15">
                                        <strong>Name : </strong>{{$client_personal->name}}
                                        </address>
                                    </div>
                                    <div class="col-sm-3 invoice-col">
                                        <address class="font-15">
                                        <strong>Father Name : </strong>{{$client_personal->name}}
                                        </address>
                                    </div>
                                    <div class="col-sm-3 invoice-col">
                                        <address class="font-15">
                                        <strong>Date of Birth : </strong>{{$client_personal->dob}}
                                        </address>
                                    </div>
                                    <div class="col-sm-3 invoice-col">
                                        <address class="font-15">
                                        <strong>Pan : </strong>{{$client_personal->pan}}
                                        </address>
                                    </div>
                                    <div class="col-sm-3 invoice-col">
                                        <address class="font-15">
                                        <strong>Constitution : </strong>{{$client_personal->constitution}}
                                        </address>
                                    </div>
                                    <div class="col-sm-3 invoice-col">
                                        <address class="font-15">
                                        <strong>Gender : </strong>
                                        @if ($client_personal->gender == 'M')
                                            Male
                                        @else
                                            Female
                                        @endif
                                        </address>
                                    </div>
                                    <div class="col-sm-3 invoice-col">
                                        <address class="font-15">
                                        <strong>Mobile : </strong>{{$client_personal->mobile}}
                                        </address>
                                    </div>
                                    <div class="col-sm-3 invoice-col">
                                        <address class="font-15">
                                        <strong>Email : </strong>{{$client_personal->email}}
                                        </address>
                                    </div>
                                    <div class="col-sm-3 invoice-col">
                                        <address class="font-15">
                                        <strong>Trade Name : </strong>{{$client_personal->trade_name}}
                                        </address>
                                    </div>
                                </div>
                            @endif
                            <!-- /.row -->
                        </section>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
               <div class="x_panel">
                  <div class="x_title">
                    <h2>RESDENTIAL ADDRESS</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    @if (isset($res_addr) && !empty($res_addr))
                        <address class="font-15">
                            {{$res_addr->flat_no}}, {{$res_addr->village}}, {{$res_addr->area}}
                            <br><strong>P.O. :</strong> {{$res_addr->po}} | <strong>P.S. :</strong> {{$res_addr->ps}}
                            <br><strong>City :</strong> {{$res_addr->dist}}
                            <br><strong>State :</strong> {{$res_addr->state}}
                        </address>
                    @endif
                   	

                    <div class="clearfix"></div>
                  </div>
               </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
               <div class="x_panel">
                  <div class="x_title">
                    <h2>BUSNIESS ADDRESS</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   	 @if (isset($business_addr) && !empty($business_addr))
                        <address class="font-15">
                            {{$business_addr->flat_no}}, {{$business_addr->village}}, {{$business_addr->area}}
                            <br><strong>P.O. :</strong> {{$business_addr->po}} | <strong>P.S. :</strong> {{$business_addr->ps}}
                            <br><strong>City :</strong> {{$business_addr->dist}}
                            <br><strong>State :</strong> {{$business_addr->state}}
                        </address>
                    @endif

                    	<div class="clearfix"></div>
                  </div>
               </div>
            </div>
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>JOB LIST</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <section class="content invoice">
                            <!-- Table row -->
                            <div class="row">
                                <div class="col-xs-12 table table-responsive">
                                    <table class="table table-striped ">
                                        <thead>
                                            <tr>
                                                <th>Sl No.</th>
                                                <th>Job Id</th>
                                                <th>date</th>
                                                <th>Description</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if (isset($job_det) && !empty($job_det) && count($job_det))
                                        @php
                                            $job_count = 1;
                                        @endphp
                                            @foreach ($job_det as $item)
                                                <tr>
                                                    <td>{{$job_count++}}</td>
                                                    <td>{{$item->job_id}}</td>
                                                    <td>{{$item->created_at}}</td>
                                                    <td>{{$item->job_type_name}}</td>
                                                    <td>
                                                        @if ($item->status == '1')
                                                            <span class="label label-warning">Processing</span>
                                                        @elseif ($item->status == '2')
                                                            <span class="label label-info">Working</span>
                                                        @elseif($item->status == '3')
                                                            <span class="label label-danger">Document Correction</span>
                                                        @elseif($item->status == '3')
                                                            <span class="label label-success">Solved</span>
                                                        @endif
                                                    </td>
                                                    <td><a href="{{route('admin.job_detail',[''=>encrypt($item->id)])}}" class="btn btn-info btn-sm" target="_blank">View</a></td>
                                                </tr>                                                
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" align="center">No Job Found</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
                                <div class="col-xs-12">
                                    @if (isset($client_personal) && !empty($client_personal))
                                        <a href="{{route('admin.client_edit',['client_id'=>encrypt($client_personal->id)])}}" class="btn btn-warning pull-left"></i> Edit </a>
                                    @endif
                                    <button class="btn btn-danger pull-left" onclick="window.close()"></i>Close Window</button>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    
 @endsection