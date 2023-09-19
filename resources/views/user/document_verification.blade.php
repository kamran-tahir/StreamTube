@extends('layouts.user.focused')

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
                        <label for="first name">First Name*</label>
                        <input type="text" required name="first_name" min="15" class="form-control" id="first_name" placeholder="First Name" value="">
                    </div>
                    <div class="form-group">
                        <label for="last name">Last Name*</label>
                        <input type="text" required name="last_name" min="15" class="form-control" id="last_name" placeholder="Last Name" value="">
                    </div>
                    <div class="form-group">
                        <label for="dob">{{tr('dob')}}*</label>
                        <input type="text" name="dob" class="form-control" placeholder="{{tr('enter_dob')}}" id="dob" required autocomplete="off" value="{{old('dob')}}">
                    </div>
                    <div class="form-group">
                        <label for="security number">Tax Payer Identification Number or Social Security Number*</label>
                        <input type="text" required name="security_num"  class="form-control" id="security_num" placeholder="Identification Number" value="">
                    </div>
                    <div class="form-group">
                        <label for="address1">Address 1*</label>
                        <input type="text" required name="address1"  class="form-control" id="address1" placeholder="Address" value="">
                    </div>
                     <div class="form-group">
                        <label for="address2">Address 2 (optional)</label>
                        <input type="text"  name="address2" class="form-control" id="address2" placeholder="Optional" value="">
                    </div>
                     <div class="form-group">
                        <label for="country">Country*</label>
                        <select required onchange="setstate(value)" class="form-control" >
                            <option value="">--Select country--</option>
                            @foreach($countries as $country)
                                <option value="{{$country->id}}-{{$country->name}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                       <!--  <input type="text" required name="country" min="6" class="form-control" id="country" placeholder="Country" value=""> -->
                       <input id="country" type="hidden" value="" name="country">
                    </div>
<script>
function setstate(country)
{

country = country.split("-");
$('#country').val(country[0]);
country = country[0]; 

    $.ajax({
    url:"{{route('country.state')}}",
    contentType: "application/x-www-form-urlencoded",    
     data: { country:country},
    type: 'GET',
    dataType:'json',
   success: function(response)
                {
                    console.log(response);
                    $('select[name="state"]').empty();
                   '<option value="">--Select State--</option>'
                    $.each(response,function(key,value){
                      $('select[name="state"]').append('<option value="'+value.id+'">'+value.name+'</option');  
                    });
                 // $("#state").html(response);
                }
            }); 
}
</script> 

                     <div class="form-group">
                        <label for="state">State or Province*</label>
                        <!-- <input type="text" required name="state" class="form-control" id="state" placeholder="State or Province" value=""> -->
                         <select class="form-control" name="state" id="state" required onchange="setcity(value)">
                       <option value="">--Select State--</option>
                       </select>
                        <input id="state" type="hidden" value="" name="state">
                    </div>
