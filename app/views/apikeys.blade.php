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
                <span>User</span>
                <i class="icon-chevron-down"></i>
            </a>
            <ul class="active submenu">
                <li><a href="/system" class="active">Return to Numbers</a></li>
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
                    <h2>API Keys</h2>
                </div>
            </div>

            <div class="row filter-block">
                <div class="pull-right">
                    {{Form::open(['action'  => 'APIKeyController@generateAPIKey'])}}
                        {{ Form:: submit('Generate API Key', ['class' => 'btn-flat pull-right success new-product add-user']) }}

                </div>
            </div>

            <div class="row">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="col-md-4">
                                <span class="line"></span>API Key
                            </th>
                            <th class="col-md-4">
                                <span class="line"></span>Creator Email ID
                            </th>
                            <th class="col-md-4">
                                <span class="line"></span>Delete
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($apikeys as $key)
                            <tr class="">
                                <td class="center">{{$key->api}}</td>
                                <td class="center">{{$key->email}}</td>
                                <td class="center"><a href="/apikeys/delete/{{$key->id}}">Delete</a></td>
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

