@extends('layouts.user')

@section('meta_tags')

    <meta property="og:locale" content="en_US" />

    <meta property="og:type" content="article" />

    <meta property="og:title" content="{{$video->title}}" />

    <meta property="og:description" content="<?= $video->title ?>" />

    <meta property="og:url" content="" />

    <meta property="og:site_name" content="@if(Setting::get('site_name')) 
    {{Setting::get('site_name') }} @else {{tr('site_name')}} @endif" />

    <meta property="og:image" content="{{$video->default_image}}" />

    <meta name="twitter:card" content="summary"/>

    <meta name="twitter:description" content="<?= $video->title ?>"/>

    <meta name="twitter:title" content="{{$video->title}}"/>

    <meta name="twitter:image:src" content="{{$video->default_image}}"/>

@endsection

@section('styles')

<link rel="stylesheet" href="{{asset('assets/css/ssutar-rating.css')}}">

<link rel="stylesheet" href="{{asset('assets/css/toast.style.css')}}">

<style type="text/css">

    .sub-comhead .rating-md {
        font-size: 11px;
    }

    .thumb-class {
        cursor: pointer;
        text-decoration: none;
    }

    .common-streamtube {
        min-height: 0px !important;
    }

    textarea[name=comments] {
        resize: none;
    }

    #timings {
        padding: 5px;
    }

    .ad_progress {
        position: absolute;
        bottom: 0px;
        width: 100%;
        opacity: 0.8;
        background: #000;
        color: #fff;
        font-size: 12px;
    }

    .progress-bar-div {
        width: 100%;
        height: 5px;
        background: #e0e0e0;
        /*padding: 3px;*/
        border-radius: 3px;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, .2);
    }

    .progress-bar-fill-div {
        display: block;
        height: 5px;
        background: #cc181e;
        border-radius: 3px;
        /*transition: width 250ms ease-in-out;*/
        /*transition : width 10s ease-in-out;*/
    }

    th {
        border-top: none;
    }

</style>

@endsection

@section('content')

