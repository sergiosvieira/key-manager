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

    <title>{{ config('app.name', 'Laravel') }}</title>

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
        <a class="navbar-brand" href="#">IFCE - Controle de Chaves</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Opções">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="btn btn-info" style="margin-right: 5px;" href="{!! url('/sectors'); !!}" role="button">Setores</a>
        <a class="btn btn-info" style="margin-right: 5px;" href="{!! url('/subsectors'); !!}"
            role="button">Subsetores</a>
        <a class="btn btn-info" style="margin-right: 5px;" href="{!! url('/keys'); !!}" role="button">Chaves</a>
        <a class="btn btn-info" style="margin-right: 5px;" href="{!! url('/transactions'); !!}"
            role="button">Entregar/Devolver
            Chaves</a>
            <a class="btn btn-info" style="margin-right: 5px;" href="{!! url('/history'); !!}"
            role="button">Histórico das Chaves</a>
        {{-- <a class="btn btn-info" style="margin-right: 5px;" href="{!! url('/keys'); !!}" role="button">Chaves</a> --}}
        {{-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{!! url('/sectors'); !!}" id="sectorDropdown"
                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Setores
                    </a>
                    <div class="dropdown-menu" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Listar</a>
                        <a class="dropdown-item" href="#">Cadastrar</a>
                    </div>
                </li> <!-- Users DropDown -->

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Usuários
                    </a>
                    <div class="dropdown-menu" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">Listar</a>
                        <a class="dropdown-item" href="#">Cadastrar</a>
                    </div>
                </li> <!-- Users DropDown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="keysDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Chaves
                    </a>
                    <div class="dropdown-menu" aria-labelledby="keysDropdown">
                        <a class="dropdown-item" href="#">Listar</a>
                        <a class="dropdown-item" href="#">Cadastrar</a>
                    </div>
                </li> <!-- Users DropDown -->
                <li class="nav-item">
                    <a class="nav-link" href="#">Retirar Chaves</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Devolver Chves</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i> {{ Auth::user()->name }} </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
            <a class="dropdown-item" href="#">Minha Conta</a>
            <a class="dropdown-item" href="#">Sair</a>
        </div>
        </li>
        </ul>
        </div> --}}
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
