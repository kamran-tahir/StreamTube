@extends('layouts.admin')

@section('title', tr('assign_ad'))

@section('content-header', tr('assign_ad'))

@section('breadcrumb')
    <li><a href="{{route('admin.ads-details.index')}}"><i class="fa fa-bullhorn"></i>{{tr('video_ads')}}</a></li>
    <li class="active"><i class="fa fa-bullhorn"></i> {{tr('assign_ad')}}</li>
@endsection

@section('content')

@include('notification.notify')

<div class="row">
    
    <div class="col-xs-12">
    
        <div class="box box-primary">
			<div class="box-header label-primary">
				<b style="font-size:18px;">{{tr('assign_ad')}}</b>
			</div>

			<div class="box-body">
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="{{ !isset($_GET['id']) ? 'active' : ''}}"><a href="#selected-ad" aria-controls="selected-ad" role="tab" data-toggle="tab">1. Select Ad</a></li>
					<li role="presentation" class="{{ !isset($_GET['channel_id']) ? 'active' : ''}}"><a href="#selected-channel" aria-controls="selected-channel" role="tab" data-toggle="tab">2. Select Channel</a></li>
					<li role="presentation" class="{{ (isset($_GET['id']) && (isset($_GET['channel_id']))) ? 'active' : ''}}"><a href="#selected-videos" aria-controls="selected-videos" role="tab" data-toggle="tab">3. Select Videos</a></li>
				</ul>
				
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane {{ !isset($_GET['id']) ? 'active' : ''}}" id="selected-ad">
						<div class="row" style="margin-bottom: 1em; padding-left: 1em">
							<div class="col-xs-2">Title</div>
							<div class="col-xs-10">{{ $ad_details->name}}</div>
						</div>
						<div class="row" style="margin-bottom: 1em; padding-left: 1em">
							<div class="col-xs-2">Duration</div>
							<div class="col-xs-10">{{ $ad_details->ad_time}}</div>
						</div>
						<div class="row" style="margin-bottom: 1em; padding-left: 2em">
							<img src="{{ $ad_details->file}}" alt="" width="500">
							<video src="{{ $ad_details->file}}" height="360"></video>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane {{!isset($_GET['channel_id']) ? 'active' : ''}}" id="selected-channel">
            @php
              $videos = array();
            @endphp
						@if ($channel)
              <div class="row" style="margin-bottom: 1em; padding-left: 1em">
							 <div class="col-xs-2">Selected channel(s)</div>
              </div>
              @foreach($channel as $channel_data)
							<div class="row" style="margin-bottom: 1em; padding-left: 1em">
                <div class="col-xs-2"></div>
								<div class="col-xs-10">{{ $channel_data->name}}</div>
							</div>
							<div class="row" style="margin-bottom: 1em; padding-left: 1em">
								<div class="col-xs-2"></div>
								<div class="col-xs-10">
									<img src="{{ $channel_data->picture}}" alt="" width="150">
								</div>
              </div>
              <br>
              @php
                $videos = array_merge($videos, $channel_data->videoTape->toArray());
              @endphp
              @endforeach
              <span class="h4">Choose another channel:</span>
              <br>
            @endif
						@if(count($channelList))

              <label class="">
                <input type="checkbox" name="select_all_channels" id="select-all-channels">
                {{ tr('check_all') }}
              </label>
							<table class="table table-bordered table-striped">
								@foreach ($channelList as $chn)
									<tr>
                    <td>
                      <input type="checkbox" class="channel-selection-box" name="selected_channels[]" value="{{ $chn->id }}">
                    </td>
										<td><img src="{{ $chn->picture}}" alt="" height="60"></td>
										<td>{{ $chn->name}}</td>
										<td>
											<a href="{{route('admin.videos.assign_ad',['id'=> $ad_details->id, 'channel_id'=> $chn->id])}}" class="btn btn-info">
												Select
											</a>
										</td>
									</tr>
								@endforeach
							</table>
              <a href="{{route('admin.videos.assign_ad',['id'=> $ad_details->id, 'channel_id'=> 'all'])}}" class="btn btn-info pull-right hide" id="selected-all-channels">
                {{ tr('next') }}
              </a>
						@endif
					</div>
					<div role="tabpanel" class="tab-pane {{ (isset($_GET['id']) && (isset($_GET['channel_id']))) ? 'active' : ''}}" id="selected-videos">

						@if (!count($videos))
							<h3 class="no-result">No video found</h3>
						@else
							<form action="{{route('admin.videos.assign_ad')}}" id="selected-videos-form" method="GET">
								<input type="hidden" name="step" value="final">
								<input type="hidden" name="id" value="{{$ad_details->id}}">
								<input type="hidden" name="channel_id" value="{{$_GET['channel_id']}}">
                <label class="">
                  <input type="checkbox" name="select_all_videos" id="select-all-videos">
                  {{ tr('check_all') }}
                </label>
                <div class="">
			<button class="btn btn-info pull-right">{{tr('assign')}}</button>
		</div>
								<table class="table table-bordered table-striped">
									@foreach ($videos as $video)
										<tr>
											<td>
												<input type="checkbox" class="video-selection-box" name="selected_videos[]" value="{{$video['video_tape_id']}}">
											</td>
											<td><img src="{{ $video['default_image']}}" alt="" height="60"></td>
											<td>{{ $video['title']}}</td>
										</tr>
									@endforeach
								</table>
								
							</form>
						@endif
					</div>
				</div>
			</div>
      </div>
    </div>
