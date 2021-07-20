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
    <div class="container">
        @foreach ($performance as $pr)
            @if ($pr->user_id == $user->id)
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">User ID</th>
                            <th scope="col">ID Moban</th>
                            <th scope="col">Updated by</th>
                            <th scope="col">No. Order</th>
                            <th scope="col">Update Status</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $pr->id }}</td>
                            <td>{{ $pr->user_id }}</td>
                            <td>{{ $pr->id_moban }}</td>
                            <td>{{ $pr->user_name }}</td>
                            <td>{{ $pr->no_order }}</td>
                            <td>{{ $pr->update_status }}</td>
                            <td>{{ $pr->created_at }}</td>
                            <td>{{ $pr->updated_at }}</td>
                        </tr>
                    </tbody>
                </table>
            @endif
        @endforeach
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
                text: 'Grafik Performansi'
            },
            subtitle: {
                text: '7 hari kebelakang'
            },
            xAxis: {
                categories: [
                    '1',
                    '2',
                    '3',
                    '4',
                    '5',
                    '6',
                    '7'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'open_ogp',
                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0]

            }, {
                name: 'ogp_eskalasi',
                data: [83.6, 78.8, 98.5, 93.4, 106.0, 84.5, 105.0]

            }, {
                name: 'ogp_closed',
                data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0]

            }, {
                name: 'eskalasi_closed',
                data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4]

            }]
        });
    </script>
@endsection
