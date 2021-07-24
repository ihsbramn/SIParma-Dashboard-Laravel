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
        <input type="button" class="btn btn-primary" value="Print" onclick="printDiv()">
    </div>

@endsection

@section('isi')
    <div class="container">
        <br>
        <div class="chart" id="chart">
        </div>
    </div>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-hover" id="my_table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">User ID</th>
                        <th scope="col">ID Moban</th>
                        <th scope="col">Updated by</th>
                        <th scope="col">No. Order</th>
                        <th scope="col">Update Status</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                @foreach ($performance as $pr)
                    <tbody>
                        <tr>
                            <th scope="row">{{ $pr->id }}</th>
                            <td>{{ $pr->user_id }}</td>
                            <td>{{ $pr->id_moban }}</td>
                            <td>{{ $pr->user_name }}</td>
                            <td>{{ $pr->no_order }}</td>
                            <td>{{ $pr->update_status }}</td>
                            <td>{{ $pr->created_at }}</td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.highcharts.com/highcharts.js"></script>

    <script>
        function printDiv() {
            var divContents = document.getElementById("PFM").innerHTML;
            var a = window.open('', '', 'height=500, width=500');
            a.document.write('<html>');
            a.document.write('<body>');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.print();
        }
    </script>

    <script>
        Highcharts.chart('chart', {
            chart: {
                type: 'column'
            },
            title: {
                text: '{{ $user->name }} Performance Data'
            },
            subtitle: {
                text: 'Data for the last 30 days'
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
                    color: '#f2bd1f',
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
