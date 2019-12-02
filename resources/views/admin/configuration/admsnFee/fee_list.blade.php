@extends('admin.template.admin_master')

@section('content')

<div class="right_col" role="main">
     <div class="row">
        <div class="col-md-12" style="margin-top:50px;">
            <div class="x_panel">

                <div class="x_title">
                    <h2>Search Fees Of A Selected Class</h2>
                    <div class="clearfix"></div>
                </div>

                 <div>
                    @if (Session::has('message'))
                    <div class="alert alert-success">{{ Session::get('message') }}</div>
                    @endif @if (Session::has('error'))
                    <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
                </div>

                <div>
                    <div class="x_content">
                        {{ Form::open(['method' => 'post','route'=>'admin.search_admsn_fees']) }}

                         <div class="well" style="overflow: auto">
                            <div class="form-row mb-10">
                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                  <label for="tag_name">Select Medium</label>
                                  <select class="form-control" name="medium" id="medium">
                                    <option value="" selected>Please Select Medium</option>
                                    <option value="1" {{ old('medium') == 1 ? 'selected' : '' }}>Bengali</option>
                                    <option value="2" {{ old('medium') == 1 ? 'selected' : '' }}>English</option>
                                  </select>
                                  @if($errors->has('medium'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('medium') }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-sm-12 col-xs-12 mb-3">
                                    <label for="tag_name">Select Class</label>
                                    <select class="form-control" name="class" id="class">
                                        <option value="" selected>Please Select Class</option>
                                    </select>
                                    @if($errors->has('class'))
                                        <span class="invalid-feedback" role="alert" style="color:red">
                                            <strong>{{ $errors->first('class') }}</strong>
                                        </span>
                                    @enderror
                                </div> 

                            </div>
                        </div>
                        <div class="form-group" style="display:flex; justify-content:center">
                            {{ Form::submit('Search', array('class'=>'btn btn-success')) }}
                        </div>
                        {{ Form::close() }}
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    {{--//////////// Last Ten Sellers //////////////--}}
                    <div class="table-responsive">
                        <h2>Admission Fees List</h2>
                        <table class="table table-striped jambo_table bulk_action">
                            <thead>
                                <tr class="headings">                
                                    <th class="column-title">Sl No. </th>
                                    <th class="column-title">Title</th>
                                    <th class="column-title">Class</th>
                                    <th class="column-title">Medium</th>
                                    <th class="column-title">Fees Amount</th>
                                    <th class="column-title">Status</th>
                                    <th class="column-title">Date Added</th> 
                                    <th class="column-title">Action</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                            @if (isset($fees) && !empty($fees))
                                @php
                                    $job_count = 1;
                                @endphp
                                @foreach ($fees as $item)
                                    <tr>
                                    <td>{{$job_count++}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->c_name}}</td>
                                    <td>
                                        @if ($item->medium == '1')
                                            Bengali
                                        @else
                                            English
                                        @endif
                                    </td>                                    
                                    <td>{{ number_format($item->amount,2,".",'') }}</td>
                                    <td>
                                        @if ($item->status == '1')
                                            <a class="btn btn-success">Enabled</a>
                                        @else
                                        <a class="btn btn-danger">Disabled</a>
                                        @endif
                                    </td>
                                    <td>{{$item->created_at}}</td>
                                    <td>
                                        <a href="{{route('admin.admsn_fee_edit_form',['fee_id'=>encrypt($item->id)])}}" class="btn btn-warning">Edit</a>
                                        @if ($item->status == '1')
                                            <a class="btn btn-danger" href="{{route('admin.admsn_fee_status',['id'=>encrypt($item->id),'status'=>encrypt(2)])}}">Disable</a>
                                        @else
                                            <a class="btn btn-success" href="{{route('admin.admsn_fee_status',['id'=>encrypt($item->id),'status'=>encrypt(1)])}}">Enable</a>
                                        @endif
                                    </td>
                                    </tr>                              
                                @endforeach
                            @elseif(isset($fees_search) && !empty($fees_search))
                                @php
                                $job_count = 1;
                                @endphp
                                @foreach ($fees_search as $item)
                                    <tr>
                                    <td>{{$job_count++}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->c_name}}</td>
                                    <td>
                                        @if ($item->medium == '1')
                                            Bengali
                                        @else
                                            English
                                        @endif
                                    </td>                                    
                                    <td>{{ number_format($item->amount,2,".",'') }}</td>
                                    <td>
                                        @if ($item->status == '1')
                                            <a class="btn btn-success">Enabled</a>
                                        @else
                                            <a class="btn btn-danger">Disabled</a>
                                        @endif
                                    </td>
                                    <td>{{$item->created_at}}</td>
                                    <td>
                                        <a href="{{route('admin.admsn_fee_edit_form',['fee_id'=>encrypt($item->id)])}}" class="btn btn-warning">Edit</a>
                                        @if ($item->status == '1')
                                            <a class="btn btn-danger" href="{{route('admin.admsn_fee_status',['id'=>encrypt($item->id),'status'=>encrypt(2)])}}">Disable</a>
                                        @else
                                            <a class="btn btn-success" href="{{route('admin.admsn_fee_status',['id'=>encrypt($item->id),'status'=>encrypt(1)])}}">Enable</a>
                                        @endif
                                    </td>
                                    </tr>                              
                                @endforeach
                                <tr>
                                    <td colspan="4" align="right">Total</td>
                                    <td colspan="4" align="left">{{ number_format($fees_total,2,".",'') }}</td>
                                </tr>
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

	$(document).ready(function(){
		$("#medium").change(function(){
            
			var medium = $(this).val();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				type:"GET",
				url:"{{ url('admin/Ajax/Class/List/')}}"+"/"+medium+"",
				success:function(data){
                    
					$("#class").html("<option value=''>Please Select Class</option>");

					$.each( data, function( key, value ) {
						$("#class").append("<option value='"+value.id+"'>"+value.name+"</option>");
					});
				}
			});
		});
	});

</script>
@endsection