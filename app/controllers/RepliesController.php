<?php

// Handles requests for replies
class RepliesController extends BaseController {

	// This saves a reply 
	public function store()
	{
		// Save a new reply to server
		// Ungaurd to create a reply properly.. hacky.
		Eloquent::unguard();

		// Create the reply
		Replies::create(array(
	        'reply_content' => Input::get('reply_content'),
	        'topic_id' => Input::get('topic_id'),
	        'created_by' => Input::get('created_by'),
        ));

		// Return back to page user was on so looks like page updates
		return Redirect::back()
		        ->with('flash_notice', 'New post created!');
	}

	// This allows deletion of a reply
	public function destroy()
	{
		// Check to make sure it is admin to delete
		if(Auth::user()->id == 1) {
			// get the id of the topic from the form input
			$reply_id = Input::get('reply_id');

			// Delete the reply with the id passed in
			Replies::find($reply_id)->delete();

			// Go back to member area
			return Redirect::back()
		        ->with('flash_notice', 'Reply deleted sucessfully!');
		} else {
			// display notice saying user cant delete (user shouldnt get here unless they spoof request)
			return Redirect::route('topics.index')
		        ->with('flash_error', 'You do not have permission to delete anything!');
		}
	}
}