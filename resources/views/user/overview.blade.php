@extends('layouts.performansi')

@section('usershow')
    <div class="container text-center">
        <h2 style="font-weight: bold; font-size: 25px; color: #F44336; padding-top: 20px; padding-bottom: 10px">
            Today User performance Data</h2>
        <p>(Closed data)</p>
    </div>


    <br>
    <div class="container">
        <center>
            <div class="chart" id="chart" style=" width:600px"></div>
        </center>
        <br>
    </div>
    <br>
@endsection

@section('script')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>


    <script>
        Highcharts.chart('chart', {
            chart: {
                type: 'column'
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: {!! json_encode($namauser) !!},
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Count'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
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
                name: 'Closed',
                data: {!! json_encode($datauser) !!}
            }]
        });
    </script>
@endsection
