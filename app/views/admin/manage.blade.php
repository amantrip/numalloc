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
        <li class="">

            <a href="/public">
                <i class="icon-globe"></i>
                <span>Public Access</span>
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
                <li><a href="/admin" class="">PSAP Database</a></li>
                <li><a href="/admin/manage" class="active">Manage Admins and Private Access</a></li>
                <li><a href="/admin/reset" class="">Reset Password</a></li>
                <li><a href="/admin/edit">Edit Profile</a></li>
            </ul>
        </li>
    </ul>
@stop

@section('content')
    <div id="pad-wrapper">
        <!-- users table -->
        <div class="table-wrapper users-table section">
            <div class="row head">
                <div class="col-md-12">
                    <h2>Admins</h2>
                </div>
            </div>

            <div class="row filter-block">
                <div class="pull-right">
                    <a class="btn-flat pull-right success new-product add-user" href="/admin/add">+ Add Admin</a>
                </div>
            </div>

            <div class="row">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="col-md-3">
                                <span class="line"></span>Name
                            </th>
                            <th class="col-md-3">
                                <span class="line"></span>Company
                            </th>
                            <th class="col-md-3">
                                <span class="line"></span>Email
                            </th>
                            <th class="col-md-3">
                                <span class="line"></span>Type
                            </th>
                            <th class="col-md-3">
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
                                <td>{{$admin->name}}</td>
                                <td>{{$admin->company}}</td>
                                <td class="">{{$admin->email}}</td>
                                <td class="">{{$admin->type}}</td>
                                <td class="center">{{$admin->verified}}</td>
                                <td class="center align-right">{{ link_to("/admin/delete/{$admin->id}", "Delete") }}</td>
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

