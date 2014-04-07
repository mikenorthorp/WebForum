@extends('layout')
<!-- Load the layout template above -->

<!-- Label section for content -->
@section('content')
    <h1>Login</h1>

    <!-- See if there was error from filters -->
    @if (Session::has('flash_error'))
        <div id="flash_error">{{ Session::get('flash_error') }}</div>
    @endif

    <!-- Set up a login post form -->
    {{ Form::open(array('url' => 'login', 'method' => 'post')) }}

    <!-- Username -->
    <p>
        {{ Form::label('username', 'Username', array('class' => 'login')) }} <br/>
        {{ Form::text('username'); }}
    </p>

    <!-- Password -->
    <p>
        {{ Form::label('password', 'Password', array('class' => 'login')) }} <br/>
        {{ Form::password('password') }}
    </p>

    <!-- Submit button-->
    <p>{{ Form::submit('Login') }}</p>

    <!-- Close the form -->
    {{ Form::close() }}
@stop