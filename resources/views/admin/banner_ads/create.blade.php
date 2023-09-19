@extends('layouts.admin')

@section('title', tr('create_banner_ad'))

@section('content-header')

{{tr('create_banner_ad')}}

<br>
<small class="header-note">** {{tr('banner_ads_note')}} <a target="_blank" href="http://prntscr.com/hx6e61">http://prntscr.com/hx6e61</a>**</small>

@endsection

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>{{tr('home')}}</a></li>
    <li><a href="{{route('admin.banner-ads.list')}}"><i class="fa fa-bullhorn"></i>{{tr('banner_ads')}}</a></li>
    <li class="active"><i class="fa fa-bullhorn"></i> {{tr('create_banner_ad')}}</li>
@endsection

@section('content')

@include('admin.banner_ads._form')
    
@endsection




