@extends('layouts.admin')

@section('title',tr('settings'))

@section('content-header')

{{ tr('settings') }}


<a href="#" id="help-popover" class="btn btn-danger" style="font-size: 14px;font-weight: 600" title="{{ tr('any_help') }}">{{ tr('help') }}</a>

<div id="help-content" style="display: none">

    <ul class="popover-list">

        <li><b>{{ tr('paypal') }}-</b>{{ tr('minimum_amount') }}</li>

        <li><b>{{ tr('stripe') }}-</b>{{ tr('minimum_accepted') }}<a target="_blank" href="https://stripe.com/docs/currencies">{{ tr('check_refrences') }}</a></li>

        <li><b><span class="text-uppercase">{{ tr('other_settings') }}</span> - {{ tr('multi_channel_status') }} - </b> <span style="color: green">{{ tr('checked') }}</span>{{ tr('user_create_n_channels') }}</li>

        <li><b><span class="text-uppercase">{{ tr('other_settings') }} </span>- {{ tr('multi_channel_status') }} - </b> <span style="color: red">{{ tr('un_checked') }}</span>{{ tr('user_create_only_one_channel') }}<span style="color: #a735a7">{{ tr('note') }} : {{ tr('Previously_note_channel') }}</span></li>

    </ul>
    
</div>

@endsection

@section('styles')

<style>
    
/*  streamview tab */
div.streamview-tab-container{
  z-index: 10;
  background-color: #ffffff;
  padding: 0 !important;
  border-radius: 4px;
  -moz-border-radius: 4px;
  border:1px solid #ddd;
  margin-top: 20px;
  margin-left: 50px;
  -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
  box-shadow: 0 6px 12px rgba(0,0,0,.175);
  -moz-box-shadow: 0 6px 12px rgba(0,0,0,.175);
  background-clip: padding-box;
  opacity: 0.97;
  filter: alpha(opacity=97);
}
div.streamview-tab-menu{
  padding-right: 0;
  padding-left: 0;
  padding-bottom: 0;
}
div.streamview-tab-menu div.list-group{
  margin-bottom: 0;
}
div.streamview-tab-menu div.list-group>a{
  margin-bottom: 0;
}
div.streamview-tab-menu div.list-group>a .glyphicon,
div.streamview-tab-menu div.list-group>a .fa {
  color: #1e5780;
}
div.streamview-tab-menu div.list-group>a:first-child{
  border-top-right-radius: 0;
  -moz-border-top-right-radius: 0;
}
div.streamview-tab-menu div.list-group>a:last-child{
  border-bottom-right-radius: 0;
  -moz-border-bottom-right-radius: 0;
}
div.streamview-tab-menu div.list-group>a.active,
div.streamview-tab-menu div.list-group>a.active .glyphicon,
div.streamview-tab-menu div.list-group>a.active .fa{
  background-color: #1e5780;
  background-image: #1e5780;
  color: #ffffff;
}
div.streamview-tab-menu div.list-group>a.active:after{
  content: '';
  position: absolute;
  left: 100%;
  top: 50%;
  margin-top: -13px;
  border-left: 0;
  border-bottom: 13px solid transparent;
  border-top: 13px solid transparent;
  border-left: 10px solid #1e5780;
}

div.streamview-tab-content{
  background-color: #ffffff;
  /* border: 1px solid #eeeeee; */
  padding-left: 20px;
  padding-top: 10px;
}

.box-body {
    padding: 0px;
}

div.streamview-tab div.streamview-tab-content:not(.active){
  display: none;
}

.sub-title {
    width: fit-content;
    color: #2c648c;
    font-size: 18px;
    /*border-bottom: 2px dashed #285a86;*/
    padding-bottom: 5px;
}

hr {
    margin-top: 15px;
    margin-bottom: 15px;
}
</style>
@endsection

@section('breadcrumb')
     
    <li class="active"><i class="fa fa-gears"></i> {{ tr('settings') }}</li>
@endsection

@section('content')

