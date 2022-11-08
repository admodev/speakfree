@extends('layouts.app')

@section('title', 'SpeakFree - LOGIN')

@section('sidebar')
  @parent
@endsection

@section('content')
  <div>
    <h1>Login</h1>
    <button onclick="history.back()">
      Go back
    </button>
  </div>
@endsection
