<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <!-- Fonts -->
  <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <!-- Global styles -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="antialiased">
  @section('navbar')
  <x-navbar />
  @show

  <div class="container relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    @yield('content')
  </div>
</body>

</html>
