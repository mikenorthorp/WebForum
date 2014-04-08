@extends('layout')
<!-- Load the layout template above -->

<!-- Label section for content -->
@section('content')
    <h1>Login</h1>

    <!-- See if there was error from filters -->
    @if (Session::has('flash_error'))
        <div class="flash_error alert alert-danger">{{ Session::get('flash_error') }}</div>
    @endif

    <!-- Set up a login post form -->
    {{ Form::open(array('url' => 'login', 'method' => 'post')) }}

    <!-- Username -->
    <p>
        {{ Form::label('username', 'Username', array('class' => 'label label-info')) }} <br/>
        {{ Form::text('username'); }}
    </p>

    <!-- Password -->
    <p>
        {{ Form::label('password', 'Password', array('class' => 'label label-info')) }} <br/>
        {{ Form::password('password') }}
    </p>

    <!-- Submit button-->
    <p>{{ Form::submit('Login', array('class' => 'btn btn-primary')) }}</p>

    <!-- Close the form -->
    {{ Form::close() }}
@stop