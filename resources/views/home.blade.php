@extends('layouts.app')

@section('content')
    <h2 class=" text-center">SIParma Dashboard</h2>
    <br>
    <div class="row" style=" heights: 1080px ">
        <div class="col bg-warning rounded shadow">
            <div class="container">
                <br>
                <h4 class="text-light text-center">OPEN</h4>
                <br>
                @foreach ($report as $rp)
                    @if ($rp->report_status == 'open')
                        <div class="card rounded shadow">
                            <div class="card-header text-center">
                                <p> <b>ID Moban : {{ $rp->id }}</b> </p>
                            </div>
                            <button class="btn btn-light" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $rp->id }}" aria-expanded="false"
                                aria-controls="collapse{{ $rp->id }}">
                                Detail
                            </button>
                            </p>
                            <div class="collapse" id="collapse{{ $rp->id }}">
                                <div class="card-body">
                                    <p>Jenis Order : {{ $rp->report_type }}</p>
                                    <p>No SC : {{ $rp->report_number }}</p>
                                    <p>Deskripsi : {{ $rp->report_value }} , {{ $rp->report_detail }}</p>
                                    <p>Pelapor :
                                        <a href="https://t.me/{{ $rp->report_sender }}" target="_blank"
                                            rel="noopener noreferrer">{{ $rp->report_sender }} </a>
                                    </p>
                                    <p>Update by : {{ $rp->report_updateby }}</p>
                                    <p>Tanggal Waktu Buat : {{ $rp->created_at }}</p>
                                    <p>Tanggal Waktu Update : {{ $rp->updated_at }}</p>
                                </div>
                            </div>
                            <div class="card-body">
                                <p>Status : {{ $rp->report_status }}</p>
                            </div>
                            <div class="card-footer text-center">
                                <div class="row">
                                    <div class="col">
                                        <a class="btn btn-primary btn-block "
                                            href="{{ route('report.edit', $rp->id) }}">Update !</a>
                                    </div>
                                    <div class="col">
                                        <form action="{{ route('report.destroy', $rp->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-block"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endif
                @endforeach
                <br>
            </div>
        </div>
        <div class="col bg-info rounded shadow">
            <div class="container">
                <br>
                <h4 class="text-light text-center">OGP</h4>
                <br>
                @foreach ($report as $rp)
                    @if ($rp->report_status == 'ogp')
                        <div class="card rounded shadow">
                            <div class="card-header text-center">
                                <p> <b>ID Moban : {{ $rp->id }}</b> </p>
                            </div>
                            <button class="btn btn-light" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $rp->id }}" aria-expanded="false"
                                aria-controls="collapse{{ $rp->id }}">
                                Detail
                            </button>
                            </p>
                            <div class="collapse" id="collapse{{ $rp->id }}">
                                <div class="card-body">
                                    <p>Jenis Order : {{ $rp->report_type }}</p>
                                    <p>No SC : {{ $rp->report_number }}</p>
                                    <p>Deskripsi : {{ $rp->report_value }} , {{ $rp->report_detail }}</p>
                                    <p>Pelapor :
                                        <a href="https://t.me/{{ $rp->report_sender }}" target="_blank"
                                            rel="noopener noreferrer">{{ $rp->report_sender }} </a>
                                    </p>
                                    <p>Update by : {{ $rp->report_updateby }}</p>
                                    <p>Tanggal Waktu Buat : {{ $rp->created_at }}</p>
                                    <p>Tanggal Waktu Update : {{ $rp->updated_at }}</p>
                                </div>
                            </div>
                            <div class="card-body">
                                <p>Status : {{ $rp->report_status }}</p>
                            </div>
                            <div class="card-footer text-center">
                                <div class="row">
                                    <div class="col">
                                        <a class="btn btn-primary btn-block "
                                            href="{{ route('report.edit', $rp->id) }}">Update !</a>
                                    </div>
                                    <div class="col">
                                        <form action="{{ route('report.destroy', $rp->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-block"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endif
                @endforeach
                <br>
            </div>
        </div>
        <div class="col bg-primary rounded shadow">
            <div class="container">
                <br>
                <h4 class="text-light text-center">ESKALASI</h4>
                <br>
                @foreach ($report as $rp)
                    @if ($rp->report_status == 'eskalasi')
                        <div class="card rounded shadow">
                            <div class="card-header text-center">
                                <p> <b>ID Moban : {{ $rp->id }}</b> </p>
                            </div>
                            <button class="btn btn-light" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $rp->id }}" aria-expanded="false"
                                aria-controls="collapse{{ $rp->id }}">
                                Detail
                            </button>
                            </p>
                            <div class="collapse" id="collapse{{ $rp->id }}">
                                <div class="card-body">
                                    <p>Jenis Order : {{ $rp->report_type }}</p>
                                    <p>No SC : {{ $rp->report_number }}</p>
                                    <p>Deskripsi : {{ $rp->report_value }} , {{ $rp->report_detail }}</p>
                                    <p>Pelapor :
                                        <a href="https://t.me/{{ $rp->report_sender }}" target="_blank"
                                            rel="noopener noreferrer">{{ $rp->report_sender }} </a>
                                    </p>
                                    <p>Update by : {{ $rp->report_updateby }}</p>
                                    <p>Tanggal Waktu Buat : {{ $rp->created_at }}</p>
                                    <p>Tanggal Waktu Update : {{ $rp->updated_at }}</p>
                                </div>
                            </div>
                            <div class="card-body">
                                <p>Status : {{ $rp->report_status }}</p>
                            </div>
                            <div class="card-footer text-center">
                                <div class="row">
                                    <div class="col">
                                        <a class="btn btn-primary btn-block "
                                            href="{{ route('report.edit', $rp->id) }}">Update !</a>
                                    </div>
                                    <div class="col">
                                        <form action="{{ route('report.destroy', $rp->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-block"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endif
                @endforeach
                <br>
            </div>
        </div>
        <div class="col bg-success rounded shadow">
            <div class="container">
                <br>
                <h4 class="text-light text-center">CLOSED</h4>
                <br>
                @foreach ($report as $rp)
                    @if ($rp->report_status == 'closed')
                        <div class="card rounded shadow">
                            <div class="card-header text-center">
                                <p> <b>ID Moban : {{ $rp->id }}</b> </p>
                            </div>
                            <button class="btn btn-light" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse{{ $rp->id }}" aria-expanded="false"
                                aria-controls="collapse{{ $rp->id }}">
                                Detail
                            </button>
                            </p>
                            <div class="collapse" id="collapse{{ $rp->id }}">
                                <div class="card-body">
                                    <p>Jenis Order : {{ $rp->report_type }}</p>
                                    <p>No SC : {{ $rp->report_number }}</p>
                                    <p>Deskripsi : {{ $rp->report_value }} , {{ $rp->report_detail }}</p>
                                    <p>Pelapor :
                                        <a href="https://t.me/{{ $rp->report_sender }}" target="_blank"
                                            rel="noopener noreferrer">{{ $rp->report_sender }} </a>
                                    </p>
                                    <p>Update by : {{ $rp->report_updateby }}</p>
                                    <p>Tanggal Waktu Buat : {{ $rp->created_at }}</p>
                                    <p>Tanggal Waktu Update : {{ $rp->updated_at }}</p>
                                </div>
                            </div>
                            <div class="card-body">
                                <p>Status : {{ $rp->report_status }}</p>
                            </div>
                            <div class="card-footer text-center">
                                <div class="row">
                                    <div class="col">
                                        <a class="btn btn-primary btn-block "
                                            href="{{ route('report.edit', $rp->id) }}">Update !</a>
                                    </div>
                                    <div class="col">
                                        <form action="{{ route('report.destroy', $rp->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-block"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endif
                @endforeach
                <br>
            </div>
        </div>
    </div>

@endsection
