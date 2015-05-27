<?php

class NumberController extends \BaseController {

    public function showCreateNumberView(){

        #Authenticate User
        if(! Auth::check()){
            return Redirect::to('/');

        }

        $areacodes_all = AreaCode::all();
        $areacodes = [];

        foreach($areacodes_all as $areacode){

            $areacodes[$areacode->code] = $areacode->code." ".$areacode->area;
        }

        return View::make('number.createoptions', ['areacodes' => $areacodes]);

    }


    public function createNumber(){

        #Authenticate User
        if(! Auth::check()){
            return Redirect::to('/');

        }

        $number_formatted = Input::get('number');
        $number = preg_replace('/\D+/', '', $number_formatted);
        $count = Number::where('number', '=', $number)->count();


        if($count == 0 && strlen($number) >= 10){

            Number::create([
               'number' => $number
            ]);


            return Redirect::to('/number/create/form/'.$number );
        }

        Session::flash('error_message', 'Number not available or Number incorrect');
        return Redirect::back()->withInput();

    }

    public function showCreateNumberFormView($number){

        #Authenticate User
        if(! Auth::check()){
            return Redirect::to('/');

        }

        $user = Auth::user();

        $count = Number::where('number', '=', $number)->count();
        $info = Number::where('number', '=', $number)->first();


        if($count == 0 || $info->cnam != NULL){

            Session::flash('error_message', 'Number already allotted!');
            return Redirect::to('/system');

        }

        return View::make('number.create', ['user' => $user, 'number'=> $number ]);


    }

    public function storeNumber(){
        $user = Auth::user();
        #Authenticate User
        if(! Auth::check()){
            return Redirect::to('/');
        }


        $number = Number::where('number', '=', Input::get('number'))->first();


        $number->ocn = Input::get('ocn');
        $number->cnam= Input::get('cnam');
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
        $number->pin = Hash::make(Input::get('pin'));

        //Handle Certificate separately
        if(Input::hasFile('certificate')) {
            $extension = Input::file('certificate')->getClientOriginalExtension();
            Input::file('certificate')->move(base_path() . '/docs/certificates/', $number->number . "." . $extension);
            $number->certificate = base_path() . '/docs/certificates/' . $number->number . "." . $extension;
        }
        $number->save();

        Session::flash('success_message', 'Number Allocated and Saved!');
        if($user->type == 'number'){
            return Redirect::to('/numadmin');
        }else {
            return Redirect::to('/system');
        }

    }


    public function showEditNumberView($id){

        #Authenticate User
        if(! Auth::check()){
            return Redirect::to('/');
        }

        $number = Number::find($id);

        return View::make('number.edit', ['number' => $number]);

    }

