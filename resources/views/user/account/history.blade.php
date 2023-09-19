@extends('layouts.user')

@section('styles')
<style type="text/css">
    .search-history{
        border-right: 1px solid #f1f1f1;
        background-color: #f1f1f1; 
        padding-bottom: 15px;
        padding-top: 15px;
        margin-top: 100px;
        overflow: auto;
        z-index: 10;
        margin-bottom: 2%;
        
    }
    .search-history-actions{
        cursor: pointer;
        padding: 3%;
    }
    .search-history-actions:hover{
        background-color: #80808040;
    }
    #searchclear {
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
    @media (min-width: 768px){
        .search-history{
            position: fixed;
            right: 0;
            min-height: 700px;
        }
    
    }

</style>
@endsection

@section('content')

<div class="y-content">
    <div class="row content-row">

        @include('layouts.user.nav')

        <div class="history-content page-inner col-sm-5 col-md-7">
            <div class="slide-area1">

                @include('notification.notify')

                <div class="new-history">
                    <div class="content-head">
                        <div><h4 class="bold">{{tr('history')}}</h4></div>
                        
                        <div class="clear-fix"></div>             
                    </div>

                    <!--end of content-head-->
                    
                    <dl class="history-list">

                        @if(count($histories->items) > 0)

                            @foreach($histories->items as $date => $videos)

                                <dt style="padding:3% 0; font-size:1.8rem">{{ \Carbon\Carbon::parse($date)->format('F j, Y')}}</dt>
                                @foreach($videos as $v => $video)
                                    <dd class="sub-list search-list row">
                                        <div class="main-history">
                                             <div class="history-image">
                                                <a href="{{$video->url}}">
                                                    <img src="{{$video->video_image}}">
                                                </a>        
                                                <div class="video_duration">
                                                    {{$video->duration}}
                                                </div>                 
                                            </div><!--history-image-->

                                            <div class="history-title">
                                                <div class="history-head row">
                                                    <div class="cross-title">
                                                        <h5>
                                                            <a href="{{$video->url}}">{{$video->title}}</a></h5>
                                                        <span class="video_views">
                                                             <div><a href="{{route('user.channel',$video->channel_id)}}">{{$video->channel_name}}</a></div>
                                                            <div>
                                                                <i class="fa fa-eye"></i> {{$video->watch_count}} {{tr('views')}}<b>.</b> 
                                                                {{common_date($video->created_at) }}
                                                            </div>
                                                        </span> 
                                                    </div> 
                                                    <div class="cross-mark1">
                                                        <a class="confirm-clear-history-single" data-id="{{$video->search_history_id}}"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                    </div>
                                                                          
                                                </div> <!--end of history-head--> 

                                                <div class="description">
                                                    <div><?= $video->description?></div>
                                                </div><!--end of description--> 

                                                <span class="stars">
                                                   <a><i @if($video->ratings >= 1) style="color:#ff0000" @endif class="fa fa-star" aria-hidden="true"></i></a>
                                                   <a><i @if($video->ratings >= 2) style="color:#ff0000" @endif class="fa fa-star" aria-hidden="true"></i></a>
                                                   <a><i @if($video->ratings >= 3) style="color:#ff0000" @endif class="fa fa-star" aria-hidden="true"></i></a>
                                                   <a><i @if($video->ratings >= 4) style="color:#ff0000" @endif class="fa fa-star" aria-hidden="true"></i></a>
                                                   <a><i @if($video->ratings >= 5) style="color:#ff0000" @endif class="fa fa-star" aria-hidden="true"></i></a>
                                                </span>                                                       
                                            </div><!--end of history-title--> 
                                            
                                        </div><!--end of main-history-->
                                    </dd>

                                @endforeach
                            @endforeach

                        @else

                            <!-- <p class="no-result">{{tr('no_search_result')}}</p> -->
                            <img src="{{asset('images/no-result.jpg')}}" class="img-responsive auto-margin">

                        @endif
                       
                    </ul>

                    @if(count($histories->items) > 0)
                        <div class="row">
                            <div class="col-md-12">
                                <div align="center" id="paglink"><?php echo $videos->pagination; ?></div>
                            </div>
                        </div>
                    @endif
                </div>
            
                <div class="sidebar-back"></div>

            </div>
        </div>
        <div class="history-content page-inner col-sm-4 col-md-3 search-history ">
            <div class="card">
                <div class="card-body" >
                    <div class="row">
                        <div class="col-md-12">
                            <form action="" method="get" id="search-history-form">
                                <div class="form-group has-search" style="margin:2%">
                                    <label>Search Watch History</label> 
                                    <br>
                                    <div class="col-md-12">
                                      <input type="text" name='search' id="searchinput" class="form-control" placeholder="Search" onkeypress="serachForm(event)" value="{{$search}}">
                                      <span id="searchclear" class="glyphicon glyphicon-remove-circle"></span>
                                    </div>

                                </div> 
                            </form> 
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group search-history-actions confirm-clear-history" style="margin:2%; margin-left:5%; font-size: 1.7rem;">
                                <i class="fa fa-trash" style="font-size: 2.5rem; padding-right: 2%;"></i> Clear All  Watch History
                            </div>    
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group search-history-actions confirm-history-status-{{auth()->user()->search_history_status}}" style="margin:2%; margin-left:5%; font-size: 1.7rem;">  
                                @if(auth()->user()->search_history_status)  
                                <i class="fa fa-pause-circle" style="font-size: 2.5rem; padding-right: 2%;"></i> Turn OFF Watch History
                                @else
                                <i class="fa fa-play-circle" style="font-size: 2.5rem; padding-right: 2%;"></i> Turn ON Watch History
                                @endif
                            </div>    
                        </div>
                    </div>                  
                </div>
            </div>
        </div>

    </div>
