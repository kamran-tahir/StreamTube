
@extends('layouts.admin')



@section('title')



@section('content-header')

<h1>RESIDENCE DOCUMENT</h1>



@endsection



@section('breadcrumb')

    <li class="active"><i class="fa fa-user"></i>Users</li>

@endsection



@section('content')
  <div class="row">
   <div class="col-xs-12">
     @include('notification.notify')
        <div class="box box-primary">
         <div class="box-body table-responsive" style="text-align: center;">
          
             <img class="img-circle" src="{{ $user_details->residence_doc }}" alt="{{ $user_details->name }}" style="">
          
          </div>
        </div>

    </div>
  </div>
@endsection

