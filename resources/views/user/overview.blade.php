@extends('layouts.performansi')

@section('usershow')
    <div class="row" style="margin-top: 15px">
        <div class="col-2">
            <a href="javascript: history.go(-1)" class="btn btn-danger shadow" style="margin-left: 20px">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-chevron-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                </svg>
                Back
            </a>
            <br>
        </div>
        <div class="col-8">
            <h2 class="text-center" style="font-weight: bold; font-size: 25px; color: #F44336; padding-top: 5px"> Today User
                Performance "Closed"
            </h2>
        </div>
        <br>
    </div>
    <br>
    <br>
    <br>
    <div class="container">
        <center>
            <div class="chart responsive" id="chart" style=" width:1200px; height:580px;"></div>
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
