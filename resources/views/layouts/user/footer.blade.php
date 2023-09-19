<div class="bottom-height"></div>
<footer class="footer">
    <div class="footer1 row">
        <div class="col-sm-3 col-md-3 col-lg-3">
            <div class="tube-image text-center">
                @if(Setting::get('site_logo'))
                    <img src="{{Setting::get('site_logo')}}">
                @else
                    <img src="{{asset('logo.png')}}">
                @endif
            </div>                                 
        </div><!--end of col-sm-2-->

        <div class="col-sm-9 col-md-9 col-lg-9 foot-content">

            <ul class="term">
                @if (Auth::check())
                @if(empty(Auth::user()->idcard_doc && Auth::user()->residence_doc))
                <li style="float: left;">
                    <a href="{{route('ducoment.verify')}}" style="color: red;">Click here to become verified!</a>
                </li>
                @endif
                @endif

                <?php $pages = pages();?>
                @if (count($pages) > 0)
                    @foreach($pages as $page) 
                    @if($page->status==1)
                        <li><a  href="{{route('page_view', $page->id)}}" style="text-transform: capitalize;">{{$page->title}}</a></li> | 
                    @endif    
                    @endforeach
                @endif
                <li>
                    <a href="{{route('ad.submit')}}">Submit Ads</a>
                </li> |
                <li><a href="{{url('/')}}" >&#169; {{date('Y')}} @if(Setting::get('site_name')) {{Setting::get('site_name') }} @else {{tr('site_name')}} @endif</a></li>
               
               
            </ul>
        </div>   
    </div><!--end of footer1-->
</footer>
