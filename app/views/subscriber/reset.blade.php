@extends('layouts.home')


@section('title')
    <title>Num-Alloc Subscriber Reset Password</title>
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
                    <h4> Subscriber Reset Password</h4>

                    <div class="perk_box">
                        <div class="perk">
                            <span class="icos ico1"></span>
                            <p><strong>Access your Number</strong>: Edit cnam details.</p>
                        </div>
                        <div class="perk">
                            <span class="icos ico2"></span>
                            <p><strong>Change Password</strong>: Use your password to access cnam and pin for porting.</p>
                        </div>
                        <div class="perk">
                            <span class="icos ico3"></span>
                            <p><strong>Change Pin</strong>: Use pin to port your number to a new carrier.</p>
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
                                {{ Form::open(['action' => 'SubscriberController@subscriberResetPassword']) }}
                                    {{Form:: text('tel', null, ['class' => 'form-control', 'placeholder' => 'Number', 'id' => 'phone' ,'required'])}}
                                    {{Form:: text('accesscode', null, ['class' => 'form-control', 'placeholder' => 'Access Code', 'required'])}}
                                    {{Form:: password('password', ['class' => 'form-control', 'placeholder' => 'New Password', 'required'])}}<br>
                                    {{Form:: password('repassword',  ['class' => 'form-control', 'placeholder' => 'Re Enter Password', 'required'])}}
                                    <br>
                                    {{ Form:: submit('Submit') }}
                            </div>
                        </div>
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