<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@if(Setting::get('site_name')) {{Setting::get('site_name') }} @else {{tr('site_name')}} @endif</title>  
    <link rel="stylesheet" href="{{asset('streamtube/css/forum/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital@1&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <!--NavBar Section-->
        <div class="navbar">
            <nav class="navigation hide" id="navigation">
                <span class="close-icon" id="close-icon" onclick="showIconBar()"><i class="fa fa-close"></i></span>
                <ul class="nav-list">
                    <li class="nav-item"><a href="{{route('user.channel.member-section.community', $channel)}}">Forums</a></li>
                    <li class="nav-item"><a href="{{route('user.channel.member-section.post.my-posts', $channel)}}">My Posts</a></li>
                    <li class="nav-item"><a href="{{route('user.channel.member-section.post.create', $channel)}}">Create Post</a></li> 
                    <li class="nav-item"><a href="{{route('user.members', ['id'=>$channel->id])}}">Channel</a></li>
                </ul>
            </nav>
            <a class="bar-icon" id="iconBar" onclick="hideIconBar()"><i class="fa fa-bars"></i></a>
            <div class="brand">Post Detail</div>
        </div>
        <!--SearchBox Section-->
      </header>  
    <div class="container">
        <!--Navigation-->
        <div class="navigate">
            <span><a href="{{route('user.channel.member-section.community', $channel)}}">{{$channel->name}}</a> >> <a href="{{route('user.channel.member-section.community.posts', ['channel'=> $channel,'category'=>$category->id]) }}">{{$category->name}}</a> >> {{$post->title}}</span>
        </div>

        <!--Topic Section-->
        <div class="topic-container">
            <!--Original thread-->
            <div class="head">
                <div class="authors">Author</div>
                <div class="content">Topic: {{$post->title}}</div>
                <div class="stats"> 
                      <i class="fa fa-thumbs-up {{$user->like_posts()->where('post_id',$post->id)->count() ? '':'disabled'}}" onclick="reactPost(1)"> Like</i> <i class="fa fa-thumbs-down {{$user->dislike_posts()->where('post_id',$post->id)->count() ? '':'disabled'}}"  onclick="reactPost(0)"> Dislike</i>
                      <br>
                    {{$post->likes->count()}} Likes &nbsp;&nbsp;&nbsp; {{$post->disLikes->count()}} Dislikes <br>{{$post->commentsCount()}} Comments
                  </div>
                </div>

            <div class="body">
                <div class="authors">
                    <div class="username"><a href="">{{$user->name}}</a></div>
                    <img src="{{$comment->user->picture ?: asset('placeholder.png')}}" alt="{{ $comment->user->name }}">
                    <div>Posts: <u>{{count($user->channel_posts)}}</u></div>
                </div>
                <div class="content">
                    <div>
                        {{ $post->description }}
                    </div>
                    <div class="comment">
                        <button onclick="showComment()">Comment</button>
                    </div>
                </div>
            </div>
        </div>

        <!--Comment Area-->
        <div class="comment-area hide" id="comment-area">
            <form action="{{route('user.channel.member-section.post.comment',['channel' => $channel->id,'post' => $post->id])}}" method="post">
                {{ csrf_field()}}
                        
                <textarea name="comment" id="" placeholder="comment here ... "></textarea>
                <input type="submit" value="submit">
            </form>
        </div>
        <hr>
         @php($i=0)
            @foreach($post->comments as $comment)
            @php($i++)

            <!--Comments Section-->
            <div class="comments-container">
                <div class="body">
                    <div class="authors">
                        <div class="username"><a href="">{{ $comment->user->name }}</a></div>
                        <div>Role</div>
                        <img src="{{$comment->user->picture ?: asset('placeholder.png')}}" alt="{{ $comment->user->name }}">
                        <div>Posts: <u>{{count($comment->user->channel_posts)}}</u></div>
                        
                    </div>
                    <div class="content">
                            {{ $comment->comment }}    
                            
                        <!-- <div class="comment">
                            <button onclick="showReply()">Reply</button>
                        </div> -->
                        
                    </div>
                    <div style="margin-left:2%">
                        @if (Auth::id() == $comment->user->id)
                            <form action="{{route('user.delete.comment')}}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="comment_id" value="{{$comment->id }}">
                            </form>
                            <a onclick="$(this).siblings('form').submit();">
                                <i class="fa fa-trash"></i>
                            </a>
                        @endif
                             
                    </div>
                </div>
            </div>
            <!--Reply Area-->
            {{-- <div class="comment-area hide" id="reply-area">
                <form action="{{route('user.channel.member-section.post.comment',['channel' => $channel->id,'post' => $post->id])}}" method="post">
                    {{ csrf_field()}}
                            
                    <textarea name="comment" id="" placeholder="comment here ... "></textarea>
                    <input type="submit" value="submit">
                </form>
            </div>
            --}}

        @endforeach
    </div>
    <footer>
        <span>&copy;  {{date('Y')}} @if(Setting::get('site_name')) {{Setting::get('site_name') }} @else {{tr('site_name')}} @endif</span>
    </footer>
    <script src="{{asset('streamtube/css/forum/main.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript">
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
</body>
</html>