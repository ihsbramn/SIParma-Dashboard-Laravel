@extends('layouts.app')

@section('content')

    <h2 class=" text-center">SIParma Dashboard</h2>

    <br>
    <div class="row">
        <div class="col bg-warning rounded shadow">
            <div class="container">
                <br>
                <h4 class="text-light text-center">OPEN</h4>
                <br>
                @foreach ($report as $rp)
                    <div class="card rounded shadow">
                        <div class="card-header text-center">
                            <p> <b>ID Report : {{ $rp->id }}</b> </p>
                        </div>
                        <div class="card-body">
                            <p>Judul Report : {{ $rp->report_title }}</p>
                            <p>Isi Report : {{ $rp->report_value }}</p>
                            <p>Status : {{ $rp->report_status }}</p>
                            <p>Tanggal Waktu : {{ $rp->created_at }}</p>
                        </div>
                        <div class="card-footer text-center">
                            <div class="btn btn-primary"> Update!</div>
                        </div>
                    </div>
                    <br>
                @endforeach
                <br>
            </div>
        </div>
        <div class="col bg-info rounded shadow">
            <br>
            <h4 class="text-light text-center">OGP</h4>
        </div>
        <div class="col bg-primary rounded shadow">
            <br>
            <h4 class="text-light text-center">ESKALASI</h4>
        </div>
        <div class="col bg-success rounded shadow">
            <br>
            <h4 class="text-light text-center">CLOSED</h4>
        </div>
    </div>

@endsection
