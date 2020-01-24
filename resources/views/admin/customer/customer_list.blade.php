@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Client List</h2>
                    <div class="clearfix"></div>
                </div>
                <div>
                    <div class="x_content">
                        <table id="size_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Pan</th>
                                <th>dob</th>
                                <th>Gender</th>
                                <th>Date Created</th>
                                <th>Registered By</th>
                                <th>action</th>
                            </tr>
                            </thead>
                            <tbody>                       
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
    
            var table = $('#size_list').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.customer_ajax_list') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name' ,searchable: true},
                    {data: 'mobile', name: 'mobile' ,searchable: true},              
                    {data: 'pan', name: 'pan' ,searchable: true},    
                    {data: 'dob', name: 'dob' ,searchable: true},  
                    {data: 'gender', name: 'gender', render:function(data, type, row){
                      if (row.gender == 'M') {
                        return "Male"
                      }else{
                        return "Female"
                      }                        
                    }},
                    {data: 'created_at', name: 'created_at' ,searchable: true},  
                    {data: 'branch_name', name: 'branch_name' ,searchable: true},  
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });            
        });
     </script>
    
 @endsection