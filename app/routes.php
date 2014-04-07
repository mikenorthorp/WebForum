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
// and modified it. Learned how to use the filters and stuff as well.

// Load the login page call the guest filter before to check if user already logged in
Route::get('/', array('as' => 'home', function () { 
	return View::make('login');
}))->before('guest');

// Load the login page, call the guest filter before to check if user already logged in
Route::get('register', array('as' => 'register', function () {
	 return View::make('register');
}));

// Send user info to server and create a new user if name not taken
Route::post('register', function () {
	// Make a rule to make sure username doesnt exist in the username column of users table
	$rules = array('username' => 'unique:users,username');

	 // Get the value from the form to pass into validation function
	$input['username'] = Input::get('username');

	// Set up validator to check DB with the rule set and the input of username
	$userValidator = Validator::make($input, $rules);

	// Make a rule to make sure email doesnt exist in the email column of users table
	$rules = array('email' => 'unique:users,email');

	 // Get the value from the form to pass into validation function
	$input['email'] = Input::get('email');

	// Set up validator to check DB with the rule set and the input of username
	$emailValidator = Validator::make($input, $rules);

	// If the validator fails redirect to register page and display an error
	if ($userValidator->fails()) {
		return Redirect::route('register')
            ->with('flash_error', 'That username is already taken, please try again or login.');
	} else if ($emailValidator->fails()) {
		return Redirect::route('register')
            ->with('flash_error', 'That email is already taken, please try again or login.');
	}
	// Register a new user, authenticate them 
	else {
		// Ungaurd to create a user properly.. hacky.
		Eloquent::unguard();

		// Create the user
		User::create(array(
	        'username' => Input::get('username'),
	        'password' => Hash::make(Input::get('password')),
	        'email' => Input::get('email')
        ));

        // Get the user information
       	$user = array(
	        'username' => Input::get('username'),
	        'password' => Input::get('password')
	    );

		// Authenticate the user (will be sucessful because we just created user)
		Auth::attempt($user);

		// Redirect and display a notice to tell them it worked
        return Redirect::route('topics.index')
            ->with('flash_notice', 'You have created and logged in as ' . Auth::user()->username);
	}
});

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
        return Redirect::route('topics.index')
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

// Define routes for topics an make sure user is authenticated before any of the stuff
// wrapped in a route group
Route::group(array('before' => 'auth'), function() {
	Route::resource('topics', 'TopicsController', array('only' => array('index', 'create', 'store', 'show', 'destroy')));
});