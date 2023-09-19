@extends('layouts.admin')

@section('title', tr('assigned_ads'))

@section('content-header', tr('assigned_ads'))

@section('breadcrumb')
     
    <li class="active"><i class="fa fa-bullhorn"></i> {{ tr('assigned_ads') }}</li>
@endsection

@section('content')

	<div class="row">

        <div class="col-xs-12">
    		
    		@include('notification.notify')

          	<div class="box box-primary">

	          	<div class="box-header label-primary">
	                <b style="font-size:18px;">{{ tr('assigned_ads') }}</b>
	            </div>

	            <div class="box-body">

	            	@if(count($videoTapes) > 0)

		              	<table id="example1" class="table table-bordered table-striped">

							<thead>
							    <tr>
							      <th>{{tr('id')}}</th>
							      <th>{{tr('title')}}</th>
							      <th>{{tr('image')}}</th>
							      <th>{{tr('channel')}}</th>
							      <th>{{tr('type_of_ads')}}</th>
							      <th>{{tr('ads_name')}}</th>
							      <th>{{tr('url')}}</th>
							      <th>{{tr('updated_at')}}</th>
							      <th>{{tr('created_at')}}
							      <th>{{ tr('action') }}</th>
							    </tr>
							</thead>

							<tbody>
								@foreach ($videoTapes as $video)
									<tr>
										<td>{{ $video->id }}</td>
										<td>
											<a href="{{route('user.single', $video->id )}}" target="_blank">{{ $video->title }}</a>
										</td>
										<td> <img src="{{ $video->default_image }}" alt="" height="60"> </td>
										<td>{{ $video->getChannel->name }}</td>
										<td>{{ $video->ads->first()->ad_type }}</td>
										<td>
											<a href="{{route('admin.ads-details.view', ['ads_detail_id' => $video->ads->first()->id])}}" target="_blank">
												{{ $video->ads->first()->name }}
											</a>
										</td>
										<td>
											@if($video->ads()->first()->ad_url)
												<a href="{{ $video->ads()->first()->ad_url }}" target="_blank" class="btn btn-sm btn-default">
													<i class="fa fa-external-link"></i> Open
												</a>
											@else
												Empty
											@endif

										</td>
										<td>{{ \Carbon\Carbon::parse($video->ads->updated_at)}}</td>
										<td>{{ \Carbon\Carbon::parse($video->ads->created_at) }}</td>
										<td>
											<a href="{{ route('admin.videos.remove_ad', ['video_id'=> $video->id])}}" class="btn btn-danger">{{ tr('remove') }}</a>
										</td>
									</tr>
								@endforeach
							</tbody>

						</table>

					@else
						<h3 class="no-result">{{ tr('no_assigned_ads_found') }}</h3>
					@endif
	            </div>

          	</div>

        </div>

    </div>

@endsection