<div class="row">

    <div class="col-md-12">

        @include('notification.notify')

    </div>

    <div class="col-lg-11 col-md-11 col-sm-11 col-xs-11 streamview-tab-container">

        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 streamview-tab-menu">
            
            <div class="list-group">
                <a href="#" class="list-group-item active text-left">{{ tr('site_settings') }}</a>
              
                <a href="#" class="list-group-item text-left">{{ tr('video_settings') }}</a>

                <a href="#" class="list-group-item text-left">{{ tr('revenue_settings') }}</a>
                
                <a href="#" class="list-group-item text-left">{{ tr('social_settings') }}</a>
                
                <a href="#" class="list-group-item text-left">{{ tr('payment_settings') }}</a>

                <a href="#" class="list-group-item text-left">{{ tr('email_settings') }}</a>

                <a href="#" class="list-group-item text-left">{{ tr('mobile_settings') }}</a>

                <a href="#" class="list-group-item text-left">
                    {{ tr('notification_settings') }}
                </a>

                <a href="#" class="list-group-item text-left">{{ tr('company_site_settings') }}</a>

                <a href="#" class="list-group-item text-left">{{ tr('seo_settings')  }}</a>

                <a href="#" class="list-group-item text-left">{{ tr('other_settings') }}</a>

                <a href="#" class="list-group-item text-left">{{ tr('tax_setting') }}</a>

            </div>

        </div>

        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-10 streamview-tab">
            
            <!-- Site section -->
            
            <div class="streamview-tab-content active">

                <form action="{{ (Setting::get('admin_delete_control') == YES ) ? '#' : route('admin.settings.save') }}" method="POST" enctype="multipart/form-data" role="form">

                    <div class="box-body">

                        <div class="row">

                            <div class="col-md-12">

                                <h3 class="settings-sub-header text-uppercase"><b>{{ tr('site_settings') }}</b></h3>

                                <hr>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    
                                    <label for="sitename">{{ tr('site_name') }}</label>

                                    <input type="text" class="form-control" name="site_name" value="{{old('sitename') ?:  Setting::get('site_name')}}" id="sitename" placeholder="{{ tr('enter_site_name') }}">

                                </div>

                                <div class="form-group">
                                   
                                    <label for="site_logo">{{ tr('site_logo') }}</label>

                                    <br>

                                    @if(Setting::get('site_logo'))
                                        <img style="height: 50px; width:75px;margin-bottom: 15px; border-radius:2em;" src="{{ Setting::get('site_logo') }}">
                                    @endif

                                    <input type="file" id="site_logo" name="site_logo" accept="image/png, image/jpeg">
                                    <p class="help-block">{{ tr('image_notes') }}</p>
                                </div>

                            </div>

                            <div class="col-lg-6">

                                <div class="form-group">

                                    @if(Setting::get('site_icon'))
                                            <img style="height: 50px; width:75px; margin-bottom: 15px; border-radius:2em;" src="{{ Setting::get('site_icon') }}">
                                    @endif
                                        <label for="site_icon">{{ tr('site_icon') }}</label>
                                        <input type="file" id="site_icon" name="site_icon" accept="image/png, image/jpeg">
                                        <p class="help-block">{{ tr('image_notes') }}</p>
                                </div> 

                            </div>

                        </div>

                    </div>

                    <!-- /.box-body -->

                    <div class="box-footer">

                        <button type="reset" class="btn btn-warning">{{ tr('reset') }}</button>

                        <button type="submit" class="btn btn-primary pull-right"  @if(Setting::get('admin_delete_control') == YES )  disabled @endif >{{ tr('submit') }}</button>

                    </div>
                
                </form>

            </div>

            <!-- Video section -->
            <div class="streamview-tab-content">
                
                <form action="{{ (Setting::get('admin_delete_control') == YES ) ? '#' : route('admin.settings.save') }}" method="POST" enctype="multipart/form-data" role="form">

                    <div class="box-body">

                        <div class="row">

                            <div class="col-md-12">

                                <h3 class="settings-sub-header text-uppercase"><b>{{ tr('video_settings') }}</b></h3>

                                <hr>

                            </div>

                            <div class="col-md-12">

                                <h5 class="sub-title" >{{ tr('player_configuration') }}</h5>

                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">

                                    <label for="JWPLAYER_KEY">{{ tr('jwplayer_key') }}</label>

                                    <input type="text" value="{{  Setting::get('JWPLAYER_KEY') }}" class="form-control" name="JWPLAYER_KEY" id="JWPLAYER_KEY" placeholder="{{ tr('jwplayer_key') }}">
                                </div> 
                            </div>

                            <div class="col-md-12">

                                <h5 class="sub-title" >{{ tr('streaming_configuration') }}</h5>

                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">

                                    <label for="streaming_url">{{ tr('streaming_url') }}</label>

                                    <br>

                                    <p class="example-note">{{ tr('rtmp_settings_note') }}</p>

                                     <input type="text" value="{{  Setting::get('streaming_url') }}" class="form-control" name="streaming_url" id="streaming_url" placeholder="{{ tr('enter_streaming_url') }}">
                                </div> 
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="HLS_STREAMING_URL">{{ tr('HLS_STREAMING_URL') }}</label>
                                    
                                    <br>

                                    <p class="example-note">{{ tr('hls_settings_note') }}</p>

                                    <input type="text" value="{{  Setting::get('HLS_STREAMING_URL') }}" class="form-control" name="HLS_STREAMING_URL" id="HLS_STREAMING_URL" placeholder="Enter Streaming URL">
                                </div> 
                            </div>
                        </div>

                    </div>

                    <div class="box-footer">

                        <button type="reset" class="btn btn-warning">{{ tr('reset') }}</button>

                        <button type="submit" class="btn btn-primary pull-right"  @if(Setting::get('admin_delete_control') == YES )  disabled @endif >{{ tr('submit') }}</button>

                    </div>
                
                </form>

            </div>

            <!-- Revenue settings -->

            <div class="streamview-tab-content">

                <form action="{{  (Setting::get('admin_delete_control') == YES ) ? '#' : route('admin.settings.save') }}" method="POST" enctype="multipart/form-data" role="form">
                    
                    <div class="box-body">

                        <div class="row">

                            <div class="col-md-12">

                                <h3 class="settings-sub-header text-uppercase"><b>{{ tr('revenue_settings') }}</b></h3>

                                <hr>

                            </div>
                            <div class="col-md-12">
                                <div class="form-group">

                                    <label for="video_viewer_count">{{ tr('video_viewer_count_size_label') }}</label>

                                    <br>

                                    <p class="example-note">{{ tr('video_viewer_count_size_label_note') }}</p>

                                    <input type="text" class="form-control" name="viewers_count_per_video" value="{{ Setting::get('viewers_count_per_video')   }}" id="viewers_count_per_video" placeholder="{{ tr('video_viewer_count_size_label') }}" pattern="[0-9]{0,}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="upload_max_size">{{ tr('amount_per_video') }}</label>
                                    
                                    <br>
                                    
                                    <p class="example-note">{{ tr('amount_per_video_note') }}</p>

                                    <input type="text" class="form-control" name="amount_per_video" value="{{ Setting::get('amount_per_video')   }}" min="0.5" id="amount_per_video" pattern="[0-9]{0,}" placeholder="{{ tr('amount_per_video') }}">

                                </div>
                            </div>

                             <div class="col-md-6">
                                <div class="form-group">

                                    <label for="admin_ppv_commission">{{ tr('admin_ppv_commission') }}</label>

                                    <input type="text" class="form-control" name="admin_ppv_commission" pattern="[0-9]{0,}" value="{{ Setting::get('admin_ppv_commission')   }}" id="admin_ppv_commission" placeholder="{{ tr('admin_ppv_commission') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user_ppv_commission">{{ tr('user_ppv_commission') }}</label>
                                    <input type="text" class="form-control" name="" disabled value="{{ Setting::get('user_ppv_commission')   }}" id="user_ppv_commission" placeholder="{{ tr('user_ppv_commission') }}">
                                </div>
                            </div> 

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="referral_commission">{{ tr('referral_commission') }}</label>
                                    <input type="number" class="form-control" name="referral_commission" value="{{ Setting::get('referral_commission') }}" id="referral_commission" placeholder="{{ tr('referral_commission') }}"  min="0">
                                </div>
                            </div>
                            <div class="clearfix"></div>

                        </div>
                        
                    </div>

                    <div class="box-footer">

                        <button type="reset" class="btn btn-warning">{{ tr('reset') }}</button>

                        <button type="submit" class="btn btn-primary pull-right"  @if(Setting::get('admin_delete_control') == YES )  disabled @endif >{{ tr('submit') }}</button>

                    </div>

                </form>
            
            </div>


            <!-- Social settings -->

            <div class="streamview-tab-content">
                
                <form action="{{  (Setting::get('admin_delete_control') == YES ) ? '#' : route('admin.common-settings.save') }}" method="POST" enctype="multipart/form-data" role="form">
                    <div class="box-body">

                        <div class="row">

                            <div class="col-md-12">

                                <h3 class="settings-sub-header text-uppercase"><b>{{ tr('social_settings') }}</b></h3>

                                <hr>

                            </div>

                            <div class="col-md-12">

                                <h5 class="sub-title" >{{ tr('fb_settings') }}</h5>

                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="fb_client_id">{{ tr('FB_CLIENT_ID') }}</label>
                                     <input type="text" class="form-control" name="FB_CLIENT_ID" id="fb_client_id" placeholder="{{ tr('FB_CLIENT_ID') }}" value="{{ $result['FB_CLIENT_ID'] }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="fb_client_secret">{{ tr('FB_CLIENT_SECRET') }}</label>    
                                    <input type="text" class="form-control" name="FB_CLIENT_SECRET" id="fb_client_secret" placeholder="{{ tr('FB_CLIENT_SECRET') }}" value="{{ $result['FB_CLIENT_SECRET'] }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="fb_call_back">{{ tr('FB_CALL_BACK') }}</label>    
                                    <input type="text" class="form-control" name="FB_CALL_BACK" id="fb_call_back" placeholder="{{ tr('FB_CALL_BACK') }}" value="{{ $result['FB_CALL_BACK'] }}">
                                </div>
                            </div>
                            <div class="clearfix"></div>

                            <div class="col-md-12">

                                <h5 class="sub-title" >{{ tr('twitter_settings') }}</h5>

                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="twitter_client_id">{{ tr('TWITTER_CLIENT_ID') }}</label>
                                    <input type="text" class="form-control" name="TWITTER_CLIENT_ID" id="twitter_client_id" placeholder="{{ tr('TWITTER_CLIENT_ID') }}" value="{{ $result['TWITTER_CLIENT_ID'] }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="twitter_client_secret">{{ tr('TWITTER_CLIENT_SECRET') }}</label>    
                                    <input type="text" class="form-control" name="TWITTER_CLIENT_SECRET" id="twitter_client_secret" placeholder="{{ tr('TWITTER_CLIENT_SECRET') }}" value="{{ $result['TWITTER_CLIENT_SECRET'] }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="twitter_call_back">{{ tr('TWITTER_CALL_BACK') }}</label>    
                                    <input type="text" class="form-control" name="TWITTER_CALL_BACK" id="twitter_call_back" placeholder="{{ tr('TWITTER_CALL_BACK') }}" value="{{ $result['TWITTER_CALL_BACK'] }}">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-12">

                                <h5 class="sub-title" >{{ tr('google_settings') }}</h5>

                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="google_client_id">{{ tr('GOOGLE_CLIENT_ID') }}</label>
                                    <input type="text" class="form-control" name="GOOGLE_CLIENT_ID" id="google_client_id" placeholder="{{ tr('GOOGLE_CLIENT_ID') }}" value="{{ $result['GOOGLE_CLIENT_ID'] }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="google_client_secret">{{ tr('GOOGLE_CLIENT_SECRET') }}</label>    
                                    <input type="text" class="form-control" name="GOOGLE_CLIENT_SECRET" id="google_client_secret" placeholder="{{ tr('GOOGLE_CLIENT_SECRET') }}" value="{{ $result['GOOGLE_CLIENT_SECRET'] }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="google_call_back">{{ tr('GOOGLE_CALL_BACK') }}</label>    
                                    <input type="text" class="form-control" name="GOOGLE_CALL_BACK" id="google_call_back" placeholder="{{ tr('GOOGLE_CALL_BACK') }}" value="{{ $result['GOOGLE_CALL_BACK'] }}">
                                </div>
                            </div>
                            <div class='clearfix'></div>

                        </div>
                    
                    </div>
                   
                    <div class="box-footer">

                        <button type="reset" class="btn btn-warning">{{ tr('reset') }}</button>

                        <button type="submit" class="btn btn-primary pull-right"  @if(Setting::get('admin_delete_control') == YES ) disabled @endif >{{ tr('submit') }}</button>

                    </div>

                </form>
            </div>

            <!-- Payment settings -->

            <div class="streamview-tab-content">
                
                <form action="{{  (Setting::get('admin_delete_control') == YES ) ? '#' : route('admin.common-settings.save') }}" method="POST" enctype="multipart/form-data" role="form">
                   
                    <div class="box-body">

                        <div class="row">

                            <div class="col-md-12">

                                <h3 class="settings-sub-header text-uppercase"><b>{{ tr('payment_settings') }}</b></h3>

                                <hr>

                            </div>

                            <div class="col-md-12">

                                <h5 class="sub-title" >{{ tr('paypal_settings') }}</h5>

                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="paypal_id">{{ tr('PAYPAL_ID') }}</label>
                                    <input type="text" class="form-control" name="PAYPAL_ID" id="paypal_id" placeholder="{{ tr('PAYPAL_ID') }}" value="{{ $result['PAYPAL_ID'] }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="paypal_secret">{{ tr('PAYPAL_SECRET') }}</label>    
                                    <input type="text" class="form-control" name="PAYPAL_SECRET" id="paypal_secret" placeholder="{{ tr('PAYPAL_SECRET') }}" value="{{ $result['PAYPAL_SECRET'] }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="paypal_mode">{{ tr('PAYPAL_MODE') }}</label>    
                                    <input type="text" class="form-control" name="PAYPAL_MODE" id="paypal_mode" placeholder="{{ tr('PAYPAL_MODE') }}" value="{{ $result['PAYPAL_MODE'] }}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="redeem_paypal_url">{{tr('PAYPAL_URL')}}</label>    
                                    <input type="text" class="form-control" name="PAYPAL_URL" id="redeem_paypal_url" placeholder="{{tr('PAYPAL_URL')}}" value="{{ Setting::get('redeem_paypal_url')}}">
                                </div>
                            </div>
                            
                            <div class="clearfix"></div>

                            <div class="col-md-12">

                                <h5 class="sub-title" >{{ tr('stripe_settings') }}</h5>

                            </div>

                             <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="stripe_publishable_key">{{ tr('stripe_publishable_key') }}</label>
                                    <input type="text" class="form-control" name="stripe_publishable_key" id="stripe_publishable_key" placeholder="{{ tr('stripe_publishable_key') }}" value="{{ Setting::get('stripe_publishable_key') }}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="stripe_secret_key">{{ tr('stripe_secret_key') }}</label>
                                    <input type="text" class="form-control" name="stripe_secret_key" id="stripe_secret_key" placeholder="{{ tr('stripe_secret_key') }}" value="{{ Setting::get('stripe_secret_key') }}">
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="box-footer">

                       <button type="reset" class="btn btn-warning">{{ tr('reset') }}</button>

                        <button type="submit" class="btn btn-primary pull-right"  @if(Setting::get('admin_delete_control') == YES )  disabled @endif >{{ tr('submit') }}</button>

                    </div>

                </form>
            
            </div>

            <!-- Email settings -->

            <div class="streamview-tab-content">
                
                <form action="{{ route('admin.email.settings.save') }}" method="POST" enctype="multipart/form-data" role="form">
                            
                    <div class="box-body">

                        <div class="row">

                            <div class="col-md-12">

                                <h3 class="settings-sub-header text-uppercase"><b>{{ tr('email_settings') }}</b></h3>

                                <hr>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="MAIL_DRIVER">{{ tr('MAIL_DRIVER') }}</label>
                                    <input type="text" value="{{  $result['MAIL_DRIVER'] }}" class="form-control" name="MAIL_DRIVER" id="MAIL_DRIVER" placeholder="Enter {{ tr('MAIL_DRIVER') }}">
                                </div>

                                <div class="form-group">
                                    <label for="MAIL_HOST">{{ tr('MAIL_HOST') }}</label>
                                    <input type="text" class="form-control" value="{{ $result['MAIL_HOST'] }}" name="MAIL_HOST" id="MAIL_HOST" placeholder="{{ tr('MAIL_HOST') }}">
                                </div>

                                <div class="form-group">
                                    <label for="MAIL_PORT">{{ tr('MAIL_PORT') }}</label>
                                    <input type="text" class="form-control" value="{{ $result['MAIL_PORT'] }}" name="MAIL_PORT" id="MAIL_PORT" placeholder="{{ tr('MAIL_PORT') }}">
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="MAIL_USERNAME">{{ tr('MAIL_USERNAME') }}</label>
                                    <input type="text" class="form-control" value="{{ $result['MAIL_USERNAME']  }}" name="MAIL_USERNAME" id="MAIL_USERNAME" placeholder="{{ tr('MAIL_USERNAME') }}">
                                </div>

                                <div class="form-group">
                                    <label for="MAIL_PASSWORD">{{ tr('MAIL_PASSWORD') }}</label>
                                    <input type="password" class="form-control" name="MAIL_PASSWORD" id="MAIL_PASSWORD" placeholder="{{ tr('MAIL_PASSWORD') }}" value="{{ $result['MAIL_PASSWORD'] }}">
                                </div>

                                <div class="form-group">
                                    <label for="MAIL_ENCRYPTION">{{ tr('MAIL_ENCRYPTION') }}</label>
                                    <input type="text" class="form-control" value="{{ $result['MAIL_ENCRYPTION']  }}" name="MAIL_ENCRYPTION" id="MAIL_ENCRYPTION" placeholder="{{ tr('MAIL_ENCRYPTION') }}">
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="box-footer">

                        <button type="reset" class="btn btn-warning">{{ tr('reset') }}</button>

                        <button type="submit" class="btn btn-primary pull-right"  @if(Setting::get('admin_delete_control') == YES )  disabled @endif >{{ tr('submit') }}</button>

                    </div>

                </form>
            </div>

            <!-- Mobile Settings  -->

            <div class="streamview-tab-content">
               
                <form action="{{  (Setting::get('admin_delete_control') == YES ) ? '#' : route('admin.settings.save') }}" method="POST" enctype="multipart/form-data" role="form">
                    
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                            <h3 class="settings-sub-header text-uppercase"><b>{{ tr('mobile_settings') }}</b></h3>
                                <hr>

                                <div class="col-md-12">

                                    <h5 class="sub-title" >{{ tr('app_url_settings') }}</h5>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">

                                        <label for="upload_max_size">{{ tr('appstore') }}</label>

                                        <input type="url" class="form-control" name="appstore" id="appstore"
                                        value="{{ Setting::get('appstore') }}" placeholder="{{ tr('appstore') }}">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="upload_max_size">{{ tr('playstore') }}</label>

                                        <input type="url" class="form-control" name="playstore" value="{{ Setting::get('playstore')   }}" id="playstore" placeholder="{{ tr('playstore') }}">

                                    </div>
                                </div>
                            </div>
                    
                        </div>
                    
                    </div>
                    
                    <div class="box-footer">

                        <button type="reset" class="btn btn-warning">{{ tr('reset') }}</button>

                        <button type="submit" class="btn btn-primary pull-right"  @if(Setting::get('admin_delete_control') == YES )  disabled @endif >{{ tr('submit') }}</button>

                    </div>

                </form>

            </div>

            <!-- Notification Settings  -->

            <div class="streamview-tab-content">
               
                <form action="{{  (Setting::get('admin_delete_control') == YES ) ? '#' : route('admin.settings.save') }}" method="POST" enctype="multipart/form-data" role="form">
                    
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">

                                <h3 class="settings-sub-header text-uppercase"><b>{{ tr('notification_settings') }}</b></h3>

                                <hr>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">

                                    <label for="user_fcm_sender_id">{{ tr('user_fcm_sender_id') }}</label>

                                    <input type="text" class="form-control" name="user_fcm_sender_id" id="user_fcm_sender_id"
                                    value="{{ Setting::get('user_fcm_sender_id') }}" placeholder="{{ tr('user_fcm_sender_id') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user_fcm_server_key">{{ tr('user_fcm_server_key') }}</label>

                                    <input type="text" class="form-control" name="user_fcm_server_key" value="{{ Setting::get('user_fcm_server_key')   }}" id="user_fcm_server_key" placeholder="{{ tr('user_fcm_server_key') }}">

                                </div>
                            </div>

                            <div class="clearfix"></div>
                            
                        </div>
                    
                    </div>
                    
                    <div class="box-footer">
                        
                        <button type="reset" class="btn btn-warning">{{ tr('reset') }}</button>

                        <button type="submit" class="btn btn-primary pull-right"  @if(Setting::get('admin_delete_control') == YES )  disabled @endif >{{ tr('submit') }}</button>
                    </div>

                </form>

            </div>

            <!-- Company Settings  -->

            <div class="streamview-tab-content">
               
                <form action="{{  (Setting::get('admin_delete_control') == YES ) ? '#' : route('admin.settings.save') }}" method="POST" enctype="multipart/form-data" role="form">
                    
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">

                                <h3 class="settings-sub-header text-uppercase"><b>{{ tr('company_site_settings') }}</b></h3>

                                <hr>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">

                                    <label for="facebook_link">{{ tr('facebook_link') }}</label>

                                    <input type="url" class="form-control" name="facebook_link" id="facebook_link"
                                    value="{{ Setting::get('facebook_link') }}" placeholder="{{ tr('facebook_link') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="linkedin_link">{{ tr('linkedin_link') }}</label>

                                    <input type="url" class="form-control" name="linkedin_link" value="{{ Setting::get('linkedin_link')   }}" id="linkedin_link" placeholder="{{ tr('linkedin_link') }}">

                                </div>
                            </div>

                             <div class="col-md-6">
                                <div class="form-group">

                                    <label for="twitter_link">{{ tr('twitter_link') }}</label>

                                    <input type="url" class="form-control" name="twitter_link" value="{{ Setting::get('twitter_link')   }}" id="twitter_link" placeholder="{{ tr('twitter_link') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="google_plus_link">{{ tr('google_plus_link') }}</label>
                                    <input type="url" class="form-control" name="google_plus_link" value="{{ Setting::get('google_plus_link')   }}" id="google_plus_link" placeholder="{{ tr('google_plus_link') }}">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pinterest_link">{{ tr('pinterest_link') }}</label>
                                    <input type="url" class="form-control" name="pinterest_link" value="{{ Setting::get('pinterest_link')   }}" id="pinterest_link" placeholder="{{ tr('pinterest_link') }}">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            
                        </div>
                    
                    </div>
                    
                    <div class="box-footer">
                        
                        <button type="reset" class="btn btn-warning">{{ tr('reset') }}</button>

                        <button type="submit" class="btn btn-primary pull-right"  @if(Setting::get('admin_delete_control') == YES )  disabled @endif >{{ tr('submit') }}</button>
                    </div>

                </form>

            </div>

            <!-- SEO Settings begins-->
            <div class="streamview-tab-content">

                <form action="{{  (Setting::get('admin_delete_control') == YES ) ? '#' : route('admin.settings.save') }}" method="POST" enctype="multipart/form-data" role="form">

                    <div class="box-body">

                        <div class="row">

                            <div class="col-md-12">
                                <h3 class="settings-sub-header text-uppercase"><b>{{ tr('seo_settings') }}</b></h3>
                                <hr>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>{{ tr('meta_title') }}</label>
                                     <input type="text" name="meta_title" value="{{  Setting::get('meta_title', '')   }}" required class="form-control" placeholder="{{ tr('meta_title') }}">
                                </div>                               
                            </div>

                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="meta_author">{{ tr('meta_author') }}</label>
                                    <input type="text" class="form-control" value="{{ Setting::get('meta_author') }}" name="meta_author" id="meta_author" placeholder="{{ tr('meta_author') }}">
                                </div>                             
                            </div>

                            <div class="clearfix"></div>

                            <div class="col-md-12">

                                <div class="form-group">
                                    <label for="meta_keywords">{{ tr('meta_keywords') }}</label>
                                    <textarea class="form-control" id="meta_keywords" name="meta_keywords">{{ Setting::get('meta_keywords') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="meta_description">{{ tr('meta_description') }}</label>
                                    <textarea class="form-control" id="meta_description" name="meta_description">{{ Setting::get('meta_description') }}</textarea>
                                </div>  

                            </div>

                            <div class="clearfix"></div>
                            
                        </div>
                    
                    </div>

                    <div class="box-footer">
                        <button type="reset" class="btn btn-warning">{{ tr('reset') }}</button>
                        
                        <button type="submit" class="btn btn-primary pull-right" @if(Setting::get('admin_delete_control') == YES ) disabled  @endif>{{ tr('submit') }}</button>                       
                    </div>

                </form>

            </div>
            <!-- SEO Settings ends -->


            <!-- Other Settingssssssssssss -->

            <div class="streamview-tab-content">
                <form action="{{ (Setting::get('admin_delete_control') == YES ) ? '#' : route('admin.settings.save') }}" method="POST" enctype="multipart/form-data" role="form">
                            
                    <div class="box-body"> 
                        <div class="row"> 

                            <div class="col-md-12">

                                <h3 class="settings-sub-header text-uppercase"><b>{{ tr('other_settings') }}</b></h3>

                                <hr>

                            </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="multi_channel_status">{{ tr('multi_channel_status') }}</label><br>
                                        <label>
                                          <input required type="radio" name="multi_channel_status" value="1" class="flat-red" @if(Setting::get('multi_channel_status') == 1) checked @endif>
                                          {{tr('yes')}}
                                        </label>
                                        <label>
                                            <input required type="radio" name="multi_channel_status" class="flat-red"  value="0" @if(Setting::get('multi_channel_status') == 0) checked @endif>
                                            {{tr('no')}}
                                        </label><br><br>
                                        
                                    </div>   
                                </div>

                               
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="payment_type">{{ tr('payment_type') }}</label>

                                        <?php $type = Setting::get('payment_type') ;?>
                                        <select id="payment_type" name="payment_type" class="form-control">
                        
                                            <option value="paypal" @if($type == 'paypal') selected @endif>{{ tr('paypal') }}</option>

                                            <option value="stripe" @if($type == 'stripe') selected @endif >{{ tr('stripe') }}</option>
                                            
                                        </select>
                                    </div>
                                </div>

                            <div class="col-lg-12">

                                <div class="form-group">
                                    <label for="google_analytics">{{ tr('google_analytics') }}</label>
                                    <textarea class="form-control" id="google_analytics" name="google_analytics">{{ Setting::get('google_analytics') }}</textarea>
                                </div>

                            </div> 

                            <div class="col-lg-12">

                                <div class="form-group">
                                    <label for="header_scripts">{{ tr('header_scripts') }}</label>
                                    <textarea class="form-control" id="header_scripts" name="header_scripts">{{ Setting::get('header_scripts') }}</textarea>
                                </div>

                            </div> 

                            <div class="col-lg-12">

                                <div class="form-group">
                                    <label for="body_scripts">{{ tr('body_scripts') }}</label>
                                    <textarea class="form-control" id="body_scripts" name="body_scripts">{{ Setting::get('body_scripts') }}</textarea>
                                </div>
                            </div> 
                        </div>
                    </div>
                          <!-- /.box-body -->

                    <div class="box-footer">

                        <button type="reset" class="btn btn-warning">{{ tr('reset') }}</button>

                        <button type="submit" class="btn btn-primary pull-right"  @if(Setting::get('admin_delete_control') == YES )  disabled @endif >{{ tr('submit') }}</button>

                    </div>

                </form>

            </div>

            <!-- Tax Settings -->

            <div class="streamview-tab-content">

                <form action="{{  (Setting::get('admin_delete_control') == YES ) ? '#' : route('admin.tax-settings.save') }}" method="POST" enctype="multipart/form-data" role="form">

                    <div class="box-body">

                        <div class="row">

                            <div class="col-md-12">
                                <h3 class="settings-sub-header text-uppercase"><b>{{ tr('tax_setting') }}</b></h3>
                                <hr>
                            </div>
                           
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>{{ tr('Alabama') }}</label>
                                     <input type="text" name="alabama" value="{{  $tax_rates->alabama   }}" required class="form-control" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                               
                            </div>

                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="meta_author">{{ tr('Alaska') }}</label>
                                    <input type="text" class="form-control" value="{{  $tax_rates->alaska }}" name="alaska" id="meta_author" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                             
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>{{ tr('American_Samoa') }}</label>
                                     <input type="text" name="american_samoa" value="{{   $tax_rates->american_samoa   }}" required class="form-control" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                               
                            </div>

                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="meta_author">{{ tr('Arizona') }}</label>
                                    <input type="text" class="form-control" value="{{  $tax_rates->arizona }}" name="arizona" id="meta_author" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                             
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>{{ tr('Arkansas') }}</label>
                                     <input type="text" name="arkansas" value="{{   $tax_rates->arkansas   }}" required class="form-control" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                               
                            </div>

                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="meta_author">{{ tr('California') }}</label>
                                    <input type="text" class="form-control" value="{{  $tax_rates->california }}" name="california" id="meta_author" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                             
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>{{ tr('Colorado') }}</label>
                                     <input type="text" name="colorado" value="{{   $tax_rates->colorado   }}" required class="form-control" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                               
                            </div>

                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="meta_author">{{ tr('Connecticut') }}</label>
                                    <input type="text" class="form-control" value="{{  $tax_rates->connecticut }}" name="connecticut" id="meta_author" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                             
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>{{ tr('Delaware') }}</label>
                                     <input type="text" name="delaware" value="{{   $tax_rates->delaware   }}" required class="form-control" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                               
                            </div>

                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="meta_author">{{ tr('Dist_of_Columbia') }}</label>
                                    <input type="text" class="form-control" value="{{  $tax_rates->dist_of_columbia }}" name="dist_of_columbia" id="meta_author" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                             
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>{{ tr('Florida') }}</label>
                                     <input type="text" name="florida" value="{{   $tax_rates->florida   }}" required class="form-control" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                               
                            </div>

                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="meta_author">{{ tr('Georgia') }}</label>
                                    <input type="text" class="form-control" value="{{  $tax_rates->georgia }}" name="georgia" id="meta_author" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                             
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>{{ tr('Guam') }}</label>
                                     <input type="text" name="guam" value="{{   $tax_rates->guam   }}" required class="form-control" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                               
                            </div>

                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="meta_author">{{ tr('Hawaii') }}</label>
                                    <input type="text" class="form-control" value="{{  $tax_rates->hawaii }}" name="hawaii" id="meta_author" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                             
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>{{ tr('Idaho') }}</label>
                                     <input type="text" name="idaho" value="{{   $tax_rates->idaho   }}" required class="form-control" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                               
                            </div>

                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="meta_author">{{ tr('Illinois') }}</label>
                                    <input type="text" class="form-control" value="{{  $tax_rates->illinois }}" name="illinois" id="meta_author" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                             
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>{{ tr('Indiana') }}</label>
                                     <input type="text" name="indiana" value="{{   $tax_rates->indiana   }}" required class="form-control" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                               
                            </div>

                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="meta_author">{{ tr('Iowa') }}</label>
                                    <input type="text" class="form-control" value="{{  $tax_rates->iowa }}" name="iowa" id="meta_author" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                             
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>{{ tr('Kansas') }}</label>
                                     <input type="text" name="kansas" value="{{   $tax_rates->kansas   }}" required class="form-control" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                               
                            </div>

                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="meta_author">{{ tr('Kentucky') }}</label>
                                    <input type="text" class="form-control" value="{{  $tax_rates->kentucky }}" name="kentucky" id="meta_author" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                             
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>{{ tr('Louisiana') }}</label>
                                     <input type="text" name="louisiana" value="{{   $tax_rates->louisiana   }}" required class="form-control" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                               
                            </div>

                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="meta_author">{{ tr('Maine') }}</label>
                                    <input type="text" class="form-control" value="{{  $tax_rates->maine }}" name="maine" id="meta_author" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                             
                            </div>
                            
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>{{ tr('Maryland') }}</label>
                                     <input type="text" name="maryland" value="{{   $tax_rates->maryland   }}" required class="form-control" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                               
                            </div>

                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="meta_author">{{ tr('Massachusetts') }}</label>
                                    <input type="text" class="form-control" value="{{  $tax_rates->massachusetts }}" name="massachusetts" id="meta_author" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                             
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>{{ tr('Michigan') }}</label>
                                     <input type="text" name="michigan" value="{{   $tax_rates->michigan   }}" required class="form-control" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                               
                            </div>

                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="meta_author">{{ tr('Minnesota') }}</label>
                                    <input type="text" class="form-control" value="{{  $tax_rates->minnesota }}" name="minnesota" id="meta_author" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                             
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>{{ tr('Mississippi') }}</label>
                                     <input type="text" name="mississippi" value="{{   $tax_rates->mississippi   }}" required class="form-control" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                               
                            </div>

                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="meta_author">{{ tr('Missouri') }}</label>
                                    <input type="text" class="form-control" value="{{  $tax_rates->missouri }}" name="missouri" id="meta_author" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                             
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>{{ tr('Montana') }}</label>
                                     <input type="text" name="montana" value="{{   $tax_rates->montana   }}" required class="form-control" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                               
                            </div>

                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="meta_author">{{ tr('Nebraska') }}</label>
                                    <input type="text" class="form-control" value="{{  $tax_rates->nebraska }}" name="nebraska" id="meta_author" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                             
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>{{ tr('Nevada') }}</label>
                                     <input type="text" name="nevada" value="{{   $tax_rates->nevada   }}" required class="form-control" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                               
                            </div>

                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="meta_author">{{ tr('New_Hampshire') }}</label>
                                    <input type="text" class="form-control" value="{{  $tax_rates->new_hampshire }}" name="new_hampshire" id="meta_author" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                             
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>{{ tr('New_Jersey') }}</label>
                                     <input type="text" name="new_jersey" value="{{   $tax_rates->new_jersey   }}" required class="form-control" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                               
                            </div>

                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="meta_author">{{ tr('New_Mexico') }}</label>
                                    <input type="text" class="form-control" value="{{  $tax_rates->new_mexico }}" name="new_mexico" id="meta_author" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                             
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>{{ tr('New_York') }}</label>
                                     <input type="text" name="new_york" value="{{   $tax_rates->new_york   }}" required class="form-control" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                               
                            </div>

                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="meta_author">{{ tr('North_Carolina') }}</label>
                                    <input type="text" class="form-control" value="{{ $tax_rates->north_carolina }}" name="north_carolina" id="meta_author" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                             
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>{{ tr('North_Dakota') }}</label>
                                     <input type="text" name="north_dakota" value="{{   $tax_rates->north_dakota   }}" required class="form-control" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                               
                            </div>

                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="meta_author">{{ tr('Ohio') }}</label>
                                    <input type="text" class="form-control" value="{{  $tax_rates->ohio }}" name="ohio" id="meta_author" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                             
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>{{ tr('Oklahoma') }}</label>
                                     <input type="text" name="oklahoma" value="{{   $tax_rates->oklahoma   }}" required class="form-control" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                               
                            </div>

                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="meta_author">{{ tr('Oregon') }}</label>
                                    <input type="text" class="form-control" value="{{  $tax_rates->oregon }}" name="oregon" id="meta_author" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                             
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>{{ tr('Pennsylvania') }}</label>
                                     <input type="text" name="pennsylvania" value="{{   $tax_rates->pennsylvania   }}" required class="form-control" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                               
                            </div>

                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="meta_author">{{ tr('Puerto_Rico') }}</label>
                                    <input type="text" class="form-control" value="{{  $tax_rates->puerto_rico }}" name="puerto_rico" id="meta_author" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                             
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>{{ tr('Rhode_Island') }}</label>
                                     <input type="text" name="rhode_island" value="{{   $tax_rates->rhode_island   }}" required class="form-control" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                               
                            </div>

                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="meta_author">{{ tr('South_Carolina') }}</label>
                                    <input type="text" class="form-control" value="{{  $tax_rates->south_carolina }}" name="south_carolina" id="meta_author" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                             
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>{{ tr('South_Dakota') }}</label>
                                     <input type="text" name="south_dakota" value="{{   $tax_rates->south_dakota   }}" required class="form-control" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                               
                            </div>

                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="meta_author">{{ tr('Tennessee') }}</label>
                                    <input type="text" class="form-control" value="{{  $tax_rates->tennessee }}" name="tennessee" id="meta_author" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                             
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>{{ tr('Texas') }}</label>
                                     <input type="text" name="texas" value="{{   $tax_rates->texas   }}" required class="form-control" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                               
                            </div>

                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="meta_author">{{ tr('Utah') }}</label>
                                    <input type="text" class="form-control" value="{{  $tax_rates->utah }}" name="utah" id="meta_author" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                             
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>{{ tr('Vermont') }}</label>
                                     <input type="text" name="vermont" value="{{   $tax_rates->vermont   }}" required class="form-control" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                               
                            </div>

                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="meta_author">{{ tr('Virginia') }}</label>
                                    <input type="text" class="form-control" value="{{  $tax_rates->virginia }}" name="virginia" id="meta_author" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                             
                            </div> 

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="meta_author">{{ tr('Virgin_Islands') }}</label>
                                    <input type="text" class="form-control" value="{{  $tax_rates->virgin_Islands }}" name="virgin_Islands" id="meta_author" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                             
                            </div>    
                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="meta_author">{{ tr('Washington') }}</label>
                                    <input type="text" class="form-control" value="{{  $tax_rates->washington }}" name="washington" id="meta_author" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                             
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="meta_author">{{ tr('West_Virginia') }}</label>
                                    <input type="text" class="form-control" value="{{  $tax_rates->west_virginia }}" name="west_virginia" id="meta_author" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                             
                            </div>  
                            <div class="col-md-5 col-md-offset-1">
                                <div class="form-group">
                                    <label for="meta_author">{{ tr('Wisconsin') }}</label>
                                    <input type="text" class="form-control" value="{{  $tax_rates->wisconsin }}" name="wisconsin" id="meta_author" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                             
                            </div>  
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="meta_author">{{ tr('Wyoming') }}</label>
                                    <input type="text" class="form-control" value="{{  $tax_rates->wyoming }}" name="wyoming" id="meta_author" placeholder="{{ tr('Enter_Tax_Rate') }}">
                                </div>                             
                            </div>        
                           
                        </div>
                    
                    </div>
                    <div class="box-footer">
                        <!-- <button type="reset" class="btn btn-warning">{{ tr('reset') }}</button> -->
                        
                        <button type="submit" class="btn btn-primary pull-right" @if(Setting::get('admin_delete_control') == YES ) disabled  @endif>{{ tr('submit') }}</button>                       
                    </div>
                    

                </form>

            </div>

        </div>
    
    </div>
    
    <div class="clearfix"></div>

</div>


@endsection


@section('scripts')

<script type="text/javascript">
    
    $(document).ready(function() {
        $("div.streamview-tab-menu>div.list-group>a").click(function(e) {
            e.preventDefault();
            $(this).siblings('a.active').removeClass("active");
            $(this).addClass("active");
            var index = $(this).index();
            $("div.streamview-tab>div.streamview-tab-content").removeClass("active");
            $("div.streamview-tab>div.streamview-tab-content").eq(index).addClass("active");
        });
    });
</script>
@endsection

