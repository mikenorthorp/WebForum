@extends('layout')
<!-- Load the layout template above -->

<!-- Label section for content -->
@section('content')
    <h1>Create Forum</h1>

    <!-- See if there was error from filters -->
    @if (Session::has('flash_error'))
        <div class="flash_error alert alert-danger">{{ Session::get('flash_error') }}</div>
    @endif

    <!-- Set up a forum topics post form -->
    {{ Form::open(array('url' => 'topics', 'method' => 'post')) }}

    <!-- Topic name -->
    <p>
        {{ Form::label('topic_name', 'New Forum Name', array('class' => 'create_forum')) }} <br/>
        {{ Form::text('topic_name'); }}
    </p>

     <!-- Topic desc -->
    <p>
        {{ Form::label('topic_desc', 'New Forum Description', array('class' => 'create_forum')) }} <br/>
        {{ Form::text('topic_desc'); }}
    </p>

    <!-- Submit button-->
    <p>{{ Form::submit('Click Me!'); }}</p>

    <!-- Close the form -->
    {{ Form::close() }}
@stop