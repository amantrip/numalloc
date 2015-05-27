<?php

class OCNController extends \BaseController {

	public function getOCN($id){

        $ocn = OCN::where('ocn', '=', $id)->first();

        return $ocn->company;

    }


    public function addOCN(){

        OCN::create([
           'state'  => Input::get('state'),
            'ocn'   => Input::get('ocn'),
            'company'   => Input::get('company')
        ]);

        Session::flash('success_message', "OCN successfully added!");
        return Redirect::to('/system/ocns');

    }

    public function editOCN(){

        $ocn = OCN::find(Input::get('id'));

        $ocn->state = Input::get('state');
        $ocn->ocn = Input::get('ocn');
        $ocn->company = Input::get('company');

        $ocn->save();

        Session::flash('success_message', "OCN successfully edited!");
        return Redirect::to('/system/ocns');


    }






}
