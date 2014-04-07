@extends('layout')

@section('content')
  <h2>Welcome to the forum page {{ Auth::user()->username }}!</h2>
  <p>You have the id: {{ Auth::user()->id }}</p>
@stop