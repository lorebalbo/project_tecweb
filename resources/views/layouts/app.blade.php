<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>R.A.S.</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    @guest
        <style>
            .bg-immagin {
                background-color: black;
            }
            .container-bg {
                width: 100%;
                padding: 0;
                background-color: black;
                
            }
            .container-bg>.overlay-bg>img {
                position: fixed;
                width: 100%;
                opacity:0.5;
                
            }
            .container-bg>.overlay-bg {
                width: 100%;
                height: 100%;
                z-index: 3;
                background-color: black;
            }
        </style>
    @endguest

</head>
<body class="bg-immagin">
    
    @guest
        <div class="container-bg">
            <div class="overlay-bg">
                <img src="welcome.jpg" />
            </div>
        </div>
    @endguest    

    <div id="app">
        
        <nav class="navbar navbar-expand-md navbar-dark shadow" style="background-color: #0A3E52;">
            <div class="container">
            @guest
            <a class="navbar-brand" href="{{ url('/') }}">
                    R.A.S.
                </a>
                @endguest
                <!-- Ombra bottone Home
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    
                    <!-- Left Side Of Navbar -->
                    @auth <!-- Controllo se l'utente è loggato -->
                        @if(Auth::User()->is_admin=='1')  <!-- Controllo se l'utente è admin -->
                        <!-- Admin -->
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ URL::action('HomeController@adminHome') }}">Home</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ URL::action('ProjectController@index') }}">Progetti</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ URL::action('ClientController@index') }}">Clienti</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ URL::action('UserController@index') }}">Utenti</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ URL::action('AdminReportController@project_hours') }}">Report Ore Progetti</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ URL::action('AdminReportController@client_hours') }}">Report Ore Clienti</a>
                            </li>
                        </ul>
                        @else
                        <!-- Utente semplice -->
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('home') ? 'active' : ''}}" href="{{ URL::action('HomeController@index') }}">Home</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('report') ? 'active' : ''}}" href="{{ URL::action('ReportController@index') }}">Report Ore</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('work','work/search', 'work/create', 'work/edit') ? 'active' : ''}}" href="{{ URL::action('WorkController@index') }}">Scheda Ore</a>
                            </li>
                        </ul>
                        @endif
                    @endauth

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}" style="background-color: #0A3E52; color:#ffffff; ">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}" style="background-color: #0A3E52; color:#ffffff; ">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<script>

</script>
</html>