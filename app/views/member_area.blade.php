@extends('layout')

@section('content')
  <h2>Welcome to the Forum Page {{ Auth::user()->username }}!</h2>
  <p>Your user id is: {{ Auth::user()->id }}</p>

  <div class="container">
  	<table class="table">
    <!-- Go through each topic object passed in -->
	@foreach($topics as $topic)	
		<!-- Create a table to display forum links -->
		<tr> 
			<!-- Link to a topic -->
			<td> {{ link_to('topics/' . $topic->id, $topic->topic_name . ' -- ' . $topic->topic_desc) }} </td>
			<!-- Create another row if the user is an admin -->
		</tr> 
	@endforeach	
	<table class="table">		
  </div>
		
@stop