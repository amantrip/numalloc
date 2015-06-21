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

            }else if($user->type == 'privileged') {

                return Redirect::to('/manager');

            }else{
                return Redirect::to('/system');
            }
        }

        Session::flash('error_message', 'Invalid email or password!');
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

            $message = "Please check your email for access code and password link.";
            Session::flash('success_message', $message);
            return Redirect::back();

        }else{ # This user does not exist, ask them to register first

            $message = "Your email ID is not registered! Please email our admin to receive an access code.";
            Session::flash('error_message', $message);
            return Redirect::back()->withInput();

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

            $message = "Passwords do not match and/or accesscode does not match!";

            Session::flash('error_message', $message);
            return Redirect::back()->withInput();

        }else{
            #entries match, save new password
            $user->password = Hash::make($password);
            $user->save();
        }

        #Authenticate User and redirect
        if (Auth::attempt(Input::only('email', 'password'))){
            $current_user = Auth::user();

            if($current_user->type == 'number'){

                return Redirect::to('/numadmin');

            }else if($user->type == 'privileged') {

                return Redirect::to('/manager');

            }else {
                return Redirect::to('/system');
            }
        }
    }


    public function showRegistrationView(){

        # Un-authenticate any user
        Auth::logout();

        #make the register
        return View::make('register');

    }

    public function register(){

        $message = "";

        if(User::where('email', '=', Input::get('email'))->count() > 0){ #check if the email ID has been registered
            $admin = User::where('email', '=', Input::get('email'))->first();


            if($admin->verified == 'No') { #check the user has already been verified

                if ($admin->accesscode == Input::get('accesscode')) { #check if the access code matches

                    $admin->password = Hash::make(Input::get('password')); # Passwords are stores after salting and hashing
                    $admin->ocn = Input::get('ocn');
                    $admin->assignee= Input::get('assignee');
                    $admin->verified = 'Yes';

                    $admin->save();
                    if ($admin->type == 'number') {

                        return Redirect::to('/numadmin');

                    }else if($admin->type == 'privileged') {

                        return Redirect::to('/manager');

                    } else {
                        return Redirect::to('/system');
                    }

                } else { #access code did not match
                    $message = $message . "Access code does not match with our records. ";
                }
            }else{ #already verified
                $message = $message."This account has already been verified.";
            }

        }else{ # Email is not registered

            $message = $message.'Email ID is not registered with Num-Alloc.';

        }
        # Send an error message
        Session::flash('error_message', $message);
        return Redirect::back()->withInput();

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
