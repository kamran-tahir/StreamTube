@extends('layouts.admin')

@section('title', tr('view_and_assign_ad'))

@section('content-header', tr('view_and_assign_ad'))

@section('breadcrumb')
     

    <li><a href="{{route('admin.ads-details.index')}}"><i class="fa fa-bullhorn"></i>{{tr('video_ads')}}</a></li>

    <li class="active"><i class="fa fa-bullhorn"></i> {{ tr('view_and_assign_ad') }}</li>
@endsection

@section('content')

	<div class="row">

        <div class="col-xs-12">

            @include('notification.notify')

	        <div class="box box-primary">

	          	<div class="box-header label-primary">
	                <b style="font-size:18px;">{{ tr('view_and_assign_ad') }}</b>
	            </div>

	            <div class="box-body">

	            	@if(count($ads_details) > 0)

		              	<table id="example1" class="table table-bordered table-striped">

							<thead>
							    <tr>
							      	<th>{{ tr('id') }}</th>
							      	<th>{{ tr('name') }}</th>
							      	<th>{{ tr('url') }}</th>
							      	<th>{{ tr('ad_time') }} ({{ tr('in_sec') }})</th>
							      	<th>{{ tr('ad_type') }}</th>
							      	<th>{{ tr('image') }}</th>
							      	<th>{{ tr('status') }}</th>
							      	<th>{{ tr('action') }}</th>
							    </tr>
							</thead>

							<tbody>

								@foreach($ads_details as $i => $ads_detail_details)
								   
								    <tr>
								      	<td>
								      		<a href="{{ route('admin.ads-details.view' , ['ads_detail_id' => $ads_detail_details->id] ) }}">{{ $ads_detail_details->id }}
								      		</a>
								      	</td>

								      	<td>
								      		<a href="{{ route('admin.ads-details.view' , ['ads_detail_id' => $ads_detail_details->id] ) }}">{{ $ads_detail_details->name }}</a>
								      	</td>
								      	
								      	<td>
											@if($ads_detail_details->ad_url)
												<a href="{{ $ads_detail_details->ad_url}}" target="_blank" class="btn btn-sm btn-default">
													<i class="fa fa-external-link"></i> Open
												</a>
											@else
												Empty
											@endif
								      	</td>
								      	
								      	<td>{{ $ads_detail_details->ad_time }}</td>
										  
										  <td>{{ $ads_detail_details->ad_type }}</td>
								      	
								      	<td>
											@if ($ads_detail_details->ad_type == 'BANNER' || $ads_detail_details->ad_type == 'HOME_AD' || $ads_detail_details->ad_type == 'VIDEO_PAGE AD' ||
											$ads_detail_details->ad_type == 'SEARCH_PAGE_AD')
												<img src="{{ asset($ads_detail_details->file) }}" style="width: 30px;height: 45px;" />
											@elseif ($ads_detail_details->ad_type == 'VIDEO')
												<video src="{{ $ads_detail_details->file }}" style="height:45px"></video>
											@endif
								      	</td>
								      	
								      	<td>								      		
								      		@if($ads_detail_details->status == DEFAULT_TRUE)
								      			<span class="label label-success">{!! ($ads_detail_details->ad_type == 'HOME_AD' || $ads_detail_details->ad_type == 'VIDEO_PAGE AD' || $ads_detail_details->ad_type == 'SEARCH_PAGE_AD') ? '<i class="fa fa-check"></i> Active' : tr('approved') !!}</span>
								      		@elseif($ads_detail_details->top_ads_status == DEFAULT_TRUE_BIT)
								      			<span class="label label-success">{!! ($ads_detail_details->ad_type == 'HOME_AD' || $ads_detail_details->ad_type == 'VIDEO_PAGE AD' || $ads_detail_details->ad_type == 'SEARCH_PAGE_AD') ? '<i class="fa fa-check"></i> Active' : tr('approved') !!}</span>	
								       		@else
								       			<span class="label label-warning">{!! ($ads_detail_details->ad_type == 'HOME_AD' || $ads_detail_details->ad_type == 'VIDEO_PAGE AD' || $ads_detail_details->ad_type == 'SEARCH_PAGE_AD') ? '<i class="fa fa-remove"></i> Inactive' : tr('pending') !!}</span>
								       		@endif
								      	</td>
									    
									    <td>
	            							<ul class="admin-action btn btn-default">
	            								
	            								<li class="dropup">
									                
									                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
									                  {{ tr('action') }} <span class="caret"></span>
									                </a>
									                
									                <ul class="dropdown-menu" style="margin-left: -58px;">
									                		
									                  	<li role="presentation">
									                  		<a role="menuitem" tabindex="-1" href="{{ route('admin.ads-details.view' , ['ads_detail_id' => $ads_detail_details->id] ) }}">{{ tr('view') }}</a>
									                  	</li>							                  	
                                                        @if(Setting::get('admin_delete_control') == YES )            
                                                            <li role="presentation">
                                                            	<a role="button" href="javascript:;" class="btn disabled" style="text-align: left">{{ tr('edit') }}</a>
                                                            </li>

                                                            <li role="presentation">
                                                            	<a role="button" href="javascript:;" class="btn disabled" style="text-align: left">{{ tr('delete') }}</a>
                                                            </li>

                                                        @else

                                                            <li role="presentation">
                                                            	<a role="menuitem" tabindex="-1" href="{{ route('admin.ads-details.edit' , ['ads_detail_id' => $ads_detail_details->id] ) }}">{{ tr('edit') }}</a>
                                                            </li>

                                                            <li role="presentation">
                                                            	<a role="menuitem" tabindex="-1" onclick="return confirm(&quot;{{ tr('admin_ads_detail_delete_confirmation', $ads_detail_details->name) }}&quot;)"  href="{{ route('admin.ads-details.delete' , ['ads_detail_id' => $ads_detail_details->id] ) }}">{{ tr('delete') }}</a>
                                                            </li>
                                                        @endif
	                                                    
									                  	@if($ads_detail_details->status == DEFAULT_TRUE)
									                  		<li role="presentation">
									                  			<a role="menuitem" tabindex="-1" href="{{ route('admin.ads-details.status' , ['ads_detail_id' => $ads_detail_details->id] ) }}" onclick="return confirm(&quot;{{ tr('admin_ads_detail_decline_confirmation', $ads_detail_details->name) }}&quot;)">{{ ($ads_detail_details->ad_type == 'HOME_AD' || $ads_detail_details->ad_type == 'VIDEO_PAGE AD' || $ads_detail_details->ad_type == 'SEARCH_PAGE_AD') ? "De-activate ad 1" : tr('decline') }}</a>
									                  		</li>
									                  	@else
									                  		<li role="presentation">
									                  			<a role="menuitem" tabindex="-1" href="{{ route('admin.ads-details.status' , ['ads_detail_id' => $ads_detail_details->id ] ) }}" onclick="return confirm(&quot;{{ tr('admin_ads_detail_approve_confirmation', $ads_detail_details->name) }}&quot;)" >{{ ($ads_detail_details->ad_type == 'HOME_AD' || $ads_detail_details->ad_type == 'VIDEO_PAGE AD' || $ads_detail_details->ad_type == 'SEARCH_PAGE_AD') ? "Activate as ad 1" : tr('approve') }}</a>
									                  		</li>
									                  	@endif
									                  	<!-- /////Top Ads 
									                  	Activate////////// -->
									                  	@if($ads_detail_details->top_ads_status == DEFAULT_TRUE_BIT)
									                  		<li role="presentation">
									                  			<a role="menuitem" tabindex="-1" href="{{ route('admin.ads-details.top_status' , ['ads_detail_id' => $ads_detail_details->id] ) }}" onclick="return confirm(&quot;{{ tr('admin_ads_detail_decline_confirmation', $ads_detail_details->name) }}&quot;)">{{ ($ads_detail_details->ad_type == 'HOME_AD' || $ads_detail_details->ad_type == 'VIDEO_PAGE AD' || $ads_detail_details->ad_type == 'SEARCH_PAGE_AD') ? "De-activate ad 2" : tr('decline') }}</a>
									                  		</li>
									                  	@else
									                  		<li role="presentation">
									                  			<a role="menuitem" tabindex="-1" href="{{ route('admin.ads-details.top_status' , ['ads_detail_id' => $ads_detail_details->id ] ) }}" onclick="return confirm(&quot;{{ tr('admin_ads_detail_approve_confirmation', $ads_detail_details->name) }}&quot;)" >
									                  			
									                  				{{ ($ads_detail_details->ad_type == 'HOME_AD' || $ads_detail_details->ad_type == 'VIDEO_PAGE AD' || $ads_detail_details->ad_type == 'SEARCH_PAGE_AD') ? "Activate as ad 2" : tr('approve') }}
									                  			
									                  			</a>
									                  		</li>
									                  	@endif
									                  	<!-- /////////////////// -->
									                  	@if($ads_detail_details->status == DEFAULT_TRUE && (!in_array($ads_detail_details->ad_type, ["HOME_AD", "VIDEO_PAGE AD"])))

									                  		<li role="presentation">
									                  			<a  href="{{ route('admin.videos.assign_ad', ['id' => $ads_detail_details->id])}}">{{ tr('assign_ad') }}</a>
									                  		</li>

									                  	@endif
									              															
									                  	<li class="divider" role="presentation"></li>

									                </ul>

	              								</li>

	            							</ul>

									    </td>

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
