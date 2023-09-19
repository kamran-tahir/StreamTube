@foreach($users as $user)
                                
<div class="new-profile-sec">
    <div class="display-inline">
        <div class="new-profile-left">
            @if($user->picture)
                <img src="{{Auth::user()->picture}}">
            @else
                <img src="{{asset('placeholder.png')}}">
            @endif     
        </div>
        <div class="new-profile-right">
            <div class="profile-title">
                <h4><i class="fa fa-user"></i>{{$user->name}}</h4>
                
                @if($user->login_by == 'manual')
                    <h4><i class="fa fa-envelope"></i>{{$user->email}}</h4>
                @endif
               
                <h4><i class="fa fa-phone"></i>{{$user->mobile}}</h4>  

                <h4><i class="fa fa-calendar"></i>
                @php 

                if (!empty($user->dob) && $user->dob != "0000-00-00") {

                    $dob = date('d-m-Y', strtotime($user->dob));

                } else {

                    $divob = "00-00-0000";
                }

                @endphp

                {{$dob}}

                </h4>
                
            </div>
        </div>
    </div>
</div>
<br>
@endforeach
                                