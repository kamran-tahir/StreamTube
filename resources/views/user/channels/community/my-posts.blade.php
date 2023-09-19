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
    <style type="text/css">
        .search-box a {
            padding: 10px;
            background-color: #fff;
            color: #000000;
        }
    </style>
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
            <div class="brand">My Posts</div>
        </div>
    </header>
        <!--SearchBox Section-->
        <div class="search-box">
            <form>
                <div>
                    <select name="type" id="">
                        <option value="">Everything</option>
                        <option value="title" @if(request()->type == 'title') selected="selected" @endif>Title</option>
                        <option value="description" @if(request()->type == 'description') selected="selected" @endif>Description</option>
                    </select>
                    <input type="text" name="search" placeholder="search ..." value="{{request()->search}}">
                    <button type="submit"><i class="fa fa-search"></i></button>
                    <button type="button" onclick="document.getElementById('clear-search').click()">
                        <i class="fa fa-remove"></i>
                    </button>
                    <a id="clear-search" href="{{route('user.channel.member-section.post.my-posts', $channel)}}" style="display:none"></a>
                </div>
            </form>
        </div>
    </header>
    <div class="container">
        @foreach($posts as $category_id => $category_posts)
        @php
            $category = App\ForumCategory::find($category_id);
        @endphp
        <div class="subforum">
            <div class="subforum-title">
                <h1> {{$category->name}} </h1>
                <div class="category_posts_stats">
                    <span style="margin-right: 5%;">{{count($category_posts)}} Posts </span>
                    <!-- <span style="display: inline-block;">
                        <b><a href="">Last post</a></b> by <a href="">JustAUser</a> 
                    <br>on <small>12 Dec 2020</small>
                    </span> -->
                </div>
            
            </div>
            @foreach( $category_posts as $category_post)
            <div class="subforum-row">
                <div class="subforum-icon subforum-column center">
                    <i class="fa fa-fire center"></i>
                </div>
                <div class="subforum-description subforum-column">
                    <h4><a href="{{route('user.channel.member-section.post.detail',['channel' => $channel->id,'post' => $category_post->id])}}">{{ $category_post->title }} </a></h4>
                    <div class="topic-description">
                        {{ strlen($category_post->description) > 1000 ? substr($category_post->description ,0,1000).'.........' : $category_post->description }} 
                        
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!--More-->
        @endforeach
        
    </div>

    <footer>
        <span>&copy;  {{date('Y')}} @if(Setting::get('site_name')) {{Setting::get('site_name') }} @else {{tr('site_name')}} @endif</span>
    </footer>
    <script src="{{asset('streamtube/css/forum/main.js')}}"></script>
</body>
</html>