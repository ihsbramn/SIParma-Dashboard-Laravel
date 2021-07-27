@extends('layouts.performansi')

@section('user')
    <div class="row bg-white shadow " style="border-radius: 1rem;">
        <div class="col-6 col-md-4 bg-white shadow" style="border-radius: 1rem;">
            <ul class="nav flex-column">
                <br>
                <p class=" text-center"><b>User Performance</b> </p>
                <hr>
                <p class=" text-center"> List User</p>
                @foreach ($user as $us)
                    <li class="nav-item hover bg-white">
                        <a class="nav-link" href="{{ route('user.show', $us->id) }}">{{ $us->name }}</a>
                    </li>
                @endforeach
                <br>
            </ul>
        </div>

    @endsection

    @section('isi')
        <div class="col-md-8">
            <figure class="highcharts-figure">
                <br>
                <h3 class=" text-center">Today Performance Data</h3>
                <p class="text-center" id='ct'></p>
                <br>
                <div id="container"></div>
                <br>
                <br>
            </figure>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
        Highcharts.chart('container', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: ''
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Count',
                colorByPoint: true,
                data: [{
                    name: 'Open -> OGP',
                    color: '#f2bd1f',
                    y: {{ $open_ogpi }}
                }, {
                    name: 'OGP -> Eskalasi',
                    color: '#0aa9ff',
                    y: {{ $ogp_eskalasii }}
                }, {
                    name: 'OGP -> Closed',
                    color: '#1e4afa',
                    y: {{ $ogp_closedi }}
                }, {
                    name: 'Eskalasi -> Closed',
                    color: '#1cbd00',
                    y: {{ $eskalasi_closedi }}
                }]
            }]
        });
    </script>
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
@endsection
