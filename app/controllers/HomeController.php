<?php

class HomeController extends BaseController {


    public function showIndexView(){

        return View::make('home');

    }

    public function showLoginView(){

        #Check if user already authenticated
        if (Auth::check()){
            return Redirect::to('/system');
        }

        #Render login view
        return View::make('login');
    }



    public function loginUser(){
        if (Auth::attempt(Input::only('email', 'password'))){
            $user = Auth::user();

            # Check if the Admin has already verified their email address
            /*if($user->verified == 'No'){
                return Redirect::to('/register');
            }*/
            if($user->type == 'number'){
                return Redirect::to('/numadmin');
            }else {
                return Redirect::to('/system');
            }
        }

        Session::flash('error_message', 'Invalid Email or Password');
        return Redirect::back()->withInput();
    }


    public function showForgotPasswordView(){
        return View::make('forgot');
    }

    public function sendForgotPassword(){

        $email = Input::get('email');

        $user = User::where('email', '=', $email)->first();
        $count = User::where('email', '=', $email)->count();

        if($count > 0){ #Existing User

            #Generate a random access code for password reset
            $accesscode = Str::random(5);
            $user->accesscode = $accesscode;
            $user->save();

            #Send the user an email with accesscode
            $email_data = [
                'recipient' => $email,
                'subject' => 'Num Alloc: Reset Password'
            ];

            $view_data = [
                'accesscode' => $accesscode,
                'user' => $user
            ];

            #Send Email
            Mail::send('emails.reset', $view_data, function($message) use ($email_data){
                $message->to($email_data['recipient'])
                    ->subject($email_data['subject']);
            });

            return View::make('success', ['message' => 'Please check your email for access code and password link']);

        }else{ # This user does not exist, ask them to register first

            $message = "Your email is not registered! Please email our admin to receive an access code.";
            return View::make('error', ['message' => $message]);
        }
    }

    public function showResetPasswordView(){
        return View::make('reset');
    }

    public function resetPassword(){
        #get user details
        $user = User:: where('email', '=', Input::get('email'))->first();

        #Get form inputs
        $password = Input::get('password');
        $repassword = Input::get('repassword');
        $accesscode = Input::get('accesscode');

        if($password != $repassword || $accesscode != $user->accesscode){

            $message = "Passwords Do no match And/OR Accesscode does not match!";

            return View::make('error', ['message' => $message]);

        }else{
            #entries match, save new password
            $user->password = Hash::make($password);
            $user->save();
        }

        #Authenticate User and redirect
        if (Auth::attempt(Input::only('email', 'password'))){
            $current_user = Auth::user();

            if($current_user->type == 'associate'){
                return Redirect::to('/associate');
            }else {
                return Redirect::to('/admin');
            }
        }
    }



    /*
     * logout user, flush all session variables and un-authenticate user
     */
    public function logout(){
        Session::flush();
        Auth::logout();
        return Redirect::to('/');
    }



}
