@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="">

        <div class="row vpanel">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_content">

                        <section class="content invoice">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-xs-12 invoice-header">
                                    <h3>
                                       JOB ID: <span> 
                                           @if (isset($jod_det_id) && !empty($jod_det_id))
                                               {{$jod_det_id}}
                                           @endif
                                       </span>
                                    </h3>
                                </div>
                                <!-- /.col -->
                            </div>
                            <br>
                            <!-- info row -->
                            @if (isset($job_det) && !empty($job_det))
                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">
                                        <address class="font-15">
                                        <strong>Client Name : </strong>{{$job_det->cl_name}}
                                        </address>
                                    </div>
                                    <div class="col-sm-4 invoice-col">
                                        <address class="font-15">
                                        <strong>Client PAN : </strong>{{$job_det->cl_pan}}
                                        </address>
                                    </div>
                                    <div class="col-sm-4 invoice-col">
                                        <address class="font-15">
                                        <strong>Client Mobile : </strong>{{$job_det->cl_mobile}}
                                        </address>
                                    </div>
                                    <div class="col-sm-4 invoice-col">
                                        <address class="font-15">
                                        <strong>Description : </strong>{{$job_det->job_type_name}}
                                        </address>
                                    </div>
                                    <div class="col-sm-4 invoice-col">
                                        <address class="font-15">
                                        <strong>Status : </strong>
                                        @if ($job_det->status == '1')
                                            <span class="label label-warning">Processing</span>
                                        @elseif ($job_det->status == '2')
                                            <span class="label label-info">Working</span>
                                        @elseif($job_det->status == '3')
                                            <span class="label label-danger">Document Correction</span>
                                        @elseif($job_det->status == '3')
                                            <span class="label label-success">Solved</span>
                                        @endif
                                        </address>
                                    </div>
                                    <div class="col-sm-4 invoice-col">
                                        <address class="font-15">
                                        <strong>Date : </strong>{{$job_det->created_at}}
                                        </address>
                                    </div>
                                </div>
                            @endif
                        </section>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Remarks</h2>
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
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sl No.</th>
                                                <th>Date</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($remarks) && !empty($remarks) && (count($remarks) > 0) )
                                            @php
                                                $remark_count = 1;
                                            @endphp
                                                @foreach ($collection as $item)
                                                    <tr>
                                                        <td>{{$remark_count++}}</td>
                                                        <td>{{$item->created_at}}</td>
                                                        <td>{{$item->remarks}}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="3" align="center">No Remarks Found</td>
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
                                    <button onclick="window.close()" class="btn btn-warning pull-left">Close Window</button>
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