</div>

<form action="{{route('user.search-history.clear')}}" id="search-history-clear" method="POST">
    {!! csrf_field() !!}
    <input type="hidden" name="user_id" value="{{auth()->id()}}">
    <input type="hidden" name="record_id" value="" id="record_id">

</form>

<form action="{{route('user.search-history.status.update')}}" id="search-history-status" method="POST">
    {!! csrf_field() !!}
    <input type="hidden" name="user_id" value="{{auth()->id()}}">
    <input type="hidden" name="status" value="{{ ! auth()->user()->search_history_status}}">

</form>
@endsection

@section('scripts')
<script type="text/javascript">
    
    $('.confirm-clear-history').confirm({
        columnClass:'small',
        theme: 'bootstrap',
        title: 'Do you want to clear your all watch history?',
        content: 'Your watch history will be cleared. Your video recommendations will be reset.',
        buttons: {
            cancel:{
                action: function(){

                }
            },
            continue:{
                btnClass: 'btn-blue',
                action: function(){
                    submitForm('search-history-clear');
                }
            }
        }
    });

    $('.confirm-clear-history-single').confirm({
        columnClass:'small',
        theme: 'bootstrap',
        title: 'Do you want to clear this entry from your watch history?',
        content: 'This entry of Your watch history will be cleared.',
        buttons: {
            cancel:{
                action: function(){

                }
            },
            continue:{
                btnClass: 'btn-blue',
                action: function(){
                    $('#record_id').val(this.$target.attr('data-id'))
                    submitForm('search-history-clear');
                }
            }
        }
    });

    $('.confirm-history-status-0').confirm({
        columnClass:'small',
        theme: 'bootstrap',
        title: 'Do You Want To Turn ON Watch History ',
        content: 'Your private watch history makes your recently watched videos on StreamTube easy to find.When StreamTube watch history is on, this data may be saved from any of your signed-in devices. You can always control and review your activity',
        buttons: {
            cancel:{
                action: function(){

                }
            },
            continue:{
                btnClass: 'btn-blue',
                action: function(){
                    submitForm('search-history-status');
                }
            }
        }
    });
    $('.confirm-history-status-1').confirm({
        columnClass:'small',
        theme: 'bootstrap',
        title: 'Pause Watch History?',
        content: "Pausing StreamTube watch history can make it harder to find videos you watched, pausing this setting doesn't delete any previous activity, but you can view, edit and delete your private StreamTube watch history data anytime.",
        buttons: {
            cancel:{
                action: function(){

                }
            },
            continue:{
                btnClass: 'btn-blue',
                action: function(){
                    submitForm('search-history-status');
                }
            }
        }
    });

    function submitForm(id){
        $("#"+id).submit();
    }

    $("#searchclear").click(function(){
        $("#searchinput").val('');
        $("#search-history-form").submit();
    });
    
</script>

@endsection