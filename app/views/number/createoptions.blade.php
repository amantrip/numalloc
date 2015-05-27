@extends('layouts.default')

@section('title')
    <title>Num-ALLOC Allocate New Number</title>
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
            <a class="" href="/">
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
                <span>System/Number Admin</span>

            </a>
        </li>
    </ul>
@stop




@section('content')
    <div id="pad-wrapper" class="new-user">
        <div class="row header">
            <div class="col-md-12">
                <h3>Choose A Number or an Area Code </h3>
            </div>
        </div>
        <div class="row form-wrapper">
            <!-- left column -->
            <div class="col-md-6 with-sidebar">
                {{ Form:: open(['action' => 'NumberController@createNumber', 'class' => 'form-horizontal']) }}
                    @if(Session::has('error_message'))
                        <div class="alert alert-danger">
                            <i class="icon-remove-sign"></i>
                            {{Session::get('error_message')}}
                        </div>
                    @endif
                    <div class="form-group">
                        {{ Form:: label('number', 'Choose A Number', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-8">
                            {{ Form:: input('tel', 'number', null, ['class' => 'form-control col-md-2', 'id' => 'phone', 'required']) }}

                        </div>

                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-8">
                            {{ Form:: submit('Submit', ['class' => 'btn btn-flat success']) }}
                            <a href="/system" class="btn btn-flat default">Cancel</a>
                        </div>
                    </div>
                {{Form:: close()}}
                <hr>
                {{ Form:: open(['action' => 'NumberController@createNumber', 'class' => 'form-horizontal']) }}
                    <div class="form-group">
                        {{ Form:: label('number', 'Pick An Area Code', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-8">
                              {{ Form:: select('areacode', $areacodes, ['class'=>'col-md-2 control-label']) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-8">
                            <!--{{ Form:: submit('Submit', ['class' => 'btn btn-flat success']) }} -->
                            <a href="/system" class="btn btn-flat default">Cancel</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
    <script>
        $(document).ready(function(){
           $("#phone").inputmask("mask", {"mask": "(999) 999-9999"}); //specifying fn & options
        });
    </script>
    <script src="/js/inputmask.js" type="text/javascript"></script>
    <script src="/js/jquery.inputmask.js" type="text/javascript"></script>

@stop