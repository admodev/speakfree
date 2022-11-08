@extends('layouts.app')

@section('head')
  @section('title', 'SpeakFree - LOGIN')

  @section('styles')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  @endsection
  @section('scripts')
  @endsection
@endsection

@section('content')
  <div>
    <h1>Login</h1>
    <form method="post" class="loginForm">
      <input type="email" name="emailInput" id="emailInput">
      <input type="password" name="passwordInput" id="passwordInput">
      <button type="submit">Enter</button>
      <button onclick="history.back()">
        Go back
      </button>
    </form>
  </div>
@endsection
