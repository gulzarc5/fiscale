@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    {{--//////////// Last Ten Sellers //////////////--}}
                    <div class="table-responsive">
                        <h2>Contact Mail</h2>
                        <table  id="size_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                                <tr class="headings">                
                                    <th class="column-title">Sl No. </th>
                                    <th class="column-title">Name</th>
                                    <th class="column-title">Email</th>
                                    <th class="column-title">Subject</th>
                                    <th class="column-title">Message</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if (isset($contacts) && !empty($contacts))
                                @php
                                    $job_count = 1;
                                @endphp
                                @foreach ($contacts as $item)
                                    <tr>
                                    <td>{{$job_count++}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->subject}}</td>
                                    <td>{{$item->message}}</td>
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