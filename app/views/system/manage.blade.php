@extends('layouts.default')

@section('title')
    <title>NUM ALLOC Manage Admin</title>
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
                <li><a href="/system">Number List</a></li>
                <li><a href="/number/create">Add New Number</a></li>
                <li><a href="/number/port">Port A Number</a></li>
                <li><a href="/system/ocns" class="">OCN List</a></li>
                <li><a href="/system/areacodes" class="">Area Code List</a></li>
                <li><a href="/system/manage" class="active">Manage System and Number Admins</a></li>
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
                    <h2>Admins</h2>
                </div>
            </div>

            <div class="row filter-block">
                <div class="pull-right">
                    <a class="btn-flat pull-right success new-product add-user" href="/system/add">+ Add Admin</a>
                </div>
            </div>

            <div class="row">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="col-md-3">
                                <span class="line"></span>Email
                            </th>
                            <th class="col-md-2">
                                <span class="line"></span>Type
                            </th>
                            <th class="col-md-2">
                                <span class="line"></span>OCN
                            </th>
                            <th class="col-md-3">
                                <span class="line"></span>Company
                            </th>
                            <th class="col-md-2">
                                <span class="line"></span>Verified?
                            </th>
                            <th class="col-md-3 align-right">
                                <span class="line"></span>Delete Admin?
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admins as $admin)
                            <tr class="">
                                <td class="">{{$admin->email}}</td>
                                @if($admin->type == 'system')
                                    <td class="">System Admin</td>
                                @else
                                    <td class="">Number Admin</td>
                                @endif
                                <td class="center">{{$admin->ocn}}</td>
                                <td class="center">{{$admin->assignee}}</td>
                                <td class="center">{{$admin->verified}}</td>
                                <td class="center align-right">{{ link_to("/system/delete/{$admin->id}", "Delete") }}</td>
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

