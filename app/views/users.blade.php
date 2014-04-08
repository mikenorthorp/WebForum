@extends('layout')

@section('content')
  <h2>Welcome to the Users Page {{ Auth::user()->username }}!</h2>
  <p>Your user id is: {{ Auth::user()->id }}</p>

<!-- See if there was error from filters -->
@if (Session::has('flash_error'))
		 <div class="flash_error alert alert-danger">{{ Session::get('flash_error') }}</div>
@endif

  <div class="container">
  	<table class="table">
    <!-- Go through each topic object passed in -->
	@foreach($users as $user)	
		<!-- Create a table to display forum links -->
		<tr> 
			<!-- Show each username -->
			<td> {{ $user->username }} </td>
				<!-- Make a form button to delete if user is admin -->
				<!-- Citation from Salman in class who told me to use a form with a hidden field for this since
			 	 I couldnt get delete working with a url (same with other deletes)-->
				<td> {{ Form::open(array('route' => 'user.destroy', 'method' => 'delete')) }}
					 <!-- Pass in a hidden field with topic id -->
					 {{ Form::hidden('user_id', $user->id) }}
					 <!-- Create a delete button -->
					 {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
					 <!-- Close the forum -->
					 {{ Form::close() }}
				</td>
		</tr> 
	@endforeach	
	<table class="table">		
  </div>
		
@stop