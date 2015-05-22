@extends('layouts.default')

@section('title')
    <title>Num-Alloc Edit Admin Profile</title>
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
                    <li><a href="" class="active">Number List</a></li>
                    <li><a href="/number/create">Add New Number</a></li>
                    <li><a href="/number/port">Port A Number</a></li>
                    <li><a href="/admin/manage">Manage Admins and Associate Users</a></li>
                    <li><a href="/admin/reset">Reset Password</a></li>
                    <li><a href="/admin/edit">Edit Profile</a></li>
                </ul>
            </li>
        </ul>
@stop

@section('content')
    <div id="pad-wrapper" class="new-user">
        <div class="row header">
            <div class="col-md-12">
                <h3>Edit Profile</h3>
            </div>
        </div>
        <div class="row form-wrapper">
            <!-- left column -->
            <div class="col-md-6 with-sidebar">
                {{ Form:: open(['action' => 'AdminController@editProfile', 'class' => 'form-horizontal']) }}
                    {{ Form::hidden('id', $admin->id) }}
                    <div class="form-group">
                        {{ Form:: label('email', 'Email', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-8">
                            {{ Form:: label('email', $admin->email, ['class' => 'col-md-2 control-label']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form:: label('ocn', 'OCN', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-8">
                            {{ Form:: input('text', 'ocn', $admin->ocn, ['class' => 'form-control', 'required']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form:: label('owner_name', 'Owner Name', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-8">
                            {{ Form:: input('text', 'owner_name', $admin->owner_name, ['class' => 'form-control', 'required']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-8">
                            {{ Form:: submit('Submit', ['class' => 'btn btn-flat success']) }}
                            <a class="btn btn-flat" href="/admin">Cancel</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@stop