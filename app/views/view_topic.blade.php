@extends('layout')

@section('content')
  <h2>Welcome to the topic page {{ Auth::user()->username }}!</h2>
  <p>Your user id is: {{ Auth::user()->id }}</p>

  <div class="container">
  	<!-- Topic name and description -->
  	<div class="panel panel-default">
  	<div class="panel-heading"> {{ $topics->topic_name }} </div>
  	<div class="panel-heading"> {{ $topics->topic_desc }} </div>

  	<table class="table">
	  	<!-- Topic headers -->
	  	<tr>
	  		<th> Reply Content </th>
	  		<th> Created At </th>
	  		<th> Created By </th>
	  		<!-- Show delete header if admin -->
	  		@if( Auth::user()->id == 1) 
				<th> Delete </th>
			@endif
	  	</tr>

	    <!-- Go through each reply object passed in -->
		@foreach($replies as $reply)	
			<!-- Create a table to display each reply-->
			<tr> 
				<!-- Show a reply -->
				<td> {{ $reply->reply_content }} </td>
				<!-- Show when created -->
				<td> {{ $reply->created_at }} </td>
				<!-- Show the user that created it -->
				<td> {{ User::find($reply->created_by)->username }} </td>
				<!-- Show delete button if admin -->
				@if( Auth::user()->id == 1) 
					<td>
					<!-- Citation Salman in class, said to use form instead of url method to delete things -->
					<!-- so I used that idea -->
					{{ Form::open(array('route' => 'replies.destroy', 'method' => 'delete')) }}
					 <!-- Pass in a hidden field with reply id -->
				 	{{ Form::hidden('reply_id', $reply->id) }}
				 	<!-- Create a delete button -->
				 	{{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
				 	<!-- Close the forum -->
					{{ Form::close() }}
					</td>
				@endif
			</tr> 
		@endforeach	
	</table>	

	<!-- Box to write a reply in
	<!-- Set up a reply form -->
    {{ Form::open(array('url' => 'replies', 'method' => 'post')) }}

    <!-- Reply Content -->
    <p>
        {{ Form::label('reply_content', 'Reply Here', array('class' => 'label label-info')) }} <br/>
        {{ Form::textarea('reply_content'); }}
    </p>

    <!-- Topic id-->
    <p>
        {{ Form::hidden('topic_id', $topics->id); }}
    </p>

    <!-- Created By -->
    <p>
        {{ Form::hidden('created_by', Auth::user()->id); }}
    </p>

    <!-- Submit button-->
    <p>{{ Form::submit('Reply', array('class' => 'btn btn-primary')); }}</p>

    <!-- Close the form -->
    {{ Form::close() }}

    </div>
  </div>
		
@stop