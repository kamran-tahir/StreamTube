<!DOCTYPE html>
<html lang="en">
<head>
    <title>@if(Setting::get('site_name')) {{Setting::get('site_name') }} @else {{tr('site_name')}} @endif</title>  
    <meta name="robots" content="noindex">
    
    <meta name="viewport" content="width=device-width,  initial-scale=1">

    @include('layouts.user.sub-layouts.head')

</head>
<body>
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
            background: url({{$image}}) no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
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

    <div class="container-fluid page_desc" style="padding: 0px">

        <div class="row content-row">
            <div class="page-inner" style="margin-top: 0px !important">
                @include('notification.notify')
                <div class="row">
                    <div class="col-sm-12">
                        <div style="padding: 1em 2em; background-color:{{$model->bg_header ?? '#fff'}}">
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
                        
                        <div class=""  style="padding: 4em 1em;">
                            @if($model)
                                {!! $model->description !!}
                            @else 
                                {{tr('model')}} 
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row" style="position: absolute; bottom: 1em; left: 45%">
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
    @include('layouts.user.sub-layouts.scripts')
</body>
</html>