@extends('layouts.app')


@section('content')
    <h1 class="text-center">Report</h1>

    <div class="container">
        <div class="row">
            <div class="col">
                Search
            </div>
            <div class="col">
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            <div class="col">
                Tanggal
            </div>
            <div class="col">
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            <div class="col">
                <label class="form-check-label" for="">Sampai</label>
            </div>
            <div class="col">
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
        </div>
    </div>

    <table class="table" style="text-align: center">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Report Type</th>
                <th scope="col">Report Number</th>
                <th scope="col">Report Value</th>
                <th scope="col">Report Detail</th>
                <th scope="col">Report ID Sender</th>
                <th scope="col">Report Sender</th>
                <th scope="col">Report Status</th>
                <th scope="col">last updated by</th>
                <th scope="col">Option</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($report as $rp)
                <tr>
                    <th>{{ $rp->id }}</th>
                    <td>{{ $rp->report_type }}</td>
                    <td>{{ $rp->report_number }}</td>
                    <td>{{ $rp->report_value }}</td>
                    <td>{{ $rp->report_detail }}</td>
                    <td>{{ $rp->report_idsender }}</td>
                    <td>{{ $rp->report_sender }}</td>
                    <td>{{ $rp->report_status }}</td>
                    <td>{{ $rp->open_ogp }}</td>
                    <td>
                        <ul>
                            <li style="list-style: none;display: inline;">
                                <button type="button" class="btn btn-link" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal{{ $rp->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                    </svg>
                                </button>
                            </li>
                            <li style="list-style: none;display: inline;">
                                <button type="button" class="btn btn-link" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" style="color: red">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                        <path fill-rule="evenodd"
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                    </svg>
                                </button>
                            </li>
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    @foreach ($report as $rp)
        <div class="modal fade" id="exampleModal{{ $rp->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ID : {{ $rp->id }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <ul style="list-style: none;display: inline;">
                                    <li>Type : {{ $rp->report_type }}</li>
                                    <li>Number : {{ $rp->report_number }}</li>
                                    <li>Value : {{ $rp->report_value }}</li>
                                    <li>Details : {{ $rp->report_detail }}</li>
                                </ul>
                            </div>

                            <div class="col">
                                <ul style="list-style: none;display: inline;">
                                    <li>ID Telegram Sender : {{ $rp->report_idsender }}</li>
                                    <li>Sender Name : {{ $rp->report_sender }}</li>
                                    <li>Status : {{ $rp->report_status }}</li>
                                </ul>
                            </div>
                        </div>
                        <table class="table" style="text-align: center">
                            <thead>
                                <tr>
                                    <th scope="col">open-ogp</th>
                                    <th scope="col">ogp-eskalasi</th>
                                    <th scope="col">ogp-closed</th>
                                    <th scope="col">eskalasi-closed</th>
                                    <th scope="col">created at</th>
                                    <th scope="col">updated at</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $rp->open_ogp }}</td>
                                    <td>{{ $rp->ogp_eskalasi }}</td>
                                    <td>{{ $rp->ogp_closed }}</td>
                                    <td>{{ $rp->eskalasi_closed }}</td>
                                    <td>{{ $rp->created_at }}</td>
                                    <td>{{ $rp->updated_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
