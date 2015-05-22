<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/','HomeController@showIndexView');

//Authentication Routes
Route::get('/login', 'HomeController@showLoginView');
Route::post('/login', 'HomeController@loginUser');

Route::get('/logout', 'HomeController@logout');

Route::get('/forgot', 'HomeController@showForgotPasswordView');
Route::post('/forgot', 'HomeController@sendForgotPassword');

Route::get('/reset', 'HomeController@showResetPasswordView');
Route::post('/reset', 'HomeController@resetPassword');

// Associate User Routes


//Admin User Routes
Route::get('/admin', 'AdminController@showAdminView');
Route::get('/admin/reset', 'AdminController@showResetPasswordView');
Route::post('/admin/reset', 'AdminController@resetPassword');

Route::get('/admin/edit', 'AdminController@ShowEditProfileView');
Route::post('/admin/edit', 'AdminController@editProfile');



//Number Related Routes
Route::get('/number/create', 'NumberController@showCreateNumberView');
Route::post('/number/create', 'NumberController@createNumber');

Route::get('/number/create/form/{number}', 'NumberController@showCreateNumberFormView');
Route::post('/number/create/form', 'NumberController@storeNumber');

Route::get('/number/edit/{id}', 'NumberController@showEditNumberView');
Route::post('/number/edit', 'NumberController@editNumber');

Route::get('/number/port', 'NumberController@showPortNumberView');
Route::post('/number/port', 'NumberController@portNumber');



Route::get('/adduser', function(){
   User::create([
       'email' => 'am4227@columbia.edu',
       'password' => Hash::make('12345'),
       'ocn'    => '2',
       'owner_name' => 'AT&T',
       'type'   => 'admin',
       'accesscode' => 'ABCDE'
   ]);
});
/*

Route::get('/', 'HomeController@showReadView');
Route::post('/', 'HomeController@read');


Route::get('/update/{number}', 'HomeController@showUpdateView');
Route::post('/update/{input_number}', 'HomeController@updateRecord');


Route::get('/new', 'HomeController@requestNewView');
Route::post('/new', 'HomeController@newFormView');

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