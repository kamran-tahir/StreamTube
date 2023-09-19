@extends('layouts.admin')

@section('title', tr('pages'))

@section('content-header', tr('pages'))

@section('breadcrumb')
    <li><a href="{{route('admin.pages.index')}}"><i class="fa fa-book"></i> {{tr('pages')}}</a></li>
    <li class="active"> {{tr('add_page')}}</li>
@endsection

@section('content')

  	<div class="row">

	    <div class="col-md-12">
    		
    		@include('notification.notify')

	        <div class="box box-primary">

	            <div class="box-header label-primary">
	                <b>{{tr('add_page')}}</b>
	                <a href="{{route('admin.pages.index')}}" style="float:right" class="btn btn-default">{{tr('pages')}}</a>
	            </div>

	            @include('new_admin.pages._form')

	        </div>

	    </div>

	</div>
   
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/4.5.5/standard/ckeditor.js"></script>
    <script>
      function yesnoCheck(that) {
        if (that.value == "security") {
            document.getElementById("home_link").style.display = "block";
            document.getElementById("exit_link").style.display = "block";
        } else {
            document.getElementById("home_link").style.display = "none";
            document.getElementById("exit_link").style.display = "none";
        }
      }
        CKEDITOR.replace( 'ckeditor' );

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
    </script>
@endsection


