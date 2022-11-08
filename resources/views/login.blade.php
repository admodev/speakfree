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
  <div>
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
        <label for="email">Email</label>
        <input type="email" id="email" name="email" class="form-control" required="true">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" class="form-control" required="true">
      </div>
      <button type="submit" class="btn btn-primary">
        Submit
      </button>
      <button onclick="history.back()">
        Go back
      </button>
    </form>
  </div>
@endsection
