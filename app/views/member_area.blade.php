@extends('layout')

@section('content')
  <h2>Welcome to the forum page {{ Auth::user()->username }}!</h2>
  <p>Your user id is: {{ Auth::user()->id }}</p>
@stop