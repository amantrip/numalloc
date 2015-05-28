<?php

class SubscriberController extends \BaseController {

    public function showSubscriberLoginView(){


        if(Session::get('login') == true){
            return Redirect::to('/subscriber');
        }

        return View::make('subscriber.login');

    }

    public function subscriberLogin(){


        $number_formatted = Input::get('tel');
        $number_correct = preg_replace('/\D+/', '', $number_formatted);


        $count = Number::where('number', '=', $number_correct)->count();
        $number = Number::where('number', '=', $number_correct)->get()->first();
        $password = Input::get('password');

        if($count != 0){

            if ($number->password == crypt($password, $number->password) && $count != 0) {

                Session::put('login', true);
                Session::put('number', $number_correct);

            } else {
                Session::flash('error_message', 'Incorrect Password');
                return Redirect::back()->withInput();
            }
        }else{
            Session::flash('error_message', 'Number not registered');
            return Redirect::back()->withInput();
        }
        return Redirect::to('/subscriber');

    }

    public function showSubscriberForgotPasswordView(){

        return View::make('subscriber.forgot');
    }

    public function subscriberSendForgotPassword(){

        #get number details
        $number_formatted = Input::get('tel');
        $number_correct = preg_replace('/\D+/', '', $number_formatted);
        $number = Number::where('number', '=', $number_correct)->get()->first();
        $count = Number::where('number', '=', $number_correct)->count();

        if($count > 0){ #Existing User

            #Generate a random access code for password reset
            $accesscode = Str::random(5);
            $number->accesscode = $accesscode;
            $number->save();

            $txt_message ="Your access code is ".$accesscode.". Use this link: ".getenv('current_node') ."subscriber/reset to reset password.";

            // Create an authenticated client for the Twilio API
            $client = new Services_Twilio(getenv('TWILIO_ACCOUNT_SID'), getenv('TWILIO_AUTH_TOKEN'));

            // Use the Twilio REST API client to send a text message
            $m = $client->account->messages->sendMessage(
                getenv('TWILIO_NUMBER'), // the text will be sent from your Twilio number
                $number->number, // the phone number the text will be sent to
                $txt_message // the body of the text message
            );

            $message = "Please check your phone for access code and password link";
            Session::flash('success_message', $message);
            return Redirect::back();

        }else{ # This user does not exist, ask them to register first

            $message = "Your phone is not registered! Please register this number before accessing.";
            Session::flash('error_message', $message);
            return Redirect::back()->withInput();

        }


    }

    public function showSubscriberResetPasswordView(){
        return View::make('subscriber.reset');
    }

    public function subscriberResetPassword(){

        #get number details
        $number_formatted = Input::get('tel');
        $number_correct = preg_replace('/\D+/', '', $number_formatted);
        $number = Number::where('number', '=', $number_correct)->get()->first();

        #Get form inputs
        $password = Input::get('password');
        $repassword = Input::get('repassword');
        $accesscode = Input::get('accesscode');

        if($password != $repassword || $accesscode != $number->accesscode){

            $message = "Passwords Do no match And/OR Accesscode does not match!";

            Session::flash('error_message', $message);
            return Redirect::back()->withInput();

        }else{
            #entries match, save new password
            $number->password = Hash::make($password);
            $number->save();
        }

        Session::flash('success_message', "Password Reset, Please login");
        return Redirect::to('/subscriber/login');

    }

    public function showSubscriberDetailsView(){

        if(Session::get('login') == false || Session::get('login') == null){
            return Redirect::to('/subscriber/login');
        }

        $number_correct = Session::get('number');
        $number = Number::where('number', '=', $number_correct)->get()->first();


        return View::make('subscriber.details', ['number'=> $number]);

    }

    public function subscriberEditDetails(){

        $number = Number::find(Input::get('id'));

        if($number->cnam !== Input::get('cnam')){
            $comment = "Changed CNAM value from ".$number->cnam." to ".Input::get('cnam')." by Subscriber";
            static::addToLog($number->number, $comment, 'edit');
            $number->cnam = Input::get('cnam');
        }

        if($number->pin !== Input::get('pin')){
            $comment = "Changed Pin Value by Subscriber";
            static::addToLog($number->number, $comment, 'edit');
            $number->pin = Hash::make(Input::get('pin'));
        }

        $number->save();
        Session::flash('success_message', 'Edit Saved!');
        return Redirect::to('/subscriber');
    }

    private function addToLog($number, $comment, $type){
        NumLog::create([
            'number' => $number,
            'type'  => $type,
            'description' => $comment
        ]);

        return 0;
    }


    public function showSubscriberChangePasswordView(){

        if(Session::get('login') == false || Session::get('login') == null){
            return Redirect::to('/subscriber/login');
        }

        $number_correct = Session::get('number');
        $number = Number::where('number', '=', $number_correct)->get()->first();

        return View::make('subscriber.change', ['number' => $number]);
    }

    public function subscriberChangePassword(){

        $number = Number:: find(Input::get('id'));

        if(Input::get('newpassword') == Input::get('repassword')){ #validate new password
            $number->password = Hash::make(Input::get('newpassword'));
            $number->save();

            Session::flash('success_message', 'Password Reset Successful!');
            return Redirect::to('/subscriber');
        }

        Session::flash('error_message', 'Passwords Entered Do Not Match! Please Re-Try!');
        return Redirect::back();


    }


}
