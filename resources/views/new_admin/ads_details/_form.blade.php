<div class="row">

    <div class="col-md-12">

        @include('notification.notify')

        <div class="box box-primary">

            <div class="box-header label-primary">
                <b style="font-size:18px;">@yield('title')</b>
            </div>

            <div class="box-body">

                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#video_ad" aria-controls="video_ad" role="tab" data-toggle="tab">Create Video Ad</a></li>
                    <li role="presentation" class=""><a href="#banner_ad" aria-controls="banner_ad" role="tab" data-toggle="tab">Create Banner Ad</a></li>
                    <li role="presentation" class=""><a href="#sidebar_ad_home" aria-controls="sidebar_ad" role="tab" data-toggle="tab">Create Home Page Ad</a></li>
                    <li role="presentation" class=""><a href="#sidebar_ad_videos" aria-controls="sidebar_ad" role="tab" data-toggle="tab">Create Video Page Ad</a></li>
                    <li role="presentation" class=""><a href="#sidebar_ad_search" aria-controls="sidebar_ad" role="tab" data-toggle="tab">Create Search Page Ad</a></li>
                </ul>
                
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="video_ad">
                        <form class="ad-form"  action="{{ Setting::get('admin_delete_control') == YES ? '#' : route('admin.ads-details.save')}}" method="POST" enctype="multipart/form-data" role="form">
                            <input type="hidden" name="ads_detail_id" id="id" value="{{$ads_detail_details->id}}">
                            <div class="col-md-12 form-group" style="margin-top: 10px;">
                                
                                <div class="row">

                                    <div class="col-md-6">

                                        <label>{{tr('name')}} *</label>

                                        <input type="text" name="name" id="name" class="form-control" value="{{old('name') ?: $ads_detail_details->name}}" required>

                                    </div>

                                    <div class="col-md-6">

                                        <label>{{tr('ad_time')}} ({{tr('in_sec')}}) *</label>

                                        <input type="number" step="1" name="ad_time" id="ad_time" class="form-control" value="{{old('ad_time') ?: $ads_detail_details->ad_time}}" required>

                                    </div>

                                    <div class="clearfix"></div>
                                </div>
                                <div class="row">
                                    <br>
                                    <div class="col-md-6">

                                        <label>{{tr('url')}} *</label>

                                        <input type="text" name="ad_url" id="ad_url" class="form-control ad_url" value="{{old('ad_url') ?: $ads_detail_details->ad_url}}" required>

                                    </div>
                                    

                                    <div class="col-md-3">

                                        <label>{{tr('video')}} *</label>

                                        <input type="file" name="file" id="file" accept="video/mp4,video/x-m4v,video/*" @if(!$ads_detail_details->id) required @endif>

                                        <br>
                                        <input type="hidden" name="ad_type" value="VIDEO">
                                        {{-- <img src="{{$ads_detail_details->file ? $ads_detail_details->file : asset('images/default-ad.jpg')}}" style="width:100px;height: 100px;" id="ad_preview"/> --}}

                                    </div>

                                    <div class="clearfix"></div>

                                    <br>

                                </div>
                                
                            </div>
                        </form>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="banner_ad">
                        <form class="ad-form"  action="{{ Setting::get('admin_delete_control') == YES ? '#' : route('admin.ads-details.save')}}" method="POST" enctype="multipart/form-data" role="form" id="form">
                            <input type="hidden" name="ads_detail_id" id="id" value="{{$ads_detail_details->id}}">
                            <div class="col-md-12 form-group" style="margin-top: 10px;">

                                <div class="row">

                                    <div class="col-md-6">

                                        <label>{{tr('name')}} *</label>

                                        <input type="text" name="name" id="name" class="form-control" value="{{old('name') ?: $ads_detail_details->name}}" required>

                                    </div>

                                    <div class="col-md-6">

                                        <label>{{tr('url')}} *</label>

                                        <input type="text" name="ad_url" id="ad_url" class="form-control ad_url" value="{{old('ad_url') ?: $ads_detail_details->ad_url}}" required>


                                    </div>

                                    <div class="clearfix"></div>

                                    <br>
                                    
                                </div>
                                
                                <div class="row">

                                    <div class="col-md-6 ">

                                        <label>{{tr('image')}} (recommended size: 560x80 px or 7:1) *</label>

                                        <input type="file" name="file" id="file" accept="image/*" onchange="loadFile(this, 'ad_preview')" @if(!$ads_detail_details->id) required @endif>

                                        <br>

                                        <img src="{{$ads_detail_details->file ? $ads_detail_details->file : asset('images/default-ad.jpg')}}" style="height: 100px; width: auto; max-width: 100%" id="ad_preview"/>
                                        <input type="hidden" name="ad_type" value="BANNER">
                                        <input type="hidden" name="ad_time" value="0">
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Sidebar ad create form starts here -->
                    <div role="tabpanel" class="tab-pane" id="sidebar_ad_home">
                        <form class="ad-form"  action="{{ Setting::get('admin_delete_control') == YES ? '#' : route('admin.ads-details.save')}}" method="POST" enctype="multipart/form-data" role="form" id="form">
                            <input type="hidden" name="ads_detail_id" id="id" value="{{$ads_detail_details->id}}">
                            <div class="col-md-12 form-group" style="margin-top: 10px;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>{{tr('name')}} *</label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{old('name') ?: $ads_detail_details->name}}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>{{tr('url')}} *</label>
                                        <input type="text" name="ad_url" id="ad_url" class="form-control ad_url" value="{{old('ad_url') ?: $ads_detail_details->ad_url}}" required>
                                    </div>
                                    <div class="clearfix"></div>
                                    <br>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 ">
                                        <label>{{tr('image')}} (recommended size: 480x300 px or 5:3) *</label>
                                        <input type="file" name="file" id="file" accept="image/*" onchange="loadFile(this, 'ad_preview1')" @if(!$ads_detail_details->id) required @endif>
                                        <br>
                                        <img src="{{$ads_detail_details->file ? $ads_detail_details->file : asset('images/default-ad.jpg')}}" style="height: 100px; width: auto; max-width: 100%" id="ad_preview1"/>
                                        <input type="hidden" name="ad_type" value="HOME_AD">
                                        <input type="hidden" name="ad_time" value="0">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="sidebar_ad_videos">
                        <form class="ad-form"  action="{{ Setting::get('admin_delete_control') == YES ? '#' : route('admin.ads-details.save')}}" method="POST" enctype="multipart/form-data" role="form" id="form">
                            <input type="hidden" name="ads_detail_id" id="id" value="{{$ads_detail_details->id}}">
                            <div class="col-md-12 form-group" style="margin-top: 10px;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>{{tr('name')}} *</label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{old('name') ?: $ads_detail_details->name}}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>{{tr('url')}} *</label>
                                        <input type="text" name="ad_url" id="ad_url" class="form-control ad_url" value="{{old('ad_url') ?: $ads_detail_details->ad_url}}" required>
                                    </div>
                                    <div class="clearfix"></div>
                                    <br>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 ">
                                        <label>{{tr('image')}} (recommended size: 480x300 px or 5:3) *</label>
                                        <input type="file" name="file" id="file" accept="image/*" onchange="loadFile(this, 'ad_preview2')" @if(!$ads_detail_details->id) required @endif>
                                        <br>
                                        <img src="{{$ads_detail_details->file ? $ads_detail_details->file : asset('images/default-ad.jpg')}}" style="height: 100px; width: auto; max-width: 100%" id="ad_preview2"/>
                                        <input type="hidden" name="ad_type" value="VIDEO_PAGE AD">
                                        <input type="hidden" name="ad_time" value="0">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Sidebar ad create form ends here -->
                    <div role="tabpanel" class="tab-pane" id="sidebar_ad_search">
                        <form class="ad-form"  action="{{ Setting::get('admin_delete_control') == YES ? '#' : route('admin.ads-details.save')}}" method="POST" enctype="multipart/form-data" role="form" id="form">
                            <input type="hidden" name="ads_detail_id" id="id" value="{{$ads_detail_details->id}}">
                            <div class="col-md-12 form-group" style="margin-top: 10px;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>{{tr('name')}} *</label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{old('name') ?: $ads_detail_details->name}}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>{{tr('url')}} *</label>
                                        <input type="text" name="ad_url" id="ad_url" class="form-control ad_url" value="{{old('ad_url') ?: $ads_detail_details->ad_url}}" required>
                                    </div>
                                    <div class="clearfix"></div>
                                    <br>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 ">
                                        <label>{{tr('image')}} (recommended size: 480x300 px or 5:3) *</label>
                                        <input type="file" name="file" id="file" accept="image/*" onchange="loadFile(this, 'ad_preview3')" @if(!$ads_detail_details->id) required @endif>
                                        <br>
                                        <img src="{{$ads_detail_details->file ? $ads_detail_details->file : asset('images/default-ad.jpg')}}" style="height: 100px; width: auto; max-width: 100%" id="ad_preview3"/>
                                        <input type="hidden" name="ad_type" value="SEARCH_PAGE_AD">
                                        <input type="hidden" name="ad_time" value="0">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Sidebar ad search create form ends here -->
                </div>
            </div>
            <div class="box-footer">
                <a href="" class="btn btn-danger">{{tr('cancel')}}</a>
                <button type="submit" id="btn_submit" class="btn btn-success pull-right btn_submit" onclick="$('.tab-pane.active').children('.ad-form').submit()">{{tr('submit')}}</button>
            </div>
        
        </div>

    </div>

