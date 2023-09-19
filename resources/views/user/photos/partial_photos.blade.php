@foreach($photos as $user_photo)
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
            $href = route('user.photos.gallery',$user_photo->channel_id).'?photo_id='.$user_photo->id;
        }else{
            $href = route('user.photos.gallery');
        }
       }else{
            $href = route('user.photos.gallery',$user_photo->channel_id).'?photo_id='.$user_photo->id;
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
