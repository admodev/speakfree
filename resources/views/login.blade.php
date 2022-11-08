@inject( 'response', 'Illuminate\Http\Response' )
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
  <div class="mainContainer">
    @if (!empty(Request()->error))
      @foreach(Request()->error as $err)
        @if($err['error'] == 'unauthorized')
          <div class="alert alert-error">
            Wrong Credentials!
          </div>
        @endif
      @endforeach
    @endif
    <h1>Login</h1>
    <form name="add-blog-post-form" id="add-blog-post-form" method="post" action="{{url('api/v1/auth/login')}}">
      @csrf
      <div class="form-group">
        <input type="email" id="email" name="email" placeholder="email@example.com" class="form-control" required="true">
      </div>
      <div class="form-group">
        <input type="password" id="password" name="password" placeholder="password12345678" class="form-control" required="true">
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
