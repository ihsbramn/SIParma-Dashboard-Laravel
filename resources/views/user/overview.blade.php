@extends('layouts.performansi')

@section('usershow')
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
@endsection

@section('script')
    {{-- <script src="https://code.highcharts.com/highcharts.js"></script>
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
    </script> --}}
@endsection
