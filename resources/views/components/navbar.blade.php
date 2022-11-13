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
  <a href="/signup">
    Register
  </a>
  @if(!empty(session()->get('token')))
    <button class="accountButton">
      Account
    </button>
  @endif
</header>