<div class="y-content">

   <div class="row y-content-row">

        @include('layouts.user.nav')

        <div class="page-inner col-sm-9 col-md-10 profile-edit" id="ajax">

             <div class="profile-content mar-0">

                @include('notification.notify')

                <div class="row no-margin">

                   <div class="col-sm-12 col-md-8 play-video">

                        <div class="single-video-sec">
                            @include('user.videos.streaming')
                        </div>
                        
                      <div class="main-content">
                         <div class="video-content">
                            <div class="video" style="position: relative;">
                                <video src="{{$video->video}}" type="video/mp4" width="100%" height="auto" controls id="single-video" autoplay style="position:relative; z-index:0;">
                                    Your browser does not support the video tag.
                                </video>
                                <div style="position:absolute; bottom: 4.5em; z-index:1; width: 100%; display:none" id="banner-container">
                                    <img src="" id="banner-image" style=" width: 94%; margin-left: 3%;    max-height: 98px;">
                                    <!-- <span style="position: absolute; right: 3%; padding: 3px; background: #ffa2a2; cursor: pointer" onclick="$(this).parent().hide()">
                                       <i class="fa fa-close"></i>
                                    </span> -->
                                    <span id="cross_btn" style="position: absolute; right: 3%;background: #ffa2a2; cursor: pointer" onclick="$(this).parent().hide()">
                                       <i class="fa fa-close"></i>
                                    </span>
                                 </div>
                                 <div id="skip-btn" style="position: absolute; right: 5%; bottom: 4.5em; padding: 5px 15px; display:none; background: #333; color: #eaeaea; opacity: 0.6;cursor: pointer;">
                                    Skip
                                 </div>
                                 @if ($ads->last()->ad_type == 'VIDEO')
                                    <div id="redirect-btn" style="position: absolute; left: 3.5%; bottom: 5em; padding: 5px 15px; background: #fff; opacity: 0.9; display:none; z-index: 2">
                                       <span>{{str_limit($ads->last()->name, 25)}}</span>
                                       
                                       <a href="{{ $ads->last()->ad_url }}" class="btn btn-primary visit_btn confirm-redirection">Visit Now</a>
                                    </div>
                                 @elseif ($ads->last()->ad_type == 'BANNER')
                                    <div id="redirect-btn" style="position: absolute; right: 1%; bottom: 4.2em; padding: 5px 15px; opacity: 0.9; display:none; z-index: 2">
                                       <a href="{{ $ads->last()->ad_url }}" class="btn btn-primary visit_btn confirm-redirection">Visit Now</a>
                                    </div>
                                 @endif
                            </div>
                            <div class="details">
                               <div class="video-title">
                                  <div class="title row">
                                     <div class="col-lg-12 col-md-12 col-sm-12 col-lg-12 zero-padding">
                                        <h3>{{$video->title}}</h3>
                                        <div class="views pull-left">
                                           {{number_format_short($video->watch_count)}} {{tr('views')}}
                                        </div>
                                        <div class="pull-right relative">
                                           @if (Auth::check())
                                             @if($video->downloadable)
                                                <a class="thumb-class" href="{{route('user.download_video', $video->video_tape_id)}}" target="_blank" style="margin-right: 1em"><i class="material-icons">download</i></a>
                                             @endif
                                                <a class="thumb-class" onclick="likeVideo({{$video->video_tape_id}})"><i class="material-icons">thumb_up</i>&nbsp;<span id="like_count">{{number_format_short($like_count)}}</span></a>&nbsp;&nbsp;&nbsp;
                                             <a class="thumb-class" onclick="dislikeVideo({{$video->video_tape_id}})"><i class="material-icons ali-midd-20">thumb_down</i>&nbsp;<span id="dislike_count">{{number_format_short($dislike_count)}}</span></a>
                                           @else 
                                           <a class="thumb-class" data-toggle="modal" data-target="#login_error"><i class="material-icons">thumb_up</i>&nbsp;<span>{{number_format_short($like_count)}}</span></a>&nbsp;&nbsp;&nbsp;
                                           <a class="thumb-class" data-toggle="modal" data-target="#login_error"><i class="material-icons ali-midd-20">thumb_down</i>&nbsp;<span>{{number_format_short($dislike_count)}}</span></a>
                                           @endif

                                           <a  class="share-new" data-toggle="modal" data-target="#popup1">
                                              <i class="material-icons">share</i>&nbsp;Share
                                              <!--  <p class="hidden-xs">share</p> -->
                                           </a>

                                           <a class="share-new global_playlist_id" id="{{$video->video_tape_id}}" href="#" style="display: none;">
                                              <i class="material-icons">playlist_add</i>&nbsp;Save
                                           </a>
             
                                           <form name="add_to_wishlist" method="post" id="add_to_wishlist" action="{{route('user.add.wishlist')}}" class="add-wishlist">
                                              @if(Auth::check())
                                              
                                              <input type="hidden" value="{{$video->video_tape_id}}" name="video_tape_id">
                                              
                                              @if(count($wishlist_status) == 1 && $wishlist_status)
                                           
                                                 <input type="hidden" id="status" value="0" name="status">
                                                 
                                                 <input type="hidden" id="wishlist_id" value="{{$wishlist_status->id}}" name="wishlist_id">
                                                 
                                                    @if($flaggedVideo == '')

                                                        <!-- <div class="mylist">

                                                           <button  type="submit" id="added_wishlist" data-toggle="tooltip" title="{{tr('added_wishlist')}}">

                                                              <div class="added_to_wishlist" id="check_id">
                                                                 <i class="fa fa-heart" style="color: #b31217"></i>
                                                              </div>
                                                              
                                                              <span class="wishlist_heart_remove">
                                                                 <i class="fa fa-heart"></i>
                                                              </span>
                                                           </button> 
                                                        </div> -->
                                                 
                                                    @endif
                                              
                                              @else
                                              
                                                  <input type="hidden" id="status" value="1" name="status">
                                                  
                                                  <input type="hidden" id="wishlist_id" value="" name="wishlist_id">

                                              @if($flaggedVideo == '')
                                              <!-- <div class="mylist">
                                              <button type="submit" id="added_wishlist" data-toggle="tooltip" title="{{tr('add_to_wishlist')}}">
                                              <div class="add_to_wishlist" id="check_id">
                                              <i class="fa fa-heart"></i>
                                              </div>
                                              
                                              <span class="wishlist_heart">
                                              <i class="fa fa-heart"></i>
                                              </span>
                                              </button> 
                                              </div> -->
                                              @endif
                                              @endif
                                              
                                              
                                              
                                              @endif
                                              
                                           </form>

                                        </div>
                                        <!--  <h3>Channel Name</h3> -->
                                        <div class="clearfix"></div>
                                        <!-- <h4 class="video-desc">{{$video->description}}</h4> -->
                                        <hr>
                                     </div>
                                     <div class="col-lg-12 col-md-12 col-sm-12 col-lg-12 top zero-padding ">
                                        <div class="row1">
                                           <div class="col-xs-12 col-md-7 col-sm-7 col-lg-7" >
                                              <div class="channel-img">
                                                 <img src="{{$video->channel_picture}}" class="img-responsive img-circle" style="height: 100%;width: 100%">
                                              </div>
                                              <div class="username"><a href="{{route('user.channel',$video->channel_id)}}">{{$video->channel_name}}</a></div>
                                              <h5 class="rating no-margin mt-5">
                                                 <span class="rating1"><i @if($video->ratings >= 1) style="color:#ff0000" @endif class="fa fa-star" aria-hidden="true"></i></span>
                                                 <span class="rating1"><i @if($video->ratings >= 2) style="color:#ff0000" @endif class="fa fa-star" aria-hidden="true"></i></span>
                                                 <span class="rating1"><i @if($video->ratings >= 3) style="color:#ff0000" @endif class="fa fa-star" aria-hidden="true"></i></span>
                                                 <span class="rating1"><i @if($video->ratings >= 4) style="color:#ff0000" @endif class="fa fa-star" aria-hidden="true"></i></span>
                                                 <span class="rating1"><i @if($video->ratings >= 5) style="color:#ff0000" @endif class="fa fa-star" aria-hidden="true"></i></span>
                                              </h5>
                                           </div>
                                           <div class="col-xs-12 col-md-5 col-sm-5 col-lg-5" >
                                              <div class="pull-right ">
                                                 @if(Auth::check())
                                                 @if(Setting::get('is_spam')
                                                 && Auth::user()->id != $video->channel_created_by)
                                                 @if($flaggedVideo == '')
                                                 <!-- <button onclick="showReportForm();" type="button" class="report-button bottom-space" title="{{tr('report')}}">
                                                    <i class="fa fa-flag"></i> 
                                                    </button> -->
                                                 <button  type="button" class="btn btn-danger report-button bottom-space" title="{{tr('report')}}" data-toggle="modal" data-target="#report-form">
                                                 <i class="fa fa-flag"></i> 
                                                 </button>
                                                 @else 
                                                 <a href="{{route('user.remove.report_video', $flaggedVideo->video_tape_id)}}" class="btn btn-info unmark bottom-space" title="{{tr('remove_report')}}">
                                                 <i class="fa fa-flag"></i> 
                                                 </a>
                                                 @endif
                                                 @endif
                                                 @endif
                                              </div>
                                              <div class="pull-right ">
                                                 @if(Auth::check())
                                                 @if($video->get_channel->user_id != Auth::user()->id)
                                                 @if (!$subscribe_status)
                                                 <a class="btn btn-sm bottom-space btn-info text-uppercase" href="{{route('user.subscribe.channel', array('user_id'=>Auth::user()->id, 'channel_id'=>$video->channel_id))}}">{{tr('subscribe')}} &nbsp; {{$subscriberscnt}}</a>
                                                 @else 
                                                 <a class="btn btn-sm bottom-space btn-danger text-uppercase" href="{{route('user.unsubscribe.channel', array('subscribe_id'=>$subscribe_status))}}" onclick="return confirm('Are you sure want to Unsubscribe from the channel?')" style="background: rgb(229, 45, 39) !important">{{tr('un_subscribe')}} &nbsp; {{$subscriberscnt}}</a>
                                                 @endif
                                                 @else
                                                 <a class="btn btn-sm bottom-space btn-danger text-uppercase" href="{{route('user.channel.subscribers', array('channel_id'=>$video->channel_id))}}" style="background: rgb(229, 45, 39) !important"><i class="fa fa-users"></i>&nbsp; {{tr('subscribers')}} - {{$subscriberscnt}}</a>
                                                 @endif
                                                 @endif

                                                 <!-- Wishlist start -->

                                                 <a>
                                                    @if(count($wishlist_status) == 1)
                                                        
                                                        <div class="heart-now heart-now-active"></div> 

                                                    @else
                                                        <div class="heart-now"></div> 

                                                    @endif

                                                 </a>
                                              </div>
                                           </div>
                                        </div>
                                        <div class="clearfix"></div>
                                     </div>
                                     <div class="clearfix"></div>
                                     <div>
                                        <h4 class="video-desc"><?= $video->description?></h4>
                                        <div class="tag-and-category">
                                          <div class="row m-0">
                                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4 p-0 mt-10">
                                              <p class="category-name" style="float: none !important;font-size: 15px !important;">category</p>
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-sm-8 col-xs-8 p-0 mt-10">
                                              <a href="{{route('user.categories.view', $video->category_unique_id)}}" target="_blank" class="category-name blue-link">{{$video->category_name}}</a>
                                            </div>
                                          </div>
                                          @if(count($tags) > 0)
                                            <div class="row m-0">
                                              <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4 p-0 mt-10">
                                                  <p class="category-name" style="float: none !important;font-size: 15px !important;">{{tr('tags')}}</p>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-8 p-0 mt-10">
                                                <?php 
                                                    $tags_list = [];
                                                    
                                                    foreach($tags as $i => $tag) {
                                                    
                                                      $tags_list[] = '<a href="'.route('user.tags.videos', array('id'=>$tag->tag_id)).'" target="_blank" class="category-name blue-link">'.$tag->tag_name.'</a>';
                                                    
                                                    }
                                                    
                                                ?>
                                                <?= $tags_list ? implode(', ', $tags_list) : '' ?>
                                                </div>
                                            </div>
                                          @endif
                                        </div>
                                     </div>
                                     <div class="clearfix"></div>
                                      @if(Setting::get('is_spam'))
                                        @if (!$flaggedVideo)
                                          <div class="more-content" style="display: none;" id="report_video_form">
                                            <form name="report_video" method="post" id="report_video" action="{{route('user.add.spam_video')}}">
                                              <b>{{tr('report_this_video')}}</b>
                                              <br>

                                              @foreach($report_video as $report) 
                                                <div class="report_list">
                                                  <label class="radio1">
                                                     <input id="radio1" type="radio" name="reason" checked="" value="{{$report->value}}" required>
                                                     <span class="outer"><span class="inner"></span></span>{{$report->value}}
                                                  </label>
                                                </div>
                                              @endforeach

                                              <input type="hidden" name="video_tape_id" value="{{$video->video_tape_id}}" />
                                              
                                              <p class="help-block"><small>If you report this video, you won't see this video again anywhere in your account except "Spam Videos". If you want to continue to report this video as same. Click continue and proceed the same.</small></p>
                                               <div class="pull-right">
                                                  <button class="btn btn-info btn-sm">{{tr('submit')}}</button>
                                               </div>
                                               <div class="clearfix"></div>
                                            </form>
                                          </div>
                                        @endif
                                      @endif
                                      <div class="modal fade" id="report-form" role="dialog">
                                        <div class="modal-dialog">
                                           <!-- Modal content-->
                                           <div class="modal-content">
                                              <div class="modal-header">
                                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                 <h4 class="modal-title">{{tr('report_this_video')}}</h4>
                                              </div>
                                              <div class="modal-body">
                                                 @if(Setting::get('is_spam'))
                                                 @if (!$flaggedVideo)
                                                 <div class="more-content" id="report_video_form">
                                                    <form name="report_video" method="post" id="report_video" action="{{route('user.add.spam_video')}}">
                                                       @foreach($report_video as $report)  
                                                       <div class="report_list">
                                                          <label class="radio1">
                                                             <input id="radio1" type="radio" name="reason" checked="" value="{{$report->value}}" required>
                                                             <span class="outer"><span class="inner"></span></span>{{$report->value}}
                                                          </label>
                                                       </div>
                                                       <div class="clearfix"></div>
                                                       @endforeach

                                                       <input type="hidden" name="video_tape_id" value="{{$video->video_tape_id}}" />
                                                       <p class="help-block"><small>{{tr('single_video_content')}}</small></p>
                                                       <div class="pull-right">
                                                          <button class="btn btn-info btn-sm">{{tr('submit')}}</button>
                                                       </div>
                                                       <div class="clearfix"></div>
                                                    </form>
                                                 </div>
                                                 @endif
                                                 @endif
                                              </div>
                                           </div>
                                           <!-- modal content ends -->
                                        </div>
                                      </div>
                                      <div class="modal fade" id="login_error" role="dialog">
                                        <div class="modal-dialog modal-sm">
                                           <!-- Modal content-->
                                           <div class="modal-content">
                                              <div class="modal-header">
                                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                 <h4 class="modal-title">{{tr('authentication_error')}}</h4>
                                              </div>
                                              <div class="modal-body">
                                                 <div class="row">
                                                    <div class="col-lg-12">
                                                       {{tr('login_notes')}}   
                                                       <div class="clearfix"></div>
                                                       <br>
                                                       <div class="text-center">
                                                          <a href="{{route('user.login.form')}}"><button class="btn btn-sm btn-danger">{{tr('login')}}</button></a>
                                                       </div>
                                                    </div>
                                                 </div>
                                              </div>
                                           </div>
                                           <!-- modal content ends -->
                                        </div>
                                      </div>
                                  </div>
                                  <div class="hr-class">
                                     <hr>
                                  </div>
                                  <div class="clearfix"></div>
                               </div>
                               <!--end of video-title-->                                                             
                            </div>
                            <!--end of details-->
                            
                           <div class="row justify-content-center">
                                 <div class="col-md-12">
                                    <div class="card">
                              
                                       <div class="card-body" id="ajax_response">
                                       <h5>Comments (<span id="comments-count">{{ $comments_count }}</span>)</h5>
                                       <div class="card-body">
                                          @if(Auth::check())
                                          <!-- <h5>Leave a comment</h5> -->
                                          <!-- <form method="post" action="{{ route('user.add.comment') }}"> -->

                                             {{ csrf_field() }}

                                             <div class="form-group">
                                                <input type="text" name="comment" id="comment" class="form-control" placeholder="Add a public comment..." style="border-bottom: 2px solid #000;border-top: 0px;border-right: 0px;border-left: 0px;"  />
                                                <input type="hidden" name="video_tape_id" id="video_tape_id" value="{{ $video->video_tape_id }}" />
                                                 
                                             </div>
                                             <div class="form-group">
                                                <input type="submit" class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;float: right;" value="Add Comment" id="add_comment" />
                                             </div>
                                          <!-- </form> -->
                                          @else
                                          <h5>Login to comment</h5>
                                          @endif
                                          <div class="clearfix"></div>
                                          <br>
                                       </div>
                                       <div id="user-comments"> 
                                        @include('user.comments', ['comments' => $comments, 'video_tape_id' => $video->video_tape_id])
                                       </div> 
                        
                                       <hr />
                                       </div>
                        
                                       
                        
                                    </div>
                                 </div>
                           </div>
                        
                         </div>
                      </div>
                      <!--end of main-content-->
                   </div>
                   
                   <!--end of col-sm-8 and play-video-->
                   <div class="col-sm-12 col-md-4 side-video custom-side">
                      <div class="up-next" style="padding-top: 20px;">
                        @if(!empty($side_ad))

                              @for($i = 1; $i <= 1; $i++)
                              <div class="slide-box">
                                 <!-- <div class="slide-image" style="height: 278px !important;"> -->
                                  <div class="slide-image" style="height: 197px !important;">
                                     <a  class="confirm-redirection" href="{{$side_ad->link}}">
                                         <!-- <img src="{{ asset('streamtube/images/placeholder.gif') }}" data-src="{{ asset($side_ad->file) }}"class="slide-img1 placeholder" /> -->
                                         <img src="{{ asset('streamtube/images/placeholder.gif') }}" data-src="{{ asset($side_ad->file) }}"class="slide-img1 placeholder" style="object-fit: unset !important;background-size: auto !important;" />
                                     </a>
                                 </div>
                                 <div class="video-details">
                                     <div class="video-head">
                                         <a href="{{$side_ad->url}}" @if($side_ad->member_only  && !Auth::check()) force-login="true" @endif>{{$side_ad->title}}</a>
                                     </div>
                                 </div>
                              </div>
                              @endfor

                           @endif
                           @if(!empty($top_side_ad))
                            <!-- //////////////////////////////////// -->
                              @for($i = 1; $i <= 1; $i++)
                              <div class="slide-box">
                                 <!-- <div class="slide-image" style="height: 278px !important;"> -->
                                  <div class="slide-image" style="height: 197px !important;">
                                     <a  class="confirm-redirection" href="{{$top_side_ad->link}}">
                                         <!-- <img src="{{ asset('streamtube/images/placeholder.gif') }}" data-src="{{ asset($side_ad->file) }}"class="slide-img1 placeholder" /> -->
                                         <img src="{{ asset('streamtube/images/placeholder.gif') }}" data-src="{{ asset($top_side_ad->file) }}"class="slide-img1 placeholder" style="object-fit: unset !important;background-size: auto !important;" />
                                     </a>
                                 </div>
                                 <div class="video-details">
                                     <div class="video-head">
                                         <a  class="confirm-redirection" href="{{$top_side_ad->url}}" @if($top_side_ad->member_only  && !Auth::check()) force-login="true" @endif>{{$top_side_ad->title}}</a>
                                     </div>
                                 </div>
                              </div>
                              @endfor
                              @endif
                              <!-- /////////////////////////////////// -->
                           
                         <h4 class="sugg-head1">{{tr('suggestions')}}</h4>
                         <ul class="video-sugg">
                            @if(count($suggestions->items) > 0)
                            @foreach($suggestions->items as $suggestion)
                            <li class="sugg-list row">
                               <div class="main-video">
                                  <div class="video-image">
                                     <div class="video-image-outer">
                                        <a href="{{$suggestion->url}}">
                                           <!-- <img src="{{$suggestion->video_image}}"> -->
                                           <img src="{{asset('streamtube/images/placeholder.gif')}}" data-src="{{$suggestion->video_image}}" class="placeholder" />
                                        </a>
                                     </div>
                                     @if($suggestion->ppv_amount > 0)
                                     @if(!$suggestion->ppv_status)
                                     <div class="video_amount">
                                        {{tr('pay')}} - {{Setting::get('currency')}}{{$suggestion->ppv_amount}}
                                     </div>
                                     @endif
                                     @endif
                                     <div class="video_duration">
                                        {{$suggestion->duration}}
                                     </div>
                                  </div>
                                  <!--video-image-->
                                  <div class="sugg-head">
                                     <div class="suggn-title">
                                        <h5><a href="{{$suggestion->url}}">{{$suggestion->title}}</a></h5>
                                     </div>
                                     <!--end of sugg-title-->
                                     <span class="video_views">
                                        <div><a href="{{route('user.channel',$suggestion->channel_id)}}">{{$suggestion->channel_name}}</a></div>
                                        <i class="fa fa-eye"></i> {{$suggestion->watch_count}} {{tr('views')}} <b>.</b> 
                                        {{ common_date($suggestion->created_at) }} 
                                     </span>
                                     <br>
                                     <span class="stars">
                                     <a><i @if($suggestion->ratings >= 1) style="color:#ff0000" @endif class="fa fa-star" aria-hidden="true"></i></a>
                                     <a><i @if($suggestion->ratings >= 2) style="color:#ff0000" @endif class="fa fa-star" aria-hidden="true"></i></a>
                                     <a><i @if($suggestion->ratings >= 3) style="color:#ff0000" @endif class="fa fa-star" aria-hidden="true"></i></a>
                                     <a><i @if($suggestion->ratings >= 4) style="color:#ff0000" @endif class="fa fa-star" aria-hidden="true"></i></a>
                                     <a><i @if($suggestion->ratings >= 5) style="color:#ff0000" @endif class="fa fa-star" aria-hidden="true"></i></a>
                                     </span>                              
                                  </div>
                                  <!--end of sugg-head-->
                               </div>
                               <!--end of main-video-->
                            </li>
                            <!--end of sugg-list-->
                            @endforeach
                            @endif
                         </ul>
                      </div>
                      <!--end of up-next-->
                   </div>
                   <!--end of col-sm-4-->
                
                </div>

             </div>
            
            <div class="sidebar-back"></div>
     
        </div>

   </div>
   
