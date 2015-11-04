<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/* Basic pages */
Route::get('/', array('as'=>'home', function() {
    return view('home');
}));

Route::get('/about',array('as'=>'about',function() {
	return View('about');
}));

/*Password Update*/
//Route::get('users/forgotpass','Auth\PasswordController');
//Route::controller('password', 'Auth\PasswordController');
Route::get('users/password/email', 'Auth\PasswordController@getEmail'); //password.blade.php
Route::post('users/passwordreset', 'Auth\PasswordController@postEmail'); //action for password.blade.php

// Password reset routes...
Route::get('users/password/reset/{token}', 'Auth\PasswordController@getReset'); //reset.blade.php
Route::post('users/password/reset', 'Auth\PasswordController@postReset'); //action for reset.blade.php

/* User Authentication */
Route::get('users/login', 'Auth\AuthController@getLogin');
Route::post('users/login', 'Auth\AuthController@postLogin');
Route::get('users/logout', 'Auth\AuthController@getLogout');

Route::get('users/register', 'Auth\AuthController@getRegister');
Route::post('users/register', 'Auth\AuthController@postRegister');
Route::get('users/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'Auth\AuthController@confirm'
]);

/* Authenticated users */
Route::group(['middleware' => 'auth'], function() {

    Route::get('users/dashboard', array('as'=>'dashboard', function() {
		return View('users.dashboard');
	}));

	Route::get('users/settings/password', array('as'=>'password_change', function() {
		return View('users.password_change');
	}));

	Route::post('users/settings/password','Auth\AuthController@postAuthReset');
});
