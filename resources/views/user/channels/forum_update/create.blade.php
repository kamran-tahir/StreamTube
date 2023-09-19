@extends('layouts.user')
@section('styles')
<style type="text/css">
    textarea{
        min-height: 250px;
        resize: vertical;
    }
</style>

<link rel="stylesheet" href="{{asset('admin-css/plugins/datepicker/datepicker3.css')}}">

@endsection


@section('content')

<div class="y-content">
    
    <div class="row y-content-row">

        @include('layouts.user.nav')

        <div class="page-inner col-sm-9 col-md-10 profile-edit">

            <div class="profile-content slide-area1">
               
                <div class="row no-margin">

                    @include('notification.notify')

                    <div class="col-sm-12 col-md-10 col-lg-9 profile-view">
                        
                        <h3 class="mylist-head">Post Update</h3>
                       
                        <div class="edit-profile profile-view">
                            
                            <div class="edit-form profile-bg">
                                
                                <div class="editform-content"> 
                                    
                                    <form  action="{{route('user.channel.member-section.forum_update.store',$channel)}}" method="POST" enctype="multipart/form-data">
                                        {!! csrf_field() !!}
                                        <div class="form-group">
                                            <label for="title">Description</label>
                                            <textarea col="5" name="description" class="form-control" placeholder="Forum Updates" >{{old('description') }}</textarea>
                                        </div>
                                              
                                        <div class="change-pwd save-pro-btn pull-right col-md-3">
                                            <button type="submit" class="btn btn-info">{{tr('submit')}}</button>
                                        </div>                                              

                                    </form>

                                </div><!--end of editform-content-->
                                    
                            </div><!--end of edit-form-->                           
                        
                        </div><!--end of edit-profile-->
                    
                    </div><!--profile-view end-->  
                </div><!--end of profile-content row-->
            
            </div>

            <div class="sidebar-back"></div> 
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script src="{{asset('admin-css/plugins/datepicker/bootstrap-datepicker.js')}}"></script> 

<script src="https://cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script>
   
<script type="text/javascript">
    CKEDITOR.replace( 'description' );
</script>

@endsection