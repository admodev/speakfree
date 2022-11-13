@inject( 'response', 'Illuminate\Http\Response' )
@extends('layouts.app')

@section('head')
  @section('title', 'SpeakFree - HOME')

  @section('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
  @endsection

  @section('scripts')
  @endsection
@endsection

@section('content')
    <div>
      @if (!empty(Request()->responseMessage))
        @foreach(Request()->responseMessage as $message)
          @php
            Log::info($message['success']);
          @endphp
        @endforeach
      @endif
      @if (!empty(Request()->userToken))
        @foreach(Request()->userToken as $token)
          @php
            Log::info($token['access_token']);
          @endphp
        @endforeach
      @endif
      <h1>SpeakFree</h1>
      <h3>Welcome to the free social network for freedom of expression.</h3>
    </div>
@endsection
