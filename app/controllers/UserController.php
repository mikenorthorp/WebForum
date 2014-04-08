<?php

// This handles all requests for a user to delete, show all
class UserController extends BaseController {

	// Show user page if admin
	public function index()
	{
		// Store all the topic rows into a variable
		$users = User::all();
		// Call the users view if current user is admin
		if(Auth::user()->id == 1) {
			return View::make('users', array('users' => $users));
		}

		// Else tell user they do not have permission to view the page
	 	return Redirect::route('topics.index')
	        ->with('flash_error', 'You do not have permission to view the users page.');
	}

	// This allows deletion of a forum and all the topics inside it
	public function destroy()
	{
		// Check to make sure it is admin to delete
		if(Auth::user()->id == 1) {
			// get the id of the user from the form input
			$user_id = Input::get('user_id');
			// Cannot delete initial user so display notice
			if($user_id == 1) {
				return Redirect::route('user.index')
	            	->with('flash_error', 'Cannot delete initial user.');
			} else { // Delete if not initial user

				// Delete all posts accosiated with the user
				DB::table('replies')->where('created_by', '=', $user_id)->delete();
				// Delete the user with the id passed in
				User::find($user_id)->delete();

				// Go back to user area
				return Redirect::route('user.index')
			        ->with('flash_notice', 'Deleted user and posts sucessfully!');
			}
		} else {
			// display notice saying user cant delete (user shouldnt get here unless they spoof request)
			return Redirect::route('topics.index')
		        ->with('flash_error', 'You do not have permission to delete anything!');
		}
	}
}