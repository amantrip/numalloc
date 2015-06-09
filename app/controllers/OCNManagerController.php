<?php

class OCNManagerController extends \BaseController {

    public function showAdminView(){

        # Authenticate User
        if(! Auth::check()){
            return Redirect::to('/login');
        }

        $user = Auth::user(); #get user

        if($user->type == 'numadmin'){
            return Redirect::to('/numadmin');
        }else if ($user->type == 'system'){
            return Redirect::to('/system');
        }

        $numbers = Number::where('ocn', '=', $user->ocn)->get();

        return View::make('manager.index', ['numbers' => $numbers]);

    }

    public function showResetPasswordView()
    {
        # Authenticate User
        if(! Auth::check()){
            return Redirect::to('/login');
        }

        $user = Auth::user(); #get user

        if($user->type == 'numadmin'){
            return Redirect::to('/numadmin');
        }else if ($user->type == 'system'){
            return Redirect::to('/system');
        }


        return View:: make('manager.reset');
    }


    public function resetPassword(){

        $user = Auth:: user();


        $admin = User:: find($user->id);


        if(Input::get('newpassword') == Input::get('repassword')){ #validate new password
            $admin->password = Hash::make(Input::get('newpassword'));
            $admin->save();

            Session::flash('success_message', 'Password Reset Successful!');
            return Redirect::to('/manager');
        }

        Session::flash('error_message', 'Passwords Entered Do Not Match! Please Re-Try!');
        return Redirect::back();

    }


    public function showEditProfileView(){

        $user = Auth::user();

        if($user->type == 'numadmin'){

            return Redirect::to('/numadmin');

        }else if ($user->type == 'system'){

            return Redirect::to('/system');
        }

        return View::make('manager.edit', ['admin' => $user]);

    }

    public function editProfile(){

        # Authenticate User
        if(! Auth::check()){
            return Redirect::to('/login');
        }

        $user = User::find(Auth::user()->id);

        if(Input::get('ocn') == "0"){

            Session::flash('error_message', 'OCN cannot be zero!');
            return Redirect::back()->withInput();

        }

        $user->ocn = Input::get('ocn');
        $user->assignee = Input::get('assignee');
        $user->save();

        Session::flash('success_message', 'Edit Saved!');
        return Redirect::to('/manager');

    }

    public function showManageAdminView(){

        # Authenticate User
        if(! Auth::check()){
            return Redirect::to('/login');
        }

        $user = Auth::user();

        if($user->type == 'numadmin'){

            return Redirect::to('/numadmin');

        }else if ($user->type == 'system'){

            return Redirect::to('/system');
        }

        $admins = User:: where('type', '!=', 'system')->get();
        return View::make('manager.manage', ['admins' => $admins]);

    }

    public function showAddAdminView(){

        # Authenticate User
        if(! Auth::check()){
            return Redirect::to('/login');
        }

        $user = Auth::user();

        if($user->type == 'numadmin'){

            return Redirect::to('/numadmin');

        }else if ($user->type == 'system'){

            return Redirect::to('/system');
        }


        return View::make('manager.add');

    }

    public function addAdmin(){

        $user = Auth::user(); #get user


        #Check if an admin user with the input email already exists
        if(User::where('email', '=', Input::get('email'))->count() > 0){
            Session::flash('error_message', 'Fatal Error! Admin with this email already exists!');
            return Redirect::back();
        }

        #Generate a random access code for email verification
        $accesscode = Str::random(5);

        $type = Input::get('type');

        #create user with access code and email ID
        User::create([
            'email' => Input::get('email'),
            'accesscode' => $accesscode,
            'type' => $type ,
            'verified' => 'No'
        ]);

        #Send the new user an email with accesscode
        $email_data = [
            'recipient' => Input::get('email'),
            'subject' => 'Num-Alloc:Registration Code'
        ];

        if($type == 'number'){
            $role = 'Number Admin';
        }else {
            $role = 'OCN Manager';
        }

        $view_data = [
            'accesscode' => $accesscode,
            'role' => $role
        ];

        Mail::send('emails.verify', $view_data, function($message) use ($email_data){
            $message->to($email_data['recipient'])
                ->subject($email_data['subject']);
        });

        #return to manage page
        Session::flash('success_message', "Admin successfully created!");
        return Redirect::to('/manager/manage');

    }


    public function deleteAdmin($id){

        # Authenticate User
        if(! Auth::check()){
            return Redirect::to('/login');
        }

        #Admin cannot delete themselves
        $user = Auth::user();


        if($user->id == $id){
            Session::flash('error_message', 'You cannot delete yourself!');
            return Redirect::back();
        }

        #User must be of Admin type to be able to manage other admin

        if($user->type == 'number'){
            Session::flash('error_message', "You Don't have access rights to Delete Admin");
            return Redirect::back();
        }

        #delete admin with user id = $id
        $admin = User::find($id);
        $admin->delete();

        Session::flash('success_message', "Admin successfully deleted!");
        return Redirect::to('/manager/manage');
    }


}
