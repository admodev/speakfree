@inject( 'response', 'Illuminate\Http\Response' )
@extends('layouts.app')

@section('head')
  @section('title', 'SpeakFree - SIGNUP')

  @section('styles')
    <link rel="stylesheet" href="{{ asset('css/signup.css') }}">
  @endsection
  @section('scripts')
  @endsection
@endsection

@section('content')
  <div class="mainContainer">
    @if (!empty(Request()->error))
      @foreach(Request()->error as $err)
          <div class="alert alert-error">
            Error Creating Your Account!
          </div>
      @endforeach
    @endif
    <h1>Signup</h1>
    <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('api/v1/user')}}">
      @csrf
      <div class="form-group">
        <input type="name" id="name" name="name" placeholder="Your Name" class="form-control" required="true">
      </div>
      <div class="form-group">
        <input type="last_name" id="last_name" name="last_name" placeholder="Your Last Name" class="form-control" required="true">
      </div>
      <div class="form-group">
        <input type="email" id="email" name="email" placeholder="email@example.com" class="form-control" required="true">
      </div>
      <div class="form-group">
        <input type="password" id="password" name="password" placeholder="password12345678" class="form-control" required="true">
      </div>
      <div class="form-group">
        <input type="phone_number" id="phone_number" name="Phone" placeholder="Your Phone Number (optional)" class="form-control" required="true">
      </div>
      <div class="buttonRow">
        <button onclick="history.back()">
          Go back
        </button>
        <button type="submit" class="btn btn-primary">
          Submit
        </button>
      </div>
    </form>
  </div>
@endsection
