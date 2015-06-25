<?php

class GossipController extends \BaseController {


    /*public function createNumber($num, $cnam, $ocn, $assignee, $location_zip, $location, $otc, $rao, $bsp, $collect, $alt_spid, $service_indicator, $reachability, $type, $gusi, $pin, $certificate){

        $count = Number::where('number', '=', $num)->count();

        if($count == 0) {
            Number::create([
                'number' => $num
            ]);

            $number = Number::where('number', '=', $num)->first();

            $number->cnam= $cnam;
            $number->ocn = $ocn;
            $number->assignee = $assignee;
            $number->location_zip = $location_zip;
            $number->location = $location;
            $number->otc = $otc;
            $number->rao= $rao;
            $number->bsp = $bsp;
            $number->collect = $collect;
            $number->alt_spid = $alt_spid;
            $number->service_indicator = $service_indicator;
            $number->reachability = $reachability;
            $number->type = $type;
            $number->gusi = $gusi;
            $number->pin = $pin;
            $number->certificate = $certificate;

            $number->save();

        }

        return "ok";

    }*/

    public function createNumber(){

        return Redirect::to('/system');

        Number::create([
            'number' => Input::get('number'),
            'cnam'=> Input::get('cnam'),
            'ocn' => Input::get('ocn'),
            'assignee' => Input::get('assignee'),
            'location_zip' => Input::get('location_zip'),
            'location' => Input::get('location'),
            'otc' => Input::get('otc'),
            'rao'=> Input::get('rao'),
            'bsp' => Input::get('bsp'),
            'collect' => Input::get('collect'),
            'alt_spid' => Input::get('alt_spid'),
            'service_indicator' => Input::get('service_indicator'),
            'reachability' => Input::get('reachability'),
            'type' => Input::get('type'),
            'gusi' => Input::get('gusi'),
            'pin' => Input::get('pin'),
            'certifcate' => Input::get('certificate')
        ]);

        /*$number = Number::where('number', '=', Input::get('number'))->first();


        $number->cnam= Input::get('cnam');
        $number->ocn = Input::get('ocn');
        $number->assignee = Input::get('assignee');
        $number->location_zip = Input::get('location_zip');
        $number->location = Input::get('location');
        $number->otc = Input::get('otc');
        $number->rao= Input::get('rao');
        $number->bsp = Input::get('bsp');
        $number->collect = Input::get('collect');
        $number->alt_spid = Input::get('alt_spid');
        $number->service_indicator = Input::get('service_indicator');
        $number->reachability = Input::get('reachability');
        $number->type = Input::get('type');
        $number->gusi = Input::get('gusi');
        $number->pin = Input::get('pin');
        $number->certifcate = Input::get('certificate');

        $number->save(); */

        return "ok";

    }


    public function editNumber(){

    }


}
