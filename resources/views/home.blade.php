@extends('layouts.app')

@section('meta')
    <meta http-equiv="refresh" content="20">
@endsection

@section('content')
    {{-- <br>
    <h2 class=" text-center">SIParma Dashboard</h2> --}}
    {{-- <br> --}}
    <script type="text/javascript">
        function display_c() {
            var refresh = 1000; // Refresh rate in milli seconds
            mytime = setTimeout('display_ct()', refresh)
        }

        function display_ct() {
            var x = new Date()
            var x1 = x.getMonth() + 1 + "/" + x.getDate() + "/" + x.getFullYear();
            x1 = x1 + " - " + x.getHours() + ":" + x.getMinutes() + ":" + x.getSeconds();
            document.getElementById('ct').innerHTML = x1;
            display_c();
        }
    </script>
    <div class="container">
        <div class="row">
            <div class="col">
            </div>
            <div class="col">
                <p class="text-center alert alert-info shadow" id='ct'></p>
            </div>
            <div class="col">
            </div>
        </div>
        <div class="row">
            <div class="col">
            </div>
            <div class="col">
                <form class="form" method="get" action="{{ route('filter.home') }}">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <select class="form-control" name="filterorder" id="filter-order">
                                    <option value="">Jenis Order</option>
                                    <option value="#AO">#AO</option>
                                    <option value="#GGN">#GGN</option>
                                    <option value="#MO">#MO</option>
                                    <option value="#PDA">#PDA</option>
                                    <option value="#MIG">#MIG</option>
                                </select>
                            </div>
                        </div>
                        <div class="col d-grid">
                            <button type="submit" class="btn btn-danger ">Filter !</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col">
            </div>
        </div>
    </div>
    <br>
    <div class="row bg-transparent" style=" heights: 1080px; padding:20px; padding-top: 0px ">
        <div class="col card border-danger bg-transparent rounded shadow" style="margin: 10px">
            <div class="container" style="padding: 0px">
                <br>
                <h4 class="text-danger text-center">OPEN</h4>

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
                                    <p>Pelapor :
                                        <a href="https://t.me/{{ $rp->report_sender }}" target="_blank"
                                            rel="noopener noreferrer">{{ $rp->report_sender }} </a>
                                    </p>
                                    {{-- <p>Update by : {{ $rp->report_updateby }}</p> --}}
                                    <p>Status : {{ $rp->report_status }}</p>
                                    <p>Tanggal Waktu Buat : {{ $rp->created_at }}</p>
                                    <p>Tanggal Waktu Update : {{ $rp->updated_at }}</p>
                                </div>
                            </div>
                            <div class="card-body">
                                <p>Jenis Order : {{ $rp->report_type }}</p>
                                <p>No SC : {{ $rp->report_number }}</p>
                                <p>Deskripsi : {{ $rp->report_value }} , {{ $rp->report_detail }}</p>
                            </div>
                            <div class="card-footer text-center">
                                <div class="row">
                                    <div class="col">
                                        <a class="btn btn-primary btn-block "
                                            href="{{ route('report.edit', $rp->id) }}">Update !</a>
                                    </div>
                                    @if (Auth::user()->admin == 1)
                                        <div class="col">
                                            <form action="{{ route('report.destroy', $rp->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-block"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Delete</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <br>
                    @endif
                @endforeach
                <br>
            </div>
        </div>
        <div class="col card border-danger bg-transparent rounded shadow" style="margin: 10px">
            <div class="container" style="padding: 0px">
                <br>
                <h4 class="text-danger text-center">OGP</h4>
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
                                    <p>Pelapor :
                                        <a href="https://t.me/{{ $rp->report_sender }}" target="_blank"
                                            rel="noopener noreferrer">{{ $rp->report_sender }} </a>
                                    </p>
                                    <p>Update by <br> OPEN to OGP : {{ $rp->open_ogp }}</p>
                                    <p>Status : {{ $rp->report_status }}</p>
                                    <p>Tanggal Waktu Buat : {{ $rp->created_at }}</p>
                                    <p>Tanggal Waktu Update : {{ $rp->updated_at }}</p>
                                </div>
                            </div>
                            <div class="card-body">
                                <p>Jenis Order : {{ $rp->report_type }}</p>
                                <p>No SC : {{ $rp->report_number }}</p>
                                <p>Deskripsi : {{ $rp->report_value }} , {{ $rp->report_detail }}</p>
                            </div>
                            <div class="card-footer text-center">
                                <div class="row">
                                    <div class="col">
                                        <a class="btn btn-primary btn-block "
                                            href="{{ route('report.edit', $rp->id) }}">Update !</a>
                                    </div>
                                    @if (Auth::user()->admin == 1)
                                        <div class="col">
                                            <form action="{{ route('report.destroy', $rp->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-block"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Delete</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <br>
                    @endif
                @endforeach
                <br>
            </div>
        </div>
        <div class="col card border-danger bg-transparent rounded shadow" style="margin: 10px">
            <div class="container" style="padding: 0px">
                <br>
                <h4 class="text-danger text-center">ESKALASI</h4>
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
                                    <p>Pelapor :
                                        <a href="https://t.me/{{ $rp->report_sender }}" target="_blank"
                                            rel="noopener noreferrer">{{ $rp->report_sender }} </a>
                                    </p>
                                    <p>Update by <br> OGP to ESKALASI : {{ $rp->ogp_eskalasi }}</p>
                                    <p>Status : {{ $rp->report_status }}</p>
                                    <p>Tanggal Waktu Buat : {{ $rp->created_at }}</p>
                                    <p>Tanggal Waktu Update : {{ $rp->updated_at }}</p>
                                </div>
                            </div>
                            <div class="card-body">
                                <p>Jenis Order : {{ $rp->report_type }}</p>
                                <p>No SC : {{ $rp->report_number }}</p>
                                <p>Deskripsi : {{ $rp->report_value }} , {{ $rp->report_detail }}</p>
                            </div>
                            <div class="card-footer text-center">
                                <div class="row">
                                    <div class="col">
                                        <a class="btn btn-primary btn-block "
                                            href="{{ route('report.edit', $rp->id) }}">Update !</a>
                                    </div>
                                    @if (Auth::user()->admin == 1)
                                        <div class="col">
                                            <form action="{{ route('report.destroy', $rp->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-block"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Delete</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <br>
                    @endif
                @endforeach
                <br>
            </div>
        </div>
        <div class="col card border-danger bg-transparent rounded shadow" style="margin: 10px">
            <div class="container" style="padding: 0px">
                <br>
                <h4 class="text-danger text-center">CLOSED</h4>
                <br>
                @foreach ($report as $rp)
                    @if ($rp->report_status == 'closed')
                        @if (Carbon\Carbon::parse($rp->updated_at)->format('Y-m-d') == Carbon\Carbon::now()->format('Y-m-d'))
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
                                        <p>Pelapor :
                                            <a href="https://t.me/{{ $rp->report_sender }}" target="_blank"
                                                rel="noopener noreferrer">{{ $rp->report_sender }} </a>
                                        </p>
                                        <p>Update by <br> ESKALASI to CLOSED : {{ $rp->eskalasi_closed }}</p>
                                        <p>OGP to CLOSED : {{ $rp->ogp_closed }}</p>
                                        <p>Status : {{ $rp->report_status }}</p>
                                        <p>Tanggal Waktu Buat : {{ $rp->created_at }}</p>
                                        <p>Tanggal Waktu Update : {{ $rp->updated_at }}</p>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p>Jenis Order : {{ $rp->report_type }}</p>
                                    <p>No SC : {{ $rp->report_number }}</p>
                                    <p>Deskripsi : {{ $rp->report_value }} , {{ $rp->report_detail }}</p>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="row">
                                        <div class="col">
                                            {{-- href --}}
                                            {{-- https://api.telegram.org/bot1786482522:AAEKQOpHgMgtWV_IVpGv9Ldz6c_j57Eal04/sendMessage?chat_id={{ $rp->report_idsender }}&text=Halo%20Moban%20dengan%20id%20{{ $rp->id }}%20sudah%20di%20close%20 --}}
                                            <a class="btn btn-success" target="_blank"
                                                href="https://api.telegram.org/bot1786482522:AAEKQOpHgMgtWV_IVpGv9Ldz6c_j57Eal04/sendMessage?chat_id={{ $rp->report_idsender }}&text=Halo%20Moban%20dengan%20id%20{{ $rp->id }}%20sudah%20di%20close%20">Notif
                                                !</a>
                                        </div>
                                        <script type="text/javascript">
                                            // function AlertIt({{ $rp->id }}) {
                                            //     var http = new XMLHttpRequest();
                                            //     var url =
                                            //         "https://api.telegram.org/bot1786482522:AAEKQOpHgMgtWV_IVpGv9Ldz6c_j57Eal04/sendMessage?chat_id={{ $rp->report_idsender }}&text=Halo%20Moban%20dengan%20id%20{{ $rp->id }}%20sudah%20di%20close%20";
                                            //     var params = 'orem=ipsum&name=binny';
                                            //     http.open('POST', url, true);
                                            //     http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                                            //     http.onreadystatechange = function() { //Call a function when the state changes.
                                            //         if (http.readyState == 4 && http.status == 200) {
                                            //             alert('Message Send!');
                                            //         }
                                            //     }
                                            //     http.send(params);
                                            }
                                        </script>
                                        @if (Auth::user()->admin == 1)
                                            <div class="col">
                                                <form action="{{ route('report.destroy', $rp->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-block"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Delete</button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <br>
                        @endif
                    @endif
                @endforeach
                <br>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        window.setTimeout(function() {
            window.location.reload();
        }, 20000);
    </script>
@endsection
