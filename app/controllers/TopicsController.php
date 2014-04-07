<?php

// This handles all requests for a topic which includes
// showing main topic page, showing an single topic with posts,
// creating a topic, saving a new topic and destroying a topic
class TopicsController extends BaseController {

	// What to do on a basic get request show all forums
	public function index()
	{
		// Store all the topic rows into a variable
		$topics = Topics::all();
		// Call the member area view to show all forums
		// pass int the forums variable
		return View::make('member_area', array('topics' => $topics));
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
		// Get the forum with the ID passed in
		$topics = Topics::find($topic_id);

		// Get all users to link to posts
		$users = User::all();

		// Get all replies accoiated with this forum and pass them into the view
		// Select all replies where topic_id = topic id of the topic selected
		$replies = DB::table('replies')->where('topic_id', '=',  $topics->id)->get();

		// Go to the view topic view
		return View::make('view_topic', array('topics' => $topics, 'replies' => $replies, 'users' => $users));
	}

	// This allows deletion of a forum and all the topics inside it
	public function destroy()
	{
		// Check to make sure it is admin to delete
		if(Auth::user()->id == 1) {
			// get the id of the topic from the form input
			$topic_id = Input::get('topic_id');
			// Cannot delete initial topic so display notice
			if($topic_id == 1) {
				return Redirect::route('topics.index')
	            	->with('flash_error', 'Cannot delete initial topic.');
			} else { // Delete if not initial topic
				// Delete any replies that have the topic id
				DB::table('replies')->where('topic_id', '=', $topic_id)->delete();

				// Delete the topic with the id passed in
				Topics::find($topic_id)->delete();

				// Go back to member area
				return Redirect::route('topics.index')
			        ->with('flash_notice', 'Deleted topic sucessfully!');
			}
		} else {
			// display notice saying user cant delete (user shouldnt get here unless they spoof request)
			return Redirect::route('topics.index')
		        ->with('flash_error', 'You do not have permission to delete anything!');
		}
	}
}