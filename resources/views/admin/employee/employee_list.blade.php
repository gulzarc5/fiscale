@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    {{--//////////// Last Ten Sellers //////////////--}}
                    <div class="table-responsive">
                        <h2>Employee List</h2>
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                                <tr class="headings">                
                                    <th class="column-title">Sl No. </th>
                                    <th class="column-title">Name</th>
                                    <th class="column-title">Email</th>
                                    <th class="column-title">Mobile</th>
                                    <th class="column-title">Gender</th>
                                    <th class="column-title">Designation</th> 
                                    <th class="column-title">State</th>      
                                    <th class="column-title">City</th>    
                                    <th class="column-title">Address</th>    
                                    <th class="column-title">Pin</th>    
                                    <th class="column-title">Status</th>                                
                                    <th class="column-title">Action</th>                                  
                                </tr>
                            </thead>
                            <tbody>
                            @if (isset($employee) && !empty($employee))
                                @php
                                    $job_count = 1;
                                @endphp
                                @foreach ($employee as $item)
                                    <tr>
                                    <td>{{$job_count++}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->mobile}}</td>
                                    <td>
                                        @if ($item->gender == 'M')
                                            Male
                                        @else
                                            Female
                                        @endif
                                    </td>
                                    <td>{{$item->designation}}</td>
                                    <td>{{$item->state}}</td>
                                    <td>{{$item->city}}</td>
                                    <td>{{$item->address}}</td>
                                    <td>{{$item->pin}}</td>
                                    <td>
                                        @if ($item->status == '1')
                                            <a class="btn btn-success">Enabled</a>
                                        @else
                                        <a class="btn btn-success">Disabled</a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('admin.edit_employee_form',['id'=>encrypt($item->id)])}}" class="btn btn-warning">Edit</a>
                                        <a href="{{route('admin.change_pass_employee_form',['id'=>encrypt($item->id)])}}" class="btn btn-danger">Change Password</a>
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