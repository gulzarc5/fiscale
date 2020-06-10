@extends('website.branch.template.branch_master')
<!-- Head & Header Section -->
@section('content')
<div class="col p-t col-md-10" id="print_div">
    <div class="contact-form contact-page-form animated fadeInUp" data-animate="fadeInUp"
        style="animation-duration: 0.6s; animation-delay: 0.1s; margin-top: 70px;">
        @if (isset($jobs) && isset($jobs))
            <div class="alert alert-success text-center"><h2>JOB Registered Successfully</h2></div>
            @if (isset($client_details) && !empty($client_details))
                <div class="row">
                    <div class="col-md-4">
                        <p><b>Client Name : </b>{{$client_details->name}}</p>
                    </div>
                    <div class="col-md-4">
                        <p><b>Client PAN : </b>{{$client_details->pan}}</p>
                    </div>
                    <div class="col-md-4">
                        <p><b>Client Mobile : </b>{{$client_details->mobile}}</p>
                    </div>
                </div>                
            @endif
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th colspan="4" class="text-center table-header-cl">USER JOB DETAIL</th>
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
                    @foreach ($jobs as $item)
                        <tr>
                            <td>{{$job_count++}}</td>
                            <td>{{$item->job_id}}</td>
                            <td>{{$item->job_type_name}}</td>
                            <td>{{$item->created_at}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" align="center"> 
                            <button type="button" class="btn btn-warning" onclick="printDiv()">Print</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <script>
                 var original_content = document.body.innerHTML;
                function printDiv(){
                    var print_content =  document.getElementById("print_div").innerHTML;
        
                    document.body.innerHTML = print_content;
                    window.print();
                }

                window.addEventListener("afterprint", function(event) { 
                    document.body.innerHTML = original_content;
                })
            </script>
        @else
            <div class="alert alert-danger">Something Went Wrong Please Try Again</div>
        @endif
    </div>
</div>
@endsection
