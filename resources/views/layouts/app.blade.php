<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Key Manager">
    <meta name="keywords" content="ifce itapipoca key manager">
    <link rel="icon" lhref="{{ asset('favicon.ico')}}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'IFCE - Controle de Chaves') }}</title>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/aquamarine.css') }}">
</head>

<body>
    @guest
    @else
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('img/ifce-brand.png')}}" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="{!! url('/sectors'); !!}" role="button">Setores</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="{!! url('/subsectors'); !!}" role="button">Subsetores</a>
              </li>
              <li class="nav-item active">
                  <a href="{!! url('/keys'); !!}" class="nav-link">Chaves</a>
              </li>
              <li class="nav-item active">
                <a href="{!! url('/transactions'); !!}" class="nav-link">Entregar / Devolver Chaves</a>
              </li>
              <li class="nav-item active">
                <a href="{!! url('/history'); !!}" class="nav-link">Histórico</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user"></i> {{ Auth::user()->name }} 
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
                    <a class="dropdown-item" href="#">Minha Conta</a>
                    <a class="dropdown-item" href="#">Sair</a>
                </div>
              </li>                  
            </ul>
          </div>
    </nav> <!-- Navigator Bar -->
    @endguest
    <!-- <div class="container"> -->
    @include('flash::message')
    @yield('content')
    <!-- </div> -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script> --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</body>

</html>
