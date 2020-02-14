@extends('admin.template.admin_master')

@section('content')

  <div class="right_col" role="main">
    <!-- top tiles -->
    <div class="row tile_count">
      <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Jobs</span>
        <div class="count green">
          @if(isset($total_jobs))
            {{$total_jobs}}
          @endif
        </div>
      </div>
      <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-clock-o"></i> Total Service Point</span>
        <div class="count green">
            @if(isset($total_sp))
              {{$total_sp}}
            @endif
        </div>
      </div>
      <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
          <span class="count_top"><i class="fa fa-user"></i> Total Employee</span>
          <div class="count green">
              @if(isset($total_emp))
                {{$total_emp}}
              @endif
          </div>
      </div>

      <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Client</span>
        <div class="count green">
            @if(isset($total_client))
              {{$total_client}}
            @endif
        </div>
      </div>
    </div>
    <div class="row tile_count">
      <div class="col-md-12 col-sm-12 col-xs-12 tile_stats_count" style="display:flex;justify-content:center">
        <h3>Jobs</h3>
      </div>
      <div class="col-md-2 col-sm-2 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Pending Jobs</span>
        <div class="count green">
          @if(isset($working_jobs))
            {{$working_jobs}}
          @endif
        </div>
      </div>

      <div class="col-md-2 col-sm-2 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Assigned Jobs</span>
        <div class="count green">
          @if(isset($working_jobs))
            {{$working_jobs}}
          @endif
        </div>
      </div>

      <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Employee Rejected Jobs</span>
        <div class="count green">
          @if(isset($working_jobs))
            {{$working_jobs}}
          @endif
        </div>
      </div>

      <div class="col-md-2 col-sm-2 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Correction Jobs</span>
        <div class="count green">
          @if(isset($correction_jobs))
            {{$correction_jobs}}
          @endif
        </div>
      </div>

      <div class="col-md-2 col-sm-2 col-xs-6 tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Completed Jobs</span>
        <div class="count green">
          @if(isset($completed_jobs))
            {{$completed_jobs}}
          @endif
        </div>
      </div>

    </div>
    <!-- /top tiles -->

    {{-- <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <div class="x_content">
                 <div class="table-responsive">
                    <h2>Last 10 Added Jobs</h2>
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr class="headings">                
                                <th class="column-title">Sl No. </th>
                                <th class="column-title">Post Name</th>
                                <th class="column-title">Department</th>
                                <th class="column-title">Job Location</th>
                                <th class="column-title">Last Date</th>
                                <th class="column-title">Posted Date</th>
                                <th class="column-title">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                          @if (isset($last_ten_jobs) && !empty($last_ten_jobs))
                            @php
                                $job_count = 1;
                            @endphp
                              @foreach ($last_ten_jobs as $item)
                                <tr>
                                  <td>{{$job_count++}}</td>
                                  <td>{{$item->name}}</td>
                                  <td>{{$item->dept_name}}</td>
                                  <td>{{$item->job_location}}</td>
                                  <td>{{$item->last_date}}</td>
                                  <td>{{$item->created_at}}</td>
                                  <td>
                                    @if ($item->status == '1')
                                        <a class="btn btn-success">Enabled</a>
                                    @else
                                      <a class="btn btn-success">Disabled</a>
                                    @endif
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
    </div> --}}

  </div>

 @endsection