@foreach($posts as $post)
@php
  //$post = App\ChannelPost::find($post->id);
@endphp

<div class="table-row">
    <div class="status"><i class="fa fa-fire"></i></div>
    <div class="subjects">
        <a href="{{route('user.channel.member-section.post.detail',['channel' => $channel->id,'post' => $post->id])}}">{{$post->title}}</a>
        <div>
          {{ strlen($post->description) > 1000 ? substr($post->description ,0,1000).'.........' : $post->description }} 
        </div>
        <span>Started by <b>{{$post->user->name}}</b> .</span>
    </div>
    <div class="replies">
        {{$post->commentsCount()}} replies <br> {{$post->likes->count()}} Likes
    </div>

    <div class="last-reply">
        {{$post->created_at->format('F d Y')}}
        <br>By <b>{{$post->user->name}}</b>
    </div>
</div>
  
{{--
<div class="card">
  <div class="card-body">
    <h5 class="card-title">{{$post->title}}</h5>
    <div class="card-text">
        {{ substr($post->description ,0,1000)}}.........
    </div>

    
  </div>
  <div class="card-footer">
      <div class="like-stats"> 
        {{$post->likes->count()}} Likes &nbsp;&nbsp;&nbsp; {{$post->disLikes->count()}} Dislikes &nbsp;&nbsp;&nbsp;{{$post->commentsCount()}} Comments
      </div>
      <div class="comment-stats"> 
        <a href="{{route('user.channel.member-section.post.detail',['channel' => $channel->id,'post' => $post->id])}}" class="card-link float-left">View detail</a>
      </div>
  </div>
</div>
--}}
@endforeach
