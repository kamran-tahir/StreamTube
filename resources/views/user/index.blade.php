@extends('layouts.user')

@section('styles')
    <style type="text/css">
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

        #overlay {
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

        .alert {
            padding: 20px;
            background-color: #f44336;
            color: white;
        }

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }

        .list-inline {
            text-align: center;
        }

        .list-inline>li {
            margin: 10px 5px;
            padding: 0;
        }

        .list-inline>li:hover {
            cursor: pointer;
        }

        .list-inline .selected img {
            opacity: 1;
            border-radius: 15px;
        }

        .list-inline img {
            opacity: 0.5;
            -webkit-transition: all .5s ease;
            transition: all .5s ease;
        }

        .list-inline img:hover {
            opacity: 1;
        }

        .item>img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        .carousel-inner .active {
            background-color: none;
        }

        .carousel-inner .item {
            padding: 0px;
        }

        /* new css */

        .slide-image.ads {
            height: 125px !important;
            ;
        }

        @media (min-width: 1440px) and (max-width: 1679px) {
            .slide-image.ads {
                height: 200px !important;
                ;
            }
        }

        @media (min-width: 1680px) and (max-width: 1919px) {
            .slide-image.ads {
                height: 230px !important;
                ;
            }
        }

        @media (min-width: 1920px) and (max-width: 2559px) {
            .slide-image.ads {
                height: 285px !important;
                ;
            }
        }

        /* new css */
        @media (min-width: 1920px) and (max-width: 2559px) {
            .slide-area {
                /*width: 80%;*/
            }
        }
    </style>
@endsection

