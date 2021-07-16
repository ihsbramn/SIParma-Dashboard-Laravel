<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="margin: 0px; padding: 0px; overflow-x:hidden">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta')
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{!! url('/js/jquery.min.js') !!}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- Styles -->
    <link rel="shortcut icon" href="{{ url('images/favicon.png') }}">
    <link rel="icon" type="image/png" href="{{ url('images/favicon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body onload=display_ct();
    style="background-color: rgb(235, 235, 235); margin: 0px; padding: 0px; overflow-x:hidden; font-family: 'Poppins', sans-serif;">
    <div id="app">
        <!--nav-->
        <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-danger shadow">
            <div class="container">
                <div class="div-navbar-header md-auto">
                    <a class="navbar-brand" href="{{ url('/home') }}" style="font-weight: 600">
                        {{-- <img src="{{ url('images/siparma_logo.png') }}" alt="logo" width="180px"> --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                            class="bi bi-pencil-square" viewBox="0 0 16 16" style="margin-bottom: 5px">
                            <path
                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd"
                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                        </svg>
                        SIParma
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                @guest
                    @if (Route::has('login'))

                    @endif

                    @if (Route::has('register'))

                    @endif

                @else
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav nav-left">
                            <li class="nav-item {{ Route::currentRouteNamed('home') ? 'active' : '' }}">
                                <a class="nav-link {{ Route::currentRouteNamed('home.*', 'home') ? 'active' : '' }}"
                                    aria-current="page" href="{{ route('home') }}">Dashboard</a>
                            </li>
                            @auth
                                @if (Auth::user()->admin == 1)
                                    <li class="nav-item">
                                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">|</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Route::currentRouteNamed('report.*') ? 'active' : '' }}"
                                            href="{{ route('report.index') }}">Report Data</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">|</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ Route::currentRouteNamed('user.*') ? 'active' : '' }}"
                                            href="{{ route('user.index') }}">Performansi</a>
                                    </li>
                                @endif
                            @endauth
                        </ul>
                    </div>

                @endguest
                <div class="collapse d-flex" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::currentRouteNamed('login') ? 'active' : '' }}"
                                        href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::currentRouteNamed('register') ? 'active' : '' }}"
                                        href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link active" href="#">Hi, {{ Auth::user()->name }}</a>
                            </li>

                            <li class="nav-item">
                                @auth

                                    <a style="margin-left: 15px" class="btn btn-outline-light" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                @endauth
                            </li>

                            {{-- <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Hi, {{ Auth::user()->name }}
                                </a>


                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @auth
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                            {{ __('Logout') }}
                                        </a> --}}
                            {{-- @if (Auth::user()->admin == 1)
                                            <a class="dropdown-item" href="{{ route('report.index') }}">
                                                Report
                                            </a>
                                        @endif --}}
                            {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    @endauth

                                </div>
                            </li> --}}
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @if (Route::currentRouteNamed('report.*'))
            <nav class="navbar navbar-expand-lg py-0 navbar-dark bg-secondary">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteNamed('report.index', 'report.search*', 'report.datefilter') ? 'active' : '' }} py-0"
                                    href="{{ route('report.index') }}">all</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteNamed('report.open', 'report.datefilter.open*') ? 'active' : '' }} py-0"
                                    href="{{ url('report.open') }}">open</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteNamed('report.ogp', 'report.datefilter.ogp*') ? 'active' : '' }} py-0"
                                    href="{{ url('report.ogp') }}">ogp</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteNamed('report.eskalasi', 'report.datefilter.eskalasi*') ? 'active' : '' }} py-0"
                                    href="{{ url('report.eskalasi') }}">eskalasi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteNamed('report.closed', 'report.datefilter.closed*') ? 'active' : '' }} py-0"
                                    href="{{ url('report.closed') }}">closed</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        @endif

        <main>
            <div class="container">
                <br>
                <h2 class="text-center">Performansi</h2>
                <br>
                <div class="row bg-white shadow " style="border-radius: 1rem;">
                    <div class="col-6 col-md-4 bg-white shadow" style="border-radius: 1rem;">
                        @yield('user')
                    </div>
                    <div class="col-md-8 ">
                        @yield('isi')
                    </div>
                    <br>
                </div>
                <br>
        </main>
        <div style="position: bottom; 
        margin-bottom: 20px; 
        margin-left: auto;
        margin-right: auto;
        left: 0;
        right: 0;
        text-align: center;">
            © 2021 Copyright
            <a id="footer" class=" text-dark" href="{{ url('/') }}">SIParma</a>
        </div>
    </div>
    @yield('script')
</body>

</html>