    public function editNumber(){

        #Authenticate User
        if(! Auth::check()){
            return Redirect::to('/');
        }


        $number = Number::find(Input::get('id'));

        if($number->cnam !== Input::get('cnam')){
            $comment = "Changed CNAM value from ".$number->cnam." to ".Input::get('cnam');
            static::addToLog($number->number, $comment, 'edit');
            $number->cnam = Input::get('cnam');
        }

        if($number->ocn !== Input::get('ocn')){

            $comment = "Changed OCN value from ".$number->ocn." to ".Input::get('ocn');
            static::addToLog($number->number, $comment, 'edit');
            $number->ocn = Input::get('ocn');
        }


        if($number->assignee !== Input::get('assignee')){
            $comment = "Changed Assignee value from ".$number->assignee." to ".Input::get('assignee');
            static::addToLog($number->number, $comment, 'edit');
            $number->assignee = Input::get('assignee');
        }

        if($number->location_zip !== Input::get('location_zip')){
            $comment = "Changed Location Zip value from ".$number->location_zip." to ".Input::get('location_zip');
            static::addToLog($number->number, $comment, 'edit');
            $number->location_zip = Input::get('location_zip');
        }

        if($number->location !== Input::get('location')){
            $comment = "Changed Location value from ".$number->location." to ".Input::get('location');
            static::addToLog($number->number, $comment, 'edit');
            $number->location= Input::get('location');
        }

        if($number->otc !== Input::get('otc')){
            $comment = "Changed OTC value from ".$number->otc." to ".Input::get('otc');
            static::addToLog($number->number, $comment, 'edit');
            $number->otc= Input::get('otc');
        }

        if($number->rao !== Input::get('rao')){
            $comment = "Changed RAO value from ".$number->rao." to ".Input::get('rao');
            static::addToLog($number->number, $comment, 'edit');
            $number->rao = Input::get('rao');
        }

        if($number->bsp !== Input::get('bsp')){
            $comment = "Changed BSP value from ".$number->bsp." to ".Input::get('bsp');
            static::addToLog($number->number, $comment, 'edit');
            $number->bsp = Input::get('bsp');
        }

        if($number->collect !== Input::get('collect')){
            $comment = "Changed Collect value from ".$number->collect." to ".Input::get('collect');
            static::addToLog($number->number, $comment, 'edit');
            $number->collect = Input::get('collect');
        }

        if($number->alt_spid !== Input::get('alt_spid')){
            $comment = "Changed Alt SPID value from ".$number->alt_spid." to ".Input::get('alt_spid');
            static::addToLog($number->number, $comment, 'edit');
            $number->alt_spid = Input::get('alt_spid');
        }

        if($number->service_indicator !== Input::get('service_indicator')){
            $comment = "Changed Service Indicator value from ".$number->service_indicator." to ".Input::get('service_indicator');
            static::addToLog($number->number, $comment, 'edit');
            $number->service_indicator = Input::get('service_indicator');
        }

        if($number->reachability !== Input::get('reachability')){
            $comment = "Changed Reachability value from ".$number->reachability." to ".Input::get('reachability');
            static::addToLog($number->number, $comment, 'edit');
            $number->reachability = Input::get('reachability');
        }

        if($number->type !== Input::get('type')){
            $comment = "Changed Type value from ".$number->type." to ".Input::get('type');
            static::addToLog($number->number, $comment, 'edit');
            $number->type = Input::get('type');
        }

        if(Input::hasFile('certificate')) {
            $extension = Input::file('certificate')->getClientOriginalExtension();
            Input::file('certificate')->move(base_path() . '/docs/certificates/', $number->number . "." . $extension);
            $number->certificate = base_path() . '/docs/certificates/' . $number->number . "." . $extension;
            $comment = "Certificate Changed";
            static::addToLog($number->number, $comment, 'edit');
        }

        if($number->pin != crypt(Input::get('pin'), $number->pin)){
            $comment = "Changed Pin Value";
            static::addToLog($number->number, $comment, 'edit');
            $number->pin = Hash::make(Input::get('pin'));
        }

        $number->save();


        Session::flash('success_message', 'Edit Saved!');
        $user = Auth::user();
        if($user->type == 'number'){
            return Redirect::to('/numadmin');
        }else {
            return Redirect::to('/system');
        }
    }

    private function addToLog($number, $comment, $type){
        NumLog::create([
            'number' => $number,
            'type'  => $type,
            'description' => $comment
        ]);

        return 0;
    }

    public function showPortNumberView(){

        #Authenticate User
        if(! Auth::check()){
            return Redirect::to('/');
        }

        $admin = Auth::user();

        return View::make('number.port', ['admin' => $admin]);

    }

    public function portNumber(){

        #Authenticate User
        if(! Auth::check()){
            return Redirect::to('/');
        }

        $user = Auth::user();
        $number_formatted = Input::get('number');
        $number_correct = preg_replace('/\D+/', '', $number_formatted);

        $count = Number::where('number', '=', $number_correct)->count();
        $number = Number::where('number', '=', $number_correct)->first();


        if($count == 1) {
            if(crypt(Input::get('pin'), $number->pin) == $number->pin){
            #if (Hash::make(Input::get('pin')) == $number->pin) {

                $comment = "Porting from OCN: ".$number->ocn." to OCN: ".Input::get('ocn');
                static::addToLog($number->number, $comment, 'port');

                $comment = "Changed OCN value from ".$number->ocn." to ".Input::get('ocn');
                static::addToLog($number->number, $comment, 'edit');

                $comment = "Changed Assignee value from ".$number->assignee." to ".Input::get('assignee');
                static::addToLog($number->number, $comment, 'edit');

                $number->ocn = Input::get('ocn');
                $number->assignee = Input::get('assignee');
                $number->save();

                $comment = "Porting Completed Successfully!";
                static::addToLog($number->number, $comment, 'port');

                Session::flash('success_message', 'Number Ported Successfully!');
                $user = Auth::user();
                if($user->type == 'number'){
                    return Redirect::to('/numadmin');
                }else {
                    return Redirect::to('/system');
                }
            }
        }

        Session::flash('error_message', 'Number Not Allotted or Incorrect Pin');
        return Redirect::back()->withInput();

    }

    public function showLogView($number){

        #Authenticate User
        if(! Auth::check()){
            return Redirect::to('/');
        }

        $user = Auth::user();

        $count = NumLog::where('number', '=', $number)->count();
        if($count == 0){
            Session::flash('error_message', 'Number does not exist or no log exists!');
            if($user->type == 'number'){
                return Redirect::to('/numadmin');
            }else {
                return Redirect::to('/system');
            }
        }

        $log = NumLog::where('number', '=', $number)->get()->all();

        return View::make('number.log', ['number' => $number, 'logs' => $log]);

    }


}
