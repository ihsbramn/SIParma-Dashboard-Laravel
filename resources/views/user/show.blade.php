@extends('layouts.performansi')

@section('user')
    <br>
    <div class="container">
        <a href="javascript: history.go(-1)" class="">Back</a>
        <br>
        <hr>
        <div class="row bg-light shadow rounded">
            <h5 class=" text-center"> Data User </h5>
            <hr>
            <p>Nama : {{ $user->name }}</p>
            <p>Email : {{ $user->email }}</p>

            <br>

            <table class="table table-hover ml-2">
                <thead>
                    <tr>
                        <th scope="col">Status</th>
                        <th scope="col">Last Seen</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            @if (Cache::has('user-is-online-' . $user->id))
                                <span class="text-success">Online</span>
                            @else
                                <span class="text-secondary">Offline</span>
                            @endif
                        </td>
                        <td>
                            @if ($user->last_seen != null)
                                {{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}
                            @else
                                No data
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>


            <br>
            <br>
        </div>
        <br>
    </div>

@endsection

@section('isi')
    <div class="container">
        <br>
        <div class="chart" id="chart">
        </div>
    </div>
    <div class="row">
        <div class="col">

        </div>
        <div class="col">

        </div>
    </div>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col"> #</th>
                        <th scope="col">User ID</th>
                        <th scope="col">ID Moban</th>
                        <th scope="col">Updated by</th>
                        <th scope="col">No. Order</th>
                        <th scope="col">Update Status</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                @foreach ($performance as $pr)
                    {{-- @if ($pr->user_id == $user->id) --}}
                    <tbody>
                        <tr>
                            <th scope="row"></th>
                            <td>{{ $pr->user_id }}</td>
                            <td>{{ $pr->id_moban }}</td>
                            <td>{{ $pr->user_name }}</td>
                            <td>{{ $pr->no_order }}</td>
                            <td>{{ $pr->update_status }}</td>
                            <td>{{ $pr->created_at }}</td>
                        </tr>
                    </tbody>
                    {{-- @endif --}}
                @endforeach
            </table>
        </div>

    </div>
@endsection

@section('script')
    <script src="https://code.highcharts.com/highcharts.js"></script>

    <script>
        Highcharts.chart('chart', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'User Performance'
            },
            subtitle: {
                text: 'Last 30 days Data'
            },
            xAxis: {
                categories: ['Open -> OGP', 'OGP -> Eskalasi', 'OGP -> Closed', 'Eskalasi -> Closed']
            },

            yAxis: {
                min: 0,
                title: {
                    text: 'Count'
                }
            },
            series: [{
                name: 'Status',
                data: [{
                    name: 'Open -> OGP',
                    color: '#e39400',
                    y: {{ $open_ogp }}
                }, {
                    name: 'OGP -> Eskalasi',
                    color: '#0aa9ff',
                    y: {{ $ogp_eskalasi }}
                }, {
                    name: 'OGP -> Closed',
                    color: '#1e4afa',
                    y: {{ $ogp_closed }}
                }, {
                    name: 'Eskalasi -> Closed',
                    color: '#03d100',
                    y: {{ $eskalasi_closed }}
                }]
            }, ]
        });
    </script>
@endsection
