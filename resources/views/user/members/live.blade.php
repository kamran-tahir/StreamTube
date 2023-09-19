@extends( 'layouts.user' ) 

@section( 'styles' )

    <link rel="stylesheet" type="text/css" href="{{asset('streamtube/css/custom-style.css')}}">

    <style>
        #triangle-topleft {
        width: 0;
        height: 0;
        border-top: 68px solid #d9534f;
        border-left: 76px solid transparent;
        position: absolute;
    }
    #container {
        /* position: relative; */
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        height: 100%;
        width: 100%;
        /* opacity: 0; */
        transition: .5s ease;
        /* background: #0008; */
        border-radius: 10px;
    }
    #container #triangle-topleft {
        position: absolute;
        color: white;
        right: 0;
      
    }
    #overlay{
        position: absolute;
        color: white;
        right: 0;
        -ms-transform: rotate(45deg);
        -webkit-transform: rotate(45deg);
        transform: rotate(41deg); 
        font-family: arial black;
        top: 20px;
        font-size: 10px;
        margin-right: -7px;
    }
        #c4-header-bg-container {
            background-image: url({{$channel->cover}});
        }
        
        @media screen and (-webkit-min-device-pixel-ratio: 1.5),
        screen and (min-resolution: 1.5dppx) {
            #c4-header-bg-container {
                background-image: url({{$channel->cover}});
            }
        }
        
        #c4-header-bg-container .hd-banner-image {
            background-image: url({{$channel->cover}});
        }
        
        .payment_class {
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            max-height: 38px;
            line-height: 19px;
            padding: 0 !important;
            font-weight: bolder !important;
        }
        
        .switch {
            display: inline-block;
            height: 23px;
            position: relative;
            width: 45px;
            vertical-align: middle;
        }
        
        .switch input {
            display: none;
        }
        
        .slider {
            background-color: #ccc;
            bottom: 0;
            cursor: pointer;
            left: 0;
            position: absolute;
            right: 0;
            top: 0;
            transition: all 0.4s ease 0s;
        }
        
        .slider::before {
            background-color: white;
            bottom: 4px;
            content: "";
            height: 16px;
            left: 0px;
            position: absolute;
            transition: all 0.4s ease 0s;
            width: 16px;
        }
        
        input:checked + .slider {
            background-color: #51af33;
        }
        
        input:focus + .slider {
            box-shadow: 0 0 1px #2196f3;
        }
        
        input:checked + .slider::before {
            transform: translateX(26px);
        }
        
        .slider.round {
            border-radius: 34px;
        }
        
        .slider.round::before {
            border-radius: 50%;
        }

        .card{
            width: 47%;
            /*padding: 1rem;*/
            margin: 1%;
            border: 1px solid lightgrey;
            min-height: 400px;
            border-radius: 10px;
            display: inline-block;
        }
        .card-title {
            background-color: #f1f1f1;
            padding: 10px 5px;
            color: #333;
            border:1px solid lightgray;
        }
        .card-body{
            margin: 1%;
        }
        .card-text{
            color: #333;
            padding: 10px 15px;
            height: 270px;
            overflow: hidden;
            text-overflow: ellipsis;
            margin: 2%;
        }
        .card-link {
            background-color: #167ac6e6 !important;
            float: none;
            margin: .5% 5% 1%;
            border: 2px solid rgb(118 118 118 / 44%);
            padding: 2%;
            text-decoration: none;
        }
        .card-link:hover {
            background-color: white !important;
            color: #167ac6e6 !important;
            border-color: cornflowerblue;
        }
        .card-footer{
            clear: both;
            height: 50px;
            background-color: #e8e8e8;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;

        }
        .like-stats{
            display: inline-block;
            padding: 2% 5%;
            width: 48%;
            color: #167ac6e6;
        }
        .like-stats i{
            padding-right: 5%;
            padding-left: 2%;
        }
        .comment-stats{
            display: inline-block;
            padding: 2% 5%;
            width: 50%;
            text-align: right;
            color: #167ac6e6;
        }
        .search-div{
            margin-left: 1%;
            margin-top: 2%;
            padding-right: 0;
            margin-right: 0;
        }
        .search-btn-div{
            padding-left: 0;
            margin-left: 0;
            margin-top: 2%;
        }
        .search-btn{
            margin-top: 0;
            height: 36px !important;
            padding: 0px 20px !important;
        }

        .searchclear {
            position: absolute;
            right: 20px;
            top: 0;
            bottom: 0;
            height: 14px;
            margin: auto;
            font-size: 14px;
            cursor: pointer;
            color: #ccc;
        }
        .create-post-btn{
            margin-top:1.4% ;
            padding: 0;  
        }
        .create-post-btn .btn{
            padding: 10px;  
        }
        .forum_update_description{
            color: black;
        }
        .fa-bullhorn{
            color: cornflowerblue;
            font-size: 75px;
        }
    </style>

