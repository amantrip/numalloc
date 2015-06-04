<?php

class OCNController extends \BaseController {

	public function getOCN($id){

        $ocn = OCN::where('ocn', '=', $id)->where('type', '=', 'active')->first();
        $count = OCN::where('ocn', '=', $id)->where('type', '=', 'active')->count();


        if($count > 0) {

            return $ocn->company;

        }else{
            return "undefined";
        }

    }


    public function addOCN(){

        OCN::create([
           'state'  => Input::get('state'),
            'ocn'   => Input::get('ocn'),
            'company'   => Input::get('company'),
            'type' => Input::get('type')
        ]);

        Session::flash('success_message', "OCN successfully added!");
        return Redirect::to('/system/ocns');

    }

    public function editOCN(){

        $ocn = OCN::find(Input::get('id'));

        $ocn->state = Input::get('state');
        $ocn->ocn = Input::get('ocn');
        $ocn->company = Input::get('company');
        $ocn->type = Input::get('type');

        $ocn->save();

        Session::flash('success_message', "OCN successfully edited!");
        return Redirect::to('/system/ocns');


    }






}
