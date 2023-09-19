@php($i=0)
@foreach($comments as $comment)
@php($i++)

<div class="row" id="">
    <div class="col-xs-1">
        <img class="profile-image" src="{{$comment->user->picture ?: asset('placeholder.png')}}">
    </div>
    
    <div class="col-xs-11">
        <strong>{{ $comment->user->name }}</strong>
        <small>{{ Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</small>

        <div class="dropdown pull-right">
            <a id="delete-comment-{{$comment->id}}" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-ellipsis-v"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="delete-comment-{{$comment->id}}">
                @if (Auth::id() == $comment->user->id)
                    <li>
                        <form action="{{route('user.delete.comment')}}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="comment_id" value="{{$comment->id }}">
                        </form>
                        <a onclick="$(this).siblings('form').submit();">
                            <i class="fa fa-trash"></i>
                            Delete
                        </a>
                    </li>
                @endif
                <li>
                    <a href="#">
                        <i class="fa fa-flag"></i>
                        Report
                    </a>
                </li>
            </ul>
        </div>

        <p id="comment_ajax">{{ $comment->comment }}</p>
        @if(Auth::check())
        <p class="reply" id="{{$comment->id}}" style="cursor: pointer;">Reply</p>
        @endif
        
        @if(count($comment->replies))
            <a data-toggle="collapse" href="#collapsibleComments-{{$comment->id}}" aria-expanded="false" aria-controls="collapsibleComments-{{$comment->id}}">
                View <span id="replies-count-{{$comment->id}}">{{$comment->replies_count}}</span> replies
            </a>
        @endif
        <div class="collapse ajax_reply" style="margin-left: 1em" id="collapsibleComments-{{$comment->id}}">
            @foreach($comment->replies as $reply)
            <div class="row" id="">
                <div class="col-xs-1">
                    <img class="profile-image" src="{{$reply->user->picture ?: asset('placeholder.png')}}">
                </div>
                
                <div class="col-xs-11">
                    <strong>{{ $reply->user->name }}</strong>
                    <small>{{ Carbon\Carbon::parse($reply->created_at)->diffForHumans()}}</small>
                    
                    <div class="dropdown pull-right">
                        <a id="delete-comment-{{$reply->id}}" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fa fa-ellipsis-v"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="delete-comment-{{$reply->id}}">
                            @if (Auth::id() == $reply->user)
                                <li>
                                    <form action="{{route('user.delete.comment')}}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="comment_id" value="{{$reply->id }}">
                                    </form>
                                    <a onclick="$(this).siblings('form').submit();">
                                        <i class="fa fa-trash"></i>
                                        Delete
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="#">
                                    <i class="fa fa-flag"></i>
                                    Report
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                    <p>{{ $reply->comment }}</p>
                    @if(Auth::check())
                    <p class="reply" id="{{$reply->id}}" style="cursor: pointer;">Reply</p>
                    @endif
                </div>
                <div class="col-xs-10 col-xs-offset-1 reply-section" id="reply-section{{$reply->id}}" style="display: none;">
        <!-- <form method="post" action="{{ route('user.add.comment') }}"> -->
            {{ csrf_field() }}
            <div class="form-group" id="reply_comment_section{{$reply->id}}">
                <input type="text" name="comment" class="form-control" style="border-bottom: 2px solid #000;border-top: 0px; border-right: 0px;border-left: 0px;" id="reply_comment{{$reply->id}}" />
                <input type="hidden" name="video_tape_id" id="reply_video_tape_id{{$reply->id}}" value="{{ $video_tape_id }}" />
                <input type="hidden" name="comment_id" id="reply_comment_id{{$reply->id}}" value="{{ $comment->id }}" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-sm btn-outline-danger py-0 add_reply" style="font-size: 0.8em;float: right;" value="Reply" id="{{$reply->id}}" />
                <input type="button" class="btn btn-sm btn-outline-danger py-0 cancel" style="font-size: 0.8em;float: right;margin-right: 10px;" value="Cancel" id="{{$comment->id}}" />
            </div>
        <!-- </form> -->
    </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-xs-10 col-xs-offset-1 reply-section" id="reply-section{{$comment->id}}" style="display: none;">
        <!-- <form method="post" action="{{ route('user.add.comment') }}"> -->
            {{ csrf_field() }}
            <div class="form-group" id="reply_comment_section{{$comment->id}}">
                <input type="text" name="comment" class="form-control" style="border-bottom: 2px solid #000;border-top: 0px; border-right: 0px;border-left: 0px;" id="reply_comment{{$comment->id}}" />
                <input type="hidden" name="video_tape_id" id="reply_video_tape_id{{$comment->id}}" value="{{ $video_tape_id }}" />
                <input type="hidden" name="comment_id" id="reply_comment_id{{$comment->id}}" value="{{ $comment->id }}" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-sm btn-outline-danger py-0 add_reply" style="font-size: 0.8em;float: right;" value="Reply" id="{{$comment->id}}" />
                <input type="button" class="btn btn-sm btn-outline-danger py-0 cancel" style="font-size: 0.8em;float: right;margin-right: 10px;" value="Cancel" id="{{$comment->id}}" />
            </div>
        <!-- </form> -->
    </div>
</div>


@endforeach 