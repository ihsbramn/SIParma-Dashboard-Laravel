@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <br>
        <h1 class="text-center">Moban Update</h1>
        <br>

        <div class="card">
            <form action="{{ route('report.update', $report->id) }}" method="POST">
                <div class="card-header">

                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col">
                            <div class="label">ID Moban : <b>{{ $report->id }}</b> </div>
                        </div>
                        <div class="col">
                            <input type="text" name="id" class="form-control" value="{{ $report->id }}" readonly hidden>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="label">No. SC : <b>{{ $report->report_number }}</b> </div>
                        </div>
                        <div class="col">
                            <input type="text" name="report_number" class="form-control"
                                value="{{ $report->report_number }}" readonly hidden>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="label">Deskripsi : <b>{{ $report->report_value }}
                                    {{ $report->report_detail }}</b>
                            </div>
                        </div>
                        <div class="col">
                            <input type="text" name="report_value" class="form-control"
                                value="{{ $report->report_value }}" readonly hidden>
                            <input type="text" name="report_detail" class="form-control"
                                value="{{ $report->report_detail }}" readonly hidden>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="label">Pelapor : <a href="https://t.me/{{ $report->report_sender }}"
                                    target="_blank" rel="noopener noreferrer"><b>{{ $report->report_sender }}</a>
                                </b> </div>
                        </div>
                        <div class="col">
                            <input type="text" name="report_sender" class="form-control"
                                value="{{ $report->report_sender }}" readonly hidden>
                            <input type="text" name="report_idsender" class="form-control"
                                value="{{ $report->report_idsender }}" readonly hidden>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="lable">Status : </div>
                        </div>
                        <div class="col">
                            @if ($report->report_status == 'open')
                                <select class="form-select" id="status" name="report_status"
                                    aria-label="Default select example">
                                    <option selected>{{ $report->report_status }}</option>
                                    <option value="ogp">ogp</option>
                                </select>
                            @endif
                            @if ($report->report_status == 'ogp')
                                <select class="form-select" id="statusogp" name="report_status"
                                    aria-label="Default select example">
                                    <option selected>{{ $report->report_status }}</option>
                                    <option value="eskalasi">eskalasi</option>
                                    <option value="closed">closed</option>
                                </select>
                            @endif
                            @if ($report->report_status == 'eskalasi')
                                <select class="form-select" id="status" name="report_status"
                                    aria-label="Default select example">
                                    <option selected>{{ $report->report_status }}</option>
                                    <option value="closed">closed</option>
                                </select>
                            @endif
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        @if ($report->report_status == 'open')
                            <div class="col">
                                <div class="label">Updated by (Open to Ogp) : </div>
                            </div>
                            <div class="col">
                                <input type="text" name="open_ogp" class="form-control" value="{{ Auth::user()->name }}"
                                    readonly>
                                <input type="text" name="open_ogp_time" class="form-control"
                                    value="{{ Carbon\Carbon::now()->format('H-i-s') }}" hidden>
                            </div>
                        @endif
                        <script>
                            $(function() {
                                $('#statusogp').change(function() {
                                    $('.ogpupdate').hide();
                                    $('#' + $(this).val()).show();
                                });
                            });
                        </script>
                        @if ($report->report_status == 'ogp')
                            <div class="ogpupdate" id="eskalasi" style="display:none">
                                <div class="form-group row">
                                    <div class="col">
                                        <div class="label">Updated by (Ogp to Eskalasi) : </div>
                                    </div>
                                    <div class="col">
                                        <select class="form-select" name="ogp_eskalasi" aria-label="Default select example">
                                            <option value=" "> </option>
                                            <option value="{{ Auth::user()->name }}">{{ Auth::user()->name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <div class="col">
                                        <div class="label" for="timestamp">Timestamp </div>
                                    </div>
                                    <div class="col">
                                        <input class="form-check-input" name="ogp_eskalasi_time" type="checkbox"
                                            value="{{ Carbon\Carbon::now()->format('H-i-s') }}" id="timestamp">
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($report->report_status == 'ogp')
                            <div class="ogpupdate" id="closed" style="display:none">
                                <div class="form-group row">
                                    <div class="col">
                                        <div class="label">Updated by (Ogp to Closed) : </div>
                                    </div>
                                    <div class="col">
                                        <select class="form-select" name="ogp_closed" aria-label="Default select example">
                                            <option value=" "> </option>
                                            <option value="{{ Auth::user()->name }}">{{ Auth::user()->name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <div class="col">
                                        <div class="label" for="timestamp">Timestamp </div>
                                    </div>
                                    <div class="col">
                                        <input class="form-check-input" name="ogp_closed_time" type="checkbox"
                                            value="{{ Carbon\Carbon::now()->format('H-i-s') }}" id="timestamp">
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($report->report_status == 'eskalasi')
                            <div class="col">
                                <div class="label">Updated by (Eskalasi to closed) : </div>
                            </div>
                            <div class="col">
                                <input type="text" name="eskalasi_closed" class="form-control"
                                    value="{{ Auth::user()->name }}" readonly>
                                <input type="text" name="eskalasi_closed_time" class="form-control"
                                    value="{{ Carbon\Carbon::now()->format('H-i-s') }}" hidden>
                            </div>
                        @endif

                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-inline text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    </div>
@endsection
