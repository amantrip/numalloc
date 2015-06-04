@extends('layouts.default')

@section('title')
    <title>Num-ALLOC Admin Password Reset</title>
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
                <li><a href="/system/areacodes" class="">Area Codes</a></li>
                <li><a href="/system/manage">Manage System and Number Admins</a></li>
                <li><a href="/system/reset" class="active">Reset Password</a></li>
                <li><a href="/system/edit">Edit Profile</a></li>
            </ul>
        </li>
    </ul>
@stop

@section('content')
    <div id="pad-wrapper" class="new-user">
        <div class="row header">
            <div class="col-md-12">
                <h3>Reset Password</h3>
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
                {{ Form:: open(['action' => 'SystemAdminController@resetPassword', 'class' => 'form-horizontal']) }}
                    <div class="form-group">
                        {{ Form:: label('newpassword', 'New Password', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-8">
                            {{ Form:: input('password', 'newpassword', null, ['class' => 'form-control', 'placeholder' => 'Password']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form:: label('repassword', 'Retype Password', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-8">
                            {{ Form:: input('password', 'repassword', null, ['class' => 'form-control', 'placeholder' => 'Retype Password']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-8">
                            <!--<button type="submit" class="btn btn-default">Sign in</button>-->
                            {{ Form:: submit('Reset', ['class' => 'btn btn-flat success']) }}
                            <a class="btn btn-flat" href="/system">Cancel</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@stop