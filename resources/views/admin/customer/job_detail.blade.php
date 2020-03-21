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
                                        @elseif($job_det->status == '4')
                                            <span class="label label-success">Completed</span>
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
                                                <th>Comments</th>
                                                <th>Commented By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($remarks) && !empty($remarks) && (count($remarks) > 0) )
                                            @php
                                                $remark_count = 1;
                                            @endphp
                                                @foreach ($remarks as $item)
                                                    <tr>
                                                        <td>{{$remark_count++}}</td>
                                                        <td>{{$item->created_at}}</td>
                                                        <td><p id="rem{{$item->id}}">{{$item->remarks}}</p></td>
                                                        <td>
                                                            @if ($item->remarks_by == '1')
                                                                Admin
                                                            @elseif ($item->remarks_by == '2')
                                                                {{$item->commented_by_name}} (Member)
                                                            @else   
                                                                {{$item->commented_by_name}} (SP)
                                                            @endif
                                                        </td>
                                                        <td><p id="edt{{$item->id}}"><a class="btn btn-sm btn-warning" onclick="editRemark({{$item->id}})">Edit</a></p></td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="5" align="center">No Remarks Found</td>
                                                </tr>
                                            @endif
                                            
                                        </tbody>
                                    </table>
                                </div>
                                @if (isset($job_det) && !empty($job_det))
                                {{ Form::open(['method' => 'post','route'=>'admin.remark_add']) }}
                                <input type="hidden" name="job_id" value="{{$job_det->id}}">
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    
                                    <div class="form-row mb-10">
                                        <div class="col-md-12 col-sm-12 col-xs-12 mb-3">
                                            <label for="name">Add New Remark</label>
                                            <textarea type="text" class="form-control" name="remark"></textarea>
                                        </div>
    
                                    </div>
                                    
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12" style="margin-top: 38px;">
                                    <button  class="btn btn-info pull-left" type="submit">Send</button>
                                </div>
                                {{ Form::close() }}
                                @endif

                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 38px;">
                                    <button type="button" onclick="window.close()" class="btn btn-danger pull-left">Close Window</button>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script>
        function editRemark(id){
            var remark = $("#rem"+id).html();
            $("#rem"+id).html('<textarea id="remVal'+id+'">'+remark+'</textarea>');
            $("#edt"+id).html('<a class="btn btn-sm btn-info" onclick="updateRemark('+id+')">Save</a>');
        }
        function updateRemark(id){
            var loader = "{{asset('admin/loader.gif')}}"; 
            var remark = $("#remVal"+id).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });
            $.ajax({
                type:"POST",
                url:"{{route('admin.remark_update')}}",
                data:{
                    "_token": "{{ csrf_token() }}",
                    remark:remark,
                    rem_id:id,
                },
                beforeSend:function() { 
                    $("#edt"+id).html('<img style="width: 65px;" src="'+loader+'">');
                },
                success:function(data){  
                    $("#edt"+id).html('<a class="btn btn-sm btn-warning" onclick="editRemark('+id+')">Edit</a>');
                    console.log(data);
                    $("#rem"+id).html(remark);
                }
            });
        }
    </script>
@endsection