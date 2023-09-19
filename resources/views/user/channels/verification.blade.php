@extends('layouts.user.focused')

@section('styles')

<link rel="stylesheet" href="{{asset('admin-css/plugins/datepicker/datepicker3.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<link rel="stylesheet" type="text/css" href="{{asset('assets/image-viewer/magnific-popup.css')}}">
<style type="text/css">
    .images{
        cursor: pointer;
    }
</style>
@endsection

@section('content')

<div class="login-space">
        <div class="common-form login-common">
            @include('notification.notify')
            <div class="signup-head text-center">
                <h3>Channel Verification</h3>
                <h4 class="text-primary">({{$channel->name}})</h4>

            </div><!--end  of signup-head-->

            <div class="sign-up">

                <form action="{{ $verification_record->exist ? route('user.channel.verification',$channel->id) : route('user.channel.verification.update',$channel->id)}}" method="POST" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label for="first name">First Name*</label>
                        <input type="text" required name="first_name" min="15" class="form-control" id="first_name" placeholder="First Name" value="{{old('first_name') ?? $verification_record->first_name }}">
                    </div>
                    <div class="form-group">
                        <label for="last name">Last Name*</label>
                        <input type="text" required name="last_name" min="15" class="form-control" id="last_name" placeholder="Last Name" value="{{old('last_name') ?? $verification_record->last_name }}">
                    </div>
                    <div class="form-group">
                        <label for="dob">{{tr('dob')}}*</label>
                        <input type="text" name="dob" class="form-control" placeholder="{{tr('enter_dob')}}" id="dob" required autocomplete="off" value="{{old('dob')  ?? $verification_record->dob }}">
                    </div>
                    <div class="form-group">
                        <label for="security number">Tax Payer Identification Number or Social Security Number* <i class="fa fa-lg fa-question-circle text-info tax-info" onclick="return taxInfo()" data-toggle="tooltip" title="Why we need this?" style="cursor:pointer;"></i></label>
                        <input type="text" required name="ssn"  class="form-control" id="security_num" placeholder="Identification Number" value="">
                    </div>
                    <div class="form-group">
                        <label for="address1">Address 1*</label>
                        <input type="text" required name="address1"  class="form-control" id="address1" placeholder="Address" value="{{old('address1') ?? $verification_record->address1 }}">
                    </div>
                     <div class="form-group">
                        <label for="address2">Address 2 (optional)</label>
                        <input type="text"  name="address2" class="form-control" id="address2" placeholder="Optional" value="{{old('address2') ?? $verification_record->address2 }}">
                    </div>
                     <div class="form-group">
                        <label for="country">Country*</label>
                        <select required onchange="setstate(value)" id="country_select" class="form-control" >
                            <option value="">--Select country--</option>
                            @foreach($countries as $country)
                                <option value="{{$country->id}}" {{$country->id == 231 ? 'selected':''}} >{{$country->name}}</option>

                            @endforeach
                        </select>
                       <input id="country" type="hidden" value="" name="country_id">
                    </div>

                    <div class="form-group">
                        <label for="state">State or Province*</label>
                        <!-- <input type="text" required name="state" class="form-control" id="state" placeholder="State or Province" value=""> -->
                         <select class="form-control" id="state"  name="state_id" required onchange="setcity(value)">
                       <option value="">--Select State--</option>
                       </select>
                    </div>
                    <div class="form-group">
                        <label for="state">City*</label>
                        <!-- <input type="text" required name="city" class="form-control" id="city" placeholder="City" value=""> -->
                        <select class="form-control" name="city_id" id="city" required >
                       <option value="">--Select City--</option>
                       </select>
                       
                    </div>
                     <div class="form-group">
                        <label for="zip">Postal or ZIP Code*</label>
                        <input type="text" required name="zip_code"  class="form-control" id="zip" placeholder="Postal or ZIP Code" value="{{old('zip_code')  ?? $verification_record->zip_code }}">
                    </div>
                    @if(Setting::get('documentupload_channel_verification_setting_1_status') == 1)
                    <div class="form-group">
                        <label for="driving license">{{Setting::get('documentupload_channel_verification_setting_1')}}* </label>
                        <br>
                        <br>
                        <img src="{{ $verification_record->idFrontImage->url ?? asset('document.png')}}" id="state_issued_id_front" style="height: 150px;width: 150px;object-fit: contain;" class="images">
                        <input type="file" "{{$verification_record->idFrontImage ? 'required':''}}" name="state_issued_id_front" class="form-control" accept="image/png, image/jpeg" placeholder="" value="" onchange="loadFile(this,'state_issued_id_front')">
                    </div>
                    @endif
                    
                    @if(Setting::get('documentupload_channel_verification_setting_2_status') == 1)
                    
                    <div class="form-group">
                        <label for="driving license">{{Setting::get('documentupload_channel_verification_setting_2')}}* </label>
                        <br>
                        <br>
                        <img src="{{$verification_record->idBackImage->url ?? asset('document.png')}}" id="state_issued_id_back" style="height: 150px;width: 150px;object-fit: contain;" class="images">
                        <input type="file" "{{$verification_record->idBackImage ? 'required':''}}" name="state_issued_id_back" class="form-control" accept="image/png, image/jpeg" placeholder="" title="" value="" onchange="loadFile(this,'state_issued_id_back')">
                    </div>
                    @endif
                    
                    @if(Setting::get('documentupload_channel_verification_setting_3_status') == 1)
                    
                    <div class="form-group">
                        <label for="idcard">{{Setting::get('documentupload_channel_verification_setting_3')}}*</label>
                        <br>
                        <br>
                        <img src="{{$verification_record->selfImage->url ?? asset('document.png')}}" id="image_doc" style="height: 150px;width: 150px;object-fit: contain;" class="images">
                        <input type="file" "{{$verification_record->selfImage ? 'required':''}}" name="image_doc" class="form-control" id="image_doc" accept="image/png, image/jpeg" placeholder="" title="" value="" onchange="loadFile(this,'image_doc')">
                    </div>
                    @endif
                    
                    <div class="row">
                        @foreach($channel_verification_settings as $channel_verification_setting)
                        @if($channel_verification_setting->value != '')
                            <div class="form-group col-lg-12" style="float: left;">
                                <input type="checkbox" onchange="updateNextButtonState()" required name="terms_and_conditions[]" value="{{$channel_verification_setting->value}}"  class="form-control terms-checkbox" id="{{$channel_verification_setting->key}}" style="width: 15px;
                                position: absolute;">
                                <label for="{{$channel_verification_setting->key}}" style="margin-left: 24px; margin-top: 10px;"> {{$channel_verification_setting->value}} </label>
                            </div>
                        @endif
                        @endforeach
                    </div>
                    
                    <input type="hidden" name="timezone" value="" id="userTimezone">

                    <div class="change-pwd">
                        <button type="submit" class="btn btn-primary " id="btn_submitt" disabled>{{tr('submit')}}</button>
                    </div>       
                </form>
            </div><!--end of sign-up-->
        </div><!--end of common-form-->     
    </div><!--form-background end-->

