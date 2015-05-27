@extends('layouts.default')

@section('title')
    <title>NUM ALLOC Log View</title>
@stop

@section('styling')
    <link rel="stylesheet" href="/css/compiled/tables.css" type="text/css" media="screen" />
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
                <li><a href="/system" class="active">Number List</a></li>
                <li><a href="/number/create">Add New Number</a></li>
                <li><a href="/number/port">Port A Number</a></li>
                <li><a href="/system/ocns" class="">OCN List</a></li>
                <li><a href="/system/areacodes" class="">Area Code List</a></li>
                <li><a href="/system/manage" class="">Manage System and Number Admins</a></li>
                <li><a href="/system/reset">Reset Password</a></li>
                <li><a href="/system/edit">Edit Profile</a></li>
            </ul>
        </li>
    </ul>
@stop

@section('content')
    <div id="pad-wrapper">
        @if(Session::has('success_message'))
            <div class="alert alert-success">
                <i class="icon-ok"></i>
                {{Session::get('success_message')}}
            </div>
        @endif
        @if(Session::has('error_message'))
            <div class="alert alert-danger">
                <i class="icon-remove-sign"></i>
                {{Session::get('error_message')}}
            </div>
        @endif
        <!-- users table -->
        <div class="table-wrapper users-table section">
            <div class="row head">
                <div class="col-md-12">
                    <h2>{{$number}}</h2>
                </div>
            </div>

            <div class="row filter-block">
                <div class="pull-right">
                    <a class="btn-flat pull-right success new-product add-user" href="/system"><i class="icon-angle-left"></i> Return</a>
                </div>
            </div>

            <div class="row">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="col-md-3">
                                <span class="line"></span>Number
                            </th>
                            <th class="col-md-2">
                                <span class="line"></span>Log Type
                            </th>
                            <th class="col-md-4">
                                <span class="line"></span>Description
                            </th>
                            <th class="col-md-3 align-right">
                                <span class="line"></span>Time
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $log)
                            <tr class="">
                                <td class="center">{{$log->number}}</td>
                                <td class="center">{{$log->type}}</td>
                                <td class="center">{{$log->description}}</td>
                                <td class="center align-right">{{$log->updated_at}}</td>
                            </tr>
                        @endforeach
                        <!-- row -->
                        <tr class="first">
                            <td>

                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

