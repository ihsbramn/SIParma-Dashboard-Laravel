@extends('layouts.performansi')

@section('user')
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
@endsection