</div>

@endsection

@section('scripts')

<script language="javascript">

function getCheckBoxValue(id, i) {

    if($('#'+id).is(":checked")) {

        $("#video_time_div_"+i).show();

        $("#video_time_"+i).attr('required', true);

    } else {

      $('#video_time_'+i).val('');

      $("#video_time_div_"+i).hide();

      $("#video_time_"+i).removeAttr('required');
   

    }

}

$("#assign_ad").click(function(event){

    event.preventDefault();

    var searchIDs = $("#example1 input:checkbox:checked").map(function(){
      return $(this).val();
    }).get(); 

    if(searchIDs.length == 0) {

      alert("Select any one of the Video and Assign ad");

      return false;

    } else {

      $("#video_tape_id").val(searchIDs.join(','));

      @if($ad_details->ad_type == POST_AD || $ad_details->ad_type == PRE_AD)

        $("#submit-btn").click();

      @endif

    }


});

$("#select-all-channels").on('click', function() {
  if (this.checked) {
    $(".channel-selection-box").prop('checked', true);
    $("#selected-all-channels").removeClass('hide');
  } else {
    $(".channel-selection-box").removeAttr('checked');
    $("#selected-all-channels").addClass('hide');
  }
});

$("#select-all-videos").on('click', function() {
  if (this.checked) {
    $(".video-selection-box").prop('checked', true);
  } else {
    $(".video-selection-box").removeAttr('checked');
  }
});
</script>

@endsection


