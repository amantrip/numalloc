<?php

class APIController extends \BaseController {

	public function getNumber($number){

        $num = Number::where('number', '=', $number)->first();

        return $num->toJson();

    }

    public function getOCN($number){

        $num = Number::where('number', '=', $number)->first();

        return $num->ocn;

    }

    public function getCnam($number){

        $num = Number::where('number', '=', $number)->first();

        return $num->cnam;

    }

    public function getAssignee($number){

        $num = Number::where('number', '=', $number)->first();

        return $num->assignee;

    }

    public function getLocation($number){

        $num = Number::where('number', '=', $number)->first();

        return $num->location;

    }

    public function getOTC($number){

        $num = Number::where('number', '=', $number)->first();

        return $num->otc;

    }

    public function getRAO($number){

        $num = Number::where('number', '=', $number)->first();

        return $num->rao;

    }

    public function getBSP($number){

        $num = Number::where('number', '=', $number)->first();

        return $num->bsp;

    }

    public function getCollect($number){

        $num = Number::where('number', '=', $number)->first();

        return $num->collect;

    }

    public function getAltSPID($number){

        $num = Number::where('number', '=', $number)->first();

        return $num->alt_spid;

    }

    public function getReachabilty($number){

        $num = Number::where('number', '=', $number)->first();

        return $num->reachability;

    }

    public function getType($number){

        $num = Number::where('number', '=', $number)->first();

        return $num->type;

    }

    public function getGUSI($number){

        $num = Number::where('number', '=', $number)->first();

        return $num->gusi;

    }


}
