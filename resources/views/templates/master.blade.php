<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Investindo</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">

  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  @yield('css-view')
</head>
<body>
  @if(!isset($page))
    @include('templates.menu-lateral')
  @else
    <style>
      #view-content {
        padding: 0 20px 20px 240px;
      }
    </style>
  @endif

  <section id="view-content">
    <span id="salutation">
      @if(!is_null(\Auth::user()))
        Olá {{\Auth::user()->name}}
      @endif
      <a href="{{ route('user.logout') }}"><i class="fa fa-sign-out-alt" title="Sair" style=""></i></a>
    </span>

    @yield('content-view')
  </section>

  @yield('js-view')
</body>
</html>
