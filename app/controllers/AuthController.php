<?php

class AuthController extends BaseController {

	// This does the home redirect for /
	public function home() {
		// Direct to the login view
		return View::make('login');
	}

	// This does the redirect for registering
	public function register() {
		return View::make('register');
	}

 	// This allows a user to register
	public function store() {
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
			return Redirect::back()
	            ->with('flash_error', 'That username is already taken, please try again or login.');
		} else if ($emailValidator->fails()) {
			return Redirect::back()
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
	}

	// This allows a user to view the login page
	public function login() {
		return View::make('login');
	}

	// This allows a user to login
	public function login_post() {
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
	        return Redirect::back()
	            ->with('flash_error', 'Incorrect username or password, please try again..')
	            ->withInput();
	    }
	}

	// Allows a user to logout
	public function logout() {
		// Call the logout method
		Auth::logout();

		// Redirect user to login page on logout
	    return Redirect::route('login')
	        ->with('flash_notice', 'You have been logged out.');
	}
}