@section('content')
    <div class="y-content">
        <div class="row content-row">
            @include('layouts.user.nav')
            <div class="page-inner col-xs-12 col-sm-9 col-md-10">
                @if (Setting::get('is_banner_video'))
                    @if (count($banner_videos) > 0)
                        <div class="row" id="slider">
                            <div class="col-md-12 banner-slider">
                                <div id="myCarousel" class="carousel slide">
                                    <div class="carousel-inner">
                                        @foreach ($banner_videos as $key => $banner_video)
                                            <div class="{{ $key == 0 ? 'active item' : 'item' }}"
                                                data-slide-number="{{ $key }}">
                                                <a href="{{ route('user.single', $banner_video->video_tape_id) }}"><img
                                                        src="{{ $banner_video->image }}" style="height:250px;width: 100%;">
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- Controls-->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">{{ tr('previous') }}</span>
                                    </a>
                                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">{{ tr('next') }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
                @if (Setting::get('is_banner_ad'))
                    @if (count($banner_ads) > 0)
                        <div class="row" id="slider">
                            <div class="col-md-12 banner-slider">
                                <div id="myCarousel" class="carousel slide">
                                    <div class="carousel-inner">
                                        @foreach ($banner_ads as $key => $banner_ad)
                                            <div class="{{ $key == 0 ? 'active item' : 'item' }}"
                                                data-slide-number="{{ $key }}"
                                                style="background-image: url({{ $banner_ad->image }});">
                                                <a href="{{ $banner_ad->link }}" target="_blank">
                                                    <div class="carousel-caption">
                                                        <h3>{{ $banner_ad->video_title }}</h3>
                                                        <div class="clearfix"></div>
                                                        <p class="hidden-xs">
                                                            @if ($banner_ad->content)
                                                                <?= strlen($banner_ad->content) > 200 ? substr($banner_ad->content, 0, 200) . '...' : substr($banner_ad->content, 0, 200) ?>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- Controls-->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">{{ tr('previous') }}</span>
                                    </a>
                                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">{{ tr('next') }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
                @include('notification.notify')
                <!-- wishlist start -->
                @include('user.home._wishlist')
                <!-- wishlist end -->
                @if (count($recent_videos->items) > 0)
                    <hr>
                    <div class="slide-area">
                        <div class="box-head">
                            <h3>{{ tr('recent_videos') }}</h3>
                        </div>
                        <div class="row">
                            <div class="box col-md-9"
                                @if (empty($side_ad[0]->file)) style="width: 1064px !important;" @endif>
                                @foreach ($recent_videos->items as $recent_video)
                                    <div class="slide-box">
                                        <div class="slide-image">
                                            <a href="{{ $recent_video->url }}"
                                                @if ($recent_video->member_only && !Auth::check()) force-login="true" @endif>
                                                <!-- <img src="{{ $recent_video->video_image }}" /> -->
                                                <!-- <div style="background-image: url({{ $recent_video->video_image }});" class="slide-img1"></div> -->
                                                <img src="{{ asset('streamtube/images/placeholder.gif') }}"
                                                    data-src="{{ $recent_video->video_image }}"class="slide-img1 placeholder" />
                                                @if ($recent_video->member_only)
                                                    <div id="container">
                                                        <div id="triangle-topleft"></div>
                                                        <div id="overlay">Member Only</div>
                                                    </div>
                                                @endif
                                            </a>
                                            @if ($recent_video->ppv_amount > 0)
                                                @if (!$recent_video->ppv_status)
                                                    <div class="video_amount">
                                                        {{ tr('pay') }} -
                                                        {{ Setting::get('currency') }}{{ $recent_video->ppv_amount }}
                                                    </div>
                                                @endif
                                            @endif
                                            <div class="video_mobile_views">
                                                {{ $recent_video->watch_count }} {{ tr('views') }}
                                            </div>
                                            <div class="video_duration">
                                                {{ $recent_video->duration }}
                                            </div>
                                        </div><!--end of slide-image-->
                                        <div class="video-details">
                                            <div class="video-head">
                                                <a href="{{ $recent_video->url }}"
                                                    @if ($recent_video->member_only && !Auth::check()) force-login="true" @endif>{{ $recent_video->title }}</a>
                                            </div>
                                            <span class="video_views">
                                                <div><a
                                                        href="{{ route('user.channel', $recent_video->channel_id) }}">{{ $recent_video->channel_name }}</a>
                                                </div>
                                                <div class="hidden-mobile">
                                                    <i class="fa fa-eye"></i> {{ $recent_video->watch_count }}
                                                    {{ tr('views') }} <b>.</b>
                                                    {{ $recent_video->publish_time }}
                                                </div>
                                            </span>
                                        </div><!--end of video-details-->
                                    </div><!--end of slide-box-->
                                @endforeach
                            </div><!--end of box-->

                            <div class="col-md-3">
                                @if (!empty($side_ad))
                                    @foreach ($side_ad as $recent_video)
                                        <div class="slide-box" style="padding-top: 5px;">
                                            <div class="slide-image ads">
                                                <a class="confirm-redirection" href="{{ $recent_video->link }}">
                                                    <img src="{{ asset('streamtube/images/placeholder.gif') }}"
                                                        data-src="{{ asset($recent_video->file) }}"class="slide-img1 placeholder" />
                                                </a>
                                                <div class="video_mobile_views">
                                                    {{ $recent_video->watch_count }} {{ tr('views') }}
                                                </div>
                                                <div class="video_duration">
                                                    {{ $recent_video->duration }}
                                                </div>
                                            </div><!--end of slide-image-->
                                            <div class="video-details">
                                                <div class="video-head">
                                                    <a class="confirm-redirection"
                                                        href="{{ $recent_video->link }}">{{ $recent_video->name }}</a>
                                                </div>
                                                <span class="badge">
                                                    Ad
                                                </span>
                                                <!-- //{{ route('user.channel', $recent_video->channel_id) }} -->
                                                <span><a class="confirm-redirection" href="{{ $recent_video->link }}"
                                                        style="text-transform: lowercase;">{{ $recent_video->link }} <i
                                                            class="fa fa-external-link"></i></a></span>
                                            </div><!--end of video-details-->
                                        </div><!--end of slide-box-->
                                    @endforeach
                                @endif
                            </div><!--end of box-->
                        </div>
                    </div>
                    <!--end of slide-area-->
                @endif
                @if (count($trendings->items) > 0)
                    <hr>
                    <div class="slide-area">
                        <div class="box-head">
                            <h3>{{ tr('trending') }}</h3>
                        </div>
                        <div class="row">
                            <div class="box col-md-9"
                                @if (empty($top_side_ad[0]->file)) style="width: 1064px !important;" @endif>
                                @foreach ($trendings->items as $trending)
                                    <div class="slide-box">
                                        <div class="slide-image">
                                            <a href="{{ $trending->url }}"
                                                @if ($trending->member_only && !Auth::check()) force-login="true" @endif>
                                                <!-- <img src="{{ $trending->video_image }}" /> -->
                                                <!-- <div style="background-image: url({{ $trending->video_image }});" class="slide-img1"></div> -->
                                                <img src="{{ asset('streamtube/images/placeholder.gif') }}"
                                                    data-src="{{ $trending->video_image }}"
                                                    class="slide-img1 placeholder" />
                                                @if ($trending->member_only)
                                                    <div id="container">
                                                        <div id="triangle-topleft"></div>
                                                        <div id="overlay">Member Only</div>
                                                    </div>
                                                @endif
                                            </a>
                                            @if ($trending->ppv_amount > 0)
                                                @if (!$trending->ppv_status)
                                                    <div class="video_amount">
                                                        {{ tr('pay') }} -
                                                        {{ Setting::get('currency') }}{{ $trending->ppv_amount }}
                                                    </div>
                                                @endif
                                            @endif
                                            <div class="video_mobile_views">
                                                {{ $trending->watch_count }} {{ tr('views') }}
                                            </div>
                                            <div class="video_duration">
                                                {{ $trending->duration }}
                                            </div>
                                        </div><!--end of slide-image-->
                                        <div class="video-details">
                                            <div class="video-head">
                                                @if (!Auth::check())
                                                    <a href="{{ $trending->url }}"
                                                        @if ($trending->member_only && !Auth::check()) force-login="true" @endif>{{ $trending->title }}</a>
                                                @endif
                                            </div>
                                            <span class="video_views">
                                                <div><a
                                                        href="{{ route('user.channel', $trending->channel_id) }}">{{ $trending->channel_name }}</a>
                                                </div>
                                                <div class="hidden-mobile">
                                                    <i class="fa fa-eye"></i> {{ $trending->watch_count }}
                                                    {{ tr('views') }} <b>.</b>
                                                    {{ $trending->publish_time }}
                                                </div>
                                            </span>
                                        </div><!--end of video-details-->
                                    </div><!--end of slide-box-->
                                @endforeach
                            </div><!--end of box-->

                            @if (!empty($top_side_ad))
                                <div class="col-md-3">
                                    @foreach ($top_side_ad as $recent_video)
                                        <div class="slide-box" style="padding-top: 5px;">
                                            <div class="slide-image ads">
                                                <a class="confirm-redirection" href="{{ $recent_video->link }}">
                                                    <img src="{{ asset('streamtube/images/placeholder.gif') }}"
                                                        data-src="{{ asset($recent_video->file) }}"class="slide-img1 placeholder" />
                                                </a>
                                                <div class="video_mobile_views">
                                                    {{ $recent_video->watch_count }} {{ tr('views') }}
                                                </div>
                                                <div class="video_duration">
                                                    {{ $recent_video->duration }}
                                                </div>
                                            </div><!--end of slide-image-->
                                            <div class="video-details">
                                                <div class="video-head">
                                                    <a class="confirm-redirection"
                                                        href="{{ $recent_video->link }}">{{ $recent_video->name }}</a>
                                                </div>
                                                <span class="badge">
                                                    Ad
                                                </span>
                                                <span><a class="confirm-redirection" href="{{ $recent_video->link }}"
                                                        style="text-transform: lowercase;">{{ $recent_video->link }} <i
                                                            class="fa fa-external-link"></i></a></span>
                                            </div><!--end of video-details-->
                                        </div><!--end of slide-box-->
                                    @endforeach
                                </div><!--end of box-->
                            @endif
                        </div>
                    </div><!--end of slide-area-->
                @endif

                @if (count($featureds->items) > 0)
                    <hr>
                    <div class="slide-area">
                        <div class="box-head">
                            <h3>{{ tr('featured') }}</h3>
                        </div>

                        <div class="box">
                            @foreach ($featureds->items as $featured)
                                <div class="slide-box">
                                    <div class="slide-image">
                                        <a href="{{ $featured->url }}"
                                            @if ($featured->member_only && !Auth::check()) force-login="true" @endif>
                                            <!-- <img src="{{ $featured->video_image }}" /> -->
                                            <!-- <div style="background-image: url({{ $featured->video_image }});" class="slide-img1"></div> -->
                                            <img src="{{ asset('streamtube/images/placeholder.gif') }}"
                                                data-src="{{ $featured->video_image }}" class="slide-img1 placeholder" />
                                            @if ($featured->member_only)
                                                <div id="container">
                                                    <div id="triangle-topleft"></div>
                                                    <div id="overlay">Member Only</div>
                                                </div>
                                            @endif
                                        </a>
                                        @if ($featured->ppv_amount > 0)
                                            @if (!$featured->ppv_status)
                                                <div class="video_amount">
                                                    {{ tr('pay') }} -
                                                    {{ Setting::get('currency') }}{{ $featured->ppv_amount }}
                                                </div>
                                            @endif
                                        @endif
                                        <div class="video_mobile_views">
                                            {{ $featured->watch_count }} {{ tr('views') }}
                                        </div>
                                        <div class="video_duration">
                                            {{ $featured->duration }}
                                        </div>
                                    </div><!--end of slide-image-->
                                    <div class="video-details">
                                        <div class="video-head">
                                            <a href="{{ $featured->url }}"
                                                @if ($featured->member_only && !Auth::check()) force-login="true" @endif>{{ $featured->title }}</a>
                                        </div>
                                        <span class="video_views">
                                            <div>
                                                <a
                                                    href="{{ route('user.channel', $featured->channel_id) }}">{{ $featured->channel_name }}</a>
                                            </div>
                                            <div class="hidden-mobile">
                                                <i class="fa fa-eye"></i> {{ $featured->watch_count }}
                                                {{ tr('views') }} <b>.</b>
                                                {{ $featured->publish_time }}
                                            </div>
                                        </span>
                                    </div><!--end of video-details-->
                                </div><!--end of slide-box-->
                            @endforeach
                        </div><!--end of box-->
                    </div><!--end of slide-area-->
                @endif

                @if (Auth::check())
                    @if ($users->login_count <= 3)
                        <div class="alert">
                            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                            <a ref="{{ route('ducoment.verify') }}" style="color: #fff;">Click here to become
                                verified!</a>
                        </div>
                    @endif
                @endif

                @if (count($suggestions->items) > 0)
                    <hr>
                    <div class="slide-area">
                        <div class="box-head">
                            <h3>{{ tr('suggestions') }}</h3>
                        </div>
                        <div class="box">
                            @foreach ($suggestions->items as $suggestion)
                                <div class="slide-box">
                                    <div class="slide-image">
                                        <a href="{{ $suggestion->url }}"
                                            @if ($suggestion->member_only && !Auth::check()) force-login="true" @endif>
                                            <!-- <img src="{{ $suggestion->video_image }}" /> -->
                                            <!--  <div style="background-image: url({{ $suggestion->video_image }});" class="slide-img1"></div> -->
                                            <img src="{{ asset('streamtube/images/placeholder.gif') }}"
                                                data-src="{{ $suggestion->video_image }}"
                                                class="slide-img1 placeholder" />
                                            @if ($suggestion->member_only)
                                                <div id="container">
                                                    <div id="triangle-topleft"></div>
                                                    <div id="overlay">Member Only</div>
                                                </div>
                                            @endif
                                        </a>
                                        @if ($suggestion->ppv_amount > 0)
                                            @if (!$suggestion->ppv_status)
                                                <div class="video_amount">
                                                    {{ tr('pay') }} -
                                                    {{ Setting::get('currency') }}{{ $suggestion->ppv_amount }}
                                                </div>
                                            @endif
                                        @endif
                                        <div class="video_mobile_views">
                                            {{ $suggestion->watch_count }} {{ tr('views') }}
                                        </div>
                                        <div class="video_duration">
                                            {{ $suggestion->duration }}
                                        </div>
                                    </div><!--end of slide-image-->
                                    <div class="video-details">
                                        <div class="video-head">
                                            <a href="{{ $suggestion->url }}"
                                                @if ($suggestion->member_only && !Auth::check()) force-login="true" @endif>{{ $suggestion->title }}</a>
                                        </div>
                                        <span class="video_views">
                                            <div><a
                                                    href="{{ route('user.channel', $suggestion->channel_id) }}">{{ $suggestion->channel_name }}</a>
                                            </div>
                                            <div class="hidden-mobile">
                                                <i class="fa fa-eye"></i> {{ $suggestion->watch_count }}
                                                {{ tr('views') }} <b>.</b>
                                                {{ $suggestion->publish_time }}
                                            </div>
                                        </span>
                                    </div><!--end of video-details-->
                                </div><!--end of slide-box-->
                            @endforeach
                        </div><!--end of box-->
                    </div><!--end of slide-area-->
                @endif
                @if ($watch_lists)
                    @if (count($watch_lists->items) > 0)
                        <hr>
                        <div class="slide-area">
                            <div class="box-head">
                                <h3>{{ tr('watch_lists') }}</h3>
                            </div>
                            <div class="box">
                                @foreach ($watch_lists->items as $watch_list)
                                    <div class="slide-box">
                                        <div class="slide-image">
                                            <a href="{{ $watch_list->url }}"
                                                @if ($watch_list->member_only && !Auth::check()) force-login="true" @endif>
                                                <!-- <img src="{{ $watch_list->video_image }}" /> -->
                                                <img src="{{ asset('streamtube/images/placeholder.gif') }}"
                                                    data-src="{{ $watch_list->video_image }}"
                                                    class="slide-img1 placeholder" />
                                                @if ($watch_list->member_only)
                                                    <div id="container">
                                                        <div id="triangle-topleft"></div>
                                                        <div id="overlay">Member Only</div>
                                                    </div>
                                                @endif
                                            </a>
                                            @if ($watch_list->ppv_amount > 0)
                                                @if (!$watch_list->ppv_status)
                                                    <div class="video_amount">
                                                        {{ tr('pay') }} -
                                                        {{ Setting::get('currency') }}{{ $watch_list->ppv_amount }}
                                                    </div>
                                                @endif
                                            @endif
                                            <div class="video_mobile_views">
                                                {{ $watch_list->watch_count }} {{ tr('views') }}
                                            </div>
                                            <div class="video_duration">
                                                {{ $watch_list->duration }}
                                            </div>
                                        </div><!--end of slide-image-->
                                        <div class="video-details">
                                            <div class="video-head">
                                                <a href="{{ $watch_list->url }}">{{ $watch_list->title }}</a>
                                            </div>
                                            <span class="video_views">
                                                <div><a
                                                        href="{{ route('user.channel', $watch_list->channel_id) }}">{{ $watch_list->channel_name }}</a>
                                                </div>
                                                <div class="hidden-mobile">
                                                    <i class="fa fa-eye"></i> {{ $watch_list->watch_count }}
                                                    {{ tr('views') }} <b>.</b>
                                                    {{ $watch_list->publish_time }}
                                                </div>
                                            </span>
                                        </div><!--end of video-details-->
                                    </div><!--end of slide-box-->
                                @endforeach
                            </div><!--end of box-->
                        </div><!--end of slide-area-->
                    @endif
                @endif
                <div class="sidebar-back"></div>
            </div>
        </div>
    </div>

    {{-- Show Login message modal --}}
    <div class="modal fade" id="loginMessageModal" tabindex="-1" role="dialog"
        aria-labelledby="loginMessageModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="loginMessageModal">Warning</h4>
                </div>
                <div class="modal-body text-center">
                    <div class="alert alert-warning" role="alert" style="padding:12px">
                        This is a member only video, please login to watch!
                    </div>
                    <a type="button" class="btn btn-primary" href="{{ route('user.login.form') }} ">Login</a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $('#myCarousel').carousel({
            interval: 3500
        });

        // This event fires immediately when the slide instance method is invoked.
        $('#myCarousel').on('slide.bs.carousel', function(e) {
            var id = $('.item.active').data('slide-number');

            // Added a statement to make sure the carousel loops correct
            if (e.direction == 'right') {
                id = parseInt(id) - 1;
                if (id == -1) id = 7;
            } else {
                id = parseInt(id) + 1;
                if (id == $('[id^=carousel-thumb-]').length) id = 0;
            }

            $('[id^=carousel-thumb-]').removeClass('selected');
            $('[id=carousel-thumb-' + id + ']').addClass('selected');
        });

        // Thumb control
        $('[id^=carousel-thumb-]').click(function() {
            var id_selector = $(this).attr("id");
            var id = id_selector.substr(id_selector.length - 1);
            id = parseInt(id);
            $('#myCarousel').carousel(id);
            $('[id^=carousel-thumb-]').removeClass('selected');
            $(this).addClass('selected');
        });
    </script>

    <script>
        //show login modal for not logged in users
        $('.slide-image a').click(function(e) {
            e.preventDefault();
            if (!this.getAttribute('force-login')) {
                if ($(this).hasClass('confirm-redirection') === false) {
                    window.location.href = this.href;
                }
            } else {
                $('#loginMessageModal').modal('show');
            }
        })
    </script>
    <script>
        //show login modal for not logged in users
        $('.video-head a').click(function(e) {
            e.preventDefault();
            if (!this.getAttribute('force-login')) {
                if ($(this).hasClass('confirm-redirection') === false) {
                    window.location.href = this.href;
                }
            } else {
                $('#loginMessageModal').modal('show');
            }
        })
    </script>
@endsection
