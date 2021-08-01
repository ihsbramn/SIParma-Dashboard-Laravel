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
            var refresh = 3000; // Refresh rate in milli seconds
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
    <div class="container" style="margin-top: 25px">
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
                <form class="form" method="get" action="{{ route('home.filter') }}">
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
                                    <p>Telegram Pelapor :
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
                                            href="{{ route('report.edit', $rp->id) }}">Update</a>
                                    </div>
                                    {{-- <div class="col">
                                        <button class="reqlam btn btn-success"
                                            href="https://api.telegram.org/bot{{ config('app.token') }}/sendMessage?chat_id={{ $rp->report_idsender }}&text=Halo%20{{ $rp->sender_name }}%20permintaan%20anda%20dengan%20id%20{{ $rp->id }}%20mohon%20dikirimkan%20lampiran-nya%20ke%20%40{{ Auth::user()->teleuser }}%20%2F%20{{ Auth::user()->name }}%20Melalui%20telegram%0A%0ATerimakasih%20%F0%9F%98%80">
                                            Lampiran</button> --}}
                                    {{-- modal --}}
                                    {{-- <div class="modal fade" id="modallampiran" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"
                                                            style=" text-align: center;">Status
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><b>Request Lampiran Telah dikirim !</b></p>
                                                        <p>mohon cek pelapor melalui telegram yang tertera </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                    {{-- modal --}}
                                    {{-- <script type="text/javascript">
                                            $(".reqlam").unbind().click(function() {b
                                                var url = $(this).attr("href");
                                                console.log(url);
                                                var exe = $.post(url, function() {
                                                    $('#modallampiran').modal('show');
                                                    const audio = new Audio(
                                                        'http://commondatastorage.googleapis.com/codeskulptor-assets/week7-brrring.m4a');
                                                    audio.play();
                                                })
                                            });
                                        </script>
                                    </div> --}}
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
                                    <p>Telegram Pelapor :
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
                            {{-- collapse send photo --}}
                            <button class="btn btn-light" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapsephoto{{ $rp->id }}" aria-expanded="false"
                                aria-controls="collapse{{ $rp->id }}">
                                Send Photo
                            </button>
                            <div class="collapse" id="collapsephoto{{ $rp->id }}">
                                <div class="container">
                                    <form method="POST" target="_blank"
                                        action="https://api.telegram.org/bot{{ config('app.token') }}/sendPhoto"
                                        enctype="multipart/form-data">
                                        <input type="text" name="chat_id" value="{{ config('app.idgroup') }}" hidden />
                                        <input type="text" name="reply_to_message_id" value="{{ $rp->msg_id }}" hidden />
                                        <input type="text" name="allow_sending_without_reply" value="true" hidden />
                                        <br />
                                        <input class="form-control" type="text" name="caption" placeholder="caption" />
                                        <br />
                                        <input class="form-control" type="file" name="photo" />
                                        <br />
                                        <div class="container text-center">
                                            <input class="btn btn-outline-primary" type="submit" value="Send" />
                                        </div>
                                    </form>
                                    <br>
                                </div>
                            </div>
                            {{-- collapse send photo --}}
                            <div class="card-footer text-center">
                                <div class="row">
                                    <div class="col">
                                        <a class="btn btn-primary btn-block "
                                            href="{{ route('report.edit', $rp->id) }}">Update</a>
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
                                    <p>Telegram Pelapor :
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
                            {{-- collapse send photo --}}
                            <button class="btn btn-light" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapsephoto{{ $rp->id }}" aria-expanded="false"
                                aria-controls="collapse{{ $rp->id }}">
                                Send Photo
                            </button>
                            <div class="collapse" id="collapsephoto{{ $rp->id }}">
                                <div class="container">
                                    <form method="POST" target="_blank"
                                        action="https://api.telegram.org/bot{{ config('app.token') }}/sendPhoto"
                                        enctype="multipart/form-data">
                                        <input type="text" name="chat_id" value="{{ config('app.idgroup') }}" hidden />
                                        <input type="text" name="reply_to_message_id" value="{{ $rp->msg_id }}" hidden />
                                        <input type="text" name="allow_sending_without_reply" value="true" hidden />
                                        <br />
                                        <input class="form-control" type="text" name="caption" placeholder="caption" />
                                        <br />
                                        <input class="form-control" type="file" name="photo" />
                                        <br />
                                        <div class="container text-center">
                                            <input class="btn btn-outline-primary" type="submit" value="Send" />
                                        </div>
                                    </form>
                                    <br>
                                </div>
                            </div>
                            {{-- collapse send photo --}}
                            <div class="card-footer text-center">
                                <div class="row">
                                    <div class="col">
                                        <a class="btn btn-primary btn-block "
                                            href="{{ route('report.edit', $rp->id) }}">Update</a>
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
                                        <p>Telegram Pelapor :
                                            <a href="https://t.me/{{ $rp->report_sender }}" target="_blank"
                                                rel="noopener noreferrer">{{ $rp->report_sender }} </a>
                                        </p>
                                        <p>Update by <br> ESKALASI to CLOSED : {{ $rp->eskalasi_closed }}
                                        </p>
                                        <p>OGP to CLOSED : {{ $rp->ogp_closed }}</p>
                                        <p>Status : {{ $rp->report_status }}</p>
                                        <p>Tanggal Waktu Buat : {{ $rp->created_at }}</p>
                                        <p>Tanggal Waktu Update : {{ $rp->updated_at }}</p>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p>Jenis Order : {{ $rp->report_type }}</p>
                                    <p>No SC : {{ $rp->report_number }}</p>
                                    <p>Deskripsi : {{ $rp->report_value }} , {{ $rp->report_detail }}
                                    </p>
                                </div>
                                {{-- collapse send photo --}}
                                <button class="btn btn-light" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapsephoto{{ $rp->id }}" aria-expanded="false"
                                    aria-controls="collapse{{ $rp->id }}">
                                    Send Photo
                                </button>
                                <div class="collapse" id="collapsephoto{{ $rp->id }}">
                                    <div class="container">
                                        <form method="POST" target="_blank"
                                            action="https://api.telegram.org/bot{{ config('app.token') }}/sendPhoto"
                                            enctype="multipart/form-data">
                                            <input type="text" name="chat_id" value="{{ config('app.idgroup') }}"
                                                hidden />
                                            <input type="text" name="reply_to_message_id" value="{{ $rp->msg_id }}"
                                                hidden />
                                            <input type="text" name="allow_sending_without_reply" value="true" hidden />
                                            <br />
                                            <input class="form-control" type="text" name="caption" placeholder="caption" />
                                            <br />
                                            <input class="form-control" type="file" name="photo" />
                                            <br />
                                            <div class="container text-center">
                                                <input class="btn btn-outline-primary" type="submit" value="Send" />
                                            </div>
                                        </form>
                                        <br>
                                    </div>
                                </div>
                                {{-- collapse send photo --}}
                                <div class="card-footer text-center">
                                    <div class="row">
                                        <div class="col">
                                            <button class="notif btn btn-success"
                                                href="https://api.telegram.org/bot{{ config('app.token') }}/sendMessage?chat_id={{ $rp->report_idsender }}&text=Halo%20{{ $rp->sender_name }}%20permintaan%20anda%20dengan%20id%20{{ $rp->id }}%20sudah%20di%20close%20">Notif</button>
                                        </div>
                                        {{-- modal --}}
                                        <div class="modal fade" id="modalnotif" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header text-center">
                                                        <h5 class="modal-title" id="exampleModalLabel"
                                                            style=" text-align: center;">Status</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p><b>Notif Telah dikirim !</b></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- modal --}}
                                        <script type="text/javascript">
                                            $(".notif").unbind().click(function() {
                                                var url = $(this).attr("href");
                                                console.log(url);
                                                var exe = $.post(url, function() {
                                                    $('#modalnotif').modal('show');
                                                })
                                            });
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
        }, 30000);
    </script>
@endsection
