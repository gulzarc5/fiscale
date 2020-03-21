@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    {{--//////////// Last Ten Sellers //////////////--}}
                    <div class="table-responsive">
                        <h2>Executive List</h2>
                        <table  id="size_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr class="headings">                
                                    <th class="column-title">Sl No. </th>
                                    <th class="column-title">Name</th>
                                    <th class="column-title">Email</th>
                                    <th class="column-title">Mobile</th>
                                    <th class="column-title">Gender</th>
                                    <th class="column-title">State</th>
                                    <th class="column-title">City</th>
                                    <th class="column-title">Address</th>
                                    <th class="column-title">Pin</th>
                                    <th class="column-title">Status</th>
                                    <th class="column-title">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if (isset($executive) && !empty($executive))
                                @php
                                    $job_count = 1;
                                @endphp
                                @foreach ($executive as $item)
                                    <tr>
                                    <td>{{$job_count++}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email_id}}</td>
                                    <td>{{$item->mobile}}</td>
                                    <td>
                                        @if ($item->gender == 'M')
                                            Male
                                        @else
                                            Female
                                        @endif
                                    </td>
                                    <td>{{$item->state}}</td>
                                    <td>{{$item->city}}</td>
                                    <td>{{$item->address}}</td>
                                    <td>{{$item->pin}}</td>
                                    <td>
                                        @if ($item->status == '1')
                                            <a class="btn btn-success">Enabled</a>
                                        @else
                                        <a class="btn btn-danger">Disabled</a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('admin.edit_executive_form',['id'=>encrypt($item->id)])}}" class="btn btn-warning">Edit</a>
                                        @if ($item->status == '1')
                                            <a href="{{route('admin.executive_status_update',['id'=>encrypt($item->id),'status'=>encrypt(2)])}}" class="btn btn-danger">Disable</a>
                                        @else
                                            <a href="{{route('admin.executive_status_update',['id'=>encrypt($item->id),'status'=>encrypt(1)])}}" class="btn btn-success">Enable</a>
                                        @endif
                                       
                                        <a href="{{route('admin.change_pass_executive_form',['id'=>encrypt($item->id)])}}" class="btn btn-danger">Change Password</a>

                                        <a href="{{route('admin.executive_credit_wallet_form',['exe_id'=>encrypt($item->id)])}}" class="btn btn-primary">Credit Wallet</a>                                       
                                        <a href="{{route('admin.executive_debit_wallet_form',['exe_id'=>encrypt($item->id)])}}" class="btn btn-danger">Debit Wallet</a>
                                        <a href="{{route('admin.executive_wallet_history',['exe_id'=>encrypt($item->id)])}}" class="btn btn-info">Wallet history</a>
                                    </td>
                                    </tr>                              
                                @endforeach
                            @endif
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
     
     <script type="text/javascript">
         $(function () {    
            var table = $('#size_list').DataTable({});            
        });
     </script>
    
 @endsection