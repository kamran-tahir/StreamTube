@extends('layouts.user')

@if($model)
<?php
$image= $model->bg_image; 

?>

<style type="text/css">
    .alert-success {
        margin-top: 18px !important;
    }

    .box-header>.fa,
    .box-header>.glyphicon,
    .box-header>.ion,
    .box-header .box-title {
        display: inline-block;
        font-size: 18px;
        margin: 0;
        line-height: 1;
    }

    .bg-light-blue,
    .label-primary,
    .modal-primary .modal-body {
        background-color: #3c8dbc !important;
    }

    .box-header {
        color: #444;
        display: block;
        padding: 10px;
        position: relative;
        height: 50px;
        color: #fff;
    }

    .page_desc {
        background-image:url({{$image}});
        background-size: cover;
        /* margin-top: 20px; */
        height: 600px;
    }

    .static-head {
        color: #fff;
        background: red;
        padding-bottom: 0px !important;
    }

    p {
        margin: 0 0 0px !important;
    }

    .page_desc p {
        padding: 10px;
        color: #fff;
    }
</style>

@endif
@section('content')

<div class="y-content">

    <div class="row content-row">

        @include('layouts.user.nav')

        <div class="page-inner col-sm-9 col-md-10">

            @include('notification.notify')

            <div class="row">
                <div class="col-sm-12">
                    <div class="" style="padding: 1em 2em; background-color:{{$model->bg_header ?? '#fff'}}">
                        
                            <span style="color: #000">
                                @if($model)
                                    {!! $model->heading !!}
                                @else 
                                    {{tr('model')}} 
                                @endif
                            </span>
                        
                        <!-- <h2 class="static-head " style="line-height: 2em;">@if($model) <?php echo$model->heading ?> @else {{tr('model')}} @endif</h2> -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    
                    <div class="page_desc"  style="padding: 4em 1em">
                        @if($model)
                            {!! $model->description !!}
                        @else 
                            {{tr('model')}} 
                        @endif
                    </div>
                </div>
            </div>
            <div class="row" style="position: absolute; bottom:5em; left: 45%">
                <div class="text-center">
                    @if($model->exit_link && $model->home_link )
                        <button type="button" class="btn btn-success" style="margin-right: 5px;">
                            <a href="{{$model->home_link}}" style="color: #fff;">{{ tr('home') }}</a>
                        </button>
                        <button type="button" class="btn btn-danger">
                            <a href="{{$model->exit_link}}" style="color: #fff;">{{ tr('exit') }}</a>
                        </button>
                    @endif
                </div>
            </div>
        </div>

    </div>

</div>

@endsection