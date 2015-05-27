<?php

class AreaCodeController extends \BaseController {

	public function getAreaCode($code){

        $areacode = AreaCode::where('code', '=', $code)->first();

        return $areacode->area;

    }

    public function addAreaCode(){

        AreaCode::create([
            'area'  => Input::get('area'),
            'code'   => Input::get('code'),
        ]);

        Session::flash('success_message', "Area Code successfully added!");
        return Redirect::to('/system/areacodes');

    }

    public function editAreaCode(){
        $areacode = AreaCode::find(Input::get('id'));


        $areacode->area= Input::get('area');
        $areacode->code = Input::get('code');


        $areacode->save();

        Session::flash('success_message', "Area code successfully edited!");
        return Redirect::to('/system/areacodes');
    }


}
