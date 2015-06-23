<?php

class GossipController extends \BaseController {


    public function createNumber($num, $cnam, $ocn, $assignee, $location_zip, $location, $otc, $rao, $bsp, $collect, $alt_spid, $service_indicator, $reachability, $type, $gusi, $pin, $certificate){

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

        return $number." ".$cnam." ".$ocn;

    }


    public function editNumber(){

    }


}
