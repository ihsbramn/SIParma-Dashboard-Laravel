<!doctype html>
<html lang="en" style="height: 100%">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
    <link rel="shortcut icon" href="{{ url('images/favicon.png') }}">
    <link rel="icon" type="image/png" href="{{ url('images/favicon.png') }}">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-image: linear-gradient(180deg, rgba(237, 237, 237, 1), rgba(231, 45, 35, 1));
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        div.card {
            position: fixed;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            border-radius: 25px;
        }

    </style>

    <title>SIParma Dashboard</title>
</head>

<body style="height: 100%">
    <div class="card shadow mx-auto" style="width: 18rem;">
        <div class="container">
            <br>
            <div class="row">
                <div class="col text-center">
                    <br>
                    <a href="{{ url('/') }}">
                        <img alt="logo" src="{{ url('images/siparma_pp.png') }}" width="250">
                    </a>
                    <br>
                    <br>
                </div>
                <div class="col text-center">
                    @if (Route::has('login'))
                        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                            @auth
                                <a href="{{ url('/home') }}" class="btn btn-primary shadow">Home</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary shadow">Log in</a>
                                @if (Route::has('register'))
                                    {{-- <a href="{{ route('register') }}" class="btn btn-secondary shadow">Register</a> --}}
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
            <br>
        </div>
    </div>
    <div style="position: absolute; 
    bottom: 10px; 
    margin-left: auto;
    margin-right: auto;
    left: 0;
    right: 0;
    text-align: center;">
        © 2021
        <a class=" text-dark" href="{{ url('/') }}">SIParma</a>
        |
        free to use,
        <a class=" text-dark" target="_blank" href="{{ url('https://opensource.org/licenses/MIT') }}">licensed
            under MIT</a>
        |
        <a class=" text-dark" href="{{ url('/contact') }}">Contact
            Developer</a>
    </div>
</body>

</html>
