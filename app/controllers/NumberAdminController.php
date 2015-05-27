<?php

class NumberAdminController extends \BaseController {


    public function showAdminView(){

        # Authenticate User
        if(! Auth::check()){
            return Redirect::to('/login');
        }

        $user = Auth::user(); #get user

        $numbers = Number::where('ocn', '=', $user->ocn)->get();

        return View::make('numadmin.index', ['numbers' => $numbers]);

    }




    public function showResetPasswordView()
    {
        # Authenticate User
        if(! Auth::check()){
            return Redirect::to('/login');
        }

        $user = Auth::user(); #get user


        return View:: make('numadmin.reset');
    }


    public function resetPassword(){

        $user = Auth:: user();


        $admin = User:: find($user->id);


        if(Input::get('newpassword') == Input::get('repassword')){ #validate new password
            $admin->password = Hash::make(Input::get('newpassword'));
            $admin->save();

            Session::flash('success_message', 'Password Reset Successful!');
            return Redirect::to('/numadmin');
        }

        Session::flash('error_message', 'Passwords Entered Do Not Match! Please Re-Try!');
        return Redirect::back();

    }


    public function showEditProfileView(){

        $user = Auth::user();

        return View::make('numadmin.edit', ['admin' => $user]);

    }

    public function editProfile(){

        # Authenticate User
        if(! Auth::check()){
            return Redirect::to('/login');
        }

        $user = User::find(Auth::user()->id);

        $user->ocn = Input::get('ocn');
        $user->assignee = Input::get('assignee');
        $user->save();

        Session::flash('success_message', 'Edit Saved!');
        return Redirect::to('/numadmin');

    }






}
