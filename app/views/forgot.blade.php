@extends('layouts.home')


@section('title')
    <title>Num-Alloc Forgot Password</title>
@stop


@section('styling')
    <link rel="stylesheet" href="/clean/css/compiled/sign-in.css" type="text/css" media="screen" />
@stop

@section('content')
    <!-- Sign In Option 2 -->
    <div id="sign_in2">
        <div class="container">
            <div class="section_header">

            </div>
            <div class="row login">
                <div class="col-sm-5 left_box">
                    <h4>Forgot Password</h4>

                    <div class="perk_box">
                        <div class="perk">
                            <span class="icos ico1"></span>
                            <p><strong>Access all Numbers</strong>: Edit, delete entries or assign new assignees.</p>
                        </div>
                        <div class="perk">
                            <span class="icos ico2"></span>
                            <p><strong>Create New System Admin Users</strong>: Use the new admin's email to send them an access code.</p>
                        </div>
                        <div class="perk">
                            <span class="icos ico3"></span>
                            <p><strong>Create New Number Admin Users</strong>: Use the new user's email to send them an access code.</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 signin_box">
                    <div class="box">
                        <div class="box_cont">
                            <div class="division">
                                <div class="line l"></div>
                                <span>Reset</span>
                                <div class="line r"></div>
                            </div>

                            <div class="form">
                                @if(Session::has('error_message'))
                                    <div class="alert alert-danger">
                                        <i class="icon-remove-sign"></i>
                                        {{Session::get('error_message')}}
                                    </div>
                                @endif
                                @if(Session::has('success_message'))
                                    <div class="alert alert-success">
                                        <i class="icon-ok"></i>
                                        {{Session::get('success_message')}}
                                    </div>
                                @endif
                                {{ Form::open(['action' => 'HomeController@sendForgotPassword']) }}
                                    {{Form:: text('email', null, ['class' => 'form-control', 'placeholder' => 'Email'])}}
                                    <div class="forgot">
                                        <span>Remember Password?</span>
                                        <a href="/login">Go Back</a>
                                    </div>
                                    {{ Form:: submit('Submit') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

