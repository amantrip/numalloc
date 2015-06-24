<?php



Route::get('/','HomeController@showIndexView');
/*Route::get('/', function(){
   return Redirect::to('/login');
}); */

//Authentication Routes
Route::get('/login', 'HomeController@showLoginView');
Route::post('/login', 'HomeController@loginUser');

Route::get('/logout', 'HomeController@logout');

Route::get('/forgot', 'HomeController@showForgotPasswordView');
Route::post('/forgot', 'HomeController@sendForgotPassword');

Route::get('/reset', 'HomeController@showResetPasswordView');
Route::post('/reset', 'HomeController@resetPassword');


Route::get('/register', 'HomeController@showRegistrationView');
Route::post('/register', 'HomeController@register');

//OCN Routes
Route::get('/get/ocn/{id}', 'OCNController@getOCN');



// Number Admin User Routes
Route::get('/numadmin', 'NumberAdminController@showAdminView');

Route::get('/numadmin/reset', 'NumberAdminController@showResetPasswordView');
Route::post('/numadmin/reset', 'NumberAdminController@resetPassword');

Route::get('/numadmin/edit', 'NumberAdminController@showEditProfileView');
Route::post('/numadmin/edit', 'NumberAdminController@editProfile');


// OCN Manager or Privileged User Routes

Route::get('/manager', 'OCNManagerController@showAdminView');

Route::get('/manager/reset', 'OCNManagerController@showResetPasswordView');
Route::post('/manager/reset', 'OCNManagerController@resetPassword');

Route::get('/manager/edit', 'OCNManagerController@showEditProfileView');
Route::post('/manager/edit', 'OCNManagerController@editProfile');

Route::get('/manager/manage', 'OCNManagerController@showManageAdminView');
Route::get('/manager/add', 'OCNManagerController@showAddAdminView');
Route::post('/manager/add', 'OCNManagerController@addAdmin');
Route::get('/manager/delete/{id}', 'OCNManagerController@deleteAdmin');


// System Admin User Routes
Route::get('/system', 'SystemAdminController@showAdminView');

Route::get('/system/reset', 'SystemAdminController@showResetPasswordView');
Route::post('/system/reset', 'SystemAdminController@resetPassword');

Route::get('/system/edit', 'SystemAdminController@showEditProfileView');
Route::post('/system/edit', 'SystemAdminController@editProfile');

Route::get('/system/manage', 'SystemAdminController@showManageAdminView');
Route::get('/system/add', 'SystemAdminController@showAddAdminView');
Route::post('/system/add', 'SystemAdminController@addAdmin');
Route::get('/system/delete/{id}', 'SystemAdminController@deleteAdmin');

Route::get('/system/ocns/', 'SystemAdminController@showOCNView');
Route::get('/system/ocns/add', 'SystemAdminController@showAddOCNView');
Route::post('/system/ocns/add', 'OCNController@addOCN');
Route::get('/system/ocns/edit/{id}', 'SystemAdminController@showEditOCNView');
Route::post('/system/ocns/edit', 'OCNController@editOCN');

Route::get('/system/areacodes/', 'SystemAdminController@showAreaCodeView');
Route::get('/system/areacodes/add', 'SystemAdminController@showAddAreaCodeView');
Route::post('/system/areacodes/add', 'AreaCodeController@addAreaCode');
Route::get('/system/areacodes/edit/{id}', 'SystemAdminController@showEditAreaCodeView');
Route::post('/system/areacodes/edit', 'AreaCodeController@editAreaCode');


//Number Related Routes
Route::get('/number/create', 'NumberController@showCreateNumberView');
Route::post('/number/create', 'NumberController@createNumber');

Route::get('/number/create/form/{number}', 'NumberController@showCreateNumberFormView');
Route::post('/number/create/form', 'NumberController@storeNumber');

Route::get('/number/edit/{id}', 'NumberController@showEditNumberView');
Route::post('/number/edit', 'NumberController@editNumber');

Route::get('/number/port', 'NumberController@showPortNumberView');
Route::post('/number/port', 'NumberController@portNumber');

Route::get('/number/log/{number}', 'NumberController@showLogView');

//Subscriber Routes
Route::get('/subscriber', 'SubscriberController@showSubscriberDetailsView');
Route::post('/subscriber', 'SubscriberController@subscriberEditDetails');

Route::get('/subscriber/login', 'SubscriberController@showSubscriberLoginView');
Route::post('/subscriber/login', 'SubscriberController@subscriberLogin');

Route::get('/subscriber/forgot', 'SubscriberController@showSubscriberForgotPasswordView');
Route::post('/subscriber/forgot', 'SubscriberController@subscriberSendForgotPassword');

Route::get('/subscriber/reset', 'SubscriberController@showSubscriberResetPasswordView');
Route::post('/subscriber/reset', 'SubscriberController@subscriberResetPassword');

Route::get('/subscriber/change', 'SubscriberController@showSubscriberChangePasswordView');
Route::post('/subscriber/change', 'SubscriberController@subscriberChangePassword');


//Gossip Protocol Routes

//Route::get('/gossip/create/{number}/{cnam}/{ocn}/{assignee}/{location_zip}/{location}/{otc}/{rao}/{bsp}/{collect}/{alt_spid}/{service_indicator}/{reachability}/{type}/{gusi}/{pin}/{certificate}', 'GossipController@createNumber');

Route::post('/gossip/create', 'GossipController@createNumber');


Route::get('/gossip/edit/{number}/{cnam}/{ocn}/{assignee}/{location_zip}/{location}/{otc}/{rao}/{bsp}/{collect}/{alt_spid}/{service_indicator}/{reachability}/{type}/{gusi}/{pin}', 'GossipController@editNumber');

/*


Route::get('/mail', function(){
   return View::make('emails.mail', ['accesscode'=> 'ABDCD' , 'role' => 'Number Admin']);
});


Route::get('/adduser', function(){
   User::create([
       'email' => 'am4227@columbia.edu',
       'password' => Hash::make('12345'),
       'ocn'    => '0',
       'owner_name' => 'AT&T',
       'type'   => 'system',
       'accesscode' => 'ABCDE'
   ]);
});


Route::get('/addnode', function(){

    NodeList::create([
        'domain'    => 'http://nodec.app:8000/',
        'socket'    => ''
    ]);
});

Route::get('/addnumber', function(){

    Number::create([
        'number'    => '2106396367',
        'owner'     => 'verizon',
        'reachability'  => 'true',
        'type'  => 'mobile'
    ]);

});

*/