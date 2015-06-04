@extends('layouts.default')

@section('title')
    <title>Num-Alloc Edit Area Code</title>
@stop

@section('styling')
    <link rel="stylesheet" href="css/compiled/new-user.css" type="text/css" media="screen" />
    <link rel="stylesheet" type="text/css" href="/css/home-page.css" />
@stop

@section('header')

    <ul class="nav navbar-nav pull-right hidden-xs">
        <li class="settings hidden-xs hidden-sm">
            <a href="/logout" role="button">
                <i class="icon-share-alt"></i>
            </a>
        </li>
    </ul>
@stop


@section('sidebar')
    <ul id="dashboard-menu">
            <li class="">
                <a href="/">
                    <i class="icon-home"></i>
                    <span>Home</span>
                </a>
            </li>
            <li class="active">
                <div class="pointer">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
                </div>
                <a class="dropdown-toggle" href="#">
                    <i class="icon-user"></i>
                    <span>Admin</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="active submenu">
                    <li><a href="/system" class="">Number List</a></li>
                    <li><a href="/number/create">Add New Number</a></li>
                    <li><a href="/number/port">Port Number</a></li>
                    <li><a href="/system/ocns" class="">OCN List</a></li>
                    <li><a href="/system/areacodes" class="active">Area Codes</a></li>
                    <li><a href="/system/manage" class="">Manage System and Number Admins</a></li>
                    <li><a href="/system/reset">Reset Password</a></li>
                    <li><a href="/system/edit" class="">Edit Profile</a></li>
                </ul>
            </li>
        </ul>
@stop

@section('content')
    <div id="pad-wrapper" class="new-user">
        <div class="row header">
            <div class="col-md-12">
                <h3>Edit Area Code</h3>
            </div>
        </div>
        <div class="row form-wrapper">
            <!-- left column -->
            <div class="col-md-6 with-sidebar">
                @if(Session::has('error_message'))
                    <div class="alert alert-danger">
                        <i class="icon-remove-sign"></i>
                        {{Session::get('error_message')}}
                    </div>
                @endif
                {{ Form:: open(['action' => 'AreaCodeController@editAreaCode', 'class' => 'form-horizontal']) }}
                    <div class="form-group">
                        {{ Form:: label('area', 'Area', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-8">
                            {{ Form:: input('text', 'area',  $areacode->area, ['class' => 'form-control',  'required']) }}
                            {{ Form::hidden('id', $areacode->id) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form:: label('code', 'Code', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-8">
                            {{ Form:: input('number', 'code',  $areacode->code, ['class' => 'form-control',   'required']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-8">
                            <!--<button type="submit" class="btn btn-default">Sign in</button>-->
                            {{ Form:: submit('Submit', ['class' => 'btn btn-flat success']) }}
                            <a class="btn btn-flat" href="/system/areacodes">Cancel</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@stop

@section('footer')

@stop