<?php /*

@extends('layouts.admin')

@section('title', tr('assign_ad'))

@section('content-header', tr('assign_ad'))

@section('breadcrumb')
    <li><a href="{{route('admin.ads-details.index')}}"><i class="fa fa-bullhorn"></i>{{tr('video_ads')}}</a></li>
    <li class="active"><i class="fa fa-bullhorn"></i> {{tr('assign_ad')}}</li>
@endsection

@section('content')
  <div class="row">

      @include('notification.notify')

      @if(count($video_tapes) > 0)

        <div class="col-lg-12" style="margin-bottom: 10px;">

          <div class="pull-right">

              <input type="checkbox" name="select_all" id="selectall" style="vertical-align: middle;" /> {{tr('check_all')}} &nbsp;&nbsp;

              @if($ad_details->ad_type == PRE_AD || $ad_details->ad_type == POST_AD)

                  <button id="assign_ad" type="button" class="btn btn-sm btn-success">{{tr('assign_ad')}}</button>

              @else

                <!-- Trigger the modal with a button -->
                  <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#myModal" id="assign_ad">{{tr('assign_ad')}}</button>

              @endif

          </div>

          <div class="clearfix"></div>
        </div>

        <div id="assign_ad_div">
          @foreach($video_tapes as $video)
          <div class="col-sm-3">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">{{$video->title}}</h3>
                <span class="pull-right"><input type="checkbox" class="case" name="select_item" id="select_item" value="{{$video->id}}"></span>
              </div><!-- /.box-header -->
              <div class="box-body">
                <!-- <p>Compiled and ready to use in production. Download this version if you don't want to customize AdminLTE's LESS files.</p> -->
                <img src="{{$video->default_image}}" style="width: 100%; height: 130px; margin-bottom: 10px;" />
                <p><b>{{tr('type_of_ads')}} : </b> {{($video->getVideoAds) ? implode(',' , getTypeOfAds($video->getVideoAds->types_of_ad)) : '-'}}</p>
                <a href="{{route('admin.video_tapes.view' , array('video_tape_id' => $video->id))}}" class="btn btn-primary" target="_blank"><i class="fa fa-eye"></i> {{tr('view')}}</a>
              </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div><!-- /.col -->
          @endforeach
        </div>

        <div class="col-lg-12">

            <div align="center" id="paglink">{{$video_tapes->links()}}</div>

        </div>

      @endif

      @if(count($video_tapes) == 0) 

      <div class="col-lg-12">{{tr('no_videos_found')}}</div>

      @endif

      <!-- Modal -->
      <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <form method="post" action="{{route('admin.video-ads.assign.ads')}}" id="assing_ad_form">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">{{tr('assign_ad')}}</h4>
            </div>
            <div class="modal-body">
              <p>{{tr('ad_note_for_video_time')}}</p>

              
                
                <input type="hidden" name="ad_id" id="ad_id" value="{{$ad_details->id}}">

                <input type="hidden" name="video_tape_ids" id="video_tape_id" required>

                <input type="hidden" name="ad_type" id="ad_type" value="{{$ad_details->ad_type}}"> 

                @if($ad_details->ad_type == PRE_AD || $ad_details->ad_type == POST_AD)

                  <input type="hidden" name="video_time" id="video_time">

                @else 

                <div class="row">

                  <div class="col-lg-12">

                    <label>{{tr('video_time')}}</label>

                    <input type="text" name="video_time" id="video_time" class="form-control" placeholder="hh:mm:ss" required>

                  </div>

                </div>

                @endif

              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">{{tr('close')}}</button>
              <button type="submit" class="btn btn-success" id="submit-btn">{{tr('assign')}}</button>
            </div>
          </div>

          </form>

        </div>
      </div>

@endsection


@section('scripts')

<SCRIPT language="javascript">

$(function(){

  $("#selectall").click(function () {
      $('.case').prop('checked', this.checked);
  });

  $(".case").click(function(){
    if($(".case").length == $(".case:checked").length) {
      $("#selectall").prop("checked", "checked");
    } else {
      $("#selectall").removeAttr("checked");
    }
  });
});

$("#assign_ad").click(function(event){

    event.preventDefault();

    var searchIDs = $("#assign_ad_div input:checkbox:checked").map(function(){
      return $(this).val();
    }).get(); 

    if(searchIDs.length == 0) {

      alert("Select any one of the Video and Assign ad");

      return false;

    } else {

      $("#video_tape_id").val(searchIDs.join(','));

      @if($ad_details->ad_type == POST_AD || $ad_details->ad_type == PRE_AD)

        $("#submit-btn").click();

      @endif

    }


});
</SCRIPT>

@endsection */ ?>
