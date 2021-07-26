@extends('layouts.performansi')

@section('user')
    <div class="row bg-white shadow " style="border-radius: 1rem;">
        <div class="col-6 col-md-4 bg-white shadow" style="border-radius: 1rem;">
            <ul class="nav flex-column">
                <br>
                <h5 class=" text-center"> List User</h5>
                <hr>
                @foreach ($user as $us)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.show', $us->id) }}">{{ $us->name }}</a>
                    </li>
                @endforeach
                <br>
            </ul>
        </div>

    @endsection

    @section('isi')
        <div class="col-md-8" id="PFM">
            <div class="spinner"></div>
            <style>
                .spinner {
                    width: 85px;
                    height: 85px;
                    background-color: #333;

                    margin: 100px auto;
                    -webkit-animation: sk-rotateplane 1.2s infinite ease-in-out;
                    animation: sk-rotateplane 1.2s infinite ease-in-out;
                }

                @-webkit-keyframes sk-rotateplane {
                    0% {
                        -webkit-transform: perspective(120px)
                    }

                    50% {
                        -webkit-transform: perspective(120px) rotateY(180deg)
                    }

                    100% {
                        -webkit-transform: perspective(120px) rotateY(180deg) rotateX(180deg)
                    }
                }

                @keyframes sk-rotateplane {
                    0% {
                        transform: perspective(120px) rotateX(0deg) rotateY(0deg);
                        -webkit-transform: perspective(120px) rotateX(0deg) rotateY(0deg)
                    }

                    50% {
                        transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg);
                        -webkit-transform: perspective(120px) rotateX(-180.1deg) rotateY(0deg)
                    }

                    100% {
                        transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg);
                        -webkit-transform: perspective(120px) rotateX(-180deg) rotateY(-179.9deg);
                    }
                }

            </style>
        </div>
    </div>
@endsection

@section('scrpit')
    <script>

    </script>
@endsection
