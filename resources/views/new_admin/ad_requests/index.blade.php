@extends('layouts.admin')

@section('title', tr('view_and_assign_ad'))

@section('content-header')

@section('breadcrumb')
     

    <li><a href="{{route('admin.ads-details.index')}}"><i class="fa fa-bullhorn"></i>{{tr('video_ads')}}</a></li>

    <li class="active"><i class="fa fa-bullhorn"></i> Ad Requests</li>
@endsection

@section('content')

	<div class="row">

        <div class="col-xs-12">

            @include('notification.notify')

	        <div class="box box-primary">

	          	<div class="box-header label-primary">
	                <b style="font-size:18px;">Ad Requests</b>
	            </div>

	            <div class="box-body">

	            	@if(count($ads_details) > 0)

		              	<table id="example1" class="table table-bordered table-striped">

							<thead>
							    <tr>
							      	<th>{{ tr('id') }}</th>
							      	<th>First Name</th>
							      	<th>Last Name</th>
							      	<th>Email</th>
							      	<th>Phone</th>
							      	<th>Address</th>
							      	<th>Ad Type</th>
							      	<th>Ad Skip Time</th>
							      	<th>Ad Duration</th>
							      	<th>Url</th>
							      	<th>File</th>
							    </tr>
							</thead>

							<tbody>

								@foreach($ads_details as $i => $ads_detail_details)
								   
								    <tr>
								      	<td>
								      		<a href="">{{ $ads_detail_details->id }}
								      		</a>
								      	</td>

								      	<td>
								      		<a href="">{{ $ads_detail_details->first_name }}</a>
								      	</td>
								      	
								      	<td>{{ $ads_detail_details->last_name }}</td>
										  
										<td>{{ $ads_detail_details->email }}</td>
										<td>{{ $ads_detail_details->phone }}</td>
										<td>{{ $ads_detail_details->address }}</td>
										<td>{{ $ads_detail_details->ad_type }}</td>
										<td>{{ $ads_detail_details->ad_skip_time }}</td>
										<td>{{ $ads_detail_details->ad_duration }}</td>
										<td>{{ $ads_detail_details->url }}</td>
										<td>
											@if ($ads_detail_details->ad_type == 'video')
											<video src="{{ $ads_detail_details->file }}" style="height:45px"></video>
											@else
											<img src="{{ asset($ads_detail_details->file) }}" style="width: 30px;height: 45px;" />
											@endif
										</td>


								      	
								      	<!-- <td>
											@if ($ads_detail_details->ad_type == 'BANNER' || $ads_detail_details->ad_type == 'HOME_AD' || $ads_detail_details->ad_type == 'VIDEO_PAGE AD')
												<img src="{{ asset($ads_detail_details->file) }}" style="width: 30px;height: 45px;" />
											@elseif ($ads_detail_details->ad_type == 'VIDEO')
												<video src="{{ $ads_detail_details->file }}" style="height:45px"></video>
											@endif
								      	</td> -->
								      	
								      	
				

								    </tr>
								
								@endforeach

							</tbody>

						</table>

					@else
						<h3 class="no-result">{{ tr('no_ads_found') }}</h3>
					@endif
					
	            </div>

	        </div>

        </div>

    </div>

@endsection


@section('scripts')


<script type="text/javascript">
	
function redirectView() {

	var value = $('input[name=type]:checked').val();;

	alert(value);

}

</script>

@endsection