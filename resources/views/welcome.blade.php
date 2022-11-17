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
      <h1>SpeakFree</h1>
      <h3>Welcome to the free social network for freedom of expression.</h3>
    </div>
@endsection
