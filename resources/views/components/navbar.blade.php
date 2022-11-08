<head>
  <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
</head>
<header class="navbar" id="navbar">
  <a href="/">
    Home
  </a>
  <a href="/login">
    Login
  </a>
  <a href="/register">
    Register
  </a>
  @if(session()->get('token'))
  <a href="/account">
    Account
  </a>
  @endif
</header>
