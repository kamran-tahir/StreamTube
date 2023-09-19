<!-- @extends('layouts.user.focused') -->
<!-- @extends('layouts.user') -->

@section('styles')

<link rel="stylesheet" href="{{asset('admin-css/plugins/datepicker/datepicker3.css')}}">

@endsection

@section('content')

<div class="login-space">
        <div class="common-form login-common">

            @include('notification.notify')
        
            <div class="signup-head text-center">
                <h3>Document Verification</h3>
            </div><!--end  of signup-head-->

            @if((config('services.facebook.client_id') && config('services.facebook.client_secret'))
            || (config('services.twitter.client_id') && config('services.twitter.client_secret'))
            || (config('services.google.client_id') && config('services.google.client_secret')))
            
            <div class="social-form">
                
                <div class="social-btn">

                    @if(config('services.facebook.client_id') && config('services.facebook.client_secret'))
                        
                        <div class="social-fb">
                            
                            <form class="social-form form-horizontal" role="form" method="POST" action="{{ route('SocialLogin') }}">
                                
                                <input type="hidden" value="facebook" name="provider" id="provider">

                                <input type="hidden" name="timezone" value="" id="f-userTimezone">

                                <input type="hidden" value="{{ app('request')->input('referral') }}" name="referral" id="referral">

                                <a href="#">
                                    <button type="submit">
                                        <i class="fa fa-facebook"></i>{{tr('login_via_fb')}}
                                    </button>
                                </a>
                        
                            </form>
                        
                        </div>
                    
                    @endif

                    @if(config('services.twitter.client_id') && config('services.twitter.client_secret'))

                        <div class="social-twitter">
                          
                            <form class="social-form form-horizontal" role="form" method="POST" action="{{ route('SocialLogin') }}">
                                
                                <input type="hidden" value="twitter" name="provider" id="provider">

                                <input type="hidden" name="timezone" value="" id="t-userTimezone">

                                <input type="hidden" value="{{ app('request')->input('referral') }}" name="referral" id="referral">

                                <a href="#">
                                    <button type="submit">
                                        <i class="fa fa-twitter"></i>{{tr('login_via_twitter')}}
                                    </button>
                                </a>
                            
                            </form>
                        
                        </div>

                    @endif

                    @if(config('services.google.client_id') && config('services.google.client_secret'))

                        <div class="social-google">
                            <form class="social-form form-horizontal" role="form" method="POST" action="{{ route('SocialLogin') }}">
                                <input type="hidden" value="google" name="provider" id="provider">
                                <input type="hidden" name="timezone" value="" id="g-userTimezone">

                                <a href="#">
                                    <button type="submit">
                                        <i class="fa fa-google-plus"></i>{{tr('login_via_google')}}
                                    </button>
                                </a>
                            </form>
                        </div>
                        
                    @endif

                </div><!--end of social-btn-->          
            </div><!--end of socila-form-->

            <p class="col-xs-12 divider1">OR</p>

            @endif

            <div class="sign-up">

                <form  action="{{ route('document.save') }}" method="POST" enctype="multipart/form-data">

                    {!! csrf_field() !!}
                    
                    <div class="form-group">
                        <label for="idcard">ID Card*</label>
                        <img src="" id="id_card">
                        <input type="file" required name="id_card" class="form-control" id="id_card" aria-describedby="emailHelp" placeholder="" title="" value="" onchange="loadFile(this,'id_card')">
                    </div>
                    <div class="form-group">
                        <label for="residence">Residence Document*</label>
                        <img src="" id="residence">
                        
                        <input type="file" required name="residence" class="form-control" id="residence" aria-describedby="emailHelp" placeholder="" value="" onchange="loadFile(this,'residence')"> 
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone *</label>
                        <input type="text" name="phone" class="form-control" placeholder="Phone Number" id="dob" required value="">
                    </div>

                    <div class="form-group">
                        <label for="address">Address*</label>
                        <input type="text" required name="address" min="6" class="form-control" id="address" placeholder="Address" value="">
                    </div>

                   <!--  <div class="form-group">
                        <label for="confirm_password">{{tr('confirm_password')}}*</label>
                        <input type="password" required name="password_confirmation" min="6" class="form-control" id="confirm_password" placeholder="{{tr('confirm_password')}}" value="{{old('confirm_password')}}">
                    </div> -->

                    <input type="hidden" name="timezone" value="" id="userTimezone">

                    <div class="change-pwd">
                        <button type="submit" class="btn btn-primary signup-submit">{{tr('submit')}}</button>
                    </div>  
                   <!--  <p class="text-right">{{tr('already_account')}} <a href="{{route('user.login.form')}}">{{tr('login')}}</a></p> -->         
                </form>
            </div><!--end of sign-up-->
        </div><!--end of common-form-->     
    </div><!--form-background end-->

@endsection


@section('scripts')

<script src="{{asset('assets/js/jstz.min.js')}}"></script>

<script src="{{asset('admin-css/plugins/datepicker/bootstrap-datepicker.js')}}"></script> 

<script type="text/javascript">

    // $(document).ready(function() {

    //     var max_age_limit = "{{Setting::get('max_register_age_limit' , 18)}}";

    //     max_age_limit = max_age_limit ? "-"+max_age_limit+"y" : "-15y";

    //     $('#dob').datepicker({
    //         autoclose:true,
    //         format : 'dd-mm-yyyy',
    //         endDate: max_age_limit,
    //     });

    //     var dMin = new Date().getTimezoneOffset();

    //     var dtz = -(dMin/60);
    //     $("#userTimezone, #t-userTimezone,#f-userTimezone,#g-userTimezone").val(jstz.determine().name());
    // });
    function loadFile(event, id){
        // alert(event.files[0]);
        var reader = new FileReader();
        reader.onload = function(){
          var output = document.getElementById(id);
          output.src = reader.result;
           //$("#imagePreview").css("background-image", "url("+this.result+")");
        };
        reader.readAsDataURL(event.files[0]);
    }

</script>

@endsection