</div>

@endsection

@section('scripts')

<script type="text/javascript" src="{{asset('assets/js/star-rating.js')}}"></script>

<script type="text/javascript" src="{{asset('assets/js/toast.script.js')}}"></script>
<!-- ////////////////////////////////// -->
<script>
//-----------------
$(document).ready(function(){
function isEmptyOrSpaces(str){
  return str === null || str.match(/^ *$/) !== null;
}
$('#add_comment').click(function(e){
   e.preventDefault();
 
   var comment=$('#comment').val();
   if(isEmptyOrSpaces(comment)){
    return false;
   }
   var video_tape_id=$('#video_tape_id').val();

    // $('#comment_ajax').append(comment);

   /* Submit form data using ajax*/
   $.ajax({
      url: "{{ route('user.add.comment') }}",
      method: 'post',
      data: {
              comment:comment,
              video_tape_id:video_tape_id
            },
      success: function(data){
        $('#comments-count').text(data.comments_count);
        // $('#ajax_response').append(result);
        $('#user-comments').html(data.html);
        $(".reply").click(function(){
        id = $(this).attr('id');
    
        $("#reply-section"+ id).show();
        });
        
        $(".cancel").click(function(){
        id = $(this).attr('id');
    
        $("#reply-section"+ id).hide();
        });
     ///////////////////////////////////
     $('.add').click(function(e){
     e.preventDefault();
     id = $(this).attr('id');
     // alert(id);
      var comment=$('#reply_comment' + id).val();
      var video_tape_id=$('#reply_video_tape_id' + id).val();
      var comment_id=$('#reply_comment_id' + id).val();
      // alert(comment);
      // alert(video_tape_id);
      // alert(comment_id);

     $.ajax({
        url: "{{ route('user.add.comment') }}",
        method: 'post',
        data: {
                comment:comment,
                video_tape_id:video_tape_id,
                comment_id:comment_id
              },
        success: function(data){
          var record = JSON.parse(data);
          var date_var=new Date();
          var second=date_var.getSeconds();
          var result =
          '<div class="row" id="">'+
            '<div class="col-xs-1">'+
            '<img class="profile-image" src="'+record.user.picture+'">'+
            '</div>'+ 
            '<div class="col-xs-11"><strong>'+record.user.name+'</strong> <small>'+ second+' second ago</small>'+        
            '<div class="dropdown pull-right">'+
            '<a id="delete-comment-58" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
            '<i class="fa fa-ellipsis-v"></i>'+
            '</a>'+
            '<ul class="dropdown-menu" aria-labelledby="delete-comment-58">'+
            '<li>'+
            '<a href="#">'+
            '<i class="fa fa-flag"></i>Report</a></li></ul>'+
            '</div><p>'+record.comment+'</p></div>'+
          '</div>';
            console.log(record);
          $('#collapsibleComments-' + id).append(result);
            $("#collapsibleComments-" + id).addClass("in");
          
       
        }
      });
         $('#reply_comment' + id).val('');

       });
     //////////////////////////////////
      }
    });
    $('#comment').val('');

   });

});
//-----------------
</script>
<!-- ////////////////////////////////// -->
<!-- /////////////////////////////////// -->
<script>
//-----------------
$(document).ready(function(){
function isEmptyOrSpaces(str){
  return str === null || str.match(/^ *$/) !== null;
}
$(document).on("click", '.add_reply', function(e) { 
   e.preventDefault();
   id = $(this).attr('id');
   var comment=$('#reply_comment' + id).val();
   //reply_comment462
  // alert('#reply_comment' + id);
   if(isEmptyOrSpaces(comment)){
    return false;
   }
   var video_tape_id=$('#reply_video_tape_id' + id).val();
   var comment_id=$('#reply_comment_id' + id).val();
   $.ajax({
      url: "{{ route('user.add.reply') }}",
      method: 'post',
      data: {
              comment:comment,
              video_tape_id:video_tape_id,
              comment_id:comment_id
            },
      success: function(data){
        $('#replies-count-'+data.parent_id).text(data.replies_count);
        $('#comments-count').text(data.comments_count);
        $('#collapsibleComments-' + data.parent_id).html(data.html);
          $("#collapsibleComments-" + data.parent_id).addClass("in");
        
     
      }});
    $('#reply_comment' + id).val('');

   });
});
//-----------------
</script>
<!-- ////////////////////////////////// -->
<script>
    @if(count($ads))
        var adUrl = '{{ $ads->last()->file}}';
        var adType = '{{ $ads->last()->ad_type}}';
    @else
        var adUrl = '';
        var adType = '';
    @endif

    var video = $('#single-video');
    var mainVideoSrc = video.attr('src');

    function playVideoAd() {
        video.attr('src', adUrl);
        video.load();
        video.bind('ended',playMainVideo);
        video.bind('play',showSkipButton);

        $('#redirect-btn').show();
    }

    function showSkipButton() {
        video.unbind('play',showSkipButton);

        var skipBtn = $('#skip-btn')
        skipBtn.show();

        var adDuration = parseInt({{$ads->last()->ad_time}});
        var skipInterval = setInterval(function(){ 
            if(adDuration > 0){
                skipBtn.html("SKIP " + adDuration);
                adDuration--;
            } else {
                skipBtn.attr('onclick','playMainVideo()')
                skipBtn.html("SKIP");
                clearInterval(skipInterval)
            }
         }, 1000);
    }

    function playMainVideo() {
        video.unbind('ended', playMainVideo)
        $('#skip-btn').hide();
        $('#redirect-btn').hide()

        video.attr('src', mainVideoSrc);
        video.load();
    }

    function showBannerAd() {
        $('#banner-image').attr('src', adUrl);
        $('#banner-container').show();

        $('#redirect-btn').show();
    }

    $(document).ready(function () {
        if(adType == 'VIDEO')
            playVideoAd();
        else if( adType == 'BANNER')
            showBannerAd();
    });
</script>
<script>
  $(document).ready(function () {
    $(document).on("click", '.reply', function(e) { 
      id = $(this).attr('id');
      $(".reply-section").hide();
      $("#reply-section"+ id).show();
      $('html, body').animate({
          scrollTop: $("#reply_comment_section"+ id).offset().top - $("#reply_comment_section"+ id).outerHeight(true)
      }, 1000);
    });

    $(".cancel").click(function(){
    id = $(this).attr('id');
    
    $("#reply-section"+ id).hide();
    });
   });  
</script>
<script>
  $(document).ready(function () {
    $("#cross_btn").click(function(){
    
    $(".visit_btn").hide();
    });

   });  
</script>
@endsection


