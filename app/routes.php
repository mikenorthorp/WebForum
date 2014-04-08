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

// For basic login routes used parts of login tutorial found here http://laravelbook.com/laravel-user-authentication/
// and heavily modified it. Learned how to use the filters and stuff as well.

// Load main page to the home which goes to login
Route::get('/', array('as' => 'home','uses'=>'AuthController@home'))->before('guest');

// Load the register page 
Route::get('register',  array('as' => 'register','uses'=>'AuthController@register'));

// Send user info to server and create a new user if name not taken
Route::post('register', 'AuthController@store');

// Load the login page, call the guest filter before to check if user already logged in
Route::get('login',  array('as' => 'login','uses'=>'AuthController@login'))->before('guest');

// Send user info to server and authenticate
Route::post('login', 'AuthController@login_post');

// Logout the user but check the auth filter before to see if user can see page
Route::get('logout',  array('as' => 'logout','uses'=>'AuthController@logout'))->before('auth');

// Define routes for topics an make sure user is authenticated before any of the stuff
// wrapped in a route group to make sure only logged in users can access the methods
Route::group(array('before' => 'auth'), function() {
	// Create all methods for topics
	Route::resource('topics', 'TopicsController', array('only' => array('index', 'create', 'store', 'show', 'destroy')));
	// Create all methods for reply (only delete and saving)
	Route::resource('replies', 'RepliesController', array('only' => array('store', 'destroy')));
	// Create all methods for user, user page, and destroy a user
	Route::resource('user', 'UserController', array('only' => array('index', 'destroy')));
});