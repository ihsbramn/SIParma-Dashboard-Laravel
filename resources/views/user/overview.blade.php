@extends('layouts.performansi')

@section('usershow')
    <div class="container text-center">
        <h2 style="font-weight: bold; font-size: 25px; color: #F44336; padding-top: 20px; padding-bottom: 10px">
            today performance data</h2>
        <p>(Closed data)</p>
    </div>


    <br>
    <div class="container">
        <center>
            <div class="chart" id="chart" style=" width:600px"></div>
        </center>
        @foreach ($performance as $pr)
            @if ($pr->update_status == 'ogp_closed')
                <p>{{ $pr->user_name }}</p>
            @endif
        @endforeach
    </div>
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
                    text: 'Closed Count'
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
                name: 'Closed in Count',
                data: [49.9, 71.5, 106.4, 129.2]
            }]
        });
    </script>
@endsection
