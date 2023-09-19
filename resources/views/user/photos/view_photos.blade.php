@extends('layouts.user')
 
@section('styles')
<link rel="stylesheet" type="text/css" href="{{asset('streamtube/css/wizard.css')}}">

<link rel="stylesheet" href="{{asset('admin-css/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}">
<style type="text/css">
  .overlay5 {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    height: 100%;
    width: 100%;
    opacity: 0;
    transition: .5s ease;
    background: #0008;
    border-radius: 10px;
  }
    .closebtn{
        position: absolute;
        /* top: 10px; */
        right: 46px;
        color: white;
        font-size: 35px;
        cursor: pointer;
    }    
    #cke_25{
        display: none !important;
    }
    .slide-image{
        /* border: 1px solid;
        border-radius: 5px; */
        /* padding: 2px; */
        height: 215px !important;

    }
    .slide-img1{
        border-radius: 10px;
        height: 190px;
        object-fit: cover;
    }
    .slide-image:hover .overlay5 {
      opacity: 1;
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
    #triangle-topleft {
        width: 0;
        height: 0;
        border-top: 68px solid #d9534f;
        border-left: 76px solid transparent;
        position: absolute;
    }
</style>
@endsection

@section('content')

<div class="y-content">
<input type="hidden" class='baseURL' value="{{ url('/') }}">
 <div class="row content-row">

    @include('layouts.user.nav')

    <div class="page-inner">

        <!--Wizard container-->
        <div class="col-sm-12">
            <div class="upload_photo">
            <a href="{{route('user.photo')}}">
                <input type="button" name="upload_file" class="btn btn-fill btn-danger btn-wd" value="Upload Photo" id="upload_file" style="float: right;">
            </a>
            </div>
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
                    @if($user_photo->members_only)

                    @php
                       if(Auth::check()){
                        if(! userChannelMemberStaus(Auth::user(),$user_photo->channel_id) AND !Auth::user()->getChannel->contains($user_photo->channel_id)){
                            $href = route('user.photos.gallery').'?photo_id='.$user_photo->id;
                        }else{
                            $href = route('user.photos.gallery');
                        }
                       }else{
                            $href = route('user.photos.gallery').'?photo_id='.$user_photo->id;
                       } 
                    @endphp
                    <a href="{{$href}}"> 
                    <div id="container">
                        <div id="triangle-topleft"></div>
                        <div id="overlay">Member Only</div>
                    </div>
                    </a>
                    @endif
                    
                </div>      
             @endforeach
             
            </div>  
           
        </div>
        
    </div>
</div>
    		
</div>
<!-- <div class="overlay">
    <div id="loading-img"></div>
</div> -->
@endsection

@section('scripts')

@endsection