@endsection 

@section('content')

    <div class="y-content">

        <div class="row content-row">

            @include('layouts.user.nav')

            <div class="page-inner col-sm-9 col-md-10">

                <div class="slide-area1">

                    <div class="branded-page-v2-top-row">

                        <div class="branded-page-v2-header channel-header yt-card">

                            <div id="gh-banner">

                                <div id="" class="c4-visible-on-hover-container has-custom-banner">

                                    <div class="hd-banner">
                                        <div class="hd-banner-image"></div>
                                    </div>

                                    <!-- <a class="channel-header-profile-image spf-link" href="">
                                    <img class="channel-header-profile-image" src="{{$channel->picture}}" title="{{$channel->name}}" alt="{{$channel->name}}">
                                    </a> -->

                                </div>

                            </div>

                            @include('notification.notify')

                            <div class="channel-content-spacing display-inline">

                                <div id="channel-subheader" class="clearfix branded-page-gutter-padding appbar-content-trigger">

                                    <ul id="channel-navigation-menu" class="clearfix nav nav-tabs" role="tablist">

                                        <li role="presentation" class="active" id="videos_sec">
                                            <a href="#videos" class="yt-uix-button  spf-link  yt-uix-sessionlink yt-uix-button-epic-nav-item yt-uix-button-size-default" aria-controls="videos" role="tab" data-toggle="tab">
                                                <span class="yt-uix-button-content">{{tr('videos')}}</span>
                                            </a>
                                        </li>

                                        <li role="presentation" class="" id="videos_sec">
                                            <a href="#photos" class="yt-uix-button  spf-link  yt-uix-sessionlink yt-uix-button-epic-nav-item yt-uix-button-size-default" aria-controls="Photos" role="tab" data-toggle="tab">
                                                <span class="yt-uix-button-content">Photos</span>
                                            </a>
                                        </li>

                                        <li role="presentation">
                                            <a href="#users" class="yt-uix-button  spf-link  yt-uix-sessionlink yt-uix-button-epic-nav-item yt-uix-button-size-default" aria-controls="videos" role="tab" data-toggle="tab">
                                                <span class="yt-uix-button-content">{{tr('users')}}</span>
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a href="#categories" class="yt-uix-button  spf-link  yt-uix-sessionlink yt-uix-button-epic-nav-item yt-uix-button-size-default" aria-controls="videos" role="tab" data-toggle="tab">
                                                <span class="yt-uix-button-content">Categories</span>
                                            </a>
                                        </li>
                                        <li role="presentation">
                                            <a href="#updates" class="yt-uix-button  spf-link  yt-uix-sessionlink yt-uix-button-epic-nav-item yt-uix-button-size-default" aria-controls="videos" role="tab" data-toggle="tab">
                                                <span class="yt-uix-button-content">Updates</span>
                                            </a>
                                        </li>
                                        
                                        <li role="presentation">
                                            <a href="{{route('user.channel.member-section.community', $channel)}}" class="yt-uix-button  spf-link  yt-uix-sessionlink yt-uix-button-epic-nav-item yt-uix-button-size-default" aria-controls="forum" role="tab" target="_blank">
                                                <span class="yt-uix-button-content ">Community</span>
                                            </a>
                                        </li>
                                    </ul>
                               
                                </div>

                            </div>

                        </div>

                    </div>

                    <ul class="tab-content"  style="padding-left: 0px;">

                        <li role="tabpanel" class="tab-pane  active" id="videos">
                           
                            <div class="recom-area abt-sec">

                                <div class="abt-sec-head">

                                    <div class="new-history1">

                                        <div class="content-head">

                                            <div>
                                                <h4 style="color: #000;">{{tr('videos')}}&nbsp;&nbsp;
                                                @if(Auth::check())

                                                <!-- @if(Auth::user()->id == $channel->user_id)
                                                <small style="font-size: 12px">({{tr('note')}}:{{tr('ad_note')}} )</small>

                                                @endif -->

                                                @endif
                                                </h4>
                                            </div>

                                        </div>
                                        <!--end of content-head-->

                                        @if(count($videos) > 0)

                                        <ul class="history-list">

                                            @foreach($videos as $i => $video)

                                            <li class="sub-list row border-0">

                                                <div class="main-history">
                                                    <a href="{{$video->url}}">
                                                        
                                                    <div class="history-image">

                                                            <!-- <img src="{{$video->video_image}}"> -->
                                                            <img src="{{asset('streamtube/images/placeholder.gif')}}" data-src="{{$video->video_image}}" class="slide-img1 placeholder" />
                                                        <div id="container">
                                                            <div id="triangle-topleft"></div>
                                                            <div id="overlay">Member Only</div>
                                                        </div>
                                                        @if($video->ppv_amount > 0) 

                                                            @if($video->ppv_status)
                                                                <div class="video_amount">
                                                                    {{tr('pay')}} - {{Setting::get('currency')}}{{$video->ppv_amount}}

                                                                </div>
                                                            @endif 

                                                        @endif

                                                        <div class="video_duration">
                                                            {{$video->duration}}
                                                        </div>

                                                    </div>
                                                    </a> 
                                                        
                                                    <!--history-image-->

                                                    <div class="history-title">

                                                        <div class="history-head row">
                                                           
                                                            <div class="cross-title2">
                                                                <h5 class="payment_class unset-height">
                                                                    @if(Auth::check())

                                                                        @if($channel->user_id == Auth::user()->id)

                                                                            @if($video->is_approved == YES)
                                                                                <span class="text-green" title="Admin Approved"><i class="fa fa-check-circle"></i></span>
                                                                            @else

                                                                                <span class="text-red" title="Admin Declined"><i class="fa fa-times"></i></span>

                                                                            @endif

                                                                        @endif

                                                                    @endif

                                                                    <a href="{{$video->url}}">{{$video->title}}</a>
                                                                </h5>

                                                                <span class="video_views">
                                                                    <i class="fa fa-eye"></i> {{$video->watch_count}} {{tr('views')}} <b>.</b> 
                                                                     {{ common_date($video->created_at) }}
                                                                </span>
                                                            </div>
                                                         
                                                            <div class="pull-right">
                                                                <div class="description ">
                                                                    {!!$video->description!!}
                                                                </div>
                                                                <!--end of description-->

                                                                <span class="stars">
                                                                    <a><i @if($video->ratings >= 1) style="color:#ff0000" @endif class="fa fa-star" aria-hidden="true"></i></a>
                                                                    <a><i @if($video->ratings >= 2) style="color:#ff0000" @endif class="fa fa-star" aria-hidden="true"></i></a>
                                                                    <a><i @if($video->ratings >= 3) style="color:#ff0000" @endif class="fa fa-star" aria-hidden="true"></i></a>
                                                                    <a><i @if($video->ratings >= 4) style="color:#ff0000" @endif class="fa fa-star" aria-hidden="true"></i></a>
                                                                    <a><i @if($video->ratings >= 5) style="color:#ff0000" @endif class="fa fa-star" aria-hidden="true"></i></a>
                                                                </span>    
                                                            </div>
                                                            
                                                      
                                                        </div>
                                                        <!--end of history-title-->

                                                    </div>
                                                    <!--end of main-history-->
                                               
                                                </div>

                                            </li>

                                            @endforeach

                                            

                                        </ul>
                                        <span id="videos_list"></span>

                                            <div id="video_loader" style="display: none;">

                                                <h1 class="text-center"><i class="fa fa-spinner fa-spin" style="color:#ff0000"></i></h1>

                                            </div>

                                            <div class="clearfix"></div>

                                            <button class="pull-right btn btn-info mb-15" onclick="getVideos()" style="color: #fff">{{tr('view_more')}}</button>

                                            <div class="clearfix"></div>

                                        @else

                                        <!-- <p style="color: #000">{{tr('no_video_found')}}</p> -->
                                        <img src="{{asset('images/no-result.jpg')}}" class="img-responsive auto-margin"> @endif

                                    </div>

                                </div>

                            </div>
                        </li>
                        <li role="tabpanel" class="tab-pane " id="photos">
                           
                            <div class="recom-area abt-sec">

                                <div class="abt-sec-head">

                                    <div class="new-history1">

                                        <div class="content-head">

                                            <div>
                                                <h4 style="color: #000;">Photos&nbsp;&nbsp;
                                                @if(Auth::check())

                                                <!-- @if(Auth::user()->id == $channel->user_id)
                                                <small style="font-size: 12px">({{tr('note')}}:{{tr('ad_note')}} )</small>

                                                @endif -->

                                                @endif
                                                </h4>
                                            </div>

                                        </div>
                                        <!--end of content-head-->

                                        @if(count($photo) > 0)

                                        <div class="recommend-list row" style="margin-top: 20px;">
                                             @foreach($photo as $user_photo)
                                                <div class="slide-box recom-box" style=" position: relative;">
                                                    <div class="slide-image">
                                                     @if($user_photo->path)
                                                     <a href="{{route('user.photos.gallery')}}">
                                                       
                                                     <img src="{{$user_photo->path}}" class="slide-img1 placeholder"  />
                                                     <div class="overlay5">

                                                      </div>
                                                     </a>
                                                   
                                                     @endif
                                                     
                                                    </div>
                                                    <a href="{{route('user.photos.gallery',$channel->id).'?is_member_section=1'}}">
                                                    
                                                    <div id="container">
                                                        <div id="triangle-topleft"></div>
                                                        <div id="overlay">Member Only</div>
                                                    </div>
                                                    </a>
                                                    
                                                </div>      
                                             @endforeach
                                             
                                            </div>

                                            
                                        @else

                                        <!-- <p style="color: #000">{{tr('no_video_found')}}</p> -->
                                        <img src="{{asset('images/no-result.jpg')}}" class="img-responsive auto-margin"> @endif

                                    </div>

                                </div>

                            </div>
                        </li>
                        <li role="tabpanel" class="tab-pane" id="users">
                            @if(count($users))
                                @include('user.account.partial_member_user')
                                <span id="users_list"></span>

                                <div id="users_loader" style="display: none;">

                                    <h1 class="text-center"><i class="fa fa-spinner fa-spin" style="color:#ff0000"></i></h1>

                                </div>

                                <div class="clearfix"></div>

                                <button class="pull-right btn btn-info mb-15" onclick="getUsers()" style="color: #fff">{{tr('view_more')}}</button>

                                <div class="clearfix"></div>

                            @else

                            <!-- <p style="color: #000">{{tr('no_video_found')}}</p> -->
                            <img src="{{asset('images/no-result.jpg')}}" class="img-responsive auto-margin"> 
                            @endif

                        </li>

                        <li role="tabpanel" class="tab-pane" id="categories">
                            <div class="content-head">

                                <div>
                                    <h4 style="color: #000; margin-bottom: 0px">Categories&nbsp;&nbsp;
                                    @if(Auth::check())

                                    <!-- @if(Auth::user()->id == $channel->user_id)
                                    <small style="font-size: 12px">({{tr('note')}}:{{tr('ad_note')}} )</small>

                                    @endif -->

                                    @endif
                                    </h4>
                                    <a  href="{{route('user.channel.member-section.category.create',$channel)}}" class="pull-right btn btn-info mb-15" style="color: #fff">Create Category</a>

                                    <div class="clearfix"></div>

                                </div>
                                <div class="clearfix"></div>

                            </div>
                            
                            @if(count($forum_categories))
                                <!-- <div class="col-sm-4 col-md-3 col-lg-2">

                                    <div class="settings-card">
                                        <div class="display-inline">
                                            <div class="">
                                                <h4 class="settings-head">{{$forum_category->name}}</h4>

                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="container">
                                    <table style="color: black; width: 100%;" class="table table-bordered">
                                        <tr>
                                            <th>
                                                Name
                                            </th>
                                            <th>
                                                No of Posts
                                            </th>
                                            <th>
                                                Action
                                            </th>
                                        </tr>
                                        @foreach($forum_categories as $forum_category)
                                            <tr>
                                                <td>
                                                    {{$forum_category->name}}
                                                </td>
                                                <td>
                                                    {{ count($forum_category->posts)}}
                                                </td>
                                                <td>
                                                    <a class="delete-category" data-category-id="{{$forum_category->id}}" href="#" onclick="return confirm('Confirm Delete Category ')">
                                                        <i style="color: red;" class="fa fa-trash "></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                        

                                    </table>
                                </div>
                                <div id="forum_categories_loader" style="display: none;">

                                    <h1 class="text-center"><i class="fa fa-spinner fa-spin" style="color:#ff0000"></i></h1>

                                </div>

                                <div class="clearfix"></div>

                            @else

                            <!-- <p style="color: #000">{{tr('no_video_found')}}</p> -->
                            <img src="{{asset('images/no-result.jpg')}}" class="img-responsive auto-margin"> 
                            @endif

                        </li>

                        <li role="tabpanel" class="tab-pane" id="updates">
                            <div class="content-head">

                                <div>
                                    <h4 style="color: #000; margin-bottom: 0px">Updates&nbsp;&nbsp;
                                    @if(Auth::check())

                                    <!-- @if(Auth::user()->id == $channel->user_id)
                                    <small style="font-size: 12px">({{tr('note')}}:{{tr('ad_note')}} )</small>

                                    @endif -->

                                    @endif
                                    </h4>
                                    <a  href="{{route('user.channel.member-section.forum_update.create',$channel)}}" class="pull-right btn btn-info mb-15" style="color: #fff">Post Update</a>

                                    <div class="clearfix"></div>

                                </div>
                                <div class="clearfix"></div>

                            </div>
                            
                            @if(count($forum_updates))
                                <div class="">
                                    @foreach($forum_updates as $forum_update)
                                        <a class="delete-update pull-right " data-update-id="{{$forum_update->id}}" href="#" onclick="return confirm('Confirm Delete Forum Update ')" style="margin:.5%">
                                            <i style="color: red;" class="fa fa-trash "></i>
                                        </a>
                                        <div class="new-profile-sec">
                                            <div class="display-inline">
                                                <div class="new-profile-left">
                                                    <i class="fa fa-bullhorn" aria-hidden="true"></i>
                                                </div>
                                                <div class="new-profile-right forum_update_description">
                                                    {{$forum_update['description']}}
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                    @endforeach
    
                                </div>
                                <div id="forum_categories_loader" style="display: none;">

                                    <h1 class="text-center"><i class="fa fa-spinner fa-spin" style="color:#ff0000"></i></h1>

                                </div>

                                <div class="clearfix"></div>

                            @else

                            <!-- <p style="color: #000">{{tr('no_video_found')}}</p> -->
                            <img src="{{asset('images/no-result.jpg')}}" class="img-responsive auto-margin"> 
                            @endif

                        </li>
                        
                    </ul>
                    <div class="sidebar-back"></div>
                </div>
            </div>
        </div>

    </div>

