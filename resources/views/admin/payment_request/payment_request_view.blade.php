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
                                    <h3 style="text-align:center;">
                                       Payment Request Details
                                    </h3>
                                </div>
                                <!-- /.col -->
                            </div>
                            <br>
                            <!-- info row -->
                            @if (isset($p_rqst) && !empty($p_rqst))
                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">
                                        <address class="font-15">
                                        <strong>Request Id : </strong>{{$p_rqst->id}}
                                        </address>
                                    </div>
                                    <div class="col-sm-4 invoice-col">
                                        <address class="font-15">
                                        <strong>Branch Id : </strong>{{$p_rqst->b_branch_id}}
                                        </address>
                                    </div>
                                    <div class="col-sm-4 invoice-col">
                                        <address class="font-15">
                                        <strong>Transaction Type : </strong>{{$p_rqst->transaction_type}}
                                        </address>
                                    </div>
                                    <div class="col-sm-4 invoice-col">
                                        <address class="font-15">
                                        <strong>Bank/UPI Name : </strong>{{$p_rqst->bank_name}}
                                        </address>
                                    </div>
                                    <div class="col-sm-4 invoice-col">
                                        <address class="font-15">
                                        <strong>Status : </strong>
                                        @if ($p_rqst->status == '1')
                                            <span class="label label-warning">Requested</span>
                                        @elseif ($p_rqst->status == '2')
                                            <span class="label label-success">Accepted</span>
                                        @elseif($p_rqst->status == '3')
                                            <span class="label label-danger">Rejected</span>
                                        @endif
                                        </address>
                                    </div>
                                    <div class="col-sm-4 invoice-col">
                                        <address class="font-15">
                                        <strong>Amount : </strong>{{ number_format($p_rqst->amount,2,".",'')}}
                                        </address>
                                    </div>
                                    <div class="col-sm-4 invoice-col">
                                        <address class="font-15">
                                        <strong>Date : </strong>{{$p_rqst->created_at}}
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
                    <div class="x_content">
                        <section class="content invoice">
                            <!-- Table row -->
                            <div class="row">
                                @if (isset($p_rqst) && !empty($p_rqst))
                                <div class="col-xs-12 table table-responsive">
                                   <center> <img src="{{route('admin.image_payment_request',['request_id'=>encrypt($p_rqst->id)])}}" alt=""></center>
                                </div>
                                
                                @endif
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 38px;">
                                    @if (isset($p_rqst) && !empty($p_rqst))
                                        <a class="btn btn-info" data-toggle="modal" data-target=".bs-example-modal-sm{{$p_rqst->id}}">Accept Request</a>

                                            {{-- Model Accept --}}
                                            <div class="modal fade bs-example-modal-sm{{$p_rqst->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                                            </button>
                                                            <h4 class="modal-title" id="myModalLabel2" style="color:#09c6ff;font-size: 17px;font-weight: bold;">Are You Sure To Accept</h4>
                                                        </div>
                                                        <div class="form-group" style="margin: 17px;">
                                                            <label for="tag_name">Branch Id</label>
                                                            <input class="form-control" value="{{$p_rqst->b_branch_id}}" disabled>
                                                        </div>
                                                        <div class="form-group" style="margin: 17px;">
                                                            <label for="tag_name">Amount</label>
                                                            <input class="form-control" value="{{$p_rqst->amount}}" disabled>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="#" class="btn btn-primary">Yes</a>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- model End --}}
                                        <a class="btn btn-danger" data-toggle="modal" data-target=".reject-mod{{$p_rqst->id}}">Reject Request</a>

                                            {{-- Model Reject --}}
                                            <div class="modal fade bs-example-modal-sm reject-mod{{$p_rqst->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">

                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                                            </button>
                                                            <h4 class="modal-title" id="myModalLabel2" style="color:red;font-size: 17px;font-weight: bold;">Are You Sure To Reject</h4>
                                                        </div>
                                                        <div class="form-group" style="margin: 17px;">
                                                            <label for="tag_name">Branch Id</label>
                                                            <input class="form-control" value="{{$p_rqst->b_branch_id}}" disabled>
                                                        </div>
                                                        <div class="form-group" style="margin: 17px;">
                                                            <label for="tag_name">Amount</label>
                                                            <input class="form-control" value="{{$p_rqst->amount}}" disabled>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="#" class="btn btn-primary">Yes</a>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- model End --}}
                                    @endif
                                    <button type="button" onclick="window.close()" class="btn btn-warning ">Close Window</button>
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