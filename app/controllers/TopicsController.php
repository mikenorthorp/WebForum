<?php

// This handles all requests for a topic which includes
// showing main topic page, showing an single topic with posts,
// creating a topic, saving a new topic and destroying a topic
class TopicsController extends BaseController {

	// What to do on a basic get request show all forums
	public function index()
	{
		// Call the member area view to show all forums
		return View::make('member_area');
	}

	// What do show on the create page
	public function create()
	{	
		// Call the forum create view to create a view
		return View::make('forum_create');
	}

	// The post request of the index to create a new topic/forum
	public function store()
	{
		// Make a rule to make sure topic name isnt already created
		$rules = array('topic_name' => 'unique:topics,topic_name');

		 // Get the value from the form to pass into validation function
		$input['topic_name'] = Input::get('topic_name');

		// Set up validator to check DB with the rule set and the input of username
		$forumValidator = Validator::make($input, $rules);

		// If the validator fails redirect to register page and display an error
		if ($forumValidator->fails()) {
			return Redirect::route('topics.create')
	            ->with('flash_error', 'That forum name already exists, please choose another.');
		}
		// Register a new user, authenticate them 
		else {
			// Ungaurd to create a user properly.. hacky.
			Eloquent::unguard();

			// Create the user
			Topics::create(array(
		        'topic_name' => Input::get('topic_name'),
		        'topic_desc' => Input::get('topic_desc')
	        ));

			// Redirect and display a notice to tell them it worked
	        return Redirect::route('topics.index')
	            ->with('flash_notice', 'You have created a new forum');
		}
	}

	// This shows the individual forum with all posts linked to the forum
	public function show($topic_id)
	{
		return View::make('member_area');
	}

	// This allows deletion of a forum
	public function destroy($topic_id)
	{
		// Check to make sure it is admin to delete
		if(Auth::user()->id == 1) {
			// Delete code 
			
		} else {
			// display notice saying user cant delete
		}
		// Go back to member area
		return View::make('member_area');
	}


}