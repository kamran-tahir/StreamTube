@extends('layouts.admin')

@section('title', tr('edit_page'))

@section('content-header', tr('edit_page'))

@section('breadcrumb')
    <li><a href="{{route('admin.pages.index')}}"><i class="fa fa-book"></i> {{tr('pages')}}</a></li>
    <li class="active"> {{tr('edit_page')}}</li>
@endsection

@section('content')


<div class="row">

    <div class="col-md-12">
        
        @include('notification.notify')

        <div class="box box-info">

            <div class="box-header">
            </div>

           	@include('new_admin.pages._form')

        </div>

    </div>

</div>
   
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script>
    <script>
        $(document).ready(function(){
         val = $("#page_type").val();
            // alert(val);
            if (val == "security") {
            document.getElementById("home_link").style.display = "block";
            document.getElementById("exit_link").style.display = "block";
            } else {
            document.getElementById("home_link").style.display = "none";
            document.getElementById("exit_link").style.display = "none";
        }
          
        });
       
        CKEDITOR.replace( 'ckeditor');
         //////////// upload image //////////////
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
        // CKEDITOR.config.extraPlugins = 'colorbutton';
        // CKEDITOR.config.extraPlugins = 'panelbutton';
    </script>
@endsection