@endsection


@section('scripts')
<script src="{{asset('assets/image-viewer/jquery.magnific-popup.min.js')}}"></script>

<script>
function setstate(country)
{
    $('#country').val(country);
    $.ajax({
    url:"{{route('country.state')}}",
    contentType: "application/x-www-form-urlencoded",    
     data: { country:country},
    type: 'GET',
    dataType:'json',
   success: function(response)
                {
                    console.log(response);
                    $('select[id="state"]').empty();
                   '<option value="">--Select State--</option>'
                    $.each(response,function(key,value){
                      $('select[id="state"]').append('<option value="'+value.id+'">'+value.name+'</option');  
                    });
                 // $("#state").html(response);
                }
            }); 
}
</script> 

<script>
function setcity(state)
{
   $('#state').val(state);
    $.ajax({
    url:"{{route('state.city')}}",
    contentType: "application/x-www-form-urlencoded",    
     data: { state:state},
    type: 'GET',
    dataType:'json',
   success: function(response)
                {
                    $('select[id="city"]').empty();
                    $.each(response,function(key,value){
                      $('select[id="city"]').append('<option value="'+value.id+'">'+value.name+'</option');  
                    });
                 // $("#city").val(response);
                }
            }); 
}
</script> 

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

        var country_id = "{{old('country_id') ?? $verification_record->country_id ?? ''}}";
        var state_id = "{{old('state_id') ?? $verification_record->state_id ?? ''}}";
        var city_id = "{{old('city_id') ?? $verification_record->city_id ?? ''}}";
        if(country_id != ''){
            $("#country_select").val(country_id);
            setstate(country_id);
            
            if(state_id != ''){
                $("#state").val(state_id);
                setcity(state_id);
                if(city_id != ''){
                
                    $("#city").val(city_id);
                }
            }
        }else{
            $("#country_select").val(231); 
            setstate(231);
            setcity(3919);
        }

        var max_age_limit = "{{Setting::get('max_register_age_limit' , 18)}}";

        max_age_limit = max_age_limit ? "-"+max_age_limit+"y" : "-15y";

        $('#dob').datepicker({
            autoclose:true,
            format : 'yyyy-dd-mm',
            endDate: max_age_limit,
        });

        var dMin = new Date().getTimezoneOffset();

        var dtz = -(dMin/60);
        $("#userTimezone, #t-userTimezone,#f-userTimezone,#g-userTimezone").val(jstz.determine().name());

        $('.images').click(function(){
                url = $(this).attr('src');
                $.magnificPopup.open({
                  items: {
                    src: url,
                  },
                  type: 'image'
                });

            }); 
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script>
    function updateNextButtonState(){
        var notChecked = 0;
        $('.terms-checkbox').each(function(){
            if( !$(this).is(':checked'))
                notChecked++;
        })

        document.getElementById('btn_submitt').disabled = (notChecked != 0)
    }

    function taxInfo(){
    	$.alert({
    		theme: 'material',
		    title: 'Why we need this?',
		    type: 'blue',
		    content: "Any money you make has to be reported and where applicable we have to withhold your sales tax per marketplace facilitator laws and mail it in for you. This number tells the tax services what specific person this income belongs to and tells your state you already paid your sales taxes so ideally you will have no issues when it comes to to file your taxes. Basically without this information we can't pay you",
		});
    }
</script>


@endsection