</div>

@section('scripts')


<script type="text/javascript">

function loadFile(event, id){
    var reader = new FileReader();
    reader.onload = function(){
        var imageObj = new Image();
      var output = document.getElementById(id);
      output.src = reader.result;
      // if (imageObj.height < 100 || imageObj.width < 100) {
      //       alert("please select image given ratio");
      //   }
       //$("#imagePreview").css("background-image", "url("+this.result+")");
    };
    reader.readAsDataURL(event.files[0]);
}

/*function getCheckBoxValue(ad_type) {

    $('#video_time').val('');

    $("#video_time_div").hide();
 
    if(ad_type == "{{BETWEEN_AD}}") {

        $("#video_time_div").show();

    }

}*/
</script>
<!-- <script>
    $(document).ready(function() {
         $('.btn_submit').click(function() {
           var expression = /(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/;
            
            var regex = new RegExp(expression);
            
            var t= $('.ad_url').val();
            
            var errors=false;

            if (t == '' || !regex.test(t)) {
                 
              alert("Please enter correct url");
              $('.ad_url').css('background-color', '#dd4b39');

              // alert("Successful match");
               errors=true;
            }
             if(errors==true){
                    return false;
                }else{
                    $('#your_form').attr('action', 'http://uri-for-button1.com');
                    return true;
                }
            //  else {
            //   alert("Please enter correct url");
            //   $('.ad_url').css('background-color', '#dd4b39');
            //    location.reload(true);


            // }
    //   });
    // });
</script> -->
@endsection
   