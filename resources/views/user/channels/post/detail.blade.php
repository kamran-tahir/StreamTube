@extends('layouts.user')
@section('styles')
<style type="text/css">
	.card{
        width: 100%;
        border: 1px solid lightgrey;
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
        margin: 2%;
    }
    .card-link {
        background-color: #167ac6e6 !important;
        float: right;
        margin: .5% 5% 1%;
        border: 2px solid rgb(118 118 118 / 44%);
        padding: 0.75%;
        text-decoration: none;
    }
    .card-link:hover {
        background-color: white !important;
        color: #167ac6e6 !important;
        border-color: cornflowerblue;
    }
    .card-footer{
        clear: both;
        background-color: #e8e8e8;
    }
    .like-stats{
        display: inline-block;
        padding: 1% 1%;
        width: 48%;
        color: #167ac6e6;
    }
    .like-stats i{
        padding-left: 2%;
        cursor: pointer;
    }
    .like-stats i.disabled{
        color: grey;
    }
    .comment-stats{
        display: inline-block;
        padding: 1% 1%;
        width: 50%;
        text-align: right;
        color: #167ac6e6;
    }    
    .comment-field-div{
    	width: 95%;
    	margin-right: 1%;
    	height: 85px;
    }
    .comment-field{
    	width: 100%;
    	height: 100%;
    	border: none;
    }
    .comment-btn-div{
    	width: 4%;
    	position: relative;
    	min-height: 85px;
    	padding: 0;
    }

	.comment-btn{
		position: absolute;
	    bottom: 0;
	    left: 0;
	    width: 100%;
	}
	.comment-btn i{
		transform: rotate(50deg);
	}
</style>

<link rel="stylesheet" href="{{asset('admin-css/plugins/datepicker/datepicker3.css')}}">

@endsection


@section('content')

<div class="y-content">
    
    <div class="row y-content-row">

        @include('layouts.user.nav')

        <div class="page-inner col-sm-9 col-md-10 profile-edit">

            <div class="profile-content slide-area1">
               
                <div class="row no-margin">

                    @include('notification.notify')

                    <div class="col-sm-12 col-md-12 col-lg-12 profile-view">
                        
                        <h3 class="mylist-head">Post Details</h3>
                       
                        <div class="card">
						  <div class="card-body">
						    <h5 class="card-title">{{$post->title}}</h5>
						    <div class="card-text">
						        {!! $post->description !!}
						    </div>
						  </div>
						  <div class="card-footer">
						      <div class="like-stats"> 
						          <i class="fa fa-thumbs-up {{$user->like_posts->contains($post->id,false) ? '':'disabled'}}" onclick="reactPost(1)"> Like</i> <i class="fa fa-thumbs-down {{$user->dislike_posts->contains($post->id,false) ? '':'disabled'}}"  onclick="reactPost(0)"> Dislike</i>
						      </div>
						      <div class="comment-stats"> 
						      	{{$post->likes->count()}} Likes &nbsp;&nbsp;&nbsp; {{$post->disLikes->count()}} Dislikes &nbsp;&nbsp;&nbsp;{{$post->commentsCount()}} Comments
						      </div>
						  </div>
						 </div>
						<br>
						<div class="row justify-content-center">
                                 <div class="col-md-12">
                                    <div class="card">
                              
                                       <div class="card-body" id="ajax_response">
                                       	<h5>Comments</h5>
                                       
                                       <div class="card-body">
                                       	<form action="{{route('user.channel.member-section.post.comment',['channel' => $channel->id,'post' => $post->id])}}" method="post">
										  	{{ csrf_field()}}
						
                                             <div class="form-group">
                                                <input type="text" name="comment" id="comment" class="form-control" placeholder="Add a public comment..." style="border-bottom: 2px solid #000;border-top: 0px;border-right: 0px;border-left: 0px;"  />
                                                 
                                             </div>
                                             <div class="form-group">
                                                <input type="submit" class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;float: right;" value="Add Comment" id="add_comment" />
                                             </div>
                                          </form>
                                          <div class="clearfix"></div>
                                          <br>
                                       </div>
                                       	<div id="user-comments"> 
				                           @php($i=0)
											@foreach($post->comments as $comment)
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
											        <form action="{{route('user.channel.member-section.post.comment',['channel' => $channel->id,'post' => $post->id])}}" method="post">
												  	    {{ csrf_field() }}
											            <div class="form-group" id="reply_comment_section{{$reply->id}}">
											                <input type="text" name="comment" class="form-control" style="border-bottom: 2px solid #000;border-top: 0px; border-right: 0px;border-left: 0px;" id="reply_comment{{$reply->id}}" />
											                <input type="hidden" name="comment_id" id="reply_comment_id{{$reply->id}}" value="{{ $comment->id }}" />
											            </div>
											            <div class="form-group">
											                <input type="submit" class="btn btn-sm btn-outline-danger py-0 add_reply" style="font-size: 0.8em;float: right;" value="Reply" id="{{$reply->id}}" />
											                <input type="button" class="btn btn-sm btn-outline-danger py-0 cancel" style="font-size: 0.8em;float: right;margin-right: 10px;" value="Cancel" id="{{$comment->id}}" />
											            </div>
											        </form>
											    </div>
											            </div>
											            @endforeach
											        </div>
											    </div>
											    <div class="col-xs-10 col-xs-offset-1 reply-section" id="reply-section{{$comment->id}}" style="display: none;">
											        <form action="{{route('user.channel.member-section.post.comment',['channel' => $channel->id,'post' => $post->id])}}" method="post">
												  	{{ csrf_field()}}
						
											            <div class="form-group" id="reply_comment_section{{$comment->id}}">
											                <input type="text" name="comment" class="form-control" style="border-bottom: 2px solid #000;border-top: 0px; border-right: 0px;border-left: 0px;" id="reply_comment{{$comment->id}}" />
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
										</div>
                                       <hr />
                                       </div>
                        
                                       
                        
                                    </div>
                                 </div>
                           </div>
                        
                    </div><!--profile-view end-->  
                </div><!--end of profile-content row-->
            
            </div>

            <div class="sidebar-back"></div> 
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script src="{{asset('admin-css/plugins/datepicker/bootstrap-datepicker.js')}}"></script> 

<script src="https://cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script>
   
<script type="text/javascript">
    
    $(".reply").click(function(){
        id = $(this).attr('id');
    
        $("#reply-section"+ id).show();
    });
        
    $(".cancel").click(function(){
        id = $(this).attr('id');
    
        $("#reply-section"+ id).hide();
    });

    function reactPost(status) {
      $.ajax({
           url : "{{route('user.channel.member-section.post.reaction',['channel' => $channel->id,'post' => $post->id])}}",
           data : {reaction:status},
           type: "get",
           success : function(data) {     
           	location.reload();
           },
           error : function(data) {
           	location.reload();
           },
      });
   }
   
   
</script>

@endsection