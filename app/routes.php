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

// For login routes followed tutorial and modified it to my needs http://laravelbook.com/laravel-user-authentication/

// Load the login page call the guest filter before to check if user already logged in
Route::get('/', array('as' => 'home', function () { 
	return View::make('login');
}))->before('guest');

// Load the login page, call the guest filter before to check if user already logged in
Route::get('login', array('as' => 'login', function () {
	 return View::make('login');
}))->before('guest');

// Send user info to server and authenticate
Route::post('login', function () {
	// Get the user information
	$user = array(
        'username' => Input::get('username'),
        'password' => Input::get('password')
    );
        
    // Try to authorize user
    if (Auth::attempt($user)) {
    	// Redirect and display a notice
        return Redirect::route('member_area')
            ->with('flash_notice', 'You have been logged in as ' . Auth::user()->username);
    } else {
    	// Redirect to the login route if auth fails
        return Redirect::route('login')
            ->with('flash_error', 'Incorrect username or password, please try again..')
            ->withInput();
    }
});

// Logout the user but check the auth filter before to see if user can see page
Route::get('logout', array('as' => 'logout', function () { 
	// Call the logout method
	Auth::logout();

	// Redirect user to login page on logout
    return Redirect::route('login')
        ->with('flash_notice', 'You have been logged out.');
}))->before('auth');

// Route for the member area which shows the main page with forum topics
// but check to make sure user is authenticated with the filter
Route::get('member_area', array('as' => 'member_area', function () { 
	 return View::make('member_area');
}))->before('auth');

// Define routes for topics and posts
