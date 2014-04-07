@extends('layout')

@section('content')
  <h2>Welcome to the topic page {{ Auth::user()->username }}!</h2>
  <p>Your user id is: {{ Auth::user()->id }}</p>

  <div class="container">
  	<table class="table">
	  	<!-- Topic name and description -->
	  	<h2> {{ $topics->topic_name }} </h2>
	  	<h4> {{ $topics->topic_desc }} <h3>
	  	</br>

	  	<!-- Topic headers -->
	  	<tr>
	  		<th> Reply Content </th>
	  		<th> Created At </th>
	  		<th> Created By </th>
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
			</tr> 
		@endforeach	
	</table>	
  </div>
		
@stop