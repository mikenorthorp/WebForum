@extends('layout')

@section('content')
  <h2>Welcome to the Forum Page {{ Auth::user()->username }}!</h2>
  <p>Your user id is: {{ Auth::user()->id }}</p>

<!-- See if there was error from filters -->
@if (Session::has('flash_error'))
		 <div class="flash_error alert alert-danger">{{ Session::get('flash_error') }}</div>
@endif

  <div class="container">
  	<table class="table">
    <!-- Go through each topic object passed in -->
	@foreach($topics as $topic)	
		<!-- Create a table to display forum links -->
		<tr> 
			<!-- Link to a topic with built in link method -->
			<td> {{ link_to('topics/' . $topic->id, $topic->topic_name . ' -- ' . $topic->topic_desc) }} </td>
			<!-- Make sure user is an admin or they cant delete -->
			@if( Auth::user()->id == 1) 
				<!-- Make a form button to delete if user is admin -->
				<!-- Citation from Salman in class who told me to use a form with a hidden field for this since
			 	 I couldnt get it working with a url -->
				<td> {{ Form::open(array('route' => 'topics.destroy', 'method' => 'delete')) }}
					 <!-- Pass in a hidden field with topic id -->
					 {{ Form::hidden('topic_id', $topic->id) }}
					 <!-- Create a delete button -->
					 {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
					 <!-- Close the forum -->
					 {{ Form::close() }}
				</td>
			@endif
			<!-- Create another row if the user is an admin -->
		</tr> 
	@endforeach	
	<table class="table">		
  </div>
		
@stop