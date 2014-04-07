@extends('layout')
<!-- Load the layout template above -->

<!-- Label section for content -->
@section('content')
    <h1>Register</h1>

    <!-- See if there was error from filters -->
    @if (Session::has('flash_error'))
        <div class="flash_error alert alert-danger">{{ Session::get('flash_error') }}</div>
    @endif

    <!-- Set up a register post form -->
    {{ Form::open(array('url' => 'register', 'method' => 'post')) }}

    <!-- Username -->
    <p>
        {{ Form::label('username', 'Username', array('class' => 'register')) }} <br/>
        {{ Form::text('username'); }}
    </p>

    <!-- Password -->
    <p>
        {{ Form::label('password', 'Password', array('class' => 'register')) }} <br/>
        {{ Form::password('password') }}
    </p>

    <!-- Email -->
    <p>
        {{ Form::label('email', 'Email', array('class' => 'register')) }} <br/>
        {{ Form::text('email'); }}
    </p>

    <!-- Submit button-->
    <p>{{ Form::submit('Register User') }}</p>

    <!-- Close the form -->
    {{ Form::close() }}
@stop