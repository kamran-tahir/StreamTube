@extends('layouts.admin') 

@section('title', tr('channels')) 

@section('content-header') 

@if(isset($user)) 

	<span class="text-green"> {{ $user->name }} </span>- 

@endif {{ tr('channels') }} Verifications Requests

@endsection 

@section('breadcrumb')
	 
	<li class="active"><i class="fa fa-suitcase"></i> {{ tr('channels') }} Verifications</li>
@endsection 

@section('content')

<div class="row">

    <div class="col-xs-12">

        @include('notification.notify')
        <div class="nav-tabs-custom">
		        <ul class="nav nav-tabs">
		          	<li class="active"><a href="#pending" data-toggle="tab" aria-expanded="true" class="text-blue text-bold"> Pending</a></li>
		          	<li class=""><a href="#verified" data-toggle="tab" aria-expanded="true" class="text-green text-bold"> Verified</a></li>
		          	<li class=""><a href="#rejected" data-toggle="tab" aria-expanded="true" class="text-red text-bold"> Rejected</a></li>
		          	
		          	
				</ul>
				<div class="tab-content">

		          	<div class="tab-pane active" id="pending">

				        <div class="box box-primary">

				            <div class="box-body table-responsive">

				                @if(count($channel_requests['']) > 0)

				                <table id="example1" class="table table-bordered table-striped">

				                    <thead>
				                        <tr>
				                            <th>{{ tr('id') }}</th>
				                            <th>{{ tr('channel') }}</th>
				                            <th>{{ tr('user_name') }}</th>
				                            <th>{{ tr('no_of_videos') }}</th>
				                            <th>{{ tr('subscribers') }}</th>
				                            <th>{{ tr('action') }}</th>
				                        </tr>
				                    </thead>

				                    <tbody>

				                        @foreach($channel_requests[''] ?? [] as $i => $channel_request)

					                        <tr>
					                            <td>{{ $i+1 }}</td>

					                            <td><a target="_blank" href="{{ route('admin.channels.view',['channel_id' => $channel_request->channel->id] ) }}">{{ $channel_request->channel->name }}</a></td>

					                            <td><a target="_blank" href="{{ route('admin.users.view', ['user_id' => $channel_request->channel->user_id] ) }}">{{ $channel_request->channel->getUser ? $channel_request->channel->getUser->name : '' }}</a></td>

					                            <td><a target="_blank" href="{{ route('admin.channels.videos', ['channel_id'=> $channel_request->channel->id] ) }}">{{ $channel_request->channel->get_video_tape_count }}</a></td>

					                            <td><a target="_blank" href="{{ route('admin.channels.subscribers', ['channel_id' => $channel_request->channel->id]) }}">{{ $channel_request->channel->get_channel_subscribers_count }}</a></td>

					                            <td>
					                                 <a role="menuitem" tabindex="-1" href="{{route('admin.channels.verification.request', ['channel_id' => $channel_request->channel->id])}}"> <i class="fa fa-edit"></i>
                                                        {{ tr('verification_request') }}
                                                        </a>
					                            </td>

					                        </tr>

				                        @endforeach

				                    </tbody>

				                </table>

				                @else

				                	<h5 class="no-result">No Pending Requests</h5> 

				                @endif

				            </div>

				        </div>
				    </div>


				    <div class="tab-pane " id="verified">

				        <div class="box box-primary">

				            <div class="box-body table-responsive">

				                @if(count($channel_requests[1]) > 0)

				                <table id="example2" class="table table-bordered table-striped">

				                    <thead>
				                        <tr>
				                            <th>{{ tr('id') }}</th>
				                            <th>{{ tr('channel') }}</th>
				                            <th>{{ tr('user_name') }}</th>
				                            <th>{{ tr('no_of_videos') }}</th>
				                            <th>{{ tr('subscribers') }}</th>
				                            <th>{{ tr('action') }}</th>
				                        </tr>
				                    </thead>

				                    <tbody>

				                        @foreach($channel_requests[1] ?? [] as $i => $channel_request)

					                        <tr>
					                            <td>{{ $i+1 }}</td>

					                            <td><a target="_blank" href="{{ route('admin.channels.view',['channel_id' => $channel_request->channel->id] ) }}">{{ $channel_request->channel->name }}</a></td>

					                            <td><a target="_blank" href="{{ route('admin.users.view', ['user_id' => $channel_request->channel->user_id] ) }}">{{ $channel_request->channel->getUser ? $channel_request->channel->getUser->name : '' }}</a></td>

					                            <td><a target="_blank" href="{{ route('admin.channels.videos', ['channel_id'=> $channel_request->channel->id] ) }}">{{ $channel_request->channel->get_video_tape_count }}</a></td>

					                            <td><a target="_blank" href="{{ route('admin.channels.subscribers', ['channel_id' => $channel_request->channel->id]) }}">{{ $channel_request->channel->get_channel_subscribers_count }}</a></td>

					                            <td>
					                                 <a role="menuitem" tabindex="-1" href="{{route('admin.channels.verification.request', ['channel_id' => $channel_request->channel->id])}}"> <i class="fa fa-eye"> View Details</i>
                                                        </a>
					                            </td>

					                        </tr>

				                        @endforeach

				                    </tbody>

				                </table>

				                @else
				                	<h5 class="no-result">No Verified Requests</h5> 

				                @endif

				            </div>

				        </div>
				    </div>


				    <div class="tab-pane" id="rejected">

				        <div class="box box-primary">

				            <div class="box-body table-responsive">

				                @if(count($channel_requests[0]) > 0)

				                <table id="example3" class="table table-bordered table-striped">

				                    <thead>
				                        <tr>
				                            <th>{{ tr('id') }}</th>
				                            <th>{{ tr('channel') }}</th>
				                            <th>{{ tr('user_name') }}</th>
				                            <th>{{ tr('no_of_videos') }}</th>
				                            <th>{{ tr('subscribers') }}</th>
				                            <th>{{ tr('action') }}</th>
				                        </tr>
				                    </thead>

				                    <tbody>

				                        @foreach($channel_requests[0] ?? [] as $i => $channel_request)

					                        <tr>
					                            <td>{{ $i+1 }}</td>

					                            <td><a target="_blank" href="{{ route('admin.channels.view',['channel_id' => $channel_request->channel->id] ) }}">{{ $channel_request->channel->name }}</a></td>

					                            <td><a target="_blank" href="{{ route('admin.users.view', ['user_id' => $channel_request->channel->user_id] ) }}">{{ $channel_request->channel->getUser ? $channel_request->channel->getUser->name : '' }}</a></td>

					                            <td><a target="_blank" href="{{ route('admin.channels.videos', ['channel_id'=> $channel_request->channel->id] ) }}">{{ $channel_request->channel->get_video_tape_count }}</a></td>

					                            <td><a target="_blank" href="{{ route('admin.channels.subscribers', ['channel_id' => $channel_request->channel->id]) }}">{{ $channel_request->channel->get_channel_subscribers_count }}</a></td>

					                            <td>
					                                 <a role="menuitem" tabindex="-1" href="{{route('admin.channels.verification.request', ['channel_id' => $channel_request->channel->id])}}"> <i class="fa fa-eye"> View Details</i>
                                                        </a>
					                            </td>

					                        </tr>

				                        @endforeach


				                    </tbody>

				                </table>

				                @else
				                	<h5 class="no-result">No Rejected Requests</h5> 

				                @endif

				            </div>

				        </div>
				    </div>


				</div>

    </div>

</div>


@endsection