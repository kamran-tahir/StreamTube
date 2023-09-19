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
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<style type="text/css">
    body {
        background-color: inherit;
        color:inherit;
    }
    .card{
        padding: 6%;
        border: 2px solid #52057b;
        border-radius: 10px;
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
            <div class="brand">Create Post</div>
        </div>
        <!--SearchBox Section-->
       </header> 
    <div class="container">
        @include('notification.notify')
        <div class="card ">
            <form  action="{{route('user.channel.member-section.post.store',$channel)}}" method="POST" enctype="multipart/form-data">
                                        {!! csrf_field() !!}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" value="{{old('title') }}" name="title" class="form-control" placeholder="Title" id="title" >
                </div>
                <div class="form-group">
                    <label for="title">Category</label>
                    <select  class="form-control" name="category_id">
                        <option value="" selected disabled>Select Category</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>

                        @endforeach
                    </select>
                </div>
                      
                <div class="form-group">                        
                    <label for="title">Description</label>
                    <br><br>
                    <textarea  style="height: 200px" class="form-control" id="description" name="description"></textarea>
                </div>

                <div class="change-pwd save-pro-btn pull-right">
                    <button type="submit" class="btn btn-info">{{tr('submit')}}</button>
                </div>                                              

            </form>    
        </div>
        
    </div>
    <footer>
        <span>&copy;  {{date('Y')}} @if(Setting::get('site_name')) {{Setting::get('site_name') }} @else {{tr('site_name')}} @endif</span>
    </footer>
    <script src="{{asset('streamtube/css/forum/main.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
</body>
</html>

