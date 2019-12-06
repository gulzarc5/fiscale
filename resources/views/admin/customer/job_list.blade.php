@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Job List</h2>
                    <div class="clearfix"></div>
                </div>
                <div>
                    <div class="x_content">
                        <table id="size_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Job Description</th>
                                <th>Customer ID</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Pan</th>                                
                                <th>Date Created</th>
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
                ajax: "{{ route('admin.job_list_ajax') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},                    
                    {data: 'job_type_name', name: 'job_type_name',searchable: true},
                    {data: 'id', name: 'id',searchable: true},
                    {data: 'c_name', name: 'c_name' ,searchable: true},
                    {data: 'c_mobile', name: 'c_mobile' ,searchable: true},              
                    {data: 'c_pan', name: 'c_pan' ,searchable: true},   
                    {data: 'created_at', name: 'created_at' ,searchable: true},  
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });            
        });
     </script>
    
 @endsection