<form action="{{route('user.channel.member-section.category.delete',$channel)}}" method="post" id="delete-category-form">
     {{csrf_field()}}
    <input type="hidden" name="id" id="delete-category-id">
</form>
<form action="{{route('user.channel.member-section.forum_update.delete',$channel)}}" method="post" id="delete-forum-update-form">
     {{csrf_field()}}
    <input type="hidden" name="id" id="delete-forum-update-id">
</form>

@endsection 

@section('scripts')

    <script>
        
        var stopScroll = false;
        var stopUserScroll = false;


        var searchLength = "{{count($videos)}}";
        var searchUserLength = "{{count($users)}}";
        var stopPaymentScroll = false;
        
        var stopPostScroll = false;
        var stopMyPostScroll = false;
        var searchPostsLength = "{{count($posts)}}";
        var searchMyPostsLength = "{{count($myposts)}}";


        var searchPaymentLength = "{{$payment_videos->count}}";

        function getVideos() {

            if (searchLength > 0) {

                videos(searchLength);

            }
        }

        
        function videos(cnt) {

            channel_id = "{{$channel->id}}";

            $.ajax({

                type: "post",
                url: "{{route('user.video.get_videos')}}",

                beforeSend: function() {

                    $("#video_loader").fadeIn();
                },

                data: {
                    skip: cnt,
                    channel_id: channel_id,
                    member_only:1
                },

                async: false,

                success: function(data) {

                    $("#videos_list").append(data.view);

                    if (data.length == 0) {

                        stopScroll = true;

                    } else {

                        stopScroll = false;

                        // console.log(searchLength);

                        // console.log(data.length);

                        searchLength = parseInt(searchLength) + data.length;

                        // console.log("searchLength" +searchLength);

                    }

                },

                complete: function() {

                    $("#video_loader").fadeOut();

                },

                error: function(data) {

                },

            });

        }


        function getUsers() {

            if (searchUserLength > 0) {

                users(searchUserLength);

            }
        }

        
        function users(cnt) {

            $.ajax({

                type: "post",
                url: "{{route('user.channel.member-section.member-users',$channel)}}",

                beforeSend: function() {

                    $("#users_loader").fadeIn();
                },

                data: {
                    skip: cnt,
                },

                async: false,

                success: function(data) {

                    $("#users_list").append(data.view);

                    if (data.length == 0) {

                        stopUserScroll = true;

                    } else {

                        stopUserScroll = false;

                        searchUserLength = parseInt(searchUserLength) + data.length;

                     
                    }

                },

                complete: function() {

                    $("#users_loader").fadeOut();

                },

                error: function(data) {

                },

            });

        }

        function getPosts() {

            if (searchPostsLength > 0) {

                posts(searchPostsLength);
            }
        }

        function getSearchPosts() {
            searchPostsLength = 0;
            $("#posts_list").html('');
            posts($('#posts_list').children().length);
        }

        
        function posts(cnt) {
            $.ajax({
                type: "post",
                url: "{{route('user.channel.member-section.post.fetch',$channel)}}",
                beforeSend: function() {
                    $("#posts_loader").fadeIn();
                },
                data: {
                    skip: cnt,
                    search:$('#post-search').val()
                },
                async: false,
                success: function(data) {
                    $("#posts_list").append(data.view);
                    if (data.length == 0) {
                        stopPostScroll = true;
                        $('#post-view-more').hide();
                    } else {
                        stopPostScroll = false;
                        searchPostsLength = parseInt(searchPostsLength) + data.length;  
                        $('#post-view-more').show();                   
                    }
                },
                complete: function() {
                    $("#posts_loader").fadeOut();
                },
                error: function(data) {
                },
            });
        }

        function getMyPosts() {
            if (searchMyPostsLength > 0) {
                myPosts(searchMyPostsLength,"{{Auth()->id()}}");
            }
        }
        
        function getSearchMyPosts(){
            searchMyPostsLength = 0;
            $("#myposts_list").html('');
            myPosts($('#myposts_list').children().length,"{{Auth()->id()}}");

        }
        function myPosts(cnt,user_id) {
            console.log(cnt,user_id,$('#mypost-search').val());
            $.ajax({
                type: "post",
                url: "{{route('user.channel.member-section.post.fetch',$channel)}}",
                beforeSend: function() {
                    $("#myposts_loader").fadeIn();
                },
                data: {
                    skip: cnt,
                    user_id:user_id,
                    search:$('#mypost-search').val(),
                },
                async: false,
                success: function(data) {
                    $("#myposts_list").append(data.view);
                    if (data.length == 0) {
                        stopMyPostScroll = true;
                        $('#mypost-view-more').hide();
                    } else {
                        stopMyPostScroll = false;
                        searchMyPostsLength = parseInt(searchMyPostsLength) + data.length;    
                        $('#mypost-view-more').show();                 
                    }
                },
                complete: function() {
                    $("#myposts_loader").fadeOut();
                },
                error: function(data) {
                },

            });
        }
        $(document).on('ready', function() {

            
        });

        $("#searchclearposts").click(function(){

            $("#post-search").val('');
        });

        $("#searchclearmyposts").click(function(){

            $("#mypost-search").val('');
        });

        $("body").on('click','.delete-category',function(e){
            e.preventDefault();

            var id = $(this).attr('data-category-id');
            $('#delete-category-id').val(id);
            $('#delete-category-form').submit();
        });
        $("body").on('click','.delete-update',function(e){
            e.preventDefault();

            var id = $(this).attr('data-update-id');
            $('#delete-forum-update-id').val(id);
            $('#delete-forum-update-form').submit();
        });
        
        
    </script>

@endsection