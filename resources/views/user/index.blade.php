@extends('layouts.performansi')

@section('user')
    <div class="col bg-white shadow" style="border-radius: 1rem; height: 605px;">
        <h2
            style="font-weight: bold; font-size: 25px; color: #F44336; padding-left: 20px; padding-top: 20px; padding-bottom: 20px">
            user performance</h2>

        <div class="row">
            <?php $search = isset($_GET['search']) ? htmlentities($_GET['search']) : ''; ?>
            <form action={{ 'performansi.search' }} method="GET" class="input-group mb-3"
                style="padding-right: 30px; padding-left: 30px">
                <input type="text" name="search" value="<?= $search ?>" class="form-control" id="search"
                    placeholder="user name">
                <input type="submit" value="Search" class="btn btn-danger">
            </form>
        </div>

        <ul class="nav flex-column">
            <p class=" text-center" style="font-weight: bold; font-size: 20px; margin: 0px; margin-top: 15px"> List User</p>
            <hr class="mx-auto" style="width: 350px">

            <div class="row" style="padding-left: 40px; padding-right: 40px; padding-bottom: 10px">
                <a href="{{ 'overview/user' }}" type="button" class="btn btn-danger btn-sm d-grid">overview all user</a>
            </div>

            <div class="row" style="height: 330px; width: 400px; overflow:auto">
                @foreach ($user as $us)
                    <li class="nav-item hover">
                        <a class="nav-link" href="{{ route('user.show', $us->id) }}"
                            style="margin: 0px; padding: 0px; padding-left: 40px">{{ $us->name }}</a>
                    </li>
                    <br><br>
                @endforeach
            </div>

        </ul>
    </div>

@endsection
@section('isi')
    <div class="col bg-white shadow" style="border-radius: 1rem; height: 605px">
        <h2
            style="font-weight: bold; font-size: 25px; color: #F44336; padding-left: 20px; padding-top: 20px; padding-bottom: 10px">
            today performance data</h2>
        <figure class="highcharts-figure">
            <br>
            <p class="text-center" id='ct'></p>
            <br>
            <div id="container"></div>
            <br>
            <br>
        </figure>
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
