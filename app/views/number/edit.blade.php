@extends('layouts.default')

@section('title')
    <title>Num Alloc Edit Number</title>
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
                <span>Admin/Associate Access</span>

            </a>
        </li>
    </ul>
@stop




@section('content')
    <div id="pad-wrapper" class="new-user">
        <div class="row header">
            <div class="col-md-12">
                <h3>Edit Details </h3>
            </div>
        </div>
        <div class="row form-wrapper">
            <!-- left column -->
            <div class="col-md-6 with-sidebar">
                {{ Form:: open(['action' => 'NumberController@editNumber', 'class' => 'form-horizontal']) }}

                    <div class="form-group">
                        {{ Form:: label('number', 'Alloted Number', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-8">
                            {{ Form:: label('number', $number->number, ['class' => 'control-label', 'required']) }}
                            {{Form::hidden('id', $number->id)}}
                            {{Form::hidden('number', $number->number)}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form:: label('cnam', 'CNAM', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-8">
                            {{ Form:: input('text', 'cnam', $number->cnam, ['class' => 'form-control', 'required']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form:: label('ocn', 'OCN Information', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-8">
                            {{ Form:: input('number', 'ocn', $number->ocn, ['class' => 'form-control', 'onkeyup' =>"showOCN(this.value)", 'required']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form:: label('assignee', 'Assignee Information', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-8">
                            {{ Form:: input('text', 'assignee', $number->assignee, ['class' => 'form-control', 'id' => 'assignee' , 'required']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form:: label('certificate', 'Certificate', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-8">
                            <a href="{{$number->certificate}}">Certificate Link</a>
                            {{Form:: file('input')}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form:: label('location_zip', 'Zip Code', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-8">
                            {{ Form:: input('number', 'location_zip', $number->location_zip, ['class' => 'form-control', 'onkeyup' =>"showLocation(this.value)", 'required']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form:: label('location', 'Location', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-8">
                            {{ Form:: input('text', 'location', $number->location, ['class' => 'form-control', 'id'=> 'location', 'required']) }}

                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form:: label('otc', 'Operating Telephone Company (OTC)', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-8">
                            {{ Form:: input('text', 'otc', $number->otc, ['class' => 'form-control', 'required']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form:: label('rao', 'Revenue Accounting Office (RAO)', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-8">
                            {{ Form:: input('text', 'rao', $number->rao, ['class' => 'form-control', 'required']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form:: label('bsp', 'Billing Service Provider (BSP)', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-8">
                            {{ Form:: input('text', 'bsp', $number->bsp, ['class' => 'form-control', 'required']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form:: label('collect', 'Collect', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-8">
                            {{ Form:: select('collect', ['allow'=>'Allow', 'deny'=>'Deny'], ['class'=>'col-md-2 control-label']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form:: label('alt_spid', 'Alternate SPID', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-8">
                            {{ Form:: input('text', 'alt_spid', $number->alt_spid, ['class' => 'form-control', 'required']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form:: label('service_indicator', 'Service Indicator', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-8">
                            {{ Form:: input('text', 'service_indicator', $number->service_indicator, ['class' => 'form-control', 'required']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form:: label('reachability', 'Reachability', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-8">
                            {{ Form:: input('text', 'reachability', $number->reachability, ['class' => 'form-control', 'required']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form:: label('type', 'Type', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-8">
                            {{ Form:: select('type', ['mobile'=>'mobile', 'landline'=>'landline'], ['class'=>'col-md-2 control-label']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form:: label('pin', 'Pin', ['class' => 'col-md-2 control-label']) }}
                        <div class="col-md-8">
                            {{ Form:: input('password', 'pin', null, ['class' => 'form-control', 'required']) }}

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-8">
                            {{ Form:: submit('Submit', ['class' => 'btn btn-flat success']) }}
                            <a href="/system" class="btn btn-flat default">Cancel</a>
                        </div>
                    </div>
                {{Form:: close()}}
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


    function showLocation(str)
        {
            if (str.length==0) {
            document.getElementById("location").value="";
            return;
            } else {
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function() {
                if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                    var jsonObj = JSON.parse(xmlhttp.responseText);
                    document.getElementById("location").value=jsonObj.results[0].formatted_address;
                }
            }
                xmlhttp.open("GET","http://maps.googleapis.com/maps/api/geocode/json?address="+str+"&sensor=true",true);
                xmlhttp.send();
            }
        }

</script>
@stop