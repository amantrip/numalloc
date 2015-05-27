@extends('layouts.default')

@section('title')
    <title>Num Alloc Admin Registration</title>
@stop

@section('styling')
    <link rel="stylesheet" href="css/compiled/new-user.css" type="text/css" media="screen" />
    <link rel="stylesheet" type="text/css" href="/css/home-page.css" />
@stop



@section('sidebar')
    <ul id="dashboard-menu">
        <li class="">

            <a href="/">
                <i class="icon-globe"></i>
                <span>Home</span>
            </a>
        </li>
        <li>
            <a class="" href="/">
                <i class="icon-user"></i>
                <span>System/Number Admin Registration</span>
            </a>
        </li>
    </ul>
@stop

@section('content')
    <div id="pad-wrapper" class="new-user">
        <div class="row header">
            <div class="col-md-12">
                <h3>Register New Number/System Admin</h3>
            </div>
        </div>
        <div class="row form-wrapper">
            <!-- left column -->
            <div class="col-md-8 with-sidebar">
                @if(Session::has('error_message'))
                    <div class="alert alert-danger">
                        <i class="icon-remove-sign"></i>
                        {{Session::get('error_message')}}
                    </div>
                @endif
                {{ Form:: open(['action' => 'HomeController@register', 'class' => 'form-horizontal']) }}
                    <div class="form-group">
                        {{ Form:: label('email', 'Registered Email', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-8">
                            {{ Form:: text('email', null, ['class' => 'form-control', 'placeholder' => 'Email', 'required']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form:: label('accesscode', 'Access Code', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-8">
                            {{ Form:: text('accesscode', null, ['class' => 'form-control', 'placeholder' => 'Access Code', 'required']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form:: label('password', 'Password', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-8">
                            {{ Form:: input('password', 'password', null, ['class' => 'form-control', 'placeholder' => 'Password', 'required']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form:: label('ocn', 'OCN', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-8">
                            {{ Form:: text('ocn', null, ['class' => 'form-control', 'placeholder' => 'Leave Empty if System Admin', 'onkeyup' =>"showOCN(this.value)"]) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form:: label('assignee', 'Company', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-8">
                            {{ Form:: text('assignee', null, ['class' => 'form-control', 'placeholder' => 'Company', 'id'=> 'assignee']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-8">
                            <!--<button type="submit" class="btn btn-default">Sign in</button>-->
                            {{ Form:: submit('Register', ['class' => 'btn btn-flat success']) }}
                            <a href="/" class="btn btn-flat btn-default">Cancel</a>
                        </div>
                    </div>
            </div>

             <!-- side right column -->
            <div class="col-md-4 form-sidebar">
                <div class="alert alert-info">
                    <i class="icon-lightbulb"></i> If you don't have an access code, please email us at am4227@columbia.edu and we will send you one!
                </div>
                <h6>Important Instructions</h6>
                <p>Please use the email ID to which you received the access code to register with Num-Alloc!</p>

            </div>
        </div>
    </div>
@stop

@section('footer')
<script>
    function showOCN(str)
    {
        if (str.length==0) {
        document.getElementById("assignee").value="";
        return;
        } else {
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                document.getElementById("assignee").value=xmlhttp.responseText;
            }
        }
            //xmlhttp.open("GET","http://nodea.app:8000/get/ocn/"+str,true);
            xmlhttp.open("GET","{{getenv('ocn')}}"+str,true);
            xmlhttp.send();
        }
    }
</script>
@stop