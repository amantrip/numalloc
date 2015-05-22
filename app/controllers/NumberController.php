<?php

class NumberController extends \BaseController {

    public function showCreateNumberView(){

        #Authenticate User
        if(! Auth::check()){
            return Redirect::to('/');

        }

        return View::make('number.createoptions');

    }


    public function createNumber(){

        #Authenticate User
        if(! Auth::check()){
            return Redirect::to('/');

        }

        $number = Input::get('number');
        $count = Number::where('number', '=', $number)->count();


        if($count == 0 && strlen($number) >= 10){

            Number::create([
               'number' => $number
            ]);


            return Redirect::to('/number/create/form/'.$number );
        }

        Session::flash('error_message', 'Number Not Available');
        return Redirect::back()->withInput();

    }

    public function showCreateNumberFormView($number){

        #Authenticate User
        if(! Auth::check()){
            return Redirect::to('/');

        }

        $user = Auth::user();

        return View::make('number.create', ['user' => $user, 'number'=> $number ]);


    }

    public function storeNumber(){

        #Authenticate User
        if(! Auth::check()){
            return Redirect::to('/');
        }


        $number = Number::where('number', '=', Input::get('number'))->first();


        $number->ocn = Input::get('ocn');
        $number->owner = Input::get('owner');
        $number->certificate = Input::get('certificate');
        $number->location = Input::get('location');
        $number->alt_spid = Input::get('alt_spid');
        $number->service_indicator = Input::get('service_indicator');
        $number->reachability = Input::get('reachability');
        $number->type = Input::get('type');
        $number->pin = Hash::make(Input::get('pin'));
        $number->save();

        Session::flash('success_message', 'Number Allocated and Saved!');
        return Redirect::to('/admin');

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

        $number->ocn = Input::get('ocn');
        $number->owner = Input::get('owner');
        $number->certificate = Input::get('certificate');
        $number->location = Input::get('location');
        $number->alt_spid = Input::get('alt_spid');
        $number->service_indicator = Input::get('service_indicator');
        $number->reachability = Input::get('reachability');
        $number->type = Input::get('type');
        $number->pin = Hash::make(Input::get('pin'));
        $number->save();

        Log::create([
            'number' => $number->number,
            'serial_number' => 1,
            'description' => Input::get('comment')
        ]);

        Session::flash('success_message', 'Edit Saved!');
        return Redirect::to('/admin');
    }


    public function showPortNumberView(){

        #Authenticate User
        if(! Auth::check()){
            return Redirect::to('/');
        }


        return View::make('number.port');

    }

    public function portNumber(){

        #Authenticate User
        if(! Auth::check()){
            return Redirect::to('/');
        }

        $user = Auth::user();

        $count = Number::where('number', '=', Input::get('number'))->count();
        $number = Number::where('number', '=', Input::get('number'))->first();

        if($count == 1) {
            if(crypt(Input::get('pin'), $number->pin) == $number->pin){
            #if (Hash::make(Input::get('pin')) == $number->pin) {

                $number->ocn = $user->ocn;
                $number->owner = $user->owner_name;
                $number->save();

                Session::flash('success_message', 'Number Ported to Current OCN and Owner!');
                return Redirect::to('/admin');
            }
        }

        Session::flash('error_message', 'Number Not Allotted or Incorrect Pin');
        return Redirect::back()->withInput();

    }

}
