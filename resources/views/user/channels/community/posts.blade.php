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
            <div class="brand">{{$category->name}} Posts</div>
        </div>
        <!--SearchBox Section-->
        <div class="search-box">
            <div>
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
                        <a id="clear-search" href="{{route('user.channel.member-section.community.posts', ['channel'=> $channel,'category'=>$category->id]) }}" style="display:none"></a>
                    </div>
                </form>
            </div>
        </div>
    </header>
    <div class="container">
        <!--Display posts table-->
        <div class="posts-table">
            <div class="table-head">
                <div class="status">Status</div>
                <div class="subjects">Subjects</div>
                <div class="replies">Replies/Views</div>
                <div class="last-reply">Last Reply</div>
            </div>
            @include('user.channels.post.partial_post',['posts' => $posts])
        </div>
        <!--Pagination starts-->
            <div class="pagination">
                pages: {{$posts->appends(request()->query())->links()}}
            </div>
        <!--pagination ends-->
    </div>

    <footer>
        <span>&copy;  {{date('Y')}} @if(Setting::get('site_name')) {{Setting::get('site_name') }} @else {{tr('site_name')}} @endif</span>
    </footer>
    <script src="{{asset('streamtube/css/forum/main.js')}}"></script>
</body>
</html>