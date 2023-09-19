@extends('layouts.admin')

@section('title', tr('verification_request'))

@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('assets/image-viewer/magnific-popup.css')}}">
<style type="text/css">
    .images{
        cursor: pointer;
    }
</style>
@endsection

@php
	$content_header = tr('verification_request'); 
 
 	if(!is_null($verification_request)){
 		$status = '';
 		if($verification_request->is_verified === null){
 			$status = '<i class="fa fa-clock-o" style="padding-left: 5px;font-size:18px;color:orange"> Pending</i>';
 		} else if($verification_request->is_verified === 1){
 			$status = '<i class="fa fa-check-circle" style="padding-left: 5px; font-size:18px;color:green"> Verified</i>';
 		}else if($verification_request->is_verified === 0){
 			$status = '<i class="fa fa-times-circle-o" style="padding-left: 5px;font-size:18px;color:red"> Declined</i>'; 		
 		}else{
 			$status = '<i class="fa fa-clock-o" style="padding-left: 5px;font-size:18px;color:orange"> Pending</i>';
 		}
 		$content_header .= $status;	
 	}

@endphp

@section('content-header',$content_header )

@section('breadcrumb')
    <li><a href="{{route('admin.channels.verification.request.list')}}"><i class="fa fa-suitcase"></i> Channel Verification Requests</a></li>
    <li class="active">{{tr('verification_request')}}</li>
@endsection

@section('content')

<div class="row">

    <div class="col-md-12">

        @include('notification.notify')

        <div class="box box-primary">

            <div class="box-header label-primary">
                <b style="font-size:18px;">{{ tr('verification_request') }} Details</b>
                <!-- <a href="{{ route('admin.channels.index') }}" class="btn btn-default pull-right">{{ tr('channels') }}</a> -->
            </div>

		    

        	@if(is_null($verification_request))
        	<div class="box-body">
        		<div class="col-sm-12">
	                <div class="form-group text-center">
	                    <h3>No Request Submitted</h3>
	                </div>
	            </div>
	        </div>
        	@else
			<div class="box box-primary">

	            <div class="box-header ">
	                <b style="font-size:16px;">Channel Details</b>
	            </div>
	            <div class="box-body">
	            	<div class="col-sm-6">
		                <div class="form-group">
		                    <label  class="control-label">Subscribers</label>
		                    <input type="text" class="form-control" value="{{ $channel_details->get_channel_subscribers_count }}" disabled>
		                </div>
		            </div>
		            <div class="col-sm-6">
		                <div class="form-group">
		                    <label  class="control-label">No of Videos</label>
		                    <input type="text" class="form-control" value="{{ $channel_details->get_video_tape_count }}" disabled>
		                </div>
		            </div>
		            <div class="col-sm-6">
		                <div class="form-group">
		                    <label  class="control-label">Strikes </label>
		                    <input type="text" class="form-control" value="0" disabled>
		                </div>
		            </div>
		            <div class="col-sm-6">
		                <div class="form-group">
		                    <label  class="control-label">Channel Age</label>
		                    <input type="text" class="form-control" value="{{\Carbon\Carbon::parse( $channel_details->created_at)->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days')}}" disabled>
		                </div>
		            </div>
	            </div>
	        </div>

	        <div class="box" style="border-top:none">
	        	<div class="box-header">
	                <b style="font-size:16px;">Verfication Details</b>
	            </div>
	            
	        	<form action="{{route('admin.channels.verification.request.update')}}" method="POST" enctype="multipart/form-data" role="form">
			        <input type="hidden" name="channel_id" value="{{ $channel_details->id }}"> 
			        <input type="hidden" name="request_id" value="{{ $verification_request->id }}">

		        	<div class="box-body">
		        		
			        	<div class="col-sm-6">
			                <div class="form-group">
			                    <label  class="control-label">First Name *</label>
			                    <input type="text" class="form-control" id="name" value="{{$verification_request->first_name}}" disabled>
			                </div>
			            </div>

			            <div class="col-sm-6">
			                <div class="form-group">
			                    <label class="control-label">Last Name *</label>
			                    <input type="text"  class="form-control" id="name" value="{{$verification_request->last_name}}" disabled>
			                </div>
			            </div>

			            <div class="col-sm-6">
			                <div class="form-group">
			                    <label  class="control-label">DOB*</label>
			                    <input type="text"  class="form-control" id="name" value="{{$verification_request->dob}}" disabled>
			                </div>
			            </div>

			            <div class="col-sm-6">
			                <div class="form-group">
			                    <label class="control-label">SSN *</label>
			                    <input type="text"  class="form-control" id="name" value="{{$verification_request->ssn}}" disabled>
			                </div>
			            </div>

			            <div class="col-sm-6">
			                <div class="form-group">
			                    <label class="control-label">Address *</label>
			                    <input type="text" class="form-control" id="name" value="{{$verification_request->address1}}" disabled>
			                </div>
			            </div>

			            <div class="col-sm-6">
			                <div class="form-group">
			                    <label  class="control-label">Address2</label>
			                    <input type="text"  class="form-control" id="name" value="{{$verification_request->address2}}" disabled>
			                </div>
			            </div>

			            <div class="col-sm-6">
			                <div class="form-group">
			                    <label class="control-label">Countrty*</label>
			                    <input type="text"  class="form-control" id="name" value="{{$verification_request->country->name}}" disabled>
			                </div>
			            </div>

			            <div class="col-sm-6">
			                <div class="form-group">
			                    <label for="name" class="control-label">State</label>
			                    <input type="text"  class="form-control" id="name" value="{{$verification_request->state->name}}" disabled>
			                </div>
			            </div>

			             <div class="col-sm-6">
			                <div class="form-group">
			                    <label class="control-label">City*</label>
			                    <input type="text"  class="form-control" id="name" value="{{$verification_request->city->name}}" disabled>
			                </div>
			            </div>

			            <div class="col-sm-6">
			                <div class="form-group">
			                    <label for="name" class="control-label">Postal Code</label>
			                    <input type="text"  class="form-control" id="name" value="{{$verification_request->zip_code}}" disabled>
			                </div>
			            </div>
			            
			            @if(Setting::get('documentupload_channel_verification_setting_1_status') == 1)
                    
			            <div class="col-sm-6">
			                <div class="form-group">                        
			                    <label for="picture" class="control-label"> {{Setting::get('documentupload_channel_verification_setting_1')}}*</label>
			                    <div style="height: 260px;">
				                    @if($verification_request->idFrontImage)
				                        <img class="images" style="max-height: 250px;margin-bottom: 15px; border-radius:.25em; max-width: 100%" src="{{ $verification_request->idFrontImage->url }}">
				                    @else
				                    	No Image Uploaded
				                    @endif
			                    </div>
			                    
			                </div>
			            </div>
			        	@endif

			        	@if(Setting::get('documentupload_channel_verification_setting_2_status') == 1)
                    
			            <div class="col-sm-6">
			                <div class="form-group">                        
			                    <label for="picture" class="control-label"> {{Setting::get('documentupload_channel_verification_setting_2')}}*</label>
			                    <div style="height: 260px;">
				                    @if($verification_request->idBackImage)
				                        <img class="images" style="max-height: 250px;margin-bottom: 15px; border-radius:.25em; max-width: 100%" src="{{ $verification_request->idBackImage->url }}">
				                    @else
				                    	No Image Uploaded
				                    @endif
			                    </div>
			                    
			                </div>
			            </div>
			            @endif

			            @if(Setting::get('documentupload_channel_verification_setting_3_status') == 1)
                    
			            <div class="col-sm-6">
			                <div class="form-group">                        
			                    <label for="picture" class="control-label"> {{Setting::get('documentupload_channel_verification_setting_3')}}*</label>
			                    <div style="height: 260px;">
				                    @if($verification_request->selfImage)
				                        <img class="images" style="max-height: 250px;margin-bottom: 15px; border-radius:.25em; max-width: 100%" src="{{ $verification_request->selfImage->url }}">
				                    @else
				                    	No Image Uploaded
				                    @endif
			                    </div>
			                    
			                </div>
			            </div>
			            @endif
			        </div>

			        <div class="col-sm-12">
		                <div class="form-group">                        
		                    <label for="decline_reason" class="control-label">Decline Reason(if request decline*)</label>
		                    <textarea  style="height: 200px" class="form-control" id="decline_reason" name="decline_reason">{{ $verification_request->decline_reasons }}</textarea>
		                </div>
		            </div>
		            <br>
			        <div class="box-footer">
			            <button type="submit" class="btn btn-danger" name="action" value="decline" {{$channel_details->verificationStatus() === null || $channel_details->verificationStatus() === -1 ? '':'disabled'}}>Decline</button>
			            <button type="submit" class="btn btn-success pull-right"  name="action" value="approve" {{$channel_details->verificationStatus() === null || $channel_details->verificationStatus() === -1 ? '':'disabled'}}>Approve</button>
			        </div>
			       
			    </form>
			</div>
	        @endif
		            
        </div>

    </div>

</div>
<a class="image-link" href="{{ $verification_request->idFrontImage->url }}" style="display:none"></a>


@endsection

@section('scripts')
   <script src="{{asset('assets/image-viewer/jquery.magnific-popup.min.js')}}"></script>

   <script src="https://cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script>
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/31.1.0/inline/ckeditor.js"></script> -->
    <script>
        CKEDITOR.replace( 'decline_reason' );
        // InlineEditor
        // .create( document.querySelector( '#decline_reason' ) )
        // .catch( error => {
        //     console.error( error );
        // } );
        $(document).ready(function() {
        	$('.images').click(function(){
        		url = $(this).attr('src');
        		$.magnificPopup.open({
				  items: {
				    src: url,
				  },
				  type: 'image'
				});

        	});	

		    
		});
    </script>
@endsection