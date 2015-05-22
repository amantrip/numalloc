<?php

class AdminController extends \BaseController {

    public function showAdminView(){

        # Authenticate User
        if(! Auth::check()){
            return Redirect::to('/login');
        }

        $user = Auth::user(); #get user

        #check user type and make sure the user has rights to access this page else redirect
        if($user->type == 'associate'){
            return Redirect::to('/associate');
        }


        $numbers = Number::where('ocn', '=', $user->ocn)->get();


        return View::make('admin.index', ['numbers' => $numbers]);

    }

    public function showResetPasswordView()
    {
        # Authenticate User
        if(! Auth::check()){
            return Redirect::to('/login');
        }

        $user = Auth::user(); #get user

        #check user type and make sure the user has rights to access this page else redirect
        if($user->type == 'associate'){
            return Redirect::to('/associate');
        }

        return View:: make('admin.reset');
    }

    /*
     * The reset password view POSTS to resetPassword().
     */

    public function resetPassword(){

        $user = Auth:: user();

        #check user type and make sure the user has rights to access this page else redirect
        if($user->type == 'associate'){
            return Redirect::to('/associate');
        }

        $admin = User:: find($user->id);


        if(Input::get('newpassword') == Input::get('repassword')){ #validate new password
            $admin->password = Hash::make(Input::get('newpassword'));
            $admin->save();

            Session::flash('success_message', 'Password Reset Successful!');
            return Redirect::to('/admin');
        }

        Session::flash('error_message', 'Passwords Entered Do Not Match! Please Re-Try!');
        return Redirect::back();

    }


    public function showEditProfileView(){

        $user = Auth::user();

        return View::make('admin.edit', ['admin' => $user]);

    }

    public function editProfile(){

        # Authenticate User
        if(! Auth::check()){
            return Redirect::to('/login');
        }

        $user = User::find(Auth::user()->id);

        $user->email = Input::get('email');
        $user->ocn = Input::get('ocn');
        $user->owner_name = Input::get('owner_name');
        $user->save();

        Session::flash('success_message', 'Edit Saved!');
        return Redirect::to('/admin');

    }


    public function showManageAdminView(){

        # Authenticate User
        if(! Auth::check()){
            return Redirect::to('/login');
        }

        $user = Auth::user();

        #User must be of Admin type to be able to manage other admin
        if($user->type == 'associate'){
            return Redirect::to('/associate');
        }

        $admins = User:: all();
        return View::make('admin.manage', ['admins' => $admins]);

    }
}
