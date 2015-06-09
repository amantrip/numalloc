<?php

class SystemAdminController extends \BaseController {

    public function showAdminView(){

        # Authenticate User
        if(! Auth::check()){
            return Redirect::to('/login');
        }

        $user = Auth::user(); #get user

        #check user type and make sure the user has rights to access this page else redirect
        if($user->type == 'number'){
            return Redirect::to('/numadmin');
        }else if($user->type == 'privileged'){
            return Redirect::to('/manager');
        }


        $numbers = Number::all();


        return View::make('system.index', ['numbers' => $numbers]);

    }

    public function showResetPasswordView()
    {
        # Authenticate User
        if(! Auth::check()){
            return Redirect::to('/login');
        }

        $user = Auth::user(); #get user

        #check user type and make sure the user has rights to access this page else redirect
        if($user->type == 'number'){
            return Redirect::to('/numadmin');
        }else if($user->type == 'privileged'){
            return Redirect::to('/manager');
        }

        return View:: make('system.reset');
    }

    /*
     * The reset password view POSTS to resetPassword().
     */

    public function resetPassword(){

        $user = Auth:: user();

        #check user type and make sure the user has rights to access this page else redirect
        if($user->type == 'number'){
            return Redirect::to('/numadmin');
        }else if($user->type == 'privileged'){
            return Redirect::to('/manager');
        }

        $admin = User:: find($user->id);


        if(Input::get('newpassword') == Input::get('repassword')){ #validate new password
            $admin->password = Hash::make(Input::get('newpassword'));
            $admin->save();

            Session::flash('success_message', 'Password Reset Successful!');
            return Redirect::to('/system');
        }

        Session::flash('error_message', 'Passwords Entered Do Not Match! Please Re-Try!');
        return Redirect::back();

    }


    public function showEditProfileView(){

        $user = Auth::user();
        #check user type and make sure the user has rights to access this page else redirect
        if($user->type == 'number'){
            return Redirect::to('/numadmin');
        }else if($user->type == 'privileged'){
            return Redirect::to('/manager');
        }

        return View::make('system.edit', ['admin' => $user]);

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
        return Redirect::to('/system');

    }


    public function showManageAdminView(){

        # Authenticate User
        if(! Auth::check()){
            return Redirect::to('/login');
        }

        $user = Auth::user();

        #User must be of Admin type to be able to manage other admin
        if($user->type == 'numadmin'){
            return Redirect::to('/numadmin');
        }else if($user->type == 'privileged'){
            return Redirect::to('/manager');
        }

        $admins = User:: all();
        return View::make('system.manage', ['admins' => $admins]);

    }

    public function showAddAdminView(){

        # Authenticate User
        if(! Auth::check()){
            return Redirect::to('/login');
        }

        $user = Auth::user();

        #User must be of System Admin type to be able to manage other admin
        if($user->type == 'numadmin'){
            return Redirect::to('/numadmin');
        }else if($user->type == 'privileged'){
            return Redirect::to('/manager');
        }

        return View::make('system.add');

    }

    public function addAdmin(){

        $user = Auth::user(); #get user

        #check user type and make sure the user has rights to access this page else redirect
        if($user->type == 'number'){
            return Redirect::to('/numadmin');
        }else if($user->type == 'privileged'){
            return Redirect::to('/manager');
        }

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
        }else if($type == 'privileged'){
            $role = 'OCN Manager';
        }
        else{
            $role = 'System Admin';
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
        return Redirect::to('/system/manage');

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

        if($user->type == 'number' || $user->type == 'privileged'){
            Session::flash('error_message', "You Don't have access rights to Delete Admin");
            return Redirect::back();
        }

        #delete admin with user id = $id
        $admin = User::find($id);
        $admin->delete();

        Session::flash('success_message', "Admin successfully deleted!");
        return Redirect::to('/system/manage');
    }

    public function showOCNView(){

        # Authenticate User
        if(! Auth::check()){
            return Redirect::to('/login');
        }

        $user = Auth::user();
        #check user type and make sure the user has rights to access this page else redirect
        if($user->type == 'number'){
            return Redirect::to('/numadmin');
        }else if($user->type == 'privileged'){
            return Redirect::to('/manager');
        }

        $ocns = OCN::all();

        return View::make('system.ocns', ['ocns' => $ocns]);

    }

    public function showAddOCNView(){

        # Authenticate User
        if(! Auth::check()){
            return Redirect::to('/login');
        }

        $user = Auth::user();
        #check user type and make sure the user has rights to access this page else redirect
        if($user->type == 'number'){
            return Redirect::to('/numadmin');
        }else if($user->type == 'privileged'){
            return Redirect::to('/manager');
        }

        return View::make('system.addocn');

    }

    public function showEditOCNView($id){

        # Authenticate User
        if(! Auth::check()){
            return Redirect::to('/login');
        }

        $user = Auth::user();
        #check user type and make sure the user has rights to access this page else redirect
        if($user->type == 'number'){
            return Redirect::to('/numadmin');
        }else if($user->type == 'privileged'){
            return Redirect::to('/manager');
        }


        $ocn = OCN::find($id);


        return View::make('system.editocn', ['ocn' => $ocn]);

    }

    public function showAreaCodeView(){

        # Authenticate User
        if(! Auth::check()){
            return Redirect::to('/login');
        }

        $user = Auth::user();
        #check user type and make sure the user has rights to access this page else redirect
        if($user->type == 'number'){
            return Redirect::to('/numadmin');
        }else if($user->type == 'privileged'){
            return Redirect::to('/manager');
        }

        $areacodes = AreaCode::all();

        return View::make('system.areacodes', ['areacodes' => $areacodes]);

    }

    public function showAddAreaCodeView(){

        # Authenticate User
        if(! Auth::check()){
            return Redirect::to('/login');
        }

        $user = Auth::user();
        #check user type and make sure the user has rights to access this page else redirect
        if($user->type == 'number'){
            return Redirect::to('/numadmin');
        }else if($user->type == 'privileged'){
            return Redirect::to('/manager');
        }

        return View::make('system.addareacode');

    }

    public function showEditAreaCodeView($id){

        # Authenticate User
        if(! Auth::check()){
            return Redirect::to('/login');
        }

        $user = Auth::user();
        #check user type and make sure the user has rights to access this page else redirect
        if($user->type == 'number'){
            return Redirect::to('/numadmin');
        }else if($user->type == 'privileged'){
            return Redirect::to('/manager');
        }


        $areacode = AreaCode::find($id);


        return View::make('system.editareacode', ['areacode' => $areacode]);
    }


}
