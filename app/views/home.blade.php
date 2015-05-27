@extends('layouts.home')

@section('title')
    <title>Welcome to Num-Alloc</title>
@stop

@section('styling')
    <style type="text/css">
        .nodeco{
            color:black
        }

        .nodeco:hover{
            color:black
        }

        div.top10{
            margin-top:60px;
        }

        div.section_header{
            margin-bottom: 15px;
        }
    </style>
@stop

@section('content')
    <div class="feature_wrapper option3">
        <div class="section_header">
            <!--<h3>Features <span>(Option 3)</span></h3>-->
        </div>
        <div class="row subtitle">
            <h2>
               Number Allocation Project: Please login as a Subscriber or Admin User to allocate new numbers, edit existing numbers or port numbers.

            </h2>
        </div>

        <!-- Features Row -->
        <div class="row">
            <!-- Feature -->
            <div class="col-sm-6">
                <a class="nodeco" href="/subscriber"><div class="feature">
                    <div class="img">
                        <img src="/clean/img/globe.png" />
                    </div>
                    <div class="text">
                        <h6>Subscriber Access</h6>
                        <p>
                        </p>
                    </div>
                </div></a>
            </div>
            <!-- Feature -->
            <div class="col-sm-6">
                <a class="nodeco" href="/system"><div class="feature last">
                    <div class="img">
                        <img src="/clean/img/user.png" />
                    </div>
                    <div class="text">
                        <h6>System/Number Admin Access</h6>
                        <p>
                        </p>
                    </div>
                </div></a>
            </div>
        </div>
    </div>

@stop