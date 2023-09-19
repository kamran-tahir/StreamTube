<form  action="{{ Setting::get('admin_delete_control') == YES ? '#' : route('admin.pages.save') }}" method="POST" enctype="multipart/form-data" role="form">

    <div class="box-body">

        <input type="hidden" name="page_id" value="{{ $page_details->id }}">
   
        @if($page_details->id != '')

            <div class="col-sm-6">
                <div class="form-group">
                    <label for="type">*{{ tr('page_type') }}</label>
                    <input type="text" class="form-control" name="type" id="page_type" value="{{  $page_details->type }}" placeholder="{{ tr('enter_type') }}" disabled="true">
                </div>
            </div>

        @else

            <div class="col-sm-6">                 
                <div class="form-group">

                    <label for="select2">*{{tr('page_type')}}</label>
                    <select id="select2" name="type" class="form-control" required onchange="yesnoCheck(this)">
                        <option value="" selected="true" >{{tr('choose')}} {{tr('page_type')}}</option>
                        <option value="about">{{tr('about')}}</option>
                        <option value="terms">{{tr('terms')}}</option>
                        <option value="privacy">{{tr('privacy')}}</option>
                        <option value="contact">{{tr('contact')}}</option>
                        <option value="help">{{tr('help')}}</option>
                        <option value="others">{{tr('others')}}</option>
                        <option value="security" id="yesCheck">{{tr('security')}}</option>
                    </select>            
                </div>
            </div>
        @endif                
        <div class="col-sm-6">
            <div class="form-group">
                <label for="title">*Page Name</label>
                <input type="text" class="form-control" name="title" required value="{{  old('title') ?: $page_details->title }}" id="title" placeholder="enter page name">
            </div>
        </div>
        <div class="col-sm-6">
            <label for="residence">* Upload Image</label>
            <br>
            @if($page_details->bg_image)
             <img src="{{$page_details->bg_image}}" id="bg_image" style="height: 100px;width: 100px;   object-fit: contain;">
             @else
            <img src="{{asset('placeholder.png')}}" id="bg_image" style="height: 100px;width: 100px;   object-fit: contain;">
            @endif
            <br>
            <input type="file"  name="bg_image" class="form-control" id="bg_image" accept="image/png, image/jpeg" placeholder="" value="{{$page_details->bg_image }}" onchange="loadFile(this,'bg_image')"> 
        </div>
        <div class="clearfix"></div>
        <br>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="bg_header">Header Background</label>
                <input type="color" class="form-control" name="bg_header" required value="{{  old('bg_header') ?: $page_details->bg_header }}" id="bg_header">
            </div>
        </div>
        <div class="clearfix"></div>
        <br>
        <div class="col-sm-6" id="home_link" style="display: none;">
            <div class="form-group">
                <label for="home">*Homepage URL</label>
                <input type="text" class="form-control" name="home_link"  value="{{$page_details->home_link}}" id="home" placeholder="{{tr('enter_link')}}">
            </div>
        </div>
         <div class="col-sm-6" id="exit_link" style="display: none;">
            <div class="form-group">
                <label for="exit">*Exit URL</label>
                <input type="text" class="form-control" name="exit_link"  value="{{$page_details->exit_link}}" id="exit" placeholder="{{tr('enter_link')}}">
            </div>
        </div>
        <br>
        <br>
         <div class="form-group">
            <div class="col-sm-12">
                <label for="description">*{{ Header }}</label>

                <textarea id="" name="heading" class="form-control ckeditor" required placeholder="{{ tr('enter_text') }}" required>{{$page_details->heading}}</textarea>
                
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-12" style="margin-top: 40px;">
                <label for="description">*{{ tr('description') }}</label>

                <textarea id="ckeditor" name="description" class="form-control" required placeholder="{{ tr('enter_text') }}" required maxlength = "10">{{ old('description') ?: $page_details->description }}</textarea>
                
            </div>
        </div>

    </div>

    <div class="box-footer">
            <button type="reset" class="btn btn-danger">{{ tr('cancel') }}</button>
            
            <button type="submit" class="btn btn-success pull-right" @if(Setting::get('admin_delete_control') == YES) disabled @endif) >{{ tr('submit') }}</button> 
    </div>

</form>