<script>
function setcity(state)
{

// country = country.split("-");
$('#state').val(state);
// country = country[0]; 

    $.ajax({
    url:"{{route('state.city')}}",
    contentType: "application/x-www-form-urlencoded",    
     data: { state:state},
    type: 'GET',
    dataType:'json',
   success: function(response)
                {
                    console.log(response);
                    $('select[name="city"]').empty();
                    $.each(response,function(key,value){
                      $('select[name="city"]').append('<option value="'+value.id+'">'+value.name+'</option');  
                    });
                 // $("#city").val(response);
                }
            }); 
}
</script> 
                    <div class="form-group">
                        <label for="state">City*</label>
                        <!-- <input type="text" required name="city" class="form-control" id="city" placeholder="City" value=""> -->
                        <select class="form-control" name="city" id="city" required >
                       <option value="">--Select City--</option>
                       </select>
                       
                    </div>
                     <div class="form-group">
                        <label for="zip">Postal or ZIP Code*</label>
                        <input type="text" required name="zip_code"  class="form-control" id="zip" placeholder="Postal or ZIP Code" value="">
                    </div>
                    <div class="form-group">
                        <label for="driving license">Driving License*</label>
                        <br>
                        <br>
                        <img src="{{asset('document.png')}}" id="driving_lisence_doc" style="height: 100px;width: 100px;object-fit: contain;">
                        <input type="file" required name="driving_lisence_doc" class="form-control" id="driving_lisence_doc" accept="image/png, image/jpeg" placeholder="" title="" value="" onchange="loadFile(this,'driving_lisence_doc')">
                    </div>
                    <div class="form-group">
                        <label for="idcard">Image of you holding your a piece of paper with your username*</label>
                        <br>
                        <br>
                        <img src="{{asset('document.png')}}" id="idcard_doc" style="height: 100px;width: 100px;object-fit: contain;">
                        <input type="file" required name="idcard_doc" class="form-control" id="idcard_doc" accept="image/png, image/jpeg" placeholder="" title="" value="" onchange="loadFile(this,'idcard_doc')">
                    </div>
                    <div class="form-group">
                        <label for="residence">Image of bill in your name that proves the address provided is real*</label>
                        <br>
                        <br>
                        <img src="{{asset('document.png')}}" id="residence_doc" style="height: 100px;width: 100px;   object-fit: contain;">
                        
                        <input type="file" required name="residence_doc" class="form-control" id="residence_doc" accept="image/png, image/jpeg" placeholder="" value="" onchange="loadFile(this,'residence_doc')"> 
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-12" style="float: left;">
                            <input type="checkbox" onchange="updateNextButtonState()" required name="verification_page_1"  class="form-control terms-checkbox" id="verification_page_1" style="width: 15px;
                            position: absolute;">
                            <label for="verification_page_1" style="margin-left: 24px; margin-top: 10px;"> {{ Setting::get('verification_page_1') }}</label>
                        </div>
                        <div class="form-group col-lg-12" style="float: left;">
                            <input type="checkbox" onchange="updateNextButtonState()" required name="verification_page_2"  class="form-control terms-checkbox" id="verification_page_2" style="width: 15px;
                            position: absolute;">
                            <label for="verification_page_2" style="margin-left: 24px; margin-top: 10px;"> {{ Setting::get('verification_page_2') }}</label>
                        </div>
                        <div class="form-group col-lg-12" style="float: left;">
                            <input type="checkbox" onchange="updateNextButtonState()" required name="verification_page_3"  class="form-control terms-checkbox" id="verification_page_3" style="width: 15px;
                            position: absolute;">
                            <label for="verification_page_3" style="margin-left: 24px; margin-top: 10px;"> {{ Setting::get('verification_page_3') }}</label>
                        </div>
                    </div>

                    <input type="hidden" name="timezone" value="" id="userTimezone">

                    <div class="change-pwd">
                        <button type="submit" class="btn btn-primary signup-submit" id="btn_submitt" disabled>{{tr('submit')}}</button>
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
    $("#terms_conditon").click(function() {
        var checked_status = this.checked;
        if (checked_status == true) {
           $("#btn_submitt").removeAttr("disabled");
        } else {
           $("#btn_submitt").attr("disabled", "disabled");
        }
    });
    $(document).ready(function() {

        var max_age_limit = "{{Setting::get('max_register_age_limit' , 18)}}";

        max_age_limit = max_age_limit ? "-"+max_age_limit+"y" : "-15y";

        $('#dob').datepicker({
            autoclose:true,
            format : 'dd-mm-yyyy',
            endDate: max_age_limit,
        });

        var dMin = new Date().getTimezoneOffset();

        var dtz = -(dMin/60);
        $("#userTimezone, #t-userTimezone,#f-userTimezone,#g-userTimezone").val(jstz.determine().name());
    });
    function loadFile(event, id){
        // alert(event.files[0]);
        var reader = new FileReader();
        reader.onload = function(){
          var output = document.getElementById(id);
          output.src = reader.result;
           //$("#imagePreview").css("background-image", "url("+this.result+")");
           // console.log(output.src);
        };
        reader.readAsDataURL(event.files[0]);
    }

</script>

<script>
    function updateNextButtonState(){
        var notChecked = 0;
        $('.terms-checkbox').each(function(){
            if( !$(this).is(':checked'))
                notChecked++;
        })

        document.getElementById('btn_submitt').disabled = (notChecked != 0)
    }
</script>


@endsection