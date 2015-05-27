@extends('layouts.default')

@section('title')
    <title>Num-ALLOC Area Code List</title>
@stop


@section('styling')
    <link rel="stylesheet" type="text/css" href="/css/home-page.css" />
    <link href="/css/lib/jquery.dataTables.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/compiled/datatables.css" type="text/css" media="screen" />
    <style type="text/css">
        .pace {
          -webkit-pointer-events: none;
          pointer-events: none;

          -webkit-user-select: none;
          -moz-user-select: none;
          user-select: none;

          -webkit-perspective: 12rem;
          -moz-perspective: 12rem;
          -ms-perspective: 12rem;
          -o-perspective: 12rem;
          perspective: 12rem;

          z-index: 2000;
          position: fixed;
          height: 6rem;
          width: 6rem;
          margin: auto;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
        }

        .pace.pace-inactive .pace-progress {
          display: none;
        }

        .pace .pace-progress {
          position: fixed;
          z-index: 2000;
          display: block;
          position: absolute;
          left: 0;
          top: 0;
          height: 6rem;
          width: 6rem !important;
          line-height: 6rem;
          font-size: 2rem;
          border-radius: 50%;
          background: rgba(31, 40, 55, 0.8);
          color: #fff;
          font-family: "Helvetica Neue", sans-serif;
          font-weight: 100;
          text-align: center;

          -webkit-animation: pace-3d-spinner linear infinite 2s;
          -moz-animation: pace-3d-spinner linear infinite 2s;
          -ms-animation: pace-3d-spinner linear infinite 2s;
          -o-animation: pace-3d-spinner linear infinite 2s;
          animation: pace-3d-spinner linear infinite 2s;

          -webkit-transform-style: preserve-3d;
          -moz-transform-style: preserve-3d;
          -ms-transform-style: preserve-3d;
          -o-transform-style: preserve-3d;
          transform-style: preserve-3d;
        }

        .pace .pace-progress:after {
          content: attr(data-progress-text);
          display: block;
        }

        @-webkit-keyframes pace-3d-spinner {
          from {
            -webkit-transform: rotateY(0deg);
          }
          to {
            -webkit-transform: rotateY(360deg);
          }
        }

        @-moz-keyframes pace-3d-spinner {
          from {
            -moz-transform: rotateY(0deg);
          }
          to {
            -moz-transform: rotateY(360deg);
          }
        }

        @-ms-keyframes pace-3d-spinner {
          from {
            -ms-transform: rotateY(0deg);
          }
          to {
            -ms-transform: rotateY(360deg);
          }
        }

        @-o-keyframes pace-3d-spinner {
          from {
            -o-transform: rotateY(0deg);
          }
          to {
            -o-transform: rotateY(360deg);
          }
        }

        @keyframes pace-3d-spinner {
          from {
            transform: rotateY(0deg);
          }
          to {
            transform: rotateY(360deg);
          }
        }

        .green{
            color: #2ca02c;
        }

        .red{
            color: red;
        }

        .white{
            background: #eeeeee;
        }

        .yellow{
            color: orange;
        }

        .blue{
            color: #32a0ee;
        }

    </style>
    <script src="/js/pace.js"></script>
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
                <li><a href="/number/port">Port A Number</a></li>
                <li><a href="/system/ocns" class="">OCN List</a></li>
                <li><a href="/system/areacodes" class="active">Area Code List</a></li>
                <li><a href="/system/manage">Manage System and Number Admins</a></li>
                <li><a href="/system/reset">Reset Password</a></li>
                <li><a href="/system/edit">Edit Profile</a></li>
            </ul>
        </li>
    </ul>
@stop

@section('content')
    <div id="pad-wrapper" class="datatables-page">
        @if(Session::has('success_message'))
            <div class="alert alert-success">
                <i class="icon-ok"></i>
                {{Session::get('success_message')}}
            </div>
        @endif
        <div class="table-wrapper users-table section">
            <div class="row filter-block">
                <div class="pull-right">
                    <a class="btn-flat pull-right success new-product add-user" href="/system/areacodes/add">+ Add New Area Code</a>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <table id="example2">
                        <thead>
                            <tr>
                                <th tabindex="0" rowspan="1" colspan="1">Area
                                </th>
                                <th tabindex="0" rowspan="1" colspan="1">Code
                                </th>
                                <th tabindex="0" rowspan="1" colspan="1">Edit?
                                </th>
                             </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">Area</th>
                                <th rowspan="1" colspan="1">Code</th>
                                <th rowspan="1" colspan="1">Edit?</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach( $areacodes as $areacode)
                                <tr>
                                    <td>{{$areacode->area}}</td>
                                    <td>{{$areacode->code}}</td>
                                    <td><a href="/system/areacodes/edit/{{$areacode->id}}">Edit</a></td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
    <script src="/js/jquery.dataTables3.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example2').dataTable({
                "sPaginationType": "full_numbers"
            });
        });
